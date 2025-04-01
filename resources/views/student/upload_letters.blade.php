@extends('layouts.student')
@section('content')
    <div class="content">
        <h1 class="mb-4">Upload Documents</h1>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Acceptance Letter Upload -->
        <div class="card mb-4">
            <div class="card-body">
                <h3 class="card-title mb-3">Upload Acceptance Letter</h3>
                <form method="POST" action="#" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="acceptance_letter" class="form-label">Acceptance Letter (PDF only, Max 2MB)</label>
                        <input type="file" class="form-control" id="acceptance_letter" name="acceptance_letter" accept="application/pdf" required>
                        @error('acceptance_letter')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-purple" onclick="return confirm('Are you sure you want to upload the acceptance letter?')">
                        Upload Acceptance Letter
                    </button>
                </form>
                @if(auth()->user()->student->acceptance_letter)
                    <div class="mt-3">
                        <label class="form-label">Current Acceptance Letter</label>
                        <p>
                            <a href="{{ Storage::url(auth()->user()->student->acceptance_letter) }}" target="_blank" class="text-decoration-none">View Uploaded Letter</a>
                        </p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Recommendation Letter Upload -->
        <div class="card mb-4">
            <div class="card-body">
                <h3 class="card-title mb-3">Upload Recommendation Letter</h3>
                <form method="POST" action="{{ route('student.upload.recommendation-letter') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="recommendation_letter" class="form-label">Recommendation Letter (PDF only, Max 2MB)</label>
                        <input type="file" class="form-control" id="recommendation_letter" name="recommendation_letter" accept="application/pdf" required>
                        @error('recommendation_letter')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-purple" onclick="return confirm('Are you sure you want to upload the recommendation letter?')">
                        Upload Recommendation Letter
                    </button>
                </form>
                @if(auth()->user()->student->recommendation_letter)
                    <div class="mt-3">
                        <label class="form-label">Current Recommendation Letter</label>
                        <p>
                            <a href="{{ Storage::url(auth()->user()->student->recommendation_letter) }}" target="_blank" class="text-decoration-none">View Uploaded Letter</a>
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection


