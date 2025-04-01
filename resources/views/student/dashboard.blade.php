@php use App\Models\Student; @endphp
@extends('layouts.student')
@section('title', 'Student Dashboard')
@section('content')
    <main class="main-content">
        <div class="dashboard-content">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Student Dashboard</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                    </div>
                </div>
            </div>

            <!-- Dashboard Widgets -->
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header">Upcoming Assessments</div>
                        <div class="card-body">
                            @php
                                $user = auth()->user();
                                $student = $user->student;
                                $assessments = $student->assessors; // Directly use the relationship
                                if ($assessments) {
                                    $assessments = $assessments->toArray();
                                } else {
                                    $assessments = [];
                                }
                            @endphp

                            @if (empty($assessments))
                                <p>No assessors assigned</p>
                            @else
                                @foreach ($assessments as $assessment)
                                    @php
                                        $assessor = \App\Models\User::find($assessment['user_id']);
                                    @endphp
                                    @if (isset($assessment['pivot']['assessment_date']) && !empty($assessment['pivot']['assessment_date']))
                                        <p>{{ $assessment['pivot']['assessment_date'] }} - {{ $assessor ? $assessor->name : 'Unknown Assessor' }}</p>
                                    @else
                                        <p>No assessment date set for {{ $assessor ? $assessor->name : ' Assessor Not Assigned' }}</p>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        @php
                            $user = auth()->user();
                            $location = $user->student->attachment_county ?? 'You have not Added Location';
                        @endphp
                        <div class="card-header">Your Location</div>
                        <div class="card-body">
                            <p>{{ $location }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Include the Modal Here -->
            @if ($showModal)
                @include('student.student_profile_modal')
            @endif
        </div>
    </main>
@endsection
