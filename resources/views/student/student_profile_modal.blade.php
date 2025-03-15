<!-- resources/views/auth/student-profile-modal.blade.php -->
<div class="modal fade" id="studentProfileModal" tabindex="-1" aria-labelledby="studentProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(90deg, #ff6f61, #6b48ff); color: white; border-bottom: none;">
                <h5 class="modal-title" id="studentProfileModalLabel">
                    <i class="fas fa-user-edit"></i> Complete Your Profile
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <p class="text-center text-muted mb-4 welcome-text" style="animation: fadeIn 1s forwards;">
                    Welcome! Let’s get you started...
                </p>
                <div class="progress mb-3" style="height: 8px;">
                    <div id="progress-bar" class="progress-bar" style="background: linear-gradient(90deg, #ff6f61, #6b48ff); width: 25%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <form action="{{route('update.profile')}}" method="POST" id="studentProfileForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="registration_number" class="d-flex align-items-center">
                            <i class="fas fa-id-card text-primary me-2"></i> Registration Number
                        </label>
                        <input type="text" class="form-control" id="registration_number" name="registration_number" placeholder="e.g., IN16/00000/21" required value="{{ old('registration_number') }}">
                        @error('registration_number')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="department" class="d-flex align-items-center">
                            <i class="fas fa-sitemap text-primary me-2"></i> Department
                        </label>
                        <select class="form-control" id="department" name="department" required>
                            <option value="">Select Department</option>
                            <option value="it-department" {{ old('department') == 'it-department' ? 'selected' : '' }}>IT Department</option>
                            <option value="finance" {{ old('department') == 'finance' ? 'selected' : '' }}>Finance</option>
                            <option value="human-resources" {{ old('department') == 'human-resources' ? 'selected' : '' }}>Human Resources</option>
                            <option value="operations" {{ old('department') == 'operations' ? 'selected' : '' }}>Operations</option>
                        </select>
                        @error('department')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="programme" class="d-flex align-items-center">
                            <i class="fas fa-graduation-cap text-primary me-2"></i> Programme
                        </label>
                        <select class="form-control" id="programme" name="programme" required>
                            <option value="">Select Programme</option>
                            <option value="computer-science" {{ old('programme') == 'computer-science' ? 'selected' : '' }}>Computer Science</option>
                            <option value="business-administration" {{ old('programme') == 'business-administration' ? 'selected' : '' }}>Business Administration</option>
                            <option value="education" {{ old('programme') == 'education' ? 'selected' : '' }}>Education</option>
                            <option value="engineering" {{ old('programme') == 'engineering' ? 'selected' : '' }}>Engineering</option>
                        </select>
                        @error('programme')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="organisation" class="d-flex align-items-center">
                            <i class="fas fa-building text-primary me-2"></i> Attachment Organisation
                        </label>
                        <input type="text" class="form-control" id="organisation" name="organisation" placeholder="e.g., Mombasa Hospital" required value="{{ old('organisation') }}">
                        @error('organisation')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="attachment_county" class="d-flex align-items-center">
                            <i class="fas fa-map-marker-alt text-primary me-2"></i> Attachment County
                        </label>
                        <select class="form-control" id="attachment_county" name="attachment_county" required>
                            <option value="">Select County</option>
                            <option value="mombasa" {{ old('attachment_county') == 'mombasa' ? 'selected' : '' }}>Mombasa</option>
                            <option value="kilifi" {{ old('attachment_county') == 'kilifi' ? 'selected' : '' }}>Kilifi</option>
                            <option value="kwale" {{ old('attachment_county') == 'kwale' ? 'selected' : '' }}>Kwale</option>
                        </select>
                        @error('attachment_county')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="location_address" class="d-flex align-items-center">
                            <i class="fas fa-address-card text-primary me-2"></i> Location Address
                        </label>
                        <input type="text" class="form-control" id="location_address" name="location_address" placeholder="e.g., P.O. Box 123" required value="{{ old('location_address') }}">
                        @error('location_address')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mb-2" id="submitButton" style="background: linear-gradient(90deg, #ff6f61, #6b48ff); border: none;">
                        Save Profile
                    </button>
                    <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">Skip for Now</button>
                </form>
                @if(session('success'))
                    <div class="alert alert-success mt-3" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    .modal-content {
        border-radius: 15px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        overflow: hidden;
    }
    .modal-header .btn-close {
        filter: brightness(10);
    }
    .welcome-text {
        opacity: 0;
    }
    @keyframes fadeIn {
        to { opacity: 1; }
    }
    @keyframes slideIn {
        from { transform: translateY(-100%); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    .modal.fade .modal-dialog {
        transform: translateY(-100%);
    }
    .modal.show .modal-dialog {
        animation: slideIn 0.5s ease forwards;
    }
    .form-control {
        border-color: #007bff;
        border-radius: 8px;
        padding: 10px;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }
    .form-control:focus {
        border-color: #0056b3;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }
    .form-group label i {
        margin-right: 8px;
    }
    .btn-primary {
        color: white;
        font-weight: 600;
        padding: 12px;
        border-radius: 8px;
        transition: background 0.3s ease, transform 0.2s ease;
    }
    .btn-primary:hover {
        background: linear-gradient(90deg, #e65c52, #5d3fd8);
        transform: scale(1.02);
    }
    .btn-primary:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }
    .btn-secondary {
        color: #333;
        background-color: #f8f9fa;
        border-color: #007bff;
        border-radius: 8px;
        padding: 12px;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }
    .btn-secondary:hover {
        background-color: #e9ecef;
        border-color: #0056b3;
        transform: scale(1.02);
    }
    .alert {
        border-radius: 8px;
        padding: 10px;
    }
    @media (max-width: 576px) {
        .modal-dialog {
            margin: 10px;
        }
        .modal-content {
            width: 90%;
        }
        .btn {
            width: 100%;
            margin-bottom: 10px;
        }
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize the modal
        var myModal = new bootstrap.Modal(document.getElementById('studentProfileModal'), {
            backdrop: 'static',
            keyboard: false
        });

        // Show modal if student profile is incomplete
        @if(auth()->check() && auth()->user()->role === 'student' && (!auth()->user()->student || !auth()->user()->student->registration_number || !auth()->user()->student->programme || !auth()->user()->student->attachment_place || !auth()->user()->student->department || !auth()->user()->student->attachment_county || !auth()->user()->student->location_address || !auth()->user()->student->recommendation_letter || !auth()->user()->student->acceptance_letter))
        myModal.show();
        // Auto-focus on the first input
        document.getElementById('registration_number').focus();
        @endif

        // Update progress bar based on filled fields
        function updateProgressBar() {
            const form = document.getElementById('studentProfileForm');
            const inputs = form.querySelectorAll('input:not([type="submit"]), select');
            const totalFields = inputs.length;
            let filledFields = 0;

            inputs.forEach(input => {
                if (input.type === 'file') {
                    if (input.files.length > 0) filledFields++;
                } else if (input.value.trim() !== '') {
                    filledFields++;
                }
            });

            const progress = (filledFields / totalFields) * 100;
            document.getElementById('progress-bar').style.width = `${progress}%`;
            document.getElementById('progress-bar').setAttribute('aria-valuenow', progress);
        }

        // Add event listeners to update progress bar on input change
        const formInputs = document.querySelectorAll('#studentProfileForm input, #studentProfileForm select');
        formInputs.forEach(input => {
            input.addEventListener('input', updateProgressBar);
            input.addEventListener('change', updateProgressBar);
        });

        // Initial progress bar update
        updateProgressBar();

        // Handle form submission with loading state
        document.getElementById('studentProfileForm').addEventListener('submit', function (e) {
            const submitButton = document.getElementById('submitButton');
            submitButton.disabled = true;
            submitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...';
        });

        // Auto-close success alert and modal after 2 seconds
        @if(session('success'))
        setTimeout(function() {
            var alert = document.querySelector('.alert-success');
            if (alert) alert.classList.add('fade-out');
            var modal = bootstrap.Modal.getInstance(document.getElementById('studentProfileModal'));
            modal.hide();
        }, 2000);
        @endif
    });
</script>
