import '../../../css/admin/users/showUsers.css';   

document.addEventListener('DOMContentLoaded', () => {
    const actionButtons = document.querySelectorAll('.action-btn');

    actionButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();

            const url = e.currentTarget.getAttribute('data-url');

            if (url) {
                window.location.assign(url);
            } else {
                console.error("Action button clicked, but 'data-url' is empty.");
            }
        });
    });
});

