<?php
include "../configs/session_handling.php";
include "../configs/config.php";
?>

<div class="container-fluid mt-4 create-user-page">

    <div class="card shadow-sm border-0 create-user-card">

        <!-- Header -->
        <div class="card-header bg-white d-flex justify-content-between align-items-center create-user-header">

            <h4 class="mb-0 create-user-title">
                <i class="bi bi-person-plus-fill me-2"></i>
                Create New User
            </h4>

            <button type="button" class="btn btn-secondary back-btn" id="backHome">
                <i class="bi bi-arrow-left me-1"></i>
                Back
            </button>

        </div>


        <!-- Form -->
        <div class="card-body create-user-body">

            <form id="userForm" class="create-user-form">

                <div class="row g-3">



                    <!-- Name -->
                    <div class="col-md-6">

                        <label for="name" class="form-label">
                            Full Name <span class="text-danger">*</span>
                        </label>

                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter full name"
                            required>

                    </div>


                    <!-- Username -->
                    <div class="col-md-6">

                        <label for="username" class="form-label">
                            Username <span class="text-danger">*</span>
                        </label>

                        <input type="text" class="form-control" id="username" name="username"
                            placeholder="Enter username" required>

                    </div>


                    <!-- Email -->
                    <div class="col-md-6">

                        <label for="email" class="form-label">
                            Email Address <span class="text-danger">*</span>
                        </label>

                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Enter email address" required>

                    </div>


                    <!-- Mobile -->
                    <div class="col-md-6">

                        <label for="phone" class="form-label">
                            Mobile Number <span class="text-danger">*</span>
                        </label>

                        <input type="text" class="form-control" id="phone" name="phone"
                            placeholder="Enter mobile number" required>

                    </div>


                    <!-- Gender -->
                    <div class="col-md-3">

                        <label for="gender" class="form-label">
                            Gender <span class="text-danger">*</span>
                        </label>

                        <select class="form-select" id="gender" name="gender" required>
                            <option selected disabled value="0">Select Gender</option>

                            <?php

                            $sql_gender = "SELECT * FROM gender ORDER BY gender_name";

                            $result_gender = mysqli_query($connection, $sql_gender);

                            if (mysqli_num_rows($result_gender) > 0) {

                                while ($row_gender = mysqli_fetch_assoc($result_gender)) {

                            ?>


                                    <option value="<?php echo $row_gender['gender_id'] ?>">
                                        <?php echo $row_gender['gender_name']; ?></option>

                            <?php
                                }
                            }
                            ?>

                        </select>

                    </div>


                    <!-- Date of Birth -->
                    <div class="col-md-3">

                        <label for="dob" class="form-label">
                            Date of Birth <span class="text-danger">*</span>
                        </label>

                        <input type="date" class="form-control" id="dob" name="dob" required>

                    </div>


                    <!-- Role -->
                    <div class="col-md-3">

                        <label for="role" class="form-label">
                            Role <span class="text-danger">*</span>
                        </label>

                        <?php
                        $sql_role = "SELECT * FROM roles ORDER BY role_name";

                        $role_result = mysqli_query($connection, $sql_role);

                        if (mysqli_num_rows($role_result) > 0) {
                        ?>

                            <select class="form-select" id="role" name="role" required>
                                <option value="" selected disabled>Select Role</option>

                                <?php

                                while ($row_role = mysqli_fetch_assoc($role_result)) {
                                ?>

                                    <option value="<?php echo $row_role['role_id']; ?>"><?php echo $row_role['role_name']; ?>
                                    </option>

                                <?php
                                }
                                ?>
                            </select>
                        <?php
                        }
                        ?>



                    </div>

                    <!-- Status -->
                    <div class="col-md-3">

                        <label for="status" class="form-label">
                            Status <span class="text-danger">*</span>
                        </label>

                        <select class="form-select" id="status" name="status" required>

                            <option value="0">Select Status</option>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>

                        </select>

                    </div>


                    <!-- Department -->
                    <div class="col-md-6">

                        <label for="department" class="form-label">
                            Department <span class="text-danger">*</span>
                        </label>

                        <?php
                        $sql_departments = "SELECT * FROM departments ORDER BY dept_name";

                        $departments_result = mysqli_query($connection, $sql_departments) or die('');

                        if (mysqli_num_rows($departments_result) > 0) {
                        ?>

                            <select class="form-select" id="department" name="department" required>
                                <option value="" selected disabled>Select Department</option>

                                <?php

                                while ($row_departments = mysqli_fetch_assoc($departments_result)) {
                                ?>

                                    <option value="<?php echo $row_departments['dept_id']; ?>">
                                        <?php echo $row_departments['dept_code']; ?> <b>(<?php echo $row_departments['dept_name']; ?>)</b></option>

                                <?php
                                }
                                ?>
                            </select>
                        <?php
                        }
                        ?>

                    </div>


                    <!-- Joining Date -->
                    <div class="col-md-6">

                        <label for="doj" class="form-label">
                            Joining Date <span class="text-danger">*</span>
                        </label>

                        <input type="date" class="form-control" id="doj" name="doj" required>

                    </div>


                    <!-- Password -->
                    <div class="col-md-6">

                        <label for="password" class="form-label">
                            Password <span class="text-danger">*</span>
                        </label>

                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Enter password" required>

                            <button type="button" class="btn btn-outline-secondary password-toggle"
                                data-target="#password">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>

                    </div>


                    <!-- Confirm Password -->
                    <div class="col-md-6">

                        <label for="confirm_password" class="form-label">
                            Confirm Password <span class="text-danger">*</span>
                        </label>

                        <div class="input-group">
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                                placeholder="Confirm password" required>

                            <button type="button" class="btn btn-outline-secondary password-toggle"
                                data-target="#confirm_password">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>

                    </div>





                    <!-- Address -->
                    <div class="col-12">

                        <label for="address" class="form-label">
                            Address <span class="text-danger">*</span>
                        </label>

                        <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter address"
                            required></textarea>

                    </div>

                    <!-- photo -->
                    <div class="col-12">
                        <label class="form-label" for="photo">
                            Chose Photo
                        </label>

                        <input type="file" name="profile_photo" id="photo" class="form-control photo">
                        <br>
                        <input type="button" value="Remove" id="remove-photo" class=" btn btn-primary d-none">

                    </div>

                    <!-- preview photo -->
                    <div class="col-12">
                        <img src="" alt="" id="preview-image" height="250px" width="250px" class="preview-image d-none">
                    </div>

                </div>


                <!-- Buttons -->
                <div class="mt-4 pt-3 border-top create-user-buttons">

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle me-1"></i>
                        Save User
                    </button>

                    <button type="reset" class="btn btn-secondary ms-2">
                        <i class="bi bi-arrow-counterclockwise me-1"></i>
                        Reset
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>