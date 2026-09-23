<?php include "../configs/session_handling.php" ?>

<?php include "../configs/config.php"; ?>

<?php 

    // errors
    $error = [];


    // USER ID VALIDATION
    $user_id = trim($_POST['user_id']);

    if ($user_id === "" OR empty($user_id)) {

        $error['User ID'] = "Please enter a user ID";

    }


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

    // checking registration number
    $sql_doctor_registration = "SELECT doctor_registration_number FROM doctor WHERE doctor_registration_number = '{$doctor_registration_number}'";

    $result_doctor_registration = mysqli_query($connection, $sql_doctor_registration);

    if (mysqli_num_rows($result_doctor_registration) === 1) {

        $error['Doctor Registration Number'] = "Duplicate Entery for regstration.";

    }


    if (!empty($error)) {
        echo json_encode([
            "status" => false,
            "message" => $error
        ]);
        exit;
    } 


    $sql_doctor = "INSERT INTO doctor (doctor_user_id, doctor_qualification, doctor_registration_number, doctor_fees, doctor_status)
                    VALUES ({$user_id}, '{$doctor_qualification}', '{$doctor_registration_number}', '{$doctor_fees}', 1)";

    $result_doctor = mysqli_query($connection, $sql_doctor);

    if ($result_doctor) {
        echo json_encode ([
            "status" => true,
            "message" => "Doctor created successfully."
        ]);
    }

?>