document.addEventListener("DOMContentLoaded", function () {
    let checkinInput = document.getElementById("checkin");
    let checkoutInput = document.getElementById("checkout");
    let totalPrice = document.getElementById("total-price");
    let roomPrice = parseFloat(document.getElementById("room-price").value);
    let availabilityMessage = document.getElementById("availability-message");
    let submitBtn = document.getElementById("submit-btn");

    // Prevent past dates for check-in
    let today = new Date().toISOString().split("T")[0];
    checkinInput.setAttribute("min", today);

    checkinInput.addEventListener("change", function () {
        checkoutInput.value = ""; // Reset check-out date
        checkoutInput.setAttribute("min", checkinInput.value);
        checkAvailability();
    });

    checkoutInput.addEventListener("change", function () {
        calculatePrice();
        checkAvailability();
    });

    function calculatePrice() {
        let checkinDate = new Date(checkinInput.value);
        let checkoutDate = new Date(checkoutInput.value);

        if (checkinDate && checkoutDate && checkoutDate > checkinDate) {
            let nights = Math.ceil((checkoutDate - checkinDate) / (1000 * 60 * 60 * 24));
            totalPrice.textContent = "Total Price: " + (nights * roomPrice);
        }
    }

    function checkAvailability() {
        if (checkinInput.value && checkoutInput.value) {
            let formData = new FormData();
            formData.append("room_type", "Deluxe");
            formData.append("checkin", checkinInput.value);
            formData.append("checkout", checkoutInput.value);

            fetch("../php/check_availability.php", {
                method: "POST",
                body: formData
            })
                .then(response => response.text())
                .then(data => {
                    availabilityMessage.innerHTML = data;
                    if (data.includes("available")) {
                        availabilityMessage.style.color = "red";
                        submit-btn.removeAttribute("disabled");
                    } else {
                        availabilityMessage.style.color = "red";
                        submit-btn.setAttribute("disabled", "true");
                    }
                })
                .catch(error => {
            console.error("Error:", error);
            availabilityMessage.innerHTML = "Error checking availability.";
            availabilityMessage.style.color = "red";
            submitBtn.setAttribute("disabled", "true"); // Disable button on error
        });
        }
    }
});