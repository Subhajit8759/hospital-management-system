<?php
include "../configs/session_handling.php";
?>
<?php

include "../configs/config.php";

$error = [];

$dept_id = trim($_POST['dept_id']);

// department name
$dept_name = trim($_POST['dept_name'] ?? '');

if ($dept_name === "" || empty($dept_name)) {

    $error['Deaprtment Name'] = "Please enter deprtment name";
} elseif (mb_strlen($dept_name) < 3 || mb_strlen($dept_name) > 30) {

    $error['Deaprtment Name'] = "Please enter department name greater than 3 characters and less than 30 characters.";
} elseif (!preg_match('/^[a-zA-Z -_]+$/', $dept_name)) {

    $error['Deaprtment Name'] = "Only letter ans spaces are allowed.";
}

//    dept_code
$dept_code = trim($_POST['dept_code'] ?? '');

if (empty($dept_code) || $dept_code === "") {

    $error['Department Code'] = "Please enter Department Code";
} elseif (mb_strlen($dept_code) < 2 || mb_strlen($dept_code) > 6) {

    $error['Department Code'] = "Please enter value between 3 and 6 characters.";
} elseif (!preg_match('/^[A-Z_]+$/', $dept_code)) {

    $error['Department Code'] = "Only capital letters and underscores(_) are allowed.";
}

//    deprtment description
$dept_description = trim($_POST['dept_description'] ?? "");

if (empty($dept_description) || $dept_description === "") {

    $error['Department Description'] = "Please enter some description";
} elseif (mb_strlen($dept_description) < 5 || mb_strlen($dept_description) > 250) {

    $error['Department Description'] = "Please enter value between 5 and 250 characters.";
}

// department sataus
$dept_status = trim($_POST['dept_status'] ?? "");

if (empty($dept_status) || $dept_status === "") {

    $error['Department Status'] = "Please select a status";
} elseif (!in_array($dept_status, ['1', '2'], true)) {

    $error['Department Status'] = "Please select a department status";
}



$sql_old_department = "SELECT dept_id FROM departments 
                        WHERE 
                        (dept_name = '{$dept_name}' OR dept_code = '{$dept_code}')
                        AND dept_id != {$dept_id} 
                        LIMIT 1";

$result_old_department = mysqli_query($connection, $sql_old_department);

if (mysqli_num_rows($result_old_department) > 0) {

    $error['Department Name'] = "Department or Code Already Exists";
}


if (!empty($error)) {

    echo json_encode([
        "status" => false,
        "message" => $error
    ]);

    exit;
}

$sql_department = "UPDATE departments
                SET dept_name = '{$dept_name}',
                dept_code = '{$dept_code}',
                dept_description = '{$dept_description}',
                dept_status = '{$dept_status}',
                dept_updated_at = NOW()
                WHERE dept_id = {$dept_id}";

$result_department = mysqli_query($connection, $sql_department);

if ($result_department) {
    echo json_encode([
        "status" => true,
        "message" => "$dept_name updated successfully."
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => [
            "Database" => "Database error."
        ]
    ]);
}
