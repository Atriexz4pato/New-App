@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('content')
<main class="main-content">
    <div class="dashboard-content">
        <!-- Dashboard Header -->
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Admin Dashboard</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-download me-1"></i>Export
                    </button>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">Distribution</div>
                    <div class="card-body">
                        <h3 class="card-title">0</h3>
                        <p class="card-text">Counties</p>
                        <a href="#" class="btn btn-primary btn-sm">Create Course</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">Assessors</div>
                    <div class="card-body">
                        <h3 class="card-title">{{$assessorsCount}}</h3>
                        <p class="card-text">Assessors</p>
                        <a href="{{route('admin.manage_assessors')}}" class="btn btn-primary btn-sm">Manage Assessors</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">Students</div>
                    <div class="card-body">
                        <h3 class="card-title">{{$studentsCount}}</h3>
                        <p class="card-text">Enrolled Students</p>
                        <a href="{{route('admin.manage_students')}}" class="btn btn-primary btn-sm">Manage Students</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        Recent Activity
                    </div>
                    <div class="card-body">
                        <p>No recent activity</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        Quick Actions
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action">
                                <i class="fas fa-plus me-2"></i>Create New Course
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <i class="fas fa-file-upload me-2"></i>Upload Assignment
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <i class="fas fa-users me-2"></i>Invite Students
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</div>

@endsection


