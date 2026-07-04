import '../../css/login.css';
import '../../css/global.css';

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
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const result = await response.json();

            if (response.ok && result.status === 'success') {
                if (result.redirect) {
                    window.location.href = '/admin/dashboard'; 
                } else {
                    showOtpModal();
                }
            } else {
                alert(result.message || 'Login failed.');
            }
        } catch (error) {
            console.error('Error:', error);
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
        let savedPassword = '';
        let savedPasswordConfirmation = '';
        
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
                    
                    <div id="modalAlert" style="display: none; padding: 10px; margin-bottom: 15px; border-radius: 4px;"></div>

                    <div id="modalFieldsContainer">
                        <div class="form-group">
                            <label for="reset_email">Registered Email Address:</label>
                            <input type="email" id="reset_email" name="email" placeholder="example@email.com" required autofocus>
                        </div>
                        <div class="form-group" style="margin-top: 10px;">
                            <label for="reset_password">New Password:</label>
                            <input type="password" id="reset_password" name="password" placeholder="••••••••" required>
                        </div>
                        <div class="form-group" style="margin-top: 10px;">
                            <label for="reset_password_confirmation">Confirm New Password:</label>
                            <input type="password" id="reset_password_confirmation" name="password_confirmation" placeholder="••••••••" required>
                        </div>
                    </div>
                    
                    <div class="modal-actions-row" style="margin-top: 20px;">
                        <button type="button" class="action-btn btn-clear" id="cancelResetModal">Cancel</button>
                        <button type="submit" class="action-btn btn-primary" id="submitResetBtn">Send OTP Code</button>
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
            submitBtn.innerText = form.action.includes('verify_otp') ? 'Verifying & Updating...' : 'Sending OTP...';
            alertBox.style.display = 'none';

            if (form.action.includes('reset_password')) {
                savedEmail = document.getElementById('reset_email').value;
                savedPassword = document.getElementById('reset_password').value;
                savedPasswordConfirmation = document.getElementById('reset_password_confirmation').value;
            }

            const formData = new FormData(form);

            if (form.action.includes('verify_otp')) {
                formData.append('email', savedEmail);
                formData.append('password', savedPassword);
                formData.append('password_confirmation', savedPasswordConfirmation);
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

                if (response.ok && result.status === 'success') {
                    alertBox.style.backgroundColor = '#d4edda';
                    alertBox.style.color = '#155724';
                    alertBox.innerText = result.message;
                    alertBox.style.display = 'block';
                    
                    if (form.action.includes('reset_password')) {
                        fieldsContainer.innerHTML = `
                            <div class="form-group">
                                <label for="otp_code">Enter the 6-digit OTP code sent to your email:</label>
                                <input type="text" id="otp_code" name="otp" placeholder="123456" maxlength="6" required autofocus>
                            </div>
                        `;
                        
                        form.action = 'verify_otp';
                        submitBtn.innerText = 'Verify & Update Password';
                    } else {
                        
                        setTimeout(closeModal, 2500);
                    }
                    
                } else {
                    throw new Error(result.message || 'Something went wrong.');
                }

            } catch (error) {
                alertBox.style.backgroundColor = '#f8d7da';
                alertBox.style.color = '#721c24';
                alertBox.innerText = error.message;
                alertBox.style.display = 'block';
            } finally {
                submitBtn.disabled = false;
                if (form.action.includes('verify_otp')) {
                    submitBtn.innerText = 'Verify & Update Password';
                } else {
                    submitBtn.innerText = 'Send OTP Code';
                }
            }
        });
    }
});
