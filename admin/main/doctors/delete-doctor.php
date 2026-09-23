<?php 

include "../configs/session_handling.php";
include "../configs/config.php";

if (!isset($_POST['user_id']) || empty($_POST['user_id'])) {
    echo json_encode([
        "status" => false,
        "message" => "ID NOT FOUND"
    ]);
}else{
    $user_id = trim($_POST['user_id']);
}

$sql_delete_doctor = "DELETE FROM doctor WHERE doctor_user_id = {$user_id}";

$result_delete_doctor = mysqli_query($connection, $sql_delete_doctor);

if ($result_delete_doctor) {
    echo json_encode([
        "status" => true,
        "message" => "Doctor Deleted Successfully."
    ]);
}



?>