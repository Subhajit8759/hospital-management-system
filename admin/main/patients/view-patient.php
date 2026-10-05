<?php

include "../configs/config.php";

$patient_id = trim($_POST['patient_id']);

$sql_view = "SELECT * FROM patients
    LEFT JOIN gender ON gender.gender_id = patients.gender
    LEFT JOIN blood_group ON blood_group.blood_group_id = patients.blood_group
    LEFT JOIN emergency_contact ON emergency_contact.patient_id = patients.patient_id
    LEFT JOIN states ON states.sid = patients.state
    LEFT JOIN districts ON districts.district_id = patients.district
    WHERE patients.patient_id = ?";

$stmt_view = mysqli_prepare($connection, $sql_view);

mysqli_stmt_bind_param($stmt_view, "i", $patient_id);

mysqli_stmt_execute($stmt_view);

$result_view = mysqli_stmt_get_result($stmt_view);

if (mysqli_num_rows($result_view) > 0) {
    while ($row_view = mysqli_fetch_assoc($result_view)) {

?>
<div class="container-fluid p-3">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">

        <h4 class="mb-0">
            Patient Details
        </h4>

        <div>
            <a href="#"
               class="btn btn-secondary btn-sm back-to-patients">
                <i class="bi bi-arrow-left"></i>
                Back
            </a>

            <a href="#"
               class="btn btn-primary btn-sm edit-patient" data-id="<?= $row_view['patient_id']; ?>">
                <i class="bi bi-pencil"></i>
                Edit
            </a>
        </div>

    </div>


    <!-- Patient Information -->
    <div class="card shadow-sm mb-3">

        <div class="card-header">
            <h6 class="mb-0">
                Patient Information
            </h6>
        </div>

        <div class="card-body">

            <!-- UHID -->
            <div class="row mb-2">
                <div class="col-md-3 fw-semibold">
                    UHID
                </div>

                <div class="col-md-9">
                :  &nbsp;&nbsp;  <?= $row_view['uhid']; ?>
                </div>
            </div>


            <!-- Title -->
            <div class="row mb-2">
                <div class="col-md-3 fw-semibold">
                    Title
                </div>

                <div class="col-md-9">
              : &nbsp;&nbsp; <?= $row_view['title']; ?>
                </div>
            </div>


            <!-- First Name -->
            <div class="row mb-2">
                <div class="col-md-3 fw-semibold">
                    First Name
                </div>

                <div class="col-md-9">
              : &nbsp;&nbsp; <?= $row_view['first_name']; ?>
                </div>
            </div>


            <!-- Middle Name -->
            <div class="row mb-2">
                <div class="col-md-3 fw-semibold">
                    Middle Name
                </div>

                <div class="col-md-9">
              : &nbsp;&nbsp; <?= (strlen($row_view['middle_name']) > 0) ? $row_view['middle_name'] : "-"; ?>
                </div>
            </div>


            <!-- Last Name -->
            <div class="row mb-2">
                <div class="col-md-3 fw-semibold">
                    Last Name
                </div>

                <div class="col-md-9">
              :  &nbsp;&nbsp; <?= $row_view['last_name']; ?>
                </div>
            </div>


            <!-- Date of Birth -->
            <div class="row mb-2">
                <div class="col-md-3 fw-semibold">
                    Date of Birth
                </div>

                <div class="col-md-9">
               : &nbsp;&nbsp;
               <?php
                    $dob = $row_view['dob'];

                    $date =  new DateTime($dob);

                    echo $date->format("d-m-Y");
               ?>
                </div>
            </div>

            <!-- Age -->
            <div class="row mb-2">
                <div class="col-md-3 fw-semibold">
                    Age
                </div>

                <div class="col-md-9">
               : &nbsp;&nbsp;
               <?php
                    $dob = $row_view['dob'];

                    $today = new DateTime("today");

                    $age = $today->format("Y") - $date->format("Y");

                    echo $age;
               ?>
                </div>
            </div>


            <!-- Gender -->
            <div class="row mb-2">
                <div class="col-md-3 fw-semibold">
                    Gender
                </div>

                <div class="col-md-9">
               : &nbsp;&nbsp; <?= $row_view['gender_name']; ?>
                </div>
            </div>


            <!-- Marital Status -->
            <div class="row mb-2">
                <div class="col-md-3 fw-semibold">
                    Marital Status
                </div>

                <div class="col-md-9">
               : &nbsp;&nbsp; <?= $row_view['marital_status']; ?>
                </div>
            </div>


            <!-- Blood Group -->
            <div class="row mb-2">
                <div class="col-md-3 fw-semibold">
                    Blood Group
                </div>

                <div class="col-md-9">
                    : &nbsp;&nbsp; <?= $row_view['blood_group_name']; ?>
                </div>
            </div>


            <!-- Nationality -->
            <div class="row mb-2">
                <div class="col-md-3 fw-semibold">
                    Nationality
                </div>

                <div class="col-md-9">
                    : &nbsp;&nbsp; <?= $row_view['nationality']; ?>
                </div>
            </div>


            <!-- Preferred Language -->
            <div class="row mb-2">
                <div class="col-md-3 fw-semibold">
                    Preferred Language
                </div>

                <div class="col-md-9">
                    : &nbsp;&nbsp; <?= $row_view['preferred_language']; ?>
                </div>
            </div>

        </div>

    </div>


    <!-- Family Information -->
    <div class="card shadow-sm mb-3">

        <div class="card-header">
            <h6 class="mb-0">
                Family Information
            </h6>
        </div>

        <div class="card-body">

            <!-- Father Name -->
            <div class="row mb-2">
                <div class="col-md-3 fw-semibold">
                    Father Name
                </div>

                <div class="col-md-9">
                    : &nbsp;&nbsp; <?= $row_view['father_name']; ?>
                </div>
            </div>


            <!-- Mother Name -->
            <div class="row mb-2">
                <div class="col-md-3 fw-semibold">
                    Mother Name
                </div>

                <div class="col-md-9">
                    : &nbsp;&nbsp; <?= $row_view['mother_name']; ?>
                </div>
            </div>


            <!-- Spouse Name -->
            <div class="row mb-2">
                <div class="col-md-3 fw-semibold">
                    Spouse Name
                </div>

                <div class="col-md-9">
                    : &nbsp;&nbsp; <?= strlen($row_view['spouse_name']) ? $row_view['spouse_name'] : "-"; ?>
                </div>
            </div>

        </div>

    </div>


    <!-- Contact Information -->
    <div class="card shadow-sm mb-3">

        <div class="card-header">
            <h6 class="mb-0">
                Contact Information
            </h6>
        </div>

        <div class="card-body">

            <!-- Patient Phone -->
            <div class="row mb-2">
                <div class="col-md-3 fw-semibold">
                    Patient Phone
                </div>

                <div class="col-md-9">
                    : &nbsp;&nbsp; <?= $row_view['patient_phone']; ?>
                </div>
            </div>


            <!-- Address -->
            <div class="row mb-2">
                <div class="col-md-3 fw-semibold">
                    Address
                </div>

                <div class="col-md-9">
                    : &nbsp;&nbsp; <?= $row_view['address']; ?>
                </div>
            </div>


            <!-- Village Town City -->
            <div class="row mb-2">
                <div class="col-md-3 fw-semibold">
                    Village / Town / City
                </div>

                <div class="col-md-9">
                    : &nbsp;&nbsp; <?= $row_view['village_town_city']; ?>
                </div>
            </div>


            <!-- District -->
            <div class="row mb-2">
                <div class="col-md-3 fw-semibold">
                    District
                </div>

                <div class="col-md-9">
                    : &nbsp;&nbsp; <?= $row_view['district_name']; ?>
                </div>
            </div>


            <!-- State -->
            <div class="row mb-2">
                <div class="col-md-3 fw-semibold">
                    State
                </div>

                <div class="col-md-9">
                    : &nbsp;&nbsp; <?= $row_view['state_name']; ?>
                </div>
            </div>


            <!-- Country -->
            <div class="row mb-2">
                <div class="col-md-3 fw-semibold">
                    Country
                </div>

                <div class="col-md-9">
                    : &nbsp;&nbsp; <?= $row_view['country']; ?>
                </div>
            </div>


            <!-- PIN Code -->
            <div class="row mb-2">
                <div class="col-md-3 fw-semibold">
                    PIN Code
                </div>

                <div class="col-md-9">
                    : &nbsp;&nbsp; <?= $row_view['pincode']; ?>
                </div>
            </div>

        </div>

    </div>


    <!-- Emergency Contact -->
    <div class="card shadow-sm mb-3">

        <div class="card-header">
            <h6 class="mb-0">
                Emergency Contact
            </h6>
        </div>

        <div class="card-body">

            <!-- Contact Name -->
            <div class="row mb-2">
                <div class="col-md-3 fw-semibold">
                    Contact Name
                </div>

                <div class="col-md-9">
                    : &nbsp;&nbsp; <?= $row_view['contact_name']; ?>
                </div>
            </div>


            <!-- Relationship -->
            <div class="row mb-2">
                <div class="col-md-3 fw-semibold">
                    Relationship
                </div>

                <div class="col-md-9">
                    : &nbsp;&nbsp; <?= ucfirst($row_view['relationship']); ?>
                </div>
            </div>


            <!-- Emergency Mobile -->
            <div class="row mb-2">
                <div class="col-md-3 fw-semibold">
                    Emergency Mobile
                </div>

                <div class="col-md-9">
                    : &nbsp;&nbsp; <?= $row_view['mobile']; ?>
                </div>
            </div>


            <!-- Emergency Address -->
            <div class="row mb-2">
                <div class="col-md-3 fw-semibold">
                    Emergency Address
                </div>

                <div class="col-md-9">
                    : &nbsp;&nbsp; <?= $row_view['emergency_address']; ?>
                </div>
            </div>

        </div>

    </div>

</div>

<?php } }?>
