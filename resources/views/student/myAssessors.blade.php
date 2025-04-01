@extends('layouts.student')

@section('content')
    <div class="assessor-section">
        <h2 class="assessor-title">My Assessors</h2>
        <div class="assessor-cards">

           @foreach($assessors as $assessor)
            <div class="assessor-card">
                <div class="assessor-name">{{$assessor->user->name}}</div>
                <div class="contact-info">
                    <p><span>Role:</span> Supervisor</p>
                    <p><span>Email:</span> {{$assessor->user->email}}</p>
                    <p><span>Phone:</span> {{$assessor->user->phone_number}}</p>
                    <p><span>Department:</span> {{$assessor->user->department}}</p>
                </div>
            </div>


           @endforeach
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .assessor-section {
            padding: 20px;
        }

        .assessor-title {
            color: #003087; /* Matches layout navy blue */
            font-size: 1.5em;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }

        .assessor-cards {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }

        .assessor-card {
            background-color: #ffffff;
            padding: 15px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            width: calc(50% - 10px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .assessor-card:hover {
            transform: translateY(-5px);
        }

        .assessor-name {
            color: #003087; /* Matches layout navy blue */
            font-size: 1.2em;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .contact-info {
            line-height: 1.6;
            color: #333333;
        }

        .contact-info span {
            font-weight: bold;
            color: #003087; /* Matches layout navy blue */
        }

        @media (max-width: 768px) {
            .assessor-card {
                width: 100%;
            }
        }
    </style>
@endpush
