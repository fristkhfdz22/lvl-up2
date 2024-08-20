<?php
include('../db.php');
$id = $_GET['id'];

// Fetch image path
$result = $conn->query("SELECT image FROM menu WHERE id = $id");
$item = $result->fetch_assoc();
$image_path = $item['image'];

// Delete the menu from database
$conn->query("DELETE FROM menu WHERE id = $id");

// Delete image file
if ($image_path && file_exists("../uploads/" . $image_path)) {
    unlink("../uploads/" . $image_path);
}

$conn->close();
header("Location: read.php");
exit();
?>
