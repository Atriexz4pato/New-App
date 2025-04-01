@extends('layouts.student')

@section('content')
    <div class="assessments-section">
        <h2 class="assessments-title">My Assessments</h2>
        <div class="assessments-container">
            @php
                $user = auth()->user();
                $student = $user->student;
                $assessments = $student->assessors ?? collect(); // Fallback to empty collection if no assessors
            @endphp

            @if ($assessments->isEmpty())
                <div class="alert alert-info" role="alert">
                    No assessments assigned yet.
                </div>
            @else
                <div class="row">
                    @foreach ($assessments as $assessor)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card assessment-card">
                                <div class="card-header">
                                    Assessment with {{ $assessor->name ?? 'Unknown Assessor' }}
                                </div>
                                <div class="card-body">
                                    <p><strong>Assessor Email:</strong> {{ $assessor->email ?? 'No email' }}</p>
                                    <p><strong>Assessment Date:</strong>
                                        {{ $assessor->pivot->assessment_date ?? 'Not scheduled' }}
                                    </p>
                                    <p><strong>Status:</strong>
                                        @if ($assessor->pivot->assessment_date && now()->lt($assessor->pivot->assessment_date))
                                            Upcoming
                                        @elseif ($assessor->pivot->assessment_date && now()->gte($assessor->pivot->assessment_date))
                                            Completed
                                        @else
                                            Not Scheduled
                                        @endif
                                    </p>
                                    <a href="#" class="btn btn-sm btn-outline-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .assessments-section {
            padding: 20px;
            background-color: #f1f3f5;
        }

        .assessments-title {
            color: #007bff;
            font-size: 1.5em;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }

        .assessments-container {
            padding: 0 15px;
        }

        .assessment-card {
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            transition: transform 0.2s;
        }

        .assessment-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #ffffff;
            color: #007bff;
            font-weight: 500;
        }

        .card-body p {
            color: #333;
            margin-bottom: 10px;
        }

        .card-body strong {
            color: #007bff;
        }

        .btn-outline-primary {
            color: #007bff;
            border-color: #007bff;
        }

        .btn-outline-primary:hover {
            background-color: #007bff;
            color: #ffffff;
        }

        @media (max-width: 768px) {
            .col-md-6.col-lg-4 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
    </style>
@endpush
