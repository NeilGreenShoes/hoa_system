document.addEventListener("DOMContentLoaded", () => {
    const toast = document.querySelector(".message-container");
    const logoutBtn = document.getElementById("logoutBtn");
    const logoutForm = document.getElementById("logoutForm");

    // Logout
    if (logoutBtn && logoutForm) {
        logoutBtn.addEventListener("click", (e) => {
            e.preventDefault();

            if (confirm("Confirm Log Out?")) {
                logoutForm.submit();
            }
        });
    }

    // Toast
    if (toast) {
        setTimeout(() => {
            toast.classList.add("hide");
        }, 4000);

        toast.addEventListener("animationend", (e) => {
            if (e.animationName === "slideOutRight") {
                toast.remove();
            }
        });
    }
});