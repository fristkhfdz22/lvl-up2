<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<style>        .dashboard-header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .card {
            margin-bottom: 20px;
        }
        .card-header {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        .card-body {
            background-color: #ffffff;
        }</style>
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
        <div class="dashboard-header">
            <h1>Welcome to Admin Dashboard</h1>
            <p>Manage your menu items here.</p>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Menu Item Management
                    </div>
                    <div class="card-body">
                        <p>Here you can add, edit, or remove menu items.</p>
                        <a href="read.php" class="btn btn-primary">Manage Menu Items</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Order Reports
                    </div>
                    <div class="card-body">
                        <p>View and analyze your order reports here.</p>
                        <a href="#" class="btn btn-secondary">View Reports</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        User Management
                    </div>
                    <div class="card-body">
                        <p>Manage users and their permissions.</p>
                        <a href="#" class="btn btn-success">Manage Users</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
