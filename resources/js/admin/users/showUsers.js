import '../../../css/admin/users/showUsers.css';   

document.addEventListener('DOMContentLoaded', () => {
    const actionButtons = document.querySelectorAll('.action-btn');
    const addBtn = document.querySelector('.createBtn');

    addBtn.addEventListener('click', (e) => {
        e.preventDefault();
        const url = addBtn.getAttribute('data-url');

        if (url) {
            window.location.href = url;
        }
    }); 

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

