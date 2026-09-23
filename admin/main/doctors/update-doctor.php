<?php 
include "../configs/session_handling.php";
include "../configs/config.php"; 
?>

<?php
 // errors
 $error = [];


 // USER ID VALIDATION
 $user_id = trim($_POST['user_id']);


//  DOCTOR STATUS
 $doctor_status = trim($_POST['doctor_status']);


 // doctor qualification validation

 $doctor_qualification = trim($_POST['doctor_qualification'] ?? "");

 if ($doctor_qualification === "" OR empty($doctor_qualification)) {

     $error['Doctor Qualification'] = "Please enter qualification.";

 } elseif (mb_strlen($doctor_qualification) < 2  OR mb_strlen($doctor_qualification) > 50) {

     $error['Doctor Qualification'] = "Please enter value between 2 and 50 characters";

 } elseif (!preg_match('/[a-zA-Z ]+$/', $doctor_qualification)) {

     $error['Doctor Qualification'] = "Only letters and spaces are allowed.";

 }

 // Doctor Registration Validation

 $doctor_registration_number = trim($_POST['doctor_registration_number'] ?? "");

 if ($doctor_registration_number === "" OR empty($doctor_registration_number)) {

     $error['Doctor Registration Number'] = "Please enter registration number.";

 } elseif (mb_strlen($doctor_registration_number) < 2  OR mb_strlen($doctor_registration_number) > 50) {

     $error['Doctor Registration Number'] = "Please enter value between 2 and 50 characters";

 } elseif (!preg_match('/[a-zA-Z0-9]+$/', $doctor_registration_number)) {

     $error['Doctor Registration Number'] = "Only letters and numbers are allowed.";

 }


 // FEES VALIDATION
 $doctor_fees = trim($_POST['doctor_fees']);

 if ($doctor_fees === "" OR empty($doctor_fees)) {

     $error['Doctor Fees'] = "Please enter doctor fees.";

 } elseif (!preg_match('/[0-9]+$/', $doctor_fees)) {

     $error['Doctor Fees'] = "Only numbers are allowed.";

 }

$sql_check_registration = "SELECT doctor_user_id FROM doctor
                            WHERE doctor_registration_number = '{$doctor_registration_number}' AND doctor_user_id != {$user_id}
                            LIMIT 1";

$result_check_registration = mysqli_query($connection, $sql_check_registration);

if (mysqli_num_rows($result_check_registration) > 0) {
    $error['Registration Number'] = "Registration number already exists on another profile.";
}

if (!empty($error)) {
    echo json_encode([
        "status" => false,
        "message" => $error
    ]);
}

$sql_doctor_update = "UPDATE doctor
                    SET doctor_status = {$doctor_status},
                    doctor_qualification = '{$doctor_qualification}',
                    doctor_registration_number = '{$doctor_registration_number}',
                    doctor_updated_at = NOW()
                    WHERE doctor_user_id = {$user_id}";


$result_doctor_update = mysqli_query($connection, $sql_doctor_update);

if ($result_doctor_update) {
    echo json_encode([
        "status" => true,
        "message" => "Doctor updated successfully."
    ]);
}

?>