<?php

include "../configs/session_handling.php";
include "../configs/config.php";


if (!isset($_POST['user_id']) || empty($_POST['user_id'])) {

    echo json_encode([
        "status" => false,
        "message" => "ID NOT FOUND"
    ]);

    exit;
}

$user_id = (int) $_POST['user_id'];

// OLD PHOTO
$sql_photo = "SELECT photo FROM user WHERE user_id = {$user_id}";

$result_photo = mysqli_query($connection, $sql_photo);

if (mysqli_num_rows($result_photo) === 0) {

    echo json_encode([
        "status" => false,
        "message" => "Photo not found on database",
    ]);

    exit;
}

$row_photo = mysqli_fetch_assoc($result_photo);

$photo = $row_photo['photo'];


// FIND ROLE
$sql_role = "SELECT role_id FROM user WHERE user_id = {$user_id}";

$result_role = mysqli_query($connection, $sql_role);

if (mysqli_num_rows($result_role) > 0) {

    $row_role = mysqli_fetch_assoc($result_role);

    // Delete Doctor
    if ($row_role['role_id'] === '1') {

        $sql_delete_doctor = "DELETE FROM doctor WHERE doctor_user_id = {$user_id}";

        $result_doctor_delete = mysqli_query($connection, $sql_delete_doctor);
    } elseif ($row_role['role_id'] === '2') {

        

    }
}



// DELETE USER
$sql_delete = "DELETE FROM user WHERE user_id = {$user_id}";

$result_delete = mysqli_query($connection, $sql_delete);

if ($result_delete) {

    // now delete photo file from local files
    if (!empty($photo)) {

        $photo_path = "uploads/" . $photo;

        if (file_exists($photo_path)) {

            unlink($photo_path);
        } else {

            echo json_encode([
                'status' => false,
                'message' => "Photo not found in the file."
            ]);
        }

        echo json_encode([
            'status' => true,
            'message' => "User Deleted Successfully"
        ]);
    } else {
        echo "USER NOT DELETED!";
    }
}
