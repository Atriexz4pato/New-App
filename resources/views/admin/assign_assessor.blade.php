@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Assign Assessors to Students by County</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- County Filter Form -->
        <form method="GET" action="#" class="mb-4">
            <div class="row">
                <div class="col-md-6">
                    <label for="county" class="form-label">Filter Students by County</label>
                    <select class="form-control select2" id="county" name="county" onchange="this.form.submit()">
                        <option value="">Select County</option>
                        @foreach($counties as $county)
                            <option value="{{ $county }}" {{ $selectedCounty == $county ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('-', ' ', $county)) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>

        <!-- Display Filtered Students -->
        @if($selectedCounty && $students->isNotEmpty())
            <div class="mb-4">
                <h3>Students in {{ ucfirst(str_replace('-', ' ', $selectedCounty)) }}</h3>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Registration Number</th>
                        <th>Programme</th>
                        <th>Attachment Place</th>
                        <th>Current Assessors</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>{{ $student->user->name }}</td>
                            <td>{{ $student->registration_number }}</td>
                            <td>{{ ucfirst(str_replace('-', ' ', $student->programme)) }}</td>
                            <td>{{ $student->attachment_place }}</td>
                            <td>
                                @if($student->assessors->isNotEmpty())
                                    @foreach($student->assessors as $assessor)
                                        {{ $assessor->user->name }} (Order: {{ $assessor->pivot->assessment_order }}, Date: {{ $assessor->pivot->assessment_date }})<br>
                                    @endforeach
                                @else
                                    None
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Bulk Assignment Form -->
            <form action="{{route('assign_assessors')}}" method="POST">
                @csrf
                <input type="hidden" name="county" value="{{ $selectedCounty }}">

                <div class="mb-3">
                    <label for="first_assessor_id" class="form-label">First Assessor</label>
                    <select class="form-control select2" id="first_assessor_id" name="first_assessor_id" required>
                        <option value="">Select First Assessor</option>
                        @foreach($assessors as $assessor)

                                <option value="{{ $assessor->id }}">
                                    {{ $assessor->user->name }} {{ implode(', ', array_map(fn($c) => ucfirst(str_replace('-', ' ', $c)), $assessor->counties ?? [])) }}
                                </option>

                        @endforeach
                    </select>
                    @error('first_assessor_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="second_assessor_id" class="form-label">Second Assessor</label>
                    <select class="form-control select2" id="second_assessor_id" name="second_assessor_id" required>
                        <option value="">Select Second Assessor</option>
                        @foreach($assessors as $assessor)
{{--                            @if($assessor->hasCounty($selectedCounty))--}}
                                <option value="{{ $assessor->id }}">
                                    {{ $assessor->user->name }} {{ implode(', ', array_map(fn($c) => ucfirst(str_replace('-', ' ', $c)), $assessor->counties ?? [])) }}
                                </option>

                        @endforeach
                    </select>
                    @error('second_assessor_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="first_assessment_date" class="form-label">First Assessment Date</label>
                    <input type="date" class="form-control" id="first_assessment_date" name="first_assessment_date" required>
                    @error('first_assessment_date')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="second_assessment_date" class="form-label">Second Assessment Date</label>
                    <input type="date" class="form-control" id="second_assessment_date" name="second_assessment_date" required>
                    @error('second_assessment_date')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to assign these assessors to all students in {{ ucfirst(str_replace('-', ' ', $selectedCounty)) }}?')">Assign Assessors to All Students</button>
            </form>
        @elseif($selectedCounty)
            <div class="alert alert-warning">No students found in {{ ucfirst(str_replace('-', ' ', $selectedCounty)) }}.</div>
        @endif
    </div>

    <!-- Include Select2 for better dropdowns -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('.select2').select2({
                    placeholder: "Select an option",
                    allowClear: true,
                    width: '100%',
                    minimumResultsForSearch: 1
                });
            });
        </script>
    @endpush
@endsection
