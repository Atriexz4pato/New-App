const wrapper = document.querySelector('.wrapper');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register-link');
const btnPopup = document.querySelector('.btnLogin-popup');
const iconClose = document.querySelector('.icon-close');

// Event listener for when the page loads
document.addEventListener('DOMContentLoaded', () => {
    // Ensure registration form is active (redundant with Blade, but good fallback)
    wrapper.classList.add('active');
    wrapper.classList.add('active-popup');

    // Example action: Log to console
    console.log('Page loaded, registration form is active');

    // Optional: Focus on the first input of the registration form
    const registerForm = document.querySelector('.form-box.register');
    const firstInput = registerForm.querySelector('input[name="name"]');
    if (firstInput) {
        firstInput.focus();
    }

    // Optional: Add a custom animation (requires CSS)
    wrapper.classList.add('load-animation');
});

// Existing event listeners
registerLink.addEventListener('click', () => {
    wrapper.classList.add('active');
    wrapper.classList.add('active-popup');
});

loginLink.addEventListener('click', () => {
    wrapper.classList.remove('active');
    wrapper.classList.add('active-popup');
});

btnPopup.addEventListener('click', () => {
    wrapper.classList.remove('active'); // Switch to login form
    wrapper.classList.add('active-popup');
});

iconClose.addEventListener('click', () => {
    wrapper.classList.remove('active-popup');
    wrapper.classList.remove('active');
});
