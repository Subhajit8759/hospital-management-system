<?php
    include "../configs/config.php";

    if ($_POST['patient_id']) {
        $patient_id = trim($_POST['patient_id'] ?? "");

        $sql_delete_emergency_contact = "DELETE FROM emergency_contact WHERE patient_id = ?";
        $stmt_delete_emergency_contact = mysqli_prepare($connection, $sql_delete_emergency_contact);
        mysqli_stmt_bind_param($stmt_delete_emergency_contact, "i", $patient_id);
        $result_emergency_contact= mysqli_stmt_execute($stmt_delete_emergency_contact);

        $sql_delete_patient = "DELETE FROM patients WHERE patient_id = ?";
        $stmt_delete_patient = mysqli_prepare($connection, $sql_delete_patient);
        mysqli_stmt_bind_param($stmt_delete_patient, "i", $patient_id);
        $result_patinet= mysqli_stmt_execute($stmt_delete_patient);

        if ($result_emergency_contact && $result_patinet) {
            echo json_encode([
                "status" => true,
                "message" => "Patient Deleted Successfuly."
            ]);
        }
    }
?>