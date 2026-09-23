<?php

    include "../configs/config.php";

    $error = [];

    // First Name & Middle Name & Last Name
    $first_name = trim($_POST['first_name'] ?? "");
    $middle_name = trim($_POST['middle_name'] ?? "");
    $last_name = trim($_POST['last_name']?? "");

    // VALIDATION FIRST NAME
    if ($_POST['first_name'] === "" || empty($_POST['first_name'])) {
        $error['First Name'] = "Please enter a First Name";
    } elseif (mb_strlen($first_name) < 3 || mb_strlen($first_name) > 15) {
        $error['First Name'] = "Please enter value between 3 and 15 characters.";
    } elseif (!preg_match('/^[A-Za-z ]+$/', $first_name)) {
        $error['First Name'] = "Only letters and spaces are allowed.";
    }

    // VALIDATION MIDDLE NAME
    if(!empty($middle_name) || $_POST['middle_name'] !== "") {
        if (!preg_match('/^[A-Za-z ]+$/', $first_name)) {
            $error['Middle Name'] = "Only letters and spaces are allowed.";
        }
    }

    // VALIDATION LAST NAME
    if ($_POST['last_name'] === "" || empty($_POST['last_name'])) {
        $error['Last Name'] = "Please enter a Last Name";
    } elseif (mb_strlen($last_name) < 3 || mb_strlen($last_name) > 15) {
        $error['Last Name'] = "Please enter value between 3 and 15 characters.";
    } elseif (!preg_match('/^[A-Za-z ]+$/', $last_name)) {
        $error['Last Name'] = "Only letters and spaces are allowed.";
    }


    

    if (!empty($error)) {
        echo json_encode([
            "status" => false,
            "message" => $error
        ]);

        exit();
    }

    echo json_encode([
        "status" => true,
        "message" => "Patient created successfully."
    ])
?>