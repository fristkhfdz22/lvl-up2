<?php
include('../db.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    
    // Handle file upload
    $image = $_FILES['image']['name'];
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
        if ( $imageFileType != "jfif" && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                // Save image name to database
                $stmt = $conn->prepare("INSERT INTO menu (title, description, price, image) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssds", $title, $description, $price, $image);
                $stmt->execute();
                $stmt->close();
                header("Location: read.php");
                exit();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        // Save without image
        $stmt = $conn->prepare("INSERT INTO menu (title, description, price) VALUES (?, ?, ?)");
        $stmt->bind_param("ssd", $title, $description, $price);
        $stmt->execute();
        $stmt->close();
        header("Location: read.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Menu</title>
    <!-- Bootstrap 5.3.1 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>


.card {
    border-radius: 15px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
}

.card-header {
    background-color: #dc3545; /* Red background for header */
    color: white;
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
}

.btn-custom {
    background-color: #007bff; /* Blue button background */
    border-color: #007bff;
    color: white;
}

.btn-custom:hover {
    background-color: #0056b3; /* Darker blue on hover */
    border-color: #004085;
}

/* Optional: Change text color to complement the theme */
h2, label {
    color: #343a40; /* Dark grey to balance the vibrant colors */
}
</style>
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


    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h2>Create New Menu Item</h2>
                    </div>
                    <div class="card-body p-4">
                        <form action="create.php" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="title" class="form-label">Title:</label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="Enter the dish title" required>
                                <div class="invalid-feedback">Please enter the title.</div>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description:</label>
                                <textarea class="form-control" name="description" id="description" rows="4" placeholder="Describe the dish" required></textarea>
                                <div class="invalid-feedback">Please enter a description.</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="price" class="form-label">Price:</label>
                                    <input type="number" class="form-control" name="price" id="price" step="0.01" placeholder="e.g., 9.99" required>
                                    <div class="invalid-feedback">Please enter the price.</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="image" class="form-label">Image:</label>
                                    <input class="form-control" type="file" name="image" id="image">
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-warning btn-lg">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5.3.1 JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict'

            var forms = document.querySelectorAll('.needs-validation')

            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>
</html>
