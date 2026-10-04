<?php

include "../configs/config.php";
include "../configs/common-function.php";

$error = [];

// Title
$title = trim($_POST['title'] ?? "");

// First Name & Middle Name & Last Name
$first_name = trim($_POST['first_name'] ?? "");
$middle_name = trim($_POST['middle_name'] ?? "");
$last_name = trim($_POST['last_name'] ?? "");

// VALIDATION FIRST NAME
if (validateRequired($first_name)) {
    $error['First Name'] = "Please enter a First Name";
} elseif (mb_strlen($first_name) < 3 || mb_strlen($first_name) > 15) {
    $error['First Name'] = "Please enter value between 3 and 15 characters.";
} elseif (!preg_match('/^[A-Za-z ]+$/', $first_name)) {
    $error['First Name'] = "Only letters and spaces are allowed.";
}

// VALIDATION MIDDLE NAME
if (!empty($middle_name) || $_POST['middle_name'] !== "") {
    if (!preg_match('/^[A-Za-z ]+$/', $first_name)) {
        $error['Middle Name'] = "Only letters and spaces are allowed.";
    }
}

// VALIDATION LAST NAME
if (validateRequired($last_name)) {
    $error['Last Name'] = "Please enter a Last Name";
} elseif (mb_strlen($last_name) < 3 || mb_strlen($last_name) > 15) {
    $error['Last Name'] = "Please enter value between 3 and 15 characters.";
} elseif (!preg_match('/^[A-Za-z ]+$/', $last_name)) {
    $error['Last Name'] = "Only letters and spaces are allowed.";
}


// DATE OF BIRTH
$dob = trim($_POST['dob'] ?? "");

if (empty($dob)) {

    $error['DOB'] = "Date of Birth is required.";
} else {

    $date = DateTime::createFromFormat("Y-m-d", $dob);

    $today = new DateTime();

    $minimum_date = new DateTime("1947-01-01");

    if (!$date || $date->format("Y-m-d") !== $dob) {

        $error['dob'] = "Please enter a valid date of birth.";
    } elseif ($date > $today) {

        $error['dob'] = "Date of Birth cannot be a future date.";
    } elseif ($date < $minimum_date) {

        $error['dob'] = "Date of Birth cannote be before 1 January 1947.";
    }
}

//    GENDER VALIDATION
$gender = mysqli_real_escape_string($connection, trim($_POST['gender'] ?? ""));

$allowed_gender = [1, 2, 3, 4];

if (empty($gender)) {

    $error['gender'] = "Please select gender.";
} elseif (!in_array($gender, $allowed_gender)) {

    $error['gender'] = "Invalid gender selected.";
}


// BLOOD GROUP VALIDATION
$blood_group = mysqli_real_escape_string($connection, trim($_POST['blood_group'] ?? ""));

$allowed_blood_group = [1, 2, 3, 4, 5, 6, 7, 8];

if (empty($blood_group)) {
    $blood_group = 0;
}

if (!empty($blood_group)) {

    if (!in_array($blood_group, $allowed_blood_group)) {

        $error['Blood Group'] = "Please select a valid blood group";
    }
}

// Marital Status & Validation
$marital_status = mysqli_real_escape_string($connection, trim($_POST['marital_status'] ?? ""));


// Nationality 
$nationality = mysqli_real_escape_string($connection, trim($_POST['nationality'] ?? ""));

if (!empty($nationality)) {
    if (!preg_match('/^[a-zA-Z ]+$/', $nationality)) {
        $error['Nationality'] = "Only letters and spaces are allowed.";
    }
}


// Preferred Language
$preferred_language = mysqli_real_escape_string($connection, trim($_POST['preferred_language'] ?? ""));

if (!empty($preferred_language)) {
    if (!preg_match('/^[a-zA-Z ]+$/', $preferred_language)) {
        $error['Preferred Language'] = "Only letters and spaces are allowed.";
    }
}

// Patient Phone
$patient_phone = mysqli_real_escape_string($connection, trim($_POST['patient_phone'] ?? ""));

if (empty($patient_phone)) {

    $error['Pateint Phone'] = "Please enter a value";

} elseif (!preg_match('/^[0-9]+$/' ,$patient_phone)) {

    $error['Patient Phone'] = "Only numbers are allowed.";

} elseif (mb_strlen($patient_phone) !== 10) {

    $error['Patient Phone'] = "Please enter 10 digit phone number.";

}

// Address Line
$address = mysqli_real_escape_string($connection, trim($_POST['full_address'] ?? ""));

if (empty($address)) {

    $error['Address'] = "Please enter address";

}

// State
$state = mysqli_real_escape_string($connection, trim($_POST['state'] ?? ""));

if (empty($state)) {
    $error['State'] = "Please select a state.";
}

// District
$district = mysqli_real_escape_string($connection, trim($_POST['district'] ?? ""));

if (empty($district)) {
    $error["District"] = "Please select a district.";
}

// Village Town City
$village_town_city = mysqli_real_escape_string($connection, trim($_POST['village_town_city'] ?? ""));

if (empty($village_town_city)) {
    $error['Village Town City'] = "Please enter a value";
} elseif (!preg_match('/^[a-zA-Z ]+$/', $village_town_city)) {
    $error['Village Town City'] = "Only letters and spaces are allowed";
}

// PIN Code
$pincode = mysqli_real_escape_string($connection, trim($_POST['pincode'] ?? ""));

if (empty($pincode)) {
    $error['PIN Code'] = "Please enter pin code.";
} elseif (!preg_match('/^[0-9]+$/', $pincode)) {
    $error['PIN Code'] = "Only numbers are allowed.";
} elseif(mb_strlen($pincode) !== 6) {
    $error['PIN Cdoe'] = "Please enter 6 digit PIN code.";
}

// Country 
$country = mysqli_real_escape_string($connection, $_POST['country'] ?? "");

if (empty($country)) {
    $error['Country'] = "Please enter a country.";
} elseif (!preg_match("/^[a-zA-Z ]+$/", $country)) {
    $error['Country'] = "Only letters and spaces are allowed.";
}


// _______________________FAMILY INFROMATION___________________________________
// Father Name

$father_name = mysqli_real_escape_string($connection, $_POST['father_name'] ?? "");

if (!empty($father_name)) {
    if (!preg_match("/^[a-zA-Z ]+$/", $father_name)) {
        $error['Father Name'] = "Only letters and spaces are allowed.";
    }elseif(mb_strlen($father_name) < 3 || mb_strlen($father_name) > 20 ) {
        $error['Father Name'] = "Please enter value between 3 and 20 characters."; 
    }
}

// Mother Name
$mother_name = mysqli_real_escape_string($connection, $_POST['mother_name'] ?? "");

if (!empty($mother_name)) {
    if (!preg_match("/^[a-zA-Z ]+$/", $mother_name)) {
        $error['Mother Name'] = "Only letters and spaces are allowed.";
    }elseif(mb_strlen($mother_name) < 3 || mb_strlen($mother_name) > 20 ) {
        $error['Mother Name'] = "Please enter value between 3 and 20 characters."; 
    }
}

// Spouse Name
$spouse_name = mysqli_real_escape_string($connection, trim($_POST['spouse_name'] ?? ""));

if (!empty($spouse_name)) {
    if (!preg_match("/^[a-zA-Z ]+$/", $spouse_name)) {
        $error['Spouse Name'] = "Only letters and spaces are allowed.";
    }elseif(mb_strlen($spouse_name) < 3 || mb_strlen($spouse_name) > 20 ) {
        $error['Spouse Name'] = "Please enter value between 3 and 20 characters."; 
    }
}


// ________________EMERGENCY CONTACT_________________________//

// Contact Name
$contact_name = mysqli_real_escape_string($connection, trim($_POST['contact_name'] ?? ""));

if (empty($contact_name)) {
    $error['Contact Name'] = "Please enter a contact name.";
}

if (!empty($contact_name)) {
    if (!preg_match("/^[a-zA-Z ]+$/", $contact_name)) {
        $error['Contact Name'] = "Only letters and spaces are allowed.";
    }elseif(mb_strlen($contact_name) < 3 || mb_strlen($contact_name) > 20 ) {
        $error['Contact Name'] = "Please enter value between 3 and 20 characters."; 
    }
}

// Relationship
$relationship = mysqli_real_escape_string($connection, trim($_POST['relationship'] ?? ""));

if (empty($relationship)) {
    $error['Relationship'] = "Please select a relation.";
}

// Emergency Mobile
$emergency_mobile = mysqli_real_escape_string($connection, trim($_POST['emergency_mobile'] ?? ""));

if (empty($emergency_mobile)) {

    $error['Emergency Phone'] = "Please enter a value";

} elseif (!preg_match('/^[0-9]+$/' ,$emergency_mobile)) {

    $error['Emergency Phone'] = "Only numbers are allowed.";

} elseif (mb_strlen($emergency_mobile) !== 10) {

    $error['Emergency Phone'] = "Please enter 10 digit phone number.";

}

// Emergency Address
$emergency_address = mysqli_real_escape_string($connection, trim($_POST['emergency_address'] ?? ""));


if (empty($address)) {
    $error['address'] = "please enter a address.";
}



if (!empty($error)) {
    echo json_encode([
        "status" => false,
        "message" => $error
    ]);

    exit();
}


// INSERTING Patient DATA

$sql_insert_patient = "INSERT INTO patients (
                        title, first_name, middle_name, last_name, dob, gender, marital_status,
                        father_name, mother_name, spouse_name, patient_phone, address, village_town_city,
                        district, state, country, pincode, nationality, preferred_language, blood_group
)

VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($connection, $sql_insert_patient);

mysqli_stmt_bind_param(
    $stmt,
    "sssssisssssssisssssi",
    $title, $first_name, $middle_name, $last_name, $dob, $gender, $marital_status,
    $father_name, $mother_name, $spouse_name, $patient_phone, $address, $village_town_city,
    $district, $state, $country, $pincode, $nationality, $preferred_language, $blood_group
);

$result_insert_patient = mysqli_stmt_execute($stmt);

// Updating UHID

if ($result_insert_patient) {

    $patient_id = mysqli_insert_id($connection);

    $uhid = "HMS" . str_pad($patient_id, 6, "0", STR_PAD_LEFT);

    $update_uhid_sql = "UPDATE patients
                        SET uhid = ?
                        WHERE patient_id = ?";

    $stmt_uhid = mysqli_prepare($connection, $update_uhid_sql);

    mysqli_stmt_bind_param($stmt_uhid, "si", $uhid, $patient_id);

    $result_uhid = mysqli_stmt_execute($stmt_uhid);

    // INSERTING EMERGENCY CONTACT
    $sql_emergency_contact = "INSERT INTO emergency_contact(patient_id, contact_name, relationship, mobile, emergency_address)
                            VALUES ( ?, ?, ?, ?, ? )";

    $stmt_emergency_contact = mysqli_prepare($connection, $sql_emergency_contact);

    mysqli_stmt_bind_param($stmt_emergency_contact, "issss", $patient_id, $contact_name, $relationship, $emergency_mobile, $emergency_address);

    $result_emergency_contact = mysqli_stmt_execute($stmt_emergency_contact);

}





echo json_encode([
    "status" => true,
    "message" => "Patient created successfully."
]);
