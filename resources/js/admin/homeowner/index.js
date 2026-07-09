document.addEventListener("DOMContentLoaded", () => {

    const btnView = document.querySelector('.btn-view');

    document.querySelectorAll(".btn-view").forEach(button => {
        button.addEventListener("click", () => {
            const url = button.getAttribute("data-url");

            if (url) {
                window.location.href = url;
            }
        });
    });

    const COOLDOWN = 300; // seconds

    document.querySelectorAll(".requestUpdateForm").forEach(form => {

        const button = form.querySelector(".btn-request-update");
        const text = form.querySelector(".btnText");

        // Unique key per homeowner
        const key = "request-update-" + form.action;

        function startCountdown(endTime) {

            function tick() {

                const remaining = Math.ceil((endTime - Date.now()) / 1000);

                if (remaining <= 0) {
                    button.disabled = false;
                    button.classList.remove("btn-disabled");
                    text.textContent = "Request Update";
                    localStorage.removeItem(key);
                    return;
                }

                button.disabled = true;
                button.classList.add("btn-disabled");

                const minutes = Math.floor(remaining / 60);
                const seconds = remaining % 60;

                text.textContent =
                    `Retry in ${minutes}:${seconds.toString().padStart(2, "0")}`;

                setTimeout(tick, 1000);
            }

            tick();
        }

        const savedEnd = localStorage.getItem(key);

        if (savedEnd && Number(savedEnd) > Date.now()) {
            startCountdown(Number(savedEnd));
        }

        form.addEventListener("submit", () => {
            const endTime = Date.now() + COOLDOWN * 1000;
            localStorage.setItem(key, endTime);
        });

    });

});