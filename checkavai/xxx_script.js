document.getElementById("availabilityForm").addEventListener("submit", function(event) {
    event.preventDefault();

    let checkIn = document.getElementById("check_in").value;
    let checkOut = document.getElementById("check_out").value;
    let roomType = document.getElementById("room_type").value;
    let numRooms = document.getElementById("num_rooms").value;

    fetch("check_availability.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `checkin_date=${checkIn}&checkout_date=${checkOut}&room_type=${roomType}&num_rooms=${numRooms}`
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById("result").innerHTML = data;
    });
});
