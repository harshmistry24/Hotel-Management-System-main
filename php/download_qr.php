<?php
if (!isset($_GET["file"])) {
    die("No file specified.");
}

$file = $_GET["file"];

if (!file_exists($file)) {
    die("File not found.");
}

header("Content-Type: image/png");
header("Content-Disposition: attachment; filename=" . basename($file));
header("Content-Length: " . filesize($file));
readfile($file);
exit;
?>