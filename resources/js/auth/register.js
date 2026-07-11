document.addEventListener('DOMContentLoaded', function() {

    const profileInput = document.getElementById('profile-input');
    const profilePreview = document.getElementById('profile-preview');

    if (profileInput && profilePreview) {
        profileInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    profilePreview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    }

    const regionsData = {
        "South Cotabato": {
            "Koronadal": ["General Paulino Santos (Bo. 1)", "Zone I", "Zone II", "Morales", "Poblacion"],
            "Polomolok": ["Poblacion", "Cannery Site", "Magsaysay", "Sulit"],
            "Banga": ["Benitez", "Poblacion", "Rizal"],
            "Surallah": ["Centrala", "Poblacion", "Buenavista"]
        },
        "Cavite": {
            "Dasmariñas": ["Poblacion I", "Salitran I", "Burol I", "Sampaloc I"],
            "Bacoor": ["Molino I", "Molino II", "Bayanan", "Mambog I"],
            "Imus": ["Anabu I", "Bayan Luma I", "Poblacion I"],
            "Tagaytay": ["Maharlika East", "Mendez Crossing West", "Sungay East"]
        },
        "Metro Manila": {
            "Manila City": ["Barangay 660", "Barangay 661", "Intramuros", "Ermita", "Malate"],
            "Quezon City": ["Bagong Pag-asa", "Socorro", "Commonwealth", "Batasan Hills"],
            "Makati City": ["Bel-Air", "Poblacion", "Guadalupe Nuevo"],
            "Pasig City": ["San Antonio", "Kapitolyo", "Ugong"]
        },
        "Cebu": {
            "Cebu City": ["Lahug", "Mabolo", "Pardo", "Guadalupe"],
            "Mandaue": ["Bakilid", "Centro", "Subangdaku"],
            "Lapu-Lapu": ["Marigondon", "Mactan", "Pajo"]
        },
        "Davao del Sur": {
            "Davao City": ["Buhangin", "Talomo", "Agdao", "Poblacion"]
        },
        "Iloilo": {
            "Iloilo City": ["Mandurriao", "Molo", "Jaro", "Poblacion"]
        }
    };

    const provinceSelect = document.getElementById('province-select');
    const citySelect = document.getElementById('city-select');
    const barangaySelect = document.getElementById('barangay-select');

    if (provinceSelect && citySelect && barangaySelect) {
        for (let province in regionsData) {
            let option = document.createElement('option');
            option.value = province;
            option.textContent = province;
            provinceSelect.appendChild(option);
        }

        provinceSelect.addEventListener('change', function() {
            citySelect.innerHTML = '<option value="" selected disabled>Select City</option>';
            barangaySelect.innerHTML = '<option value="" selected disabled>Select Barangay</option>';
            barangaySelect.disabled = true;

            const selectedProvince = this.value;
            if (selectedProvince && regionsData[selectedProvince]) {
                citySelect.disabled = false;
                for (let city in regionsData[selectedProvince]) {
                    let option = document.createElement('option');
                    option.value = city;
                    option.textContent = city;
                    citySelect.appendChild(option);
                }
            } else {
                citySelect.disabled = true;
            }
        });

        citySelect.addEventListener('change', function() {
            barangaySelect.innerHTML = '<option value="" selected disabled>Select Barangay</option>';
            const selectedProvince = provinceSelect.value;
            const selectedCity = this.value;

            if (selectedCity && regionsData[selectedProvince] && regionsData[selectedProvince][selectedCity]) {
                barangaySelect.disabled = false;
                const barangays = regionsData[selectedProvince][selectedCity];
                barangays.forEach(function(barangay) {
                    let option = document.createElement('option');
                    option.value = barangay;
                    option.textContent = barangay;
                    barangaySelect.appendChild(option);
                });
            } else {
                barangaySelect.disabled = true;
            }
        });
    }

    const registerForm = document.querySelector(".register-grid");
    if (!registerForm) return;

    let formSubmissionStep = "DISPATCH_OTP"; 

    registerForm.addEventListener("submit", async function (event) {
        if (formSubmissionStep === "VERIFY_OTP") {
            return; 
        }

        event.preventDefault(); 

        if (document.getElementById("otp-modal-overlay")) return;

        const submitButton = registerForm.querySelector('button[type="submit"]');
        const originalButtonText = submitButton ? submitButton.textContent : "Register Account";

        if (submitButton) {
            submitButton.disabled = true;
            submitButton.textContent = "Processing Details & Sending OTP...";
        }

        try {
            const formData = new FormData(registerForm);

            const response = await fetch('/register/send-otp', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            });

            const result = await response.json();

            if (response.ok && result.success) {
                const modalOverlay = document.createElement("div");
                modalOverlay.id = "otp-modal-overlay";
                modalOverlay.className = "otp-modal-overlay";

                modalOverlay.innerHTML = `
                    <div class="otp-modal-card">
                        <div class="otp-modal-header">
                            <div class="otp-icon-circle">
                                <i class="fa-solid fa-shield-halved"></i>
                            </div>
                            <h2>Security Verification</h2>
                            <p>We've sent a 6-digit confirmation code to your email. Please verify it below to complete registration.</p>
                        </div>
                        <div class="otp-input-container">
                            <input type="text" class="otp-digit" maxlength="1" inputmode="numeric" autocomplete="one-time-code" required>
                            <input type="text" class="otp-digit" maxlength="1" inputmode="numeric" required>
                            <input type="text" class="otp-digit" maxlength="1" inputmode="numeric" required>
                            <input type="text" class="otp-digit" maxlength="1" inputmode="numeric" required>
                            <input type="text" class="otp-digit" maxlength="1" inputmode="numeric" required>
                            <input type="text" class="otp-digit" maxlength="1" inputmode="numeric" required>
                        </div>
                        <button type="button" id="otp-verify-submit-btn" class="submit-btn" style="max-width: 100%;">Verify & Register Account</button>
                        <div class="otp-modal-footer">
                            <p>Didn't receive the code? <a href="#" id="otp-resend-link">Resend Code</a></p>
                            <button type="button" id="otp-close-cancel-btn" class="otp-cancel-btn">Cancel Verification</button>
                        </div>
                    </div>
                `;

                document.body.appendChild(modalOverlay);
                initializeOtpInteractions(modalOverlay, registerForm);
            } else {
                if (result.errors) {
                    let errorMessages = Object.values(result.errors).flat().join("\n");
                    alert("Validation Error:\n" + errorMessages);
                } else {
                    alert(result.error || result.message || "Validation checkpoint failed.");
                }
            }

        } catch (error) {
            console.error("AJAX Gateway Failure:", error);
            alert("System Error Encountered:\n" + error.message);
        } finally {
            if (submitButton) {
                submitButton.disabled = false;
                submitButton.textContent = originalButtonText;
            }
        }
    });

    function initializeOtpInteractions(modalElement, targetForm) {
        const digits = modalElement.querySelectorAll(".otp-digit");
        const verifyBtn = modalElement.querySelector("#otp-verify-submit-btn");
        const cancelBtn = modalElement.querySelector("#otp-close-cancel-btn");
        const resendLink = modalElement.querySelector("#otp-resend-link");

        if (digits.length > 0) digits[0].focus();

        digits.forEach((inputField, trackingIndex) => {
            inputField.addEventListener("input", (e) => {
                inputField.value = inputField.value.replace(/[^0-9]/g, '');

                if (inputField.value.length === 1 && trackingIndex < digits.length - 1) {
                    digits[trackingIndex + 1].focus();
                }
            });

            inputField.addEventListener("keydown", (e) => {
                if (e.key === "Backspace" && inputField.value.length === 0 && trackingIndex > 0) {
                    digits[trackingIndex - 1].focus();
                }
            });

            inputField.addEventListener("paste", (e) => {
                e.preventDefault();
                const pastedContent = (e.clipboardData || window.clipboardData).getData("text");
                const pureNumbers = pastedContent.replace(/[^0-9]/g, '').slice(0, 6);

                pureNumbers.split("").forEach((char, charIdx) => {
                    if (digits[charIdx]) {
                        digits[charIdx].value = char;
                        if (digits[charIdx + 1]) digits[charIdx + 1].focus();
                    }
                });
            });
        });

        if (verifyBtn) {
            verifyBtn.addEventListener("click", () => {
                let combinedToken = "";
                digits.forEach(field => combinedToken += field.value);

                if (combinedToken.length !== 6) {
                    alert("Please enter the complete 6-digit verification sequence.");
                    return;
                }

                let hiddenTokenCarrier = document.getElementById("hidden-otp-carrier");
                if (!hiddenTokenCarrier) {
                    hiddenTokenCarrier = document.createElement("input");
                    hiddenTokenCarrier.type = "hidden";
                    hiddenTokenCarrier.id = "hidden-otp-carrier";
                    hiddenTokenCarrier.name = "otp_code";
                    targetForm.appendChild(hiddenTokenCarrier);
                }
                hiddenTokenCarrier.value = combinedToken;

                modalElement.remove();
                formSubmissionStep = "VERIFY_OTP"; 
                
                targetForm.action = "/submit"; 
                targetForm.submit();
            });
        }

        if (cancelBtn) {
            cancelBtn.addEventListener("click", () => {
                modalElement.remove();
            });
        }

        if (resendLink) {
            resendLink.addEventListener("click", async function(e) {
                e.preventDefault();
                resendLink.style.pointerEvents = "none";
                resendLink.textContent = "Resending...";
                
                try {
                    const formData = new FormData(targetForm);
                    const response = await fetch('/register/send-otp', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        }
                    });
                    const result = await response.json();
                    if (response.ok && result.success) {
                        alert("A brand new verification sequence code has been dispatched!");
                        if (digits.length > 0) {
                            digits.forEach(d => d.value = "");
                            digits[0].focus();
                        }
                    } else {
                        alert(result.error || "Failed to resend code.");
                    }
                } catch (err) {
                    alert("Network disconnect encountered handling verification renewal request.");
                } finally {
                    resendLink.style.pointerEvents = "auto";
                    resendLink.textContent = "Resend Code";
                }
            });
        }
    }
});