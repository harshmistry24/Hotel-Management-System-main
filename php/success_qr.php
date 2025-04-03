<?php
if (!isset($_GET["file"]) || !isset($_GET["redirect_url"])) {
    die("Invalid request.");
}

$file = $_GET["file"];
$redirect_url = $_GET["redirect_url"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Success</title>
    <script>
        function downloadAndRedirect() {
            alert("Booking Confirmed!"); // Show success message

            // Trigger download via hidden link
            var link = document.createElement('a');
            link.href = "download_qr.php?file=<?php echo urlencode($file); ?>";
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);

            // Redirect after 2 seconds
            setTimeout(function() {
                window.location.href = "<?php echo $redirect_url; ?>";
            }, 2000);
        }
    </script>
</head>
<body onload="downloadAndRedirect()">
    <h2>Booking Confirmed!</h2>
    <p>Your QR Code is ready.</p>
    <p>If the download doesn't start automatically, <a href="download_qr.php?file=<?php echo urlencode($file); ?>">click here</a>.</p>
</body>
</html>
