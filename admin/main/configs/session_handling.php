<?php

session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");


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