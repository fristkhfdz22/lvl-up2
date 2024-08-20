<?php
include('../db.php');
$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    
    // Fetch old image path
    $result = $conn->query("SELECT image FROM menu WHERE id = $id");
    $item = $result->fetch_assoc();
    $old_image_path = $item['image'];
    
    if ($image) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($image);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image
        $check = getimagesize($_FILES['image']['tmp_name']);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES['image']['size'] > 1000000) { // 500KB
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                // Delete old image
                if ($old_image_path && file_exists("../uploads/" . $old_image_path)) {
                    unlink("../uploads/" . $old_image_path);
                }
                $image_path = $image;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        // Use old image if no new image is uploaded
        $image_path = $old_image_path;
    }

    // Update menu data into database
    $stmt = $conn->prepare("UPDATE menu SET title = ?, description = ?, price = ?, image = ? WHERE id = ?");
    $stmt->bind_param("ssdsi", $title, $description, $price, $image_path, $id);
    $stmt->execute();
    $stmt->close();
    header("Location: read.php");
    exit();
}

// Fetch menu item data
$result = $conn->query("SELECT * FROM menu WHERE id = $id");
$item = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="admin.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="create.php">Add Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="read.php">Manage Menus</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
    <h1>Edit Menu Item</h1>
    <form action="edit.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($item['title']); ?>" required>
        <br>
        <label for="description">Description:</label>
        <textarea name="description" id="description" required><?php echo htmlspecialchars($item['description']); ?></textarea>
        <br>
        <label for="price">Price:</label>
        <input type="number" name="price" id="price" value="<?php echo htmlspecialchars($item['price']); ?>" step="0.01" required>
        <br>
        <label for="image">Image:</label>
        <input type="file" name="image" id="image">
        <br>
        <input type="submit" value="Update">
    </form>

    <h2>Current Image:</h2>
    <?php if ($item['image']): ?>
        <img src="../uploads/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>" style="width: 100px; height: auto;">
    <?php else: ?>
        No image
    <?php endif; ?>
</body>
</html>
