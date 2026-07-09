document.addEventListener("DOMContentLoaded", function () {

    const overlay = document.getElementById("previewOverlay");
    const content = document.querySelector(".preview-content");
    const image = document.getElementById("previewImage");
    const pdf = document.getElementById("previewPDF");
    const closeBtn = document.querySelector(".preview-close");

    document.querySelectorAll(".btn-receipt, .btn-valid-id, .btn-lot-document")
    .forEach(button => {

        button.addEventListener("click", function () {

            const src = this.dataset.src;

            image.style.display = "none";
            pdf.style.display = "none";

            if (src.toLowerCase().endsWith(".pdf")) {
                pdf.src = src;
                pdf.style.display = "block";
            } else {
                image.src = src;
                image.style.display = "block";
            }

            overlay.style.display = "flex";
        });

    });

    function closePreview() {
        overlay.style.display = "none";
        image.src = "";
        pdf.src = "";
    }

    closeBtn.addEventListener("click", closePreview);

    // Close when clicking outside the preview
    overlay.addEventListener("click", function (e) {
        if (!content.contains(e.target)) {
            closePreview();
        }
    });

    // Prevent closing when clicking the image or PDF
    content.addEventListener("click", function (e) {
        e.stopPropagation();
    });

});