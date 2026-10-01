<?php
include "../configs/config.php";
?>

<div class="container-fluid">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">

        <div>
            <h5 class="mb-1">Patient Registration</h5>
            <small class="text-muted">Register a new patient</small>
        </div>

        <button type="button" class="btn btn-secondary btn-sm back-to-patients">
            <i class="bi bi-arrow-left"></i> Back
        </button>

    </div>


    <!-- Patient Registration Form -->
    <form id="createPatientForm">

        <!-- =========================
             PATIENT INFORMATION
        ========================== -->
        <div class="card shadow-sm mb-3">

            <div class="card-header bg-white">
                <h6 class="mb-0">
                    <i class="bi bi-person-vcard me-2"></i>
                    Patient Information
                </h6>
            </div>

            <div class="card-body">

                <div class="row g-3">

                    <!-- UHID -->
                    <div class="col-md-3">
                        <label class="form-label">UHID</label>

                        <input type="text" class="form-control" id="uhid" name="uhid" placeholder="Auto Generated"
                            readonly>
                    </div>


                    <!-- Title -->
                    <div class="col-md-3">
                        <label class="form-label">Title <span class="text-danger">*</span></label>

                        <select class="form-select" id="title" name="title">

                            <option value="" selected disabled>Select Title</option>
                            <option value="Mr">Mr</option>
                            <option value="Mrs">Mrs</option>
                            <option value="Ms">Ms</option>
                            <!-- <option value="Master">Master</option> -->
                            <option value="Baby Of">Baby Of</option>

                        </select>
                    </div>


                    <!-- First Name -->
                    <div class="col-md-3">
                        <label class="form-label">
                            First Name <span class="text-danger">*</span>
                        </label>

                        <input type="text" class="form-control" id="first_name" name="first_name"
                            placeholder="Enter first name">
                    </div>


                    <!-- Middle Name -->
                    <div class="col-md-3">
                        <label class="form-label">
                            Middle Name
                        </label>

                        <input type="text" class="form-control" id="middle_name" name="middle_name"
                            placeholder="Enter middle name">
                    </div>


                    <!-- Last Name -->
                    <div class="col-md-3">
                        <label class="form-label">
                            Last Name
                        </label>

                        <input type="text" class="form-control" id="last_name" name="last_name"
                            placeholder="Enter last name">
                    </div>


                    <!-- Date of Birth -->
                    <div class="col-md-3">
                        <label class="form-label">
                            Date of Birth <span class="text-danger">*</span>

                            <strong class="text-danger d-none" id="full_age">

                                (
                                <span id="age_year">0</span> Years,
                                <span id="age_month">0</span> Months,
                                <span id="age_day">0</span> Days
                                )

                            </strong>
                        </label>

                        <input type="date" class="form-control" id="patient_dob" name="dob" min="1947-01-01"
                            max="<?= date("Y-m-d"); ?>">
                    </div>


                    <!-- Gender -->
                    <div class="col-md-3">
                        <label class="form-label">
                            Gender <span class="text-danger">*</span>
                        </label>

                        <select class="form-select" id="gender_id" name="gender">

                            <option value="select" selected disabled>Select Gender</option>

                            <?php
                            $sql_gender = "SELECT * FROM gender";

                            $result_gender = mysqli_query($connection, $sql_gender);

                            if (mysqli_num_rows($result_gender) > 0) {

                                while ($row_gender = mysqli_fetch_assoc($result_gender)) {

                            ?>
                                    <option value="<?= $row_gender['gender_id'] ?>"><?= $row_gender['gender_name']; ?></option>

                            <?php

                                }
                            }
                            ?>


                        </select>
                    </div>


                    <!-- Blood Group -->
                    <div class="col-md-3">
                        <label class="form-label">
                            Blood Group
                        </label>

                        <select class="form-select" id="blood_group" name="blood_group">

                            <option value="">Select Blood Group</option>

                            <?php

                            $sql_blood_group = "SELECT * FROM blood_group";

                            $result_blood_group = mysqli_query($connection, $sql_blood_group);

                            if (mysqli_num_rows($result_blood_group) > 0) {

                                while ($row_blood_group = mysqli_fetch_assoc($result_blood_group)) {


                            ?>

                                    <option value="<?php echo $row_blood_group['blood_group_id']; ?>">
                                        <?php echo $row_blood_group['blood_group_name']; ?></option>

                            <?php
                                }
                            }
                            ?>


                        </select>
                    </div>


                    <!-- Marital Status -->
                    <div class="col-md-3">
                        <label class="form-label">
                            Marital Status <span class="text-danger">*</span>
                        </label>

                        <select class="form-select" id="marital_status" name="marital_status">

                            <option value="select">Select Status</option>
                            <option value="single">Single</option>
                            <option value="married">Married</option>
                            <option value="divorced">Divorced</option>
                            <option value="widowed">Widowed</option>

                        </select>
                    </div>


                    <!-- Nationality -->
                    <div class="col-md-3">
                        <label class="form-label">
                            Nationality
                        </label>

                        <input type="text" class="form-control" id="nationality" name="nationality" value="Indian">
                    </div>


                    <!-- Preferred Language -->
                    <div class="col-md-3">
                        <label class="form-label">
                            Preferred Language
                        </label>

                        <input type="text" class="form-control" id="preferred_language" name="preferred_language"
                            placeholder="Enter language">
                    </div>

                </div>

            </div>
        </div>


        <!-- =========================
             CONTACT & ADDRESS
        ========================== -->
        <div class="card shadow-sm mb-3">

            <div class="card-header bg-white">
                <h6 class="mb-0">
                    <i class="bi bi-telephone me-2"></i>
                    Contact & Address
                </h6>
            </div>

            <div class="card-body">

                <div class="row g-3">

                    <!-- Patient Phone -->
                    <div class="col-md-3">
                        <label class="form-label">
                            Mobile Number <span class="text-danger">*</span>
                        </label>

                        <input type="tel" class="form-control" id="patient_phone" name="patient_phone" maxlength="15"
                            placeholder="Enter mobile number">
                    </div>


                    <!-- Address Line 1 -->
                    <div class="col-md-6">
                        <label class="form-label">
                            Full Address <span class="text-danger">*</span>
                        </label>

                        <input type="text" class="form-control" id="full_address" name="full_address"
                            placeholder="House No., Street, etc.">
                    </div>


                    <!-- State -->
                    <div class="col-md-3">

                        <label class="form-label">
                            State
                        </label>

                        <select name="state" id="state" class="form-select state">

                            <option value="" selected disabled>
                                Select State <span class="text-danger">*</span>
                            </option>

                            <?php

                            $sql_state = "SELECT * FROM states";

                            $result_state = mysqli_query(
                                $connection,
                                $sql_state
                            );

                            if (mysqli_num_rows($result_state) > 0) {

                                while ($row_state = mysqli_fetch_assoc($result_state)) {

                            ?>

                                    <option value="<?= $row_state['sid']; ?>">
                                        <?= $row_state['state_name']; ?>
                                    </option>

                            <?php

                                }
                            }

                            ?>

                        </select>

                    </div>


                    <!-- District -->
                    <div class="col-md-3 d-none" id="district_row">

                        <label class="form-label">
                            District <span class="text-danger">*</span>
                        </label>

                        <select name="district" id="district" class="form-select">

                            <option value="">
                                Select District
                            </option>

                        </select>

                    </div>


                    <!-- Village / Town / City -->
                    <div class="col-md-3">

                        <label class="form-label">
                            Village / Town / City <span class="text-danger">*</span>
                        </label>

                        <input type="text" class="form-control" id="village_town_city" name="village_town_city"
                            placeholder="Enter village / town / city">

                    </div>


                    <!-- PIN Code -->
                    <div class="col-md-3">

                        <label class="form-label">
                            PIN Code <span class="text-danger">*</span>
                        </label>

                        <input type="text" class="form-control" id="pincode" name="pincode" maxlength="6"
                            placeholder="Enter PIN code">

                    </div>


                    <!-- Country -->
                    <div class="col-md-3">

                        <label class="form-label">
                            Country
                        </label>

                        <input type="text" class="form-control" id="country" name="country" value="India">

                    </div>

                </div>

            </div>
        </div>


        <!-- =========================
             FAMILY INFORMATION
        ========================== -->
        <div class="card shadow-sm mb-3">

            <div class="card-header bg-white">
                <h6 class="mb-0">
                    <i class="bi bi-people me-2"></i>
                    Family Information
                </h6>
            </div>

            <div class="card-body">

                <div class="row g-3">

                    <!-- Father -->
                    <div class="col-md-3">

                        <label class="form-label">
                            Father's Name
                        </label>

                        <input type="text" class="form-control" name="father_name" placeholder="Enter father's name">

                    </div>


                    <!-- Mother -->
                    <div class="col-md-3">

                        <label class="form-label">
                            Mother's Name
                        </label>

                        <input type="text" class="form-control" name="mother_name" placeholder="Enter mother's name">

                    </div>


                    <!-- Spouse -->
                    <div class="col-md-3">

                        <label class="form-label">
                            Spouse Name
                        </label>

                        <input type="text" class="form-control" name="spouse_name" placeholder="Enter spouse name">

                    </div>

                </div>

            </div>
        </div>


        <!-- =========================
             EMERGENCY CONTACT
        ========================== -->
        <div class="card shadow-sm mb-3">

            <div class="card-header bg-white">

                <h6 class="mb-0">
                    <i class="bi bi-person-exclamation me-2"></i>
                    Emergency Contact
                </h6>

            </div>

            <div class="card-body">

                <div class="row g-3">

                    <!-- Contact Name -->
                    <div class="col-md-3">

                        <label class="form-label">
                            Contact Name <span class="text-danger">*</span>
                        </label>

                        <input type="text" class="form-control" id="contact_name" name="contact_name"
                            placeholder="Enter contact name">

                    </div>


                    <!-- Relationship -->
                    <div class="col-md-3">

                        <label class="form-label">
                            Relationship <span class="text-danger">*</span>
                        </label>

                       <select name="relationship" id="relationship" class="form-control">
                            <option value="father">Father</option>
                            <option value="mother">Mother</option>
                            <option value="brother">Brother</option>
                            <option value="sister">Sister</option>
                            <option value="spouse">Spouse</option>
                            <option value="son">Son</option>
                            <option value="daughter">Daughter</option>
                            <option value="others">Others</option>
                       </select>

                    </div>


                    <!-- Mobile -->
                    <div class="col-md-3">

                        <label class="form-label">
                            Mobile <span class="text-danger">*</span>
                        </label>

                        <input type="tel" class="form-control" id="emergency_mobile" name="emergency_mobile"
                            maxlength="15" placeholder="Enter mobile number">

                    </div>


                    <!-- Emergency Address -->
                    <div class="col-md-12">

                        <label class="form-label">
                            Address <span class="text-danger">*</span>
                        </label>

                        <textarea class="form-control" id="emergency_address" name="emergency_address" rows="2"
                            placeholder="Enter emergency contact address"></textarea>

                    </div>

                </div>

            </div>
        </div>


        <!-- =========================
             FORM BUTTONS
        ========================== -->
        <div class="card shadow-sm">

            <div class="card-body d-flex justify-content-end gap-2">

                <button type="reset" class="btn btn-light border">

                    <i class="bi bi-arrow-counterclockwise"></i>
                    Reset

                </button>


                <button type="submit" class="btn btn-primary">

                    <i class="bi bi-person-plus"></i>
                    Save Patient

                </button>

            </div>

        </div>

    </form>

</div>