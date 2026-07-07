document.addEventListener('DOMContentLoaded', () => {
    const navigationButtons = document.querySelectorAll('.createBtn, .backBtn');

    navigationButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            const url = e.currentTarget.dataset.url;
            
            if (url) {
                window.location.href = url;
            }
        });
    });
});
