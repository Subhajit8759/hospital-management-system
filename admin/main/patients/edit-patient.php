<div class="container-fluid p-3">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">

        <h4 class="mb-0">
            Edit Patient
        </h4>

        <div>
            <a href="#" class="btn btn-secondary btn-sm back-to-patients">
                <i class="bi bi-arrow-left"></i>
                Back
            </a>
        </div>

    </div>


    <?php

    include "../configs/config.php";

    $patient_id = trim($_POST['patient_id']);

    $sql_edit = "SELECT * FROM patients
    LEFT JOIN gender ON gender.gender_id = patients.gender
    LEFT JOIN blood_group ON blood_group.blood_group_id = patients.blood_group
    LEFT JOIN emergency_contact ON emergency_contact.patient_id = patients.patient_id
    LEFT JOIN states ON states.sid = patients.state
    LEFT JOIN districts ON districts.district_id = patients.district
    WHERE patients.patient_id = ?";

    $stmt_patient_edit = mysqli_prepare($connection, $sql_edit);

    mysqli_stmt_bind_param($stmt_patient_edit, 'i', $patient_id);

    mysqli_stmt_execute($stmt_patient_edit);

    $result_patient_edit = mysqli_stmt_get_result($stmt_patient_edit);

    if (mysqli_num_rows($result_patient_edit) > 0) {

        while ($row_view = mysqli_fetch_assoc($result_patient_edit)) {

    ?>


    <form id="edit-patient-form">


        <!-- Patient Information -->
        <div class="card shadow-sm mb-3">

            <div class="card-header">
                <h6 class="mb-0">
                    Patient Information
                </h6>
            </div>

            <div class="card-body">

                <div class="row g-3">

                    <!-- UHID -->
                    <div class="col-md-6">
                        <label class="form-label">
                            UHID
                        </label>

                        <input type="text" class="form-control" name="uhid"
                            value="<?= htmlspecialchars($row_view['uhid']); ?>" readonly>
                    </div>


                    <!-- Title -->
                    <div class="col-md-6">
                        <label class="form-label">
                            Title
                        </label>

                        <select class="form-select" name="title">

                            <option value="">Select Title</option>

                            <option value="Ms" <?= ($row_view['title'] === 'Mr') ? 'selected' : ''; ?>>
                                Mr.
                            </option>

                            <option value="Mrs" <?= ($row_view['title'] === 'Mrs') ? 'selected' : ''; ?>>
                                Mrs.
                            </option>

                            <option value="Ms" <?= ($row_view['title'] === 'Ms') ? 'selected' : ''; ?>>
                                Ms.
                            </option>

                            <option value="Baby Of" <?= ($row_view['title'] === 'Baby Of') ? 'selected' : ''; ?>>
                                Baby Of
                            </option>

                        </select>
                    </div>


                    <!-- First Name -->
                    <div class="col-md-4">
                        <label class="form-label">
                            First Name <span class="text-danger">*</span>
                        </label>

                        <input type="text" class="form-control" name="first_name"
                            value="<?= htmlspecialchars($row_view['first_name']); ?>">
                    </div>


                    <!-- Middle Name -->
                    <div class="col-md-4">
                        <label class="form-label">
                            Middle Name
                        </label>

                        <input type="text" class="form-control" name="middle_name"
                            value="<?= htmlspecialchars($row_view['middle_name']); ?>">
                    </div>


                    <!-- Last Name -->
                    <div class="col-md-4">
                        <label class="form-label">
                            Last Name <span class="text-danger">*</span>
                        </label>

                        <input type="text" class="form-control" name="last_name"
                            value="<?= htmlspecialchars($row_view['last_name']); ?>">
                    </div>


                    <!-- DOB -->
                    <div class="col-md-4">
                        <label class="form-label">
                            Date of Birth <span class="text-danger">*</span>
                        </label>

                        <input type="date" class="form-control" name="dob"
                            value="<?= htmlspecialchars($row_view['dob']); ?>">
                    </div>


                    <!-- Gender -->
                    <div class="col-md-4">
                        <label class="form-label">
                            Gender <span class="text-danger">*</span>
                        </label>

                        <select class="form-select" name="gender">

                            <option value="">Select Gender</option>

                            <?php
                                    $sql_gender = "SELECT * FROM gender ORDER BY gender_name ASC";
                                    $result_gender = mysqli_query($connection, $sql_gender);

                                    while ($gender = mysqli_fetch_assoc($result_gender)) {
                                    ?>

                            <option value="<?= $gender['gender_id']; ?>"
                                <?= ($row_view['gender'] == $gender['gender_id']) ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($gender['gender_name']); ?>
                            </option>

                            <?php } ?>

                        </select>
                    </div>


                    <!-- Marital Status -->
                    <div class="col-md-4">
                        <label class="form-label">
                            Marital Status
                        </label>

                        <select class="form-select" name="marital_status">

                            <option value="">Select Status</option>

                            <option value="single" <?= ($row_view['marital_status'] === 'single') ? 'selected' : ''; ?>>
                                Single
                            </option>

                            <option value="married"
                                <?= ($row_view['marital_status'] === 'married') ? 'selected' : ''; ?>>
                                Married
                            </option>

                            <option value="divorced"
                                <?= ($row_view['marital_status'] === 'divorced') ? 'selected' : ''; ?>>
                                Divorced
                            </option>

                            <option value="widowed"
                                <?= ($row_view['marital_status'] === 'widowed') ? 'selected' : ''; ?>>
                                Widowed
                            </option>

                        </select>
                    </div>


                    <!-- Blood Group -->
                    <div class="col-md-4">

                        <label class="form-label">
                            Blood Group
                        </label>

                        <select class="form-select" name="blood_group">

                            <option value="">
                                Select Blood Group
                            </option>

                            <?php
                                    $sql_blood = "SELECT * FROM blood_group ORDER BY blood_group_name ASC";
                                    $result_blood = mysqli_query($connection, $sql_blood);

                                    while ($blood = mysqli_fetch_assoc($result_blood)) {
                                    ?>

                            <option value="<?= $blood['blood_group_id']; ?>"
                                <?= ($row_view['blood_group'] == $blood['blood_group_id']) ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($blood['blood_group_name']); ?>
                            </option>

                            <?php } ?>

                        </select>

                    </div>


                    <!-- Nationality -->
                    <div class="col-md-4">

                        <label class="form-label">
                            Nationality
                        </label>

                        <input type="text" class="form-control" name="nationality"
                            value="<?= htmlspecialchars($row_view['nationality']); ?>">

                    </div>


                    <!-- Preferred Language -->
                    <div class="col-md-4">

                        <label class="form-label">
                            Preferred Language
                        </label>

                        <input type="text" class="form-control" name="preferred_language"
                            value="<?= htmlspecialchars($row_view['preferred_language']); ?>">

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

                <div class="row g-3">

                    <!-- Father Name -->
                    <div class="col-md-4">

                        <label class="form-label">
                            Father Name
                        </label>

                        <input type="text" class="form-control" name="father_name"
                            value="<?= htmlspecialchars($row_view['father_name']); ?>">

                    </div>


                    <!-- Mother Name -->
                    <div class="col-md-4">

                        <label class="form-label">
                            Mother Name
                        </label>

                        <input type="text" class="form-control" name="mother_name"
                            value="<?= htmlspecialchars($row_view['mother_name']); ?>">

                    </div>


                    <!-- Spouse Name -->
                    <div class="col-md-4">

                        <label class="form-label">
                            Spouse Name
                        </label>

                        <input type="text" class="form-control" name="spouse_name"
                            value="<?= htmlspecialchars($row_view['spouse_name']); ?>">

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

                <div class="row g-3">

                    <!-- Patient Phone -->
                    <div class="col-md-4">

                        <label class="form-label">
                            Patient Phone <span class="text-danger">*</span>
                        </label>

                        <input type="text" class="form-control" name="patient_phone"
                            value="<?= htmlspecialchars($row_view['patient_phone']); ?>">

                    </div>


                    <!-- Address -->
                    <div class="col-md-8">

                        <label class="form-label">
                            Address
                        </label>

                        <textarea class="form-control" name="address"
                            rows="1"><?= htmlspecialchars($row_view['address']); ?></textarea>

                    </div>


                    <!-- State -->
                    <div class="col-md-4">

                        <label class="form-label">
                            State
                        </label>

                        <select class="form-select state" name="state">

                            <option value="">
                                Select State
                            </option>

                            <?php
                                    $sql_state = "SELECT * FROM states ORDER BY state_name ASC";

                                    $result_state = mysqli_query($connection, $sql_state);

                                    while ($state = mysqli_fetch_assoc($result_state)) {
                                    ?>

                            <option value="<?= $state['sid']; ?>"
                                <?= ($row_view['state'] == $state['sid']) ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($state['state_name']); ?>
                            </option>

                            <?php } ?>

                        </select>

                    </div>

                    <!-- District -->
                    <div class="col-md-4">

                        <label class="form-label">
                            District
                        </label>

                        <select class="form-select" name="district" id="district">

                            <option value="">
                                Select District
                            </option>

                            <?php

                                    $sid = $row_view['state'];

                                    $sql_district = "SELECT * FROM districts 
                                                    WHERE sid = ?
                                                    ORDER BY district_name ASC";

                                    $stmt_district = mysqli_prepare($connection, $sql_district);

                                    mysqli_stmt_bind_param($stmt_district, "i", $sid);

                                    mysqli_stmt_execute($stmt_district);

                                    $result_district = mysqli_stmt_get_result($stmt_district);

                                    while ($district = mysqli_fetch_assoc($result_district)) {
                                    ?>

                            <option value="<?= $district['district_id']; ?>"
                                <?= ($row_view['district'] == $district['district_id']) ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($district['district_name']); ?>
                            </option>

                            <?php } ?>

                        </select>

                    </div>


                    <!-- Country -->
                    <div class="col-md-4">

                        <label class="form-label">
                            Country
                        </label>

                        <input type="text" class="form-control" name="country"
                            value="<?= htmlspecialchars($row_view['country']); ?>">

                    </div>

                    <!-- Village / Town / City -->
                    <div class="col-md-4">

                        <label class="form-label">
                            Village / Town / City
                        </label>

                        <input type="text" class="form-control" name="village_town_city"
                            value="<?= htmlspecialchars($row_view['village_town_city']); ?>">

                    </div>

                    <!-- PIN Code -->
                    <div class="col-md-4">

                        <label class="form-label">
                            PIN Code
                        </label>

                        <input type="text" class="form-control" name="pincode"
                            value="<?= htmlspecialchars($row_view['pincode']); ?>">

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

                <div class="row g-3">

                    <!-- Contact Name -->
                    <div class="col-md-6">

                        <label class="form-label">
                            Contact Name
                        </label>

                        <input type="text" class="form-control" name="contact_name"
                            value="<?= htmlspecialchars($row_view['contact_name']); ?>">

                    </div>


                    <!-- Relationship -->
                    <div class="col-md-6">

                        <label class="form-label">
                            Relationship
                        </label>

                        <input type="text" class="form-control" name="relationship"
                            value="<?= htmlspecialchars($row_view['relationship']); ?>">

                    </div>


                    <!-- Emergency Mobile -->
                    <div class="col-md-6">

                        <label class="form-label">
                            Emergency Mobile
                        </label>

                        <input type="text" class="form-control" name="mobile"
                            value="<?= htmlspecialchars($row_view['mobile']); ?>">

                    </div>


                    <!-- Emergency Address -->
                    <div class="col-md-6">

                        <label class="form-label">
                            Emergency Address
                        </label>

                        <textarea class="form-control" name="emergency_address"
                            rows="1"><?= htmlspecialchars($row_view['emergency_address']); ?></textarea>

                    </div>

                </div>

            </div>

        </div>


        <!-- Submit Buttons -->
        <div class="d-flex justify-content-end gap-2 mb-4">

            <a href="#" class="btn btn-secondary back-to-patients">
                Cancel
            </a>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-lg"></i>
                Update Patient
            </button>

        </div>


    </form>

    <?php

        }
    }

    ?>

</div>