<?php include "../configs/session_handling.php" ?>

<?php include "../configs/config.php"; ?>

<div class="card shadow-sm">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            <i class="bi bi-person-plus me-2"></i>
            Create Doctor
        </h5>

        <button type="button" class="btn btn-secondary btn-sm back-to-doctor" id="backToDoctors">

            <i class="bi bi-arrow-left me-1"></i>
            Back

        </button>

    </div>

    <div class="card-body">
        <form id="foundDoctorUser">
            <div class="row ">

                <div class="col-md-4">

                    <label for="user_id" class="form-label">
                        User ID
                        <span class="text-danger">*</span>
                    </label>

                    <?php
                    if (isset($_POST['user_value'])) {
                        $user_value = trim($_POST['user_value']);
                    } else {
                        $user_value = "";
                    }
                    ?>

                    <input type="text" class="form-control" id="user_value" name="user_value"
                        placeholder="Enter user ID" value="<?php echo $user_value; ?>">

                </div>


                <div class="mt-2">
                    <button type="submit" id="foundDoctorBtn" class="btn btn-primary btn-sm">Found Doctor</button>
                </div>
        </form>
    </div>





    <div class="card-body">

        <hr class="mt-4">

        <?php
        if (isset($_POST['user_value'])) {
            $username = mysqli_real_escape_string($connection, trim($_POST['user_value'] ?? ""));
            $role_id = 1;

            if (ctype_digit($user_value)) {


                $sql_user = "SELECT * FROM user
                            LEFT JOIN gender ON gender.gender_id = user.gender
                            LEFT JOIN departments ON departments.dept_id = user.department
                            LEFT JOIN doctor ON doctor.doctor_user_id = user.user_id
                            WHERE user.user_id = {$user_value}
                            AND user.role_id = {$role_id}
                            LIMIT 1";

            } else {

                $sql_user = "SELECT * FROM user
                            LEFT JOIN gender ON gender.gender_id = user.gender
                            LEFT JOIN departments ON departments.dept_id = user.department
                            LEFT JOIN doctor ON doctor.doctor_user_id = user.user_id
                            WHERE user.username = '{$user_value}'
                            AND user.role_id = {$role_id}
                            LIMIT 1";

            }


            

            $result_user = mysqli_query($connection, $sql_user);

            if (mysqli_num_rows($result_user) > 0) {
        ?>
        <?php
                    while ($row_user = mysqli_fetch_assoc($result_user)) {
                        
                        if (empty($row_user['doctor_id'])) {
                        
                    ?>

        <form id="createDoctorForm" class="mt-4">



            <div class="row">

                <!-- user_id -->

                <div class="col-md-4 mb-3">
                    <label for="user_id" class="form-label">User ID</label>
                    <input type="hidden" name="user_id" class="form-control" value="<?php echo $row_user['user_id']; ?>">
                    <input type="text" class="form-control" value="User ID : <?php echo $row_user['user_id']; ?>" disabled>
                </div>

                <!-- Doctor Name -->

                <div class="col-md-4 mb-3">

                    <label for="doctor_name" class="form-label">
                        Doctor Name
                        <span class="text-danger">*</span>
                    </label>

                    <input type="text" class="form-control" id="doctor_name" name="doctor_name"
                        placeholder="Enter doctor name" value="<?php echo $row_user['name']; ?>" disabled>

                </div>


                <!-- Username -->
                <div class="col-md-4 mb-3">

                    <label for="doctor_username" class="form-label">
                        Username
                        <span class="text-danger">*</span>
                    </label>

                    <input type="text" class="form-control" id="doctor_username" name="doctor_username"
                        placeholder="Enter username" value="<?php echo $row_user['username']; ?>" disabled>

                </div>


                <!-- Email -->
                <div class="col-md-4 mb-3">

                    <label for="doctor_email" class="form-label">
                        Email
                    </label>

                    <input type="email" class="form-control" id="doctor_email" name="doctor_email"
                        placeholder="Enter email address" value="<?= htmlspecialchars($row_user['email']); ?>" disabled>

                </div>


                <!-- Phone -->
                <div class="col-md-4 mb-3">

                    <label for="doctor_phone" class="form-label">
                        Phone
                        <span class="text-danger">*</span>
                    </label>

                    <input type="text" class="form-control" id="doctor_phone" name="doctor_phone"
                        placeholder="Enter phone number" maxlength="10"
                        value="<?php echo htmlspecialchars($row_user['phone']) ?>" disabled>

                </div>


                <!-- Gender -->
                <div class="col-md-4 mb-3">

                    <label for="doctor_gender" class="form-label">
                        Gender
                        <span class="text-danger">*</span>
                    </label>

                    <select class="form-select" id="doctor_gender" name="doctor_gender" disabled>

                        <option value="">Select Gender</option>

                        <?php
                                    $sql_gender = "SELECT * FROM gender ORDER BY gender_id ASC";

                                    $result_gender = mysqli_query(
                                        $connection,
                                        $sql_gender
                                    );

                                    while ($gender = mysqli_fetch_assoc($result_gender)) {
                                        if ($gender['gender_id'] === $row_user['gender']) {
                                            $selected = "selected";
                                        } else {
                                            $selected = "";
                                        }
                                    ?>

                        <option <?= $selected; ?> value="<?= $gender['gender_id']; ?>">
                            <?= htmlspecialchars($gender['gender_name']); ?>
                        </option>

                        <?php
                                    }
                                    ?>

                    </select>

                </div>


                <!-- DOB -->
                <div class="col-md-4 mb-3">

                    <label for="doctor_dob" class="form-label">
                        Date of Birth
                        <span class="text-danger">*</span>
                    </label>

                    <input type="date" class="form-control" id="doctor_dob" name="doctor_dob"
                        value="<?php echo htmlspecialchars($row_user['dob']); ?>" disabled>

                </div>


                <!-- Department -->
                <div class="col-md-4 mb-3">

                    <label for="doctor_department" class="form-label">
                        Department
                        <span class="text-danger">*</span>
                    </label>

                    <select class="form-select" id="doctor_department" name="doctor_department" disabled>

                        <option value="">Select Department</option>

                        <?php
                                    $sql_department = "
                SELECT *
                FROM departments
                WHERE dept_status = 1
                ORDER BY dept_name ASC
            ";

                                    $result_department = mysqli_query(
                                        $connection,
                                        $sql_department
                                    );

                                    while ($department = mysqli_fetch_assoc($result_department)) {
                                        if ($department['dept_id'] === $row_user['department']) {
                                            $selected = "selected";
                                        } else {
                                            $selected = "";
                                        }
                                    ?>

                        <option <?= $selected; ?> value="<?= $department['dept_id']; ?>">
                            <?= htmlspecialchars($department['dept_code']) ?>
                            (<?= htmlspecialchars($department['dept_name']); ?>)
                        </option>

                        <?php
                                    }
                                    ?>

                    </select>

                </div>

                <!-- Date of Joining -->
                <div class="col-md-4 mb-3">

                    <label for="doctor_doj" class="form-label">
                        Date of Joining
                        <span class="text-danger">*</span>
                    </label>

                    <input type="date" class="form-control" id="doctor_doj" name="doctor_doj"
                        value="<?php echo htmlspecialchars($row_user['doj']); ?>" disabled>

                </div>


                <!-- Qualification -->
                <div class="col-md-4 mb-3">

                    <label for="doctor_qualification" class="form-label">
                        Qualification
                        <span class="text-danger">*</span>
                    </label>

                    <input type="text" class="form-control" id="doctor_qualification" name="doctor_qualification"
                        placeholder="Example: MBBS, MD">

                </div>


                <!-- Registration Number -->
                <div class="col-md-4 mb-3">

                    <label for="doctor_registration_number" class="form-label">
                        Registration Number
                        <span class="text-danger">*</span>
                    </label>

                    <input type="text" class="form-control" id="doctor_registration_number"
                        name="doctor_registration_number" placeholder="Enter medical registration number">

                </div>





                <!-- Fees -->
                <div class="col-md-4 mb-3">

                    <label for="doctor_fees" class="form-label">
                        Consultation Fees
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">₹</span>

                        <input type="number" class="form-control" id="doctor_fees" name="doctor_fees"
                            placeholder="Enter consultation fee" min="0" step="0.01">

                    </div>

                </div>

            </div>

            <!-- photo -->
            <div class="col mb-3">

                <label for="doctor_photo" class="form-label">
                    Profile Photo
                    <span class="text-danger">*</span>
                </label>
                <br>

                <img src="users/uploads/<?php echo htmlspecialchars($row_user['photo']); ?>" alt="" height="150px"
                    width="150px">

            </div>



            <!-- Buttons -->
            <div class="mt-3">

                <button type="submit" class="btn btn-primary" id="saveDoctorBtn">

                    <i class="bi bi-check-lg me-1"></i>
                    Save Doctor

                </button>


                <button type="reset" class="btn btn-secondary">

                    <i class="bi bi-arrow-counterclockwise me-1"></i>
                    Reset

                </button>

            </div>


        </form>
        <?php
                        }else{
                            ?>
        <script>
        alert("Doctor already registered");
        alert("<?php echo "Doctor ID: ". $row_user['doctor_id'];  ?>");
        </script>
        <?php
                        }
                    }
                    ?>
        <?php
            } else {
            ?>

        <script>
        alert("User not found.");
        </script>

        <?php
            }
        }
        ?>





    </div>

</div>