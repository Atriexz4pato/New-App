@extends('layouts.student')

@section('content')
    <!-- Toast Container -->
    <div class="position-fixed  end-0 p-3" style="z-index: 1050;">
        <div id="successToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
            <div class="toast-header">
                <strong class="me-auto text-purple">Success</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <span id="toastMessage"></span>
            </div>
        </div>
    </div>

    <div class="content">
        <h1 class="mb-4">Upload Documents</h1>

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
                <form method="POST" action="{{ route('upload.acceptance_letter') }}" enctype="multipart/form-data" id="acceptanceForm">
                    @csrf
                    <div class="mb-3">
                        <label for="acceptance_letter" class="form-label">Acceptance Letter (PDF only, Max 2MB)</label>
                        <input type="file" class="form-control" id="acceptance_letter" name="acceptance_letter" accept="application/pdf" required>
                        @error('acceptance_letter')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-purple" id="acceptanceUploadBtn">
                        <span id="acceptanceBtnText">Upload Acceptance Letter</span>
                        <span id="acceptanceLoadingSpinner" class="spinner-border spinner-border-sm d-none" role="status"></span>
                    </button>
                </form>
                @if(auth()->user()->student->acceptance_letter_path)
                    <div class="mt-3">
                        <label class="form-label">Current Acceptance Letter</label>
                        <p>
                            <a href="{{ Storage::url(auth()->user()->student->acceptance_letter_path) }}" target="_blank" class="text-decoration-none">View Uploaded Letter</a>
                        </p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Recommendation Letter Upload -->
        <div class="card mb-4">
            <div class="card-body">
                <h3 class="card-title mb-3">Upload Recommendation Letter</h3>
                <form method="POST" action="#" enctype="multipart/form-data" id="recommendationForm">
                    @csrf
                    <div class="mb-3">
                        <label for="recommendation_letter" class="form-label">Recommendation Letter (PDF only, Max 2MB)</label>
                        <input type="file" class="form-control" id="recommendation_letter" name="recommendation_letter" accept="application/pdf" required>
                        @error('recommendation_letter')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-purple" id="recommendationUploadBtn">
                        <span id="recommendationBtnText">Upload Recommendation Letter</span>
                        <span id="recommendationLoadingSpinner" class="spinner-border spinner-border-sm d-none" role="status"></span>
                    </button>
                </form>
                @if(auth()->user()->student->recommendation_letter_path)
                    <div class="mt-3">
                        <label class="form-label">Current Recommendation Letter</label>
                        <p>
                            <a href="{{ Storage::url(auth()->user()->student->recommendation_letter_path) }}" target="_blank" class="text-decoration-none">View Uploaded Letter</a>
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        /* General Styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        /* Content Area */
        .content {
            padding: 20px;
            margin-left: 250px; /* Match sidebar width */
            min-height: calc(100vh - 120px); /* Adjust for header/footer */
            overflow-y: auto;
        }

        h1 {
            color: #333;
            font-weight: 600;
        }

        h3.card-title {
            color: #333;
            font-size: 1.25rem;
            font-weight: 500;
        }

        /* Cards */
        .card {
            background-color: #fff;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 20px;
        }

        /* Form Elements */
        .form-label {
            font-weight: 500;
            color: #333;
        }

        .form-control {
            border-radius: 4px;
            border-color: #ced4da;
        }

        .form-control:focus {
            border-color: #6f42c1;
            box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.25);
        }

        /* Buttons */
        .btn-purple {
            background-color: #6f42c1;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            color: #fff;
            transition: background-color 0.3s;
        }

        .btn-purple:hover {
            background-color: #5a2e9d;
        }

        /* Alerts */
        .alert {
            border-radius: 4px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        /* Error Messages */
        .text-danger {
            font-size: 0.875rem;
        }

        /* Links */
        a.text-decoration-none:hover {
            text-decoration: underline;
        }

        /* Toast Styling */
        .toast {
            background-color: #fff;
            border: 1px solid #e9ecef;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .toast-header {
            background-color: #f8f9fa;
            color: #333;
        }

        .text-purple {
            color: #6f42c1;
        }

        .toast-body {
            color: #333;
        }
    </style>
@endpush

@push('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script>
        $(document).ready(function() {
            // File input validation for acceptance letter
            $('#acceptance_letter').on('change', function() {
                const file = this.files[0];
                const maxSize = 2 * 1024 * 1024; // 2MB in bytes
                const allowedTypes = ['application/pdf'];

                if (file) {
                    if (!allowedTypes.includes(file.type)) {
                        alert('Please upload a PDF file.');
                        this.value = ''; // Clear the input
                    } else if (file.size > maxSize) {
                        alert('File size exceeds 2MB. Please upload a smaller file.');
                        this.value = ''; // Clear the input
                    }
                }
            });

            // File input validation for recommendation letter
            $('#recommendation_letter').on('change', function() {
                const file = this.files[0];
                const maxSize = 2 * 1024 * 1024; // 2MB in bytes
                const allowedTypes = ['application/pdf'];

                if (file) {
                    if (!allowedTypes.includes(file.type)) {
                        alert('Please upload a PDF file.');
                        this.value = ''; // Clear the input
                    } else if (file.size > maxSize) {
                        alert('File size exceeds 2MB. Please upload a smaller file.');
                        this.value = ''; // Clear the input
                    }
                }
            });

            // Show loading spinner on form submission
            $('form').on('submit', function() {
                const btn = $(this).find('button');
                const btnText = btn.find('span[id$="BtnText"]');
                const spinner = btn.find('span[id$="LoadingSpinner"]');
                btnText.addClass('d-none');
                spinner.removeClass('d-none');
                btn.prop('disabled', true);
            });

            // Check for success message and show toast
            function showToast(message) {
                const toastEl = document.getElementById('successToast');
                const toastBody = toastEl.querySelector('#toastMessage');
                toastBody.textContent = message;
                const toast = new bootstrap.Toast(toastEl, { autohide: true, delay: 3000 });
                toast.show();
            }

            // Trigger toast if success session exists
            @if(session('success'))
            showToast('{{ session('success') }}');
            @endif
        });
    </script>
@endpush
