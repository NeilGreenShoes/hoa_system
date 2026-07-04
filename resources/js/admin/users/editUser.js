import '../../../css/admin/users/editUser.css';

document.addEventListener('DOMContentLoaded', () => {
    const backBtn = document.querySelector('.backBtn');
    backBtn.addEventListener('click', (e) => {
        window.location.href = backBtn.dataset.url;
    });

    const passwordInput = document.getElementById('password');
    const confpasswordInput = document.getElementById('password_confirmation');

    function checkPasswordsMatch() {
        if (passwordInput.value === '' && confpasswordInput.value === '') {
            confpasswordInput.classList.remove('border-error', 'border-success');
            return;
        }
        if (passwordInput.value !== confpasswordInput.value) {
            confpasswordInput.classList.add('border-error');
            confpasswordInput.classList.remove('border-success');
        } else {
            confpasswordInput.classList.remove('border-error');
            confpasswordInput.classList.add('border-success');
        }
    }

    if (passwordInput && confpasswordInput) {
        passwordInput.addEventListener('input', checkPasswordsMatch);
        confpasswordInput.addEventListener('input', checkPasswordsMatch);
    }
});