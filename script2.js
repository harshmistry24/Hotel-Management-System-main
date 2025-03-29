document.addEventListener("DOMContentLoaded", function () {
    const resetForm = document.querySelector("form");
    if (resetForm) {
        resetForm.addEventListener("submit", function (e) {
            const password = document.getElementById("newPassword").value;
            const confirmPassword = document.getElementById("confirmPassword").value;

            if (password !== confirmPassword) {
                alert("Passwords do not match!");
                e.preventDefault();
            }

            if (password.length < 8) {
                alert("Password must be at least 8 characters long.");
                e.preventDefault();
            }
        });
    }
});
