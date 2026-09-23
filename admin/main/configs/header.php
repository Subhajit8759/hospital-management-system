<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: http://localhost/hospital/admin/");
}

$connection = mysqli_connect("localhost", "root", "", "hospital_management");

$sql_user = "SELECT user_id FROM user WHERE user_id = {$_SESSION['user_id']}";

$result_user = mysqli_query($connection, $sql_user);

if (mysqli_num_rows($result_user) === 0) {
    session_start();

    session_unset();

    session_destroy();

    header("Location: http://localhost/hospital/admin/");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Hospital Management System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/waitme@1.19.0/waitMe.min.css" rel="stylesheet">
    <!-- CSS -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.min.css"> -->

    <!-- Custom CSS -->
    <link rel="stylesheet" href="http://localhost/hospital/admin/main/public/css/style.css">
    <link rel="stylesheet" href="http://localhost/hospital/admin/main/public/css/sidebar.css">
    <link rel="stylesheet" href="http://localhost/hospital/admin/main/public/css/navbar.css">
    <link rel="stylesheet" href="http://localhost/hospital/admin/main/public/css/content.css">
    <!-- <link rel="stylesheet" href="http://localhost/hospital/admin/main/public/css/modal.css"> -->

    <!-- user css -->
    <?php include "public/css/users/users-css.php"; ?>

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css"> -->

    <!-- js -->

    <!-- js section -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>

    <!-- WaitMe JS -->
    <script src="https://cdn.jsdelivr.net/npm/waitme@1.19.0/waitMe.min.js">
    </script>

    <!-- Sweet Alert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="http://localhost/hospital/admin/main/public/js/main.js"></script>

</head>

<body>