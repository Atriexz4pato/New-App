@extends('layouts.admin')

@section('title', 'Student Management')

@section('content')
    <!-- Main Content Area -->
    <div class="main-content teacher-dashboard">
        <div class="dashboard-content">
            <h1 class="mb-4">Student Management</h1>
            <div class="card">
                <div class="card-header">
                    List of Students
                    <a href="#" class="btn btn-primary float-end">Add New Student</a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($students->isEmpty())
                        <p class="text-center">No Students found.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>

                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                                                        <th>Department</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($students as $student)
                                    @php
                                        $user = \App\Models\User::where('id',$student->user_id)->first()
                                    @endphp
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone_number }}</td>
                                        <td>{{ $user->department }}</td>
{{--                                        <td>{{ $assessor->programme? }}</td>--}}
                                        <td>
                                            <a href="#" class="btn btn-sm btn-primary/..."><i class="fas fa-edit"></i> Edit</a>
                                            <form action="#" method="POST" style="display:inline;"
                                                  onsubmit="return confirm('Are you sure you want to delete this student?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{--                        {{ $assessors->links() }}--}}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .table-responsive {
        margin-top: 1rem;
    }

    .table th, .table td {
        vertical-align: middle;
    }

    .table th {
        background-color: #f8f9fa;
        font-weight: bold;
    }

    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }

    .alert {
        margin-bottom: 1rem;
    }

    .float-end {
        margin-left: 10px;
    }

    @media (max-width: 768px) {
        .table-responsive {
            overflow-x: auto;
        }
        .float-end {
            float: none !important;
            display: block;
            margin-top: 10px;
        }
    }
</style>
