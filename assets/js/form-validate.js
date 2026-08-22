// Waits until the initial HTML document is fully loaded and processed by the browser
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('.needs-validation');

    if (!form) {
        return;
    }

    // Password criteria, used for the progress bar and input validation (It needs to be 100% to be considered valid)
    const passwordCriteriaRules = {
        length: value => value.length >= 8,
        uppercase: value => /[A-Z]/.test(value),
        lowercase: value => /[a-z]/.test(value),
        number: value => /[0-9]/.test(value),
        special: value => /[^A-Za-z0-9]/.test(value),
    };

    // Return true only if the password meets all the criteria above
    function passwordMeetsAllCriteria(value) {
        return Object.values(passwordCriteriaRules).every(rule => rule(value));
    }

    const fields = {
        inputName: {
            validate: value => value.trim().length >= 3, // trim() removes all whitespace, for example " hello " => "hello"
            message: 'Name must have at least 3 characters.',
        },
        inputSurname: {
            validate: value => value.trim().length >= 3,
            message: 'Surname must have at least 3 characters.',
        },
        inputUsername: {
            validate: value => value.trim().length >= 3,
            message: 'Username must have at least 3 characters.',
        },
        inputPhone: {
            validate: value => /^\d{9}$/.test(value.trim()),
            message: 'Phone must have exactly 9 digits.',
        },
        inputAge: {
            validate: value => Number(value) >= 18,
            message: 'You must be at least 18 years old.',
        },
        inputEmail: {
            validate: value => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value.trim()),
            message: 'Please enter a valid e-mail.',
        },
        inputPassword: {
            validate: (value, input) => {
                if (value === '' && !input.required) {
                    return true;
                }
                return passwordMeetsAllCriteria(value);
            },
            message: 'The password must meet all 5 criteria.',
        },
    };

    // Validate an individual input field and apply 'is-valid' or 'is-invalid'
    function validateField(input) {
        const rule = fields[input.id];

        if (!rule) {
            return true;
        }

        const isValid = rule.validate(input.value, input);

        input.classList.toggle('is-valid', isValid);
        input.classList.toggle('is-invalid', !isValid);

        const feedback = input.parentElement.querySelector('.invalid-feedback');
        if (feedback) {
            feedback.textContent = rule.message;
        }

        return isValid;
    }

    // Validates in real time as the user types
    Object.keys(fields).forEach(id => {
        const input = document.getElementById(id);
        if (input) {
            input.addEventListener('input', () => validateField(input));
        }
    });

    // Validates everything on submit and blocks submission if anything is invalid
    form.addEventListener('submit', function (event) {
        let formIsValid = true;

        Object.keys(fields).forEach(id => {
            const input = document.getElementById(id);
            if (input && !validateField(input)) {
                formIsValid = false;
            }
        });

        if (!formIsValid) {
            event.preventDefault();
            event.stopPropagation();
        }
    }, false);

    // Password progress bar
    const passwordInput = document.getElementById('inputPassword');
    const strengthBar = document.getElementById('passwordStrengthBar');
    const strengthCriteria = document.getElementById('passwordCriteria');

    if (passwordInput && strengthBar) {
        passwordInput.addEventListener('focus', () => {
            strengthCriteria.classList.remove('d-none');
        });

        passwordInput.addEventListener('input', () => {
            const value = passwordInput.value;
            let passedCount = 0;

            Object.keys(passwordCriteriaRules).forEach(key => {
                const passed = passwordCriteriaRules[key](value);
                const item = document.getElementById(`criteria-${key}`);

                if (item) {
                    item.classList.toggle('text-success', passed);
                    item.classList.toggle('text-muted', !passed);
                    const icon = item.querySelector('i');
                    if (icon) {
                        icon.className = passed ? 'bi bi-check-circle-fill' : 'bi bi-circle';
                    }
                }

                if (passed) {
                    passedCount++;
                }
            });

            // Math.round() rounds the number to the nearest integer
            const percentage = Math.round((passedCount / Object.keys(passwordCriteriaRules).length) * 100);
            strengthBar.style.width = `${percentage}%`;

            strengthBar.classList.remove('strength-red', 'strength-orange', 'strength-yellow', 'strength-green');

            if (percentage <= 20) {
                strengthBar.classList.add('strength-red');
            } else if (percentage <= 60) {
                strengthBar.classList.add('strength-orange');
            } else if (percentage <= 80) {
                strengthBar.classList.add('strength-yellow');
            } else {
                strengthBar.classList.add('strength-green');
            }

            // Check to update 'is-valid' or 'is-invalid' in real time
            validateField(passwordInput);
        });
    }

    // Show and hide password
    const toggleButton = document.getElementById('togglePassword');

    if (toggleButton && passwordInput) {
        toggleButton.addEventListener('click', () => {
            const isPassword = passwordInput.type === 'password';

            passwordInput.type = isPassword ? 'text' : 'password';

            const icon = toggleButton.querySelector('i');
            icon.className = isPassword ? 'bi bi-eye-slash' : 'bi bi-eye';

            toggleButton.setAttribute('aria-label', isPassword ? 'Hide password' : 'Show password');
        });
    }
});