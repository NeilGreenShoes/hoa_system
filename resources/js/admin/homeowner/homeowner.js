document.addEventListener('DOMContentLoaded', () => {
    const viewBtns = document.querySelectorAll('.view-btn');

    viewBtns.forEach((btn) => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();

            const url = btn.dataset.url;

            if (url) {
                window.location.href = url;
            }
        });
    });
});