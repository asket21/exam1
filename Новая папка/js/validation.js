document.addEventListener('DOMContentLoaded', function () {

    const regForm = document.getElementById('regForm');
    if (regForm) {
        regForm.addEventListener('submit', function (e) {
            if (!validateRegistration()) {
                e.preventDefault();
            }
        });
    }

    const logForm = document.getElementById('logForm');
    if (logForm) {
        logForm.addEventListener('submit', function (e) {
            if (!validateLogin()) {
                e.preventDefault();
            }
        });
    }

    function validateRegistration() {
        let isValid = true;


        const login = document.getElementById('login').value.trim();
        const password = document.getElementById('password').value;
        const fullName = document.getElementById('full_name').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const email = document.getElementById('email').value.trim();


        clearErrors();


        const loginPattern = /^[a-zA-Z0-9]{6,}$/;
        if (!loginPattern.test(login)) {
            showError('login', 'Логин должен содержать только латиницу и цифры, не менее 6 символов');
            isValid = false;
        }

        if (password.length < 8) {
            showError('password', 'Пароль должен быть не менее 8 символов');
            isValid = false;
        }


        const fullNamePattern = /^[а-яА-ЯёЁ\s]{2,}$/u;
        if (!fullNamePattern.test(fullName)) {
            showError('full_name', 'ФИО может содержать только буквы кириллицы и пробелы');
            isValid = false;
        }


        const digits = phone.replace(/\D/g, '');
        if (digits.length !== 11 || (digits[0] !== '7' && digits[0] !== '8')) {
            showError('phone', 'Введите корректный номер телефона (11 цифр)');
            isValid = false;
        }


        const emailPattern = /^[^\s@]+@[^\s@]+\.[a-zA-Z]{2,}$/;
        if (!emailPattern.test(email)) {
            showError('email', 'Введите корректный email');
            isValid = false;
        }

        return isValid;
    }


    function validateLogin() {
        let isValid = true;
        const login = document.getElementById('login')?.value.trim() || '';
        const password = document.getElementById('password')?.value || '';

        clearErrors();

        if (login === '') {
            showError('login', 'Введите логин');
            isValid = false;
        }
        if (password === '') {
            showError('password', 'Введите пароль');
            isValid = false;
        }
        return isValid;
    }

   
    function clearErrors() {
        document.querySelectorAll('.error-message').forEach(el => el.remove());
        document.querySelectorAll('.is-invalid').forEach(el => {
            el.classList.remove('is-invalid');
        });
    }

    function showError(fieldId, message) {
        const field = document.getElementById(fieldId);
        if (!field) return;

   
        field.classList.add('is-invalid');


        let errorDiv = document.createElement('div');
        errorDiv.className = 'error-message text-danger small mt-1';
        errorDiv.innerText = message;


        const parent = field.closest('.mb-3');
        if (parent) {

            const oldError = parent.querySelector('.error-message');
            if (oldError) oldError.remove();
            parent.appendChild(errorDiv);
        } else {

            field.insertAdjacentElement('afterend', errorDiv);
        }
    }
});