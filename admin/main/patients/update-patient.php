<?php

include "../configs/config.php";

$error = [];

// ______________ PERSONAL INFORMATION ___________//

// Patient ID 
$patient_id = mysqli_real_escape_string($connection, $_POST['patient_id'] ?? "");

// UHID
$uhid = mysqli_real_escape_string($connection, $_POST['uhid'] ?? "");

// Title & Validation
$title = mysqli_real_escape_string($connection, $_POST['title'] ?? "");

if (empty($title)) {
    $error['Title'] = "Please choose a title.";
}

// First Name & Validation
$first_name = mysqli_real_escape_string($connection, $_POST['first_name'] ?? "");

if (empty($first_name)) {
    $error['First Name'] = "Please enter a First Name.";
} elseif (mb_strlen($first_name) < 3 || mb_strlen($first_name) > 20) {
    $error['First Name'] = "Please enter value between 3 and 20 characters.";
} elseif (!preg_match('/^[a-zA-Z ]+$/', $first_name)) {
    $error['First Name'] = "Only letters are allowed.";
}

// Middle Name
$middle_name = mysqli_real_escape_string($connection, $_POST['middle_name'] ?? "");

if (!empty($middle_name)) {
    if (mb_strlen($middle_name) < 3 || mb_strlen($middle_name) > 20) {
        $error['Middle Name'] = "Please enter value between 3 and 20 characters.";
    } elseif (!preg_match('/^[a-zA-Z ]+$/', $middle_name)) {
        $error['Middle Name'] = "Only letters are allowed.";
    }
}

// Last Name
$last_name = mysqli_real_escape_string($connection, trim($_POST['last_name']) ?? "");

if (empty($last_name)) {
    $error['Last Name'] = "Please enter value.";
} elseif (mb_strlen($last_name) < 3 || mb_strlen($last_name) > 20) {
    $error['Last Name'] = "Please enter value between 3 and 20 characters.";
} elseif (!preg_match('/^[a-zA-Z ]+$/', $last_name)) {
    $error['Last Name'] = "Only letters are allowed.";
}

// Date of Birth
$dob = mysqli_real_escape_string($connection, trim($_POST['dob']) ?? "");

if (empty($dob)) {
    $error['Date of Birth'] = "Please select Date of Birth.";
} else {
    $date = DateTime::createFromFormat("Y-m-d", $dob);

    $today = new DateTime();

    $minimum_date = new DateTime('1947-01-01');

    if (!$date || $date->format("Y-m-d") !== $dob) {
        $error['Date Of Birth'] = "Please select a correct date of birth.";
    } elseif ($date > $today) {
        $error['Date Of Birth'] = "Date Of Birth cannot be future date.";
    } elseif ($date < $minimum_date) {
        $error['Date Of Birth'] = "Date Of Birth cannot be less than 01-01-1947";
    }
}


// Gender
$gender = mysqli_real_escape_string($connection, trim($_POST['gender']) ?? "");

$allowed_gender = [1, 2, 3, 4];

if (empty($gender)) {
    $error['Gender'] = "Please select a gender.";
} elseif (!in_array($gender, $allowed_gender)) {
    $error['Gender'] = "Please select a valid gender";
}

// Marital Status
$marital_status = mysqli_real_escape_string($connection, $_POST['marital_status'] ?? "");

if (empty($marital_status)) {
    $error['Marital Status'] = "Please select a status.";
}

// Blood Group
$blood_group = mysqli_real_escape_string($connection, $_POST['blood_group'] ?? "");

if (!empty($blood_group)) {
    $allowed_blood_group = [1, 2, 3, 4, 5, 6, 7, 8];
    if (!in_array($blood_group, $allowed_blood_group)) {
        $error['Blood Group'] = "Please select valid blood group.";
    }
}

// Nationality
$nationality = mysqli_real_escape_string($connection, trim($_POST['nationality']) ?? "");

if (!empty($nationality)) {
    if (mb_strlen($nationality) < 3 || mb_strlen($nationality) > 20) {
        $error['Nationality'] = "Please enter value between 3 and 20 characters.";
    } elseif (!preg_match('/^[a-zA-Z ]+$/', $nationality)) {
        $error['Nationality'] = "Only letters and spaces are allowed.";
    }
}

// Preferred Language
$preferred_language = mysqli_real_escape_string($connection, $_POST['preferred_language'] ?? "");

if (!empty($preferred_language)) {
    if (mb_strlen($preferred_language) < 3 || mb_strlen($preferred_language) > 40) {
        $error['Preferred Language'] = "Please enter value between 3 and 40 characters.";
    } elseif (!preg_match('/^[a-zA-Z, ]+$/', $preferred_language)) {
        $error['Preferred Language'] = "Only letters, spaces and comma (,) are allowed.";
    }
}

// ___________FAMILY INFORMATION _________________//

// Father Name
$father_name = mysqli_real_escape_string($connection, $_POST['father_name'] ?? "");

if ($father_name === "") {
    $error['Father Name'] = "Please enter a value.";
} elseif (mb_strlen($father_name) < 3 || mb_strlen($father_name) > 20) {
    $error['Father Name'] = "Please enter value between 3 and 20 characters.";
} elseif (!preg_match('/^[a-zA-Z ]+$/', $father_name)) {
    $error['Father Name'] = "Only letters and spaces are allowed.";
}

// Mother Name
$mother_name = mysqli_real_escape_string($connection, $_POST['mother_name'] ?? "");

if ($mother_name === "") {
    $error['Mother Name'] = "Please enter a value.";
} elseif (mb_strlen($mother_name) < 3 || mb_strlen($mother_name) > 20) {
    $error['Mother Name'] = "Please enter value between 3 and 20 characters.";
} elseif (!preg_match('/^[a-zA-Z ]+$/', $mother_name)) {
    $error['Mother Name'] = "Only letters and spaces are allowed.";
}

// Spouse Name
$spouse_name = mysqli_real_escape_string($connection, $_POST['spouse_name'] ?? "");

if ($spouse_name !== "") {
    if (mb_strlen($spouse_name) < 3 || mb_strlen($spouse_name) > 20) {
        $error['Spouse Name'] = "Please enter value between 3 and 20 characters.";
    } elseif (!preg_match('/^[a-zA-Z ]+$/', $spouse_name)) {
        $error['Spouse Name'] = "Only letters and spaces are allowed.";
    }
}

// _____________CONTACT INFORMATION ________________________//

// Patient Phone
$patient_phone = mysqli_real_escape_string($connection, $_POST['patient_phone'] ?? "");

if ($patient_phone === "") {
    $error['Patient Phone'] = "Please enter a value.";
} elseif (!preg_match('/^[6-9][0-9]{9}$/', $patient_phone)) {
    $error['Patient Phone'] = "Please enter Indian Phone number.";
}

// Address
$address = mysqli_real_escape_string($connection, $_POST['address'] ?? "");

if ($address === "") {
    $error['Address'] = "Please enter a value";
} elseif (mb_strlen($address) < 5 || mb_strlen($address) > 200) {
    $error['Address'] = "Please enter value between 5 and 200 charactrs.";
}

// State
$state = mysqli_real_escape_string($connection, $_POST['state'] ?? "");

if ($state === "") {
    $error['State'] = "Please select a state.";
}

// District
$district = mysqli_real_escape_string($connection, $_POST['district'] ?? "");

if ($district === "") {
    $error['District'] = "Please select a district.";
}

// Country
$country = mysqli_real_escape_string($connection, $_POST['country'] ?? "");

if ($country === "") {
    $error['Country'] = "Please enter a value.";
} elseif (mb_strlen($country) < 3 || mb_strlen($country) > 20) {
    $error['Country'] = "Please enter value between 3 and 20 characters.";
} elseif (!preg_match('/^[a-zA-Z ]+$/', $country)) {
    $error['Country'] = "Only letters and spaces are allowed.";
}

// Village / Town / City
$village_town_city = mysqli_real_escape_string($connection, $_POST['village_town_city'] ?? "");

if ($village_town_city === "") {
    $error['Village/Town/City'] = "Please enter a value";
} elseif (mb_strlen($village_town_city) < 3 || mb_strlen($village_town_city) > 20) {
    $error['Village/Town/City'] = "Please enter value between 3 and 20 characters.";
} elseif (!preg_match('/^[a-zA-Z ]+$/', $village_town_city)) {
    $error['Village/Town/City'] = "Only letters and spaces are allowed.";
}

// PINCODE
$pincode = trim($_POST['pincode'] ?? "");

if ($pincode === "") {
    $error['PIN Code'] = "Please enter a value.";
} elseif (!preg_match('/^[7][0-9]{5}$/', $pincode)) {
    $error['PIN Code'] = "Please enter a valid pincode starting with digit 7 and only 6 digit (exmp : 746902)";
}

// _____________ EMERGENCY CONTACT ___________________//

// Contact Name
$contact_name = trim($_POST['contact_name'] ?? "");

if ($contact_name === "") {
    $error['Contact Name'] = "Please enter a value";
} elseif (mb_strlen($contact_name) < 3 || mb_strlen($contact_name) > 20) {
    $error['Contact Name'] = "Please enter value between 3 and 20 characters.";
} elseif (!preg_match('/^[a-zA-Z ]+$/', $contact_name)) {
    $error['Contact Name'] = "Only letters and spaces are allowed.";
}

// Relationship
$relationship = trim($_POST['relationship'] ?? "");

if ($relationship === "") {
    $error['Relation'] = "Please select a relation.";
}

// Emergency Mobile
$mobile = trim($_POST['mobile'] ?? "");

if ($mobile === "") {
    $error['Emergency Phone'] = "Please enter a value.";
} elseif (!preg_match('/^[6-9][0-9]{9}$/', $mobile)) {
    $error['Emergency Phone'] = "Please enter Indian Phone number.";
}

// Emergency Address
$emergency_address = trim($_POST['emergency_address'] ?? "");

if ($emergency_address === "") {
    $error['Emergency Address'] = "Please enter a value";
} elseif (mb_strlen($emergency_address) < 5 || mb_strlen($emergency_address) > 200) {
    $error['Emergency Address'] = "Please enter value between 5 and 200 charactrs.";
}





// ERROR HANDLING
if (!empty($error)) {
    echo json_encode([
        "status" => false,
        "message" => $error
    ]);

    exit();
}

// UPDATE PATIENT 
$sql_update_patient = "UPDATE patients
                        SET title = ?, first_name = ?, middle_name = ?, last_name = ?, dob = ?,
                        gender = ?, marital_status = ?, father_name = ?, mother_name = ?, spouse_name = ?, 
                        patient_phone = ?, address = ?, village_town_city = ?, district = ?, 
                        state = ?, country = ?, pincode = ?, nationality = ?, preferred_language = ?, blood_group = ?,
                        updated_at = NOW() WHERE uhid = ?";

$stmt_update = mysqli_prepare($connection, $sql_update_patient);

mysqli_stmt_bind_param(
    $stmt_update,
    "sssssisssssssisssssis",
    $title,
    $first_name,
    $middle_name,
    $last_name,
    $dob,
    $gender,
    $marital_status,
    $father_name,
    $mother_name,
    $spouse_name,
    $patient_phone,
    $address,
    $village_town_city,
    $district,
    $state,
    $country,
    $pincode,
    $nationality,
    $preferred_language,
    $blood_group,
    $uhid
);

$stmt_result = mysqli_stmt_execute($stmt_update);

if ($stmt_result) {
    echo json_encode([
        "status" => true,
        "message" => "Patient Updated Successfully."
    ]);
}
