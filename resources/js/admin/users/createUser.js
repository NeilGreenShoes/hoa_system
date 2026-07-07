

document.addEventListener('DOMContentLoaded', () => {
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirmPassword');

    function checkPasswordsMatch() {
        if (!passwordInput || !confirmPasswordInput) return;

        if (passwordInput.value === '' || confirmPasswordInput.value === '') {
            confirmPasswordInput.classList.remove('border-error', 'border-success');
            return;
        }

        if (passwordInput.value === confirmPasswordInput.value) {
            confirmPasswordInput.classList.remove('border-error');
            confirmPasswordInput.classList.add('border-success');
        } else {
            confirmPasswordInput.classList.remove('border-success');
            confirmPasswordInput.classList.add('border-error');
        }
    }

    if (passwordInput && confirmPasswordInput) {
        passwordInput.addEventListener('input', checkPasswordsMatch);
        confirmPasswordInput.addEventListener('input', checkPasswordsMatch);
    }

    const profileInput = document.getElementById('profile');

    if (profileInput) {
        profileInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            const previewContainer = document.getElementById('preview-container');
            const imagePreview = document.getElementById('image-preview');
            const uploadPrompt = document.getElementById('upload-prompt');

            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();

                reader.onload = (e) => {
                    imagePreview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                    uploadPrompt.classList.add('hidden');
                };

                reader.readAsDataURL(file);
            } else {
                imagePreview.src = '';
                previewContainer.classList.add('hidden');
                uploadPrompt.classList.remove('hidden');
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

    const provinceSelect = document.getElementById('province');
    const citySelect = document.getElementById('city');
    const barangaySelect = document.getElementById('barangay');

    if (provinceSelect && citySelect && barangaySelect) {
        provinceSelect.innerHTML = '<option value="">Select Province</option>';

        Object.keys(regionsData).sort().forEach((province) => {
            provinceSelect.add(new Option(province, province));
        });

        citySelect.disabled = true;
        barangaySelect.disabled = true;

        provinceSelect.addEventListener('change', () => {
            citySelect.innerHTML = '<option value="">Select City / Municipality</option>';
            barangaySelect.innerHTML = '<option value="">Select City First</option>';
            barangaySelect.disabled = true;

            const province = provinceSelect.value;

            if (!province) {
                citySelect.disabled = true;
                return;
            }

            Object.keys(regionsData[province]).sort().forEach((city) => {
                citySelect.add(new Option(city, city));
            });

            citySelect.disabled = false;
        });

        citySelect.addEventListener('change', () => {
            barangaySelect.innerHTML = '<option value="">Select Barangay</option>';

            const province = provinceSelect.value;
            const city = citySelect.value;

            if (!province || !city) {
                barangaySelect.disabled = true;
                return;
            }

            regionsData[province][city].sort().forEach((barangay) => {
                barangaySelect.add(new Option(barangay, barangay));
            });

            barangaySelect.disabled = false;
        });
    }
});