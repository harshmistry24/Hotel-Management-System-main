document.addEventListener("DOMContentLoaded", function () {
    let checkin = document.getElementById("checkin");
    let checkout = document.getElementById("checkout");
    let totalPrice = document.getElementById("total-price");
    let availabilityForm = document.getElementById("availability-form");
    let availabilityMessage = document.getElementById("availability-message");

    // Disable past dates for check-in
    let today = new Date().toISOString().split("T")[0];
    checkin.setAttribute("min", today);

    function validateDates() {
        let checkinDate = new Date(checkin.value);
        let checkoutDate = new Date(checkout.value);

        if (checkoutDate <= checkinDate) {
            alert("Check-out date must be after check-in date.");
            checkout.value = "";
            return false;
        }
        return true;
    }

    function calculatePrice() {
        if (!validateDates()) return;

        let pricePerNight = parseFloat(document.getElementById("room-price").value);
        let checkinDate = new Date(checkin.value);
        let checkoutDate = new Date(checkout.value);
        let diffTime = Math.abs(checkoutDate - checkinDate);
        let nights = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

        if (nights > 0) {
            totalPrice.innerText = "Total Price: $" + (pricePerNight * nights).toFixed(2);
        } else {
            totalPrice.innerText = "Total Price: $0";
        }
    }

    function checkAvailability() {
        if (!checkin.value || !checkout.value) return;

        let roomType = document.querySelector("input[name='room_type']").value;
        let checkinDate = checkin.value;
        let checkoutDate = checkout.value;

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../php/check_availability.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                let response = JSON.parse(xhr.responseText);
                if (response.available) {
                    availabilityMessage.innerText = "Room Available";
                    availabilityMessage.style.color = "green";
                } else {
                    availabilityMessage.innerText = "No Rooms Available";
                    availabilityMessage.style.color = "red";
                }
            }
        };
        xhr.send("room_type=" + roomType + "&checkin=" + checkinDate + "&checkout=" + checkoutDate);
    }

    checkin.addEventListener("change", calculatePrice);
    checkout.addEventListener("change", calculatePrice);

    availabilityForm.addEventListener("submit", function (e) {
        e.preventDefault();

        if (!validateDates()) return;

        let roomType = document.getElementById("room-type").value;
        let checkinDate = checkin.value;
        let checkoutDate = checkout.value;

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "php/check_availability.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                let response = JSON.parse(xhr.responseText);
                if (response.available) {
                    availabilityMessage.innerText = "Room Available";
                    availabilityMessage.style.color = "green";
                } else {
                    availabilityMessage.innerText = "No Rooms Available";
                    availabilityMessage.style.color = "red";
                }
            }
        };
        xhr.send("room_type=" + roomType + "&checkin=" + checkinDate + "&checkout=" + checkoutDate);
    });
});
