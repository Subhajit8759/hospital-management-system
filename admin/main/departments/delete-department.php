<?php
    include "../configs/session_handling.php";
    include "../configs/config.php";

    $error = [];

    $dept_id = trim($_POST['dept_id'] ?? "");
    $dept_name = trim($_POST['dept_name'] ?? "");
    
    if ($dept_id === "" OR empty($dept_id)) {
        $error['Department ID'] = "ID does not exists.";
    }

    if (!empty($error)) {
        echo json_encode([
            "status" => false,
            "message" => "Sorry, not deleted."
        ]);
    }

    $sql_delete_department = "DELETE FROM departments WHERE dept_id = {$dept_id}";

    $result_delete_department = mysqli_query($connection, $sql_delete_department);

    if ($result_delete_department) {
        echo json_encode ([
            "status" => "true",
            "message" => "Department deleted succesfully."
        ]);
    }
?>