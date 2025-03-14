@extends('layouts.admin')

@section('title', $assessor ? 'Edit Assessor' : 'Add New Assessor')

@section('content')
    <!-- Main Content Area -->
    <div class="main-content teacher-dashboard">
        <div class="dashboard-content">
            <h1 class="mb-4">{{ $assessor ? 'Edit Assessor' : 'Add New Assessor' }}</h1>
            <div class="card">
                <div class="card-header">
                    {{ $assessor ? 'Edit Assessor Details' : 'Assessor Details' }}
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ $assessor ? route('admin.update_assessor', $assessor->id) : route('admin.store_new_assessor') }}" method="POST" class="assessor-form">
                        @csrf
                            @if($assessor)
                                @method('PUT')
                            @endif
                        @php
                            if ($assessor){
                                $user = \App\Models\User::where('id', $assessor->user_id)->first();
                            }
                             @endphp


                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name ?? '') }}" required>
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="employee_id" class="form-label">Staff ID</label>
                                    <input type="text" class="form-control" id="employee_id" name="employee_id" value="{{ old('employee_id', $assessor->employee_id ?? '') }}" required>
                                    @error('employee_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required>
                                    @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number ?? '') }}">
                                    @error('phone_number')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="department" class="form-label">Department</label>
                                    <select class="form-select" id="department" name="department" required>
                                        <option value="">Select Department</option>
                                        <option value="computer-science" @if(old('department', $assessor->department ?? '') == 'computer-science') selected @endif>Computer Science</option>
                                        <option value="mathematics" @if(old('department', $assessor->department ?? '') == 'mathematics') selected @endif>Mathematics</option>
                                        <option value="physics" @if(old('department', $assessor->department ?? '') == 'physics') selected @endif>Physics</option>
                                        <option value="business" @if(old('department', $assessor->department ?? '') == 'business') selected @endif>Business</option>
                                    </select>
                                    @error('department')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role" class="form-label">Role</label>
                                    <select class="form-select" id="role" name="role" required>
                                        <option value="">Select Role</option>
                                        <option value="assessor" @if(old('role', $assessor->role ?? '') == 'assessor') selected @endif>Assessor</option>
                                        <option value="senior-assessor" @if(old('role', $assessor->role ?? '') == 'senior-assessor') selected @endif>Senior Assessor</option>
                                        <option value="admin" @if(old('role', $assessor->role ?? '') == 'admin') selected @endif>Admin</option>
                                    </select>
                                    @error('role')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">{{ $assessor ? 'Update Assessor' : 'Add Assessor' }}</button>
                                    <a href="{{ route('admin.manage_assessors') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .assessor-form .form-group {
        margin-bottom: 1.5rem;
    }

    .card {
        border: none;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        border-bottom: 1px solid #e0e0e0;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .btn-secondary {
        background-color: #f8f9fa;
        border-color: #e0e0e0;
        color: #333;
    }

    .btn-secondary:hover {
        background-color: #e0e0e0;
        border-color: #d0d0d0;
    }

    .text-danger {
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    .alert {
        margin-bottom: 1rem;
    }

    @media (max-width: 768px) {
        .row.g-3 > .col-md-6 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
</style>
