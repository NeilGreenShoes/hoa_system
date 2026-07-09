document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.getElementById('loginForm');
    const submitBtn = document.querySelector('.submit-btn');
    const forgotPassword = document.querySelector('.forgot-password');
    const passwordToggle = document.querySelector('.password-toggle');
    const passwordInput = document.getElementById('password');

    passwordToggle.addEventListener('click', () => {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordToggle.classList.remove('fa-eye');
            passwordToggle.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            passwordToggle.classList.remove('fa-eye-slash');
            passwordToggle.classList.add('fa-eye');
        }
    });

    if (!submitBtn || !loginForm) return;

    submitBtn.addEventListener('click', async (e) => {
        e.preventDefault();

        const formData = new FormData(loginForm);

        try {
            const response = await fetch(loginForm.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json' 
                }
            });

            if (response.redirected) {
                window.location.href = response.url;
                return;
            }

            const responseText = await response.text();
            let result;
            
            try {
                result = JSON.parse(responseText);
            } catch (jsonError) {
                console.error('Server returned non-JSON content:', responseText);
                alert('An unexpected server error occurred.');
                return;
            }

            if (response.ok) {
                if (result.status === 'success' || result.success) {
                    if (result.redirect) {
                        window.location.href = typeof result.redirect === 'string' ? result.redirect : '/admin/dashboard'; 
                    } else {
                        showOtpModal();
                    }
                } else {
                    alert(result.message || 'Action failed.');
                }
            } else {
                if (response.status === 422 && result.errors) {
                    const firstError = Object.values(result.errors)[0][0];
                    alert(firstError);
                } else {
                    alert(result.message || 'Login failed.');
                }
            }
        } catch (error) {
            console.error('Network or Execution Error:', error);
            alert('Could not connect to the server.');
        }
    });


    function showOtpModal() {
        const csrfElement = document.querySelector('input[name="_token"]');
        const csrfToken = csrfElement ? csrfElement.value : '';
        
        const modal = document.createElement('div');
        modal.classList.add('modal');
        modal.innerHTML = `
            <div class="modal-content">
                <form method="POST" action="/submitOtp">
                    <input type="hidden" name="_token" value="${csrfToken}">
                    <label for="otp">Enter OTP Code:</label>
                    <input type="text" id="otp" name="otp" required autofocus>
                    <button type="submit">Verify & Proceed</button>
                </form>
            </div>
        `;
        document.body.appendChild(modal);
    }

    if (forgotPassword) {
        forgotPassword.addEventListener('click', (e) => {
            e.preventDefault(); 
            showResetPasswordModal();
        });
    }

    function showResetPasswordModal() {
    const csrfElement = document.querySelector('input[name="_token"]');
    const csrfToken = csrfElement ? csrfElement.value : '';

    let savedEmail = '';
    let resendCountdown;

    function startResendTimer() {

        const resendBtn = document.getElementById('resendOtpBtn');

        if (!resendBtn) return;

        let seconds = 60;

        resendBtn.disabled = true;
        resendBtn.innerText = `Resend OTP (${seconds}s)`;

        clearInterval(resendCountdown);

        resendCountdown = setInterval(() => {

            seconds--;

            resendBtn.innerText = `Resend OTP (${seconds}s)`;

            if (seconds <= 0) {
                clearInterval(resendCountdown);
                resendBtn.disabled = false;
                resendBtn.innerText = "Resend OTP";
            }

        }, 1000);

        resendBtn.onclick = async () => {

            resendBtn.disabled = true;
            resendBtn.innerText = "Sending...";

            const formData = new FormData();
            formData.append('_token', csrfToken);
            formData.append('email', savedEmail);

            try {

                const response = await fetch('reset_password', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message);
                }

                alertBox.style.background = '#d4edda';
                alertBox.style.color = '#155724';
                alertBox.innerText = "A new OTP has been sent.";
                alertBox.style.display = 'block';

                startResendTimer();

            } catch (error) {

                alertBox.style.background = '#f8d7da';
                alertBox.style.color = '#721c24';
                alertBox.innerText = error.message;
                alertBox.style.display = 'block';

                resendBtn.disabled = false;
                resendBtn.innerText = "Resend OTP";
            }
        };
    }

    const modal = document.createElement('div');
    modal.classList.add('modal-overlay');
    modal.id = 'resetPasswordModal';

    modal.innerHTML = `
        <div class="modal-card">
            <div class="modal-header-row">
                <h3>Reset Password</h3>
                <button type="button" class="modal-close-btn" id="closeResetModal">&times;</button>
            </div>

            <form method="POST" action="reset_password" id="resetPasswordForm">
                <input type="hidden" name="_token" value="${csrfToken}">

                <div id="modalAlert" style="display:none;padding:10px;margin-bottom:15px;border-radius:4px;"></div>

                <div id="modalFieldsContainer">
                    <div class="form-group">
                        <label for="reset_email">Registered Email Address</label>
                        <input
                            type="email"
                            id="reset_email"
                            name="email"
                            placeholder="example@email.com"
                            required
                            autofocus
                        >
                    </div>
                </div>

                <div class="modal-actions-row" style="margin-top:20px;">
                    <button type="button" class="action-btn btn-clear" id="cancelResetModal">
                        Cancel
                    </button>

                    <button type="submit" class="action-btn btn-primary" id="submitResetBtn">
                        Send OTP
                    </button>
                </div>
            </form>
        </div>
    `;

    document.body.appendChild(modal);

    const closeModal = () => modal.remove();

    document.getElementById('closeResetModal').addEventListener('click', closeModal);
    document.getElementById('cancelResetModal').addEventListener('click', closeModal);

    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });

    const form = document.getElementById('resetPasswordForm');
    const submitBtn = document.getElementById('submitResetBtn');
    const alertBox = document.getElementById('modalAlert');
    const fieldsContainer = document.getElementById('modalFieldsContainer');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        submitBtn.disabled = true;
        alertBox.style.display = 'none';

        const formData = new FormData(form);

        // Preserve email
        if (form.action.includes('reset_password')) {
            savedEmail = document.getElementById('reset_email').value;
        } else {
            formData.append('email', savedEmail);
        }

        // Button text
        if (form.action.includes('reset_password')) {
            submitBtn.innerText = 'Sending OTP...';
        } else if (form.action.includes('verify_otp')) {
            submitBtn.innerText = 'Verifying OTP...';
        } else {
            submitBtn.innerText = 'Updating Password...';
        }

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const result = await response.json();

            if (!response.ok) {
                throw new Error(result.message || 'Something went wrong.');
            }

            alertBox.style.background = '#d4edda';
            alertBox.style.color = '#155724';
            alertBox.innerText = result.message;
            alertBox.style.display = 'block';

            // STEP 1
            if (form.action.includes('reset_password')) {

                fieldsContainer.innerHTML = `
                    <div class="form-group">
                        <label>Enter the OTP sent to your email</label>
                        <input
                            type="text"
                            id="otp_code"
                            name="otp"
                            maxlength="6"
                            placeholder="123456"
                            required
                            autofocus
                        >
                    </div>

                     <div style="margin-top:15px;">
                        <button
                            type="button"
                            id="resendOtpBtn"
                            class="action-btn btn-clear"
                            disabled>
                            Resend OTP (60s)
                        </button>
                    </div>
                `;

                form.action = "verify_otp";
                submitBtn.innerText = "Verify OTP";
                startResendTimer();
            }

            // STEP 2
            else if (form.action.includes('verify_otp')) {

                fieldsContainer.innerHTML = `
                    <div class="form-group">
                        <label>New Password</label>
                        <input
                            type="text"
                            id="reset_password"
                            name="password"
                            placeholder="new password"
                            required
                        >
                    </div>

                    <div class="form-group" style="margin-top:10px;">
                        <label>Confirm Password</label>
                        <input
                            type="text"
                            id="reset_password_confirmation"
                            name="password_confirmation"
                            placeholder="confirm password"
                            required
                        >
                    </div>
                `;

                form.action = "update_password";
                submitBtn.innerText = "Update Password";
            }

            // STEP 3
            else if (form.action.includes('update_password')) {

                alertBox.innerText = result.message;

                setTimeout(() => {
                    closeModal();
                }, 2000);
            }

        } catch (error) {

            alertBox.style.background = '#f8d7da';
            alertBox.style.color = '#721c24';
            alertBox.innerText = error.message;
            alertBox.style.display = 'block';

        } finally {

            submitBtn.disabled = false;

            if (form.action.includes('reset_password')) {
                submitBtn.innerText = 'Send OTP';
            } else if (form.action.includes('verify_otp')) {
                submitBtn.innerText = 'Verify OTP';
            } else {
                submitBtn.innerText = 'Update Password';
            }
        }
    });
    }
});
