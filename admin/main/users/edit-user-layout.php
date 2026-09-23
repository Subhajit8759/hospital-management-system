<?php
include "../configs/session_handling.php";
include "../configs/config.php";

$user_id = $_POST['userid'];

$sql = "SELECT * FROM user WHERE user_id = {$user_id}";

$result = mysqli_query($connection, $sql);

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {

?>

<div class="container-fluid mt-4 create-user-page">

    <div class="card shadow-sm border-0 create-user-card">

        <!-- Header -->
        <div class="card-header bg-white d-flex justify-content-between align-items-center create-user-header">

            <h4 class="mb-0 create-user-title">
                <i class="bi bi-person-fill-gear me-2"></i>
                Update User
            </h4>

            <button type="button" class="btn btn-secondary back-btn" id="backHome">
                <i class="bi bi-arrow-left me-1"></i>
                Back
            </button>

        </div>


        <!-- Form -->
        <div class="card-body create-user-body">

            <form id="updateForm" class="create-user-form">

                <div class="row g-3">


                    <input type="hidden" value="<?php echo $row['user_id']; ?>" class="form-control" name="user_id">

                    <!-- Name -->
                    <div class="col-md-6">

                        <label for="name" class="form-label">
                            Full Name <span class="text-danger">*</span>
                        </label>

                        <input type="text" class="form-control" id="name" name="name"
                            value="<?php echo $row['name']; ?>" placeholder="Enter full name" required>

                    </div>


                    <!-- Username -->
                    <div class="col-md-6">

                        <label for="username" class="form-label">
                            Username <span class="text-danger">*</span>
                        </label>

                        <input type="text" class="form-control" id="username" name="username"
                            value="<?php echo $row['username']; ?>" placeholder="Enter username" disabled required>

                    </div>


                    <!-- Email -->
                    <div class="col-md-6">

                        <label for="email" class="form-label">
                            Email Address <span class="text-danger">*</span>
                        </label>

                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Enter email address" value="<?php echo $row['email']; ?>" disabled required>

                    </div>


                    <!-- Mobile -->
                    <div class="col-md-6">

                        <label for="phone" class="form-label">
                            Mobile Number <span class="text-danger">*</span>
                        </label>

                        <input type="text" class="form-control" id="phone" name="phone"
                            placeholder="Enter mobile number" value="<?php echo $row['phone']; ?>" required>

                    </div>


                    <!-- Gender -->
                    <!-- Gender -->
                    <div class="col-md-3">

                        <label for="gender" class="form-label">
                            Gender <span class="text-danger">*</span>
                        </label>

                        <select class="form-select" id="gender" name="gender" required>
                            <option selected disabled value="0">Select Gender</option>

                            <?php

                                    $sql_gender = "SELECT * FROM gender";

                                    $result_gender = mysqli_query($connection, $sql_gender);

                                    if (mysqli_num_rows($result_gender) > 0) {

                                        while ($row_gender = mysqli_fetch_assoc($result_gender)) {

                                            if ($row['gender'] === $row_gender['gender_id']) {
                                                $selected = "selected";
                                            } else {
                                                $selected = "";
                                            }

                                    ?>


                            <option <?php echo $selected; ?> value="<?php echo $row_gender['gender_id'] ?>">
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

                        <input type="date" class="form-control" id="dob" name="dob"
                            value="<?php echo htmlspecialchars($row['dob']); ?>" required>


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

                                            if ($row['role_id'] === $row_role['role_id']) {
                                                $selected = "selected";
                                            } else {
                                                $selected = "";
                                            }

                                        ?>


                            <option <?php echo $selected; ?> value="<?php echo $row_role['role_id']; ?>">
                                <?php echo $row_role['role_name']; ?></option>

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


                            <?php
                                    if ($row['status'] == 1) {
                                    ?>

                            <option selected value="1">Active</option>
                            <option value="2">Inactive</option>

                            <?php
                                    } else {
                                    ?>

                            <option value="1">Active</option>
                            <option selected value="2">Inactive</option>

                            <?php
                                    }
                                    ?>


                        </select>

                    </div>


                    <!-- Department -->
                    <div class="col-md-6">

                        <label for="department" class="form-label">
                            Department <span class="text-danger">*</span>
                        </label>

                        <?php
                                $sql_departments = "SELECT * FROM departments";

                                $departments_result = mysqli_query($connection, $sql_departments) or die('');

                                if (mysqli_num_rows($departments_result) > 0) {
                                ?>

                        <select class="form-select" id="department" name="department" required>
                            <option value="" selected disabled>Select Department</option>

                            <?php

                                        while ($row_departments = mysqli_fetch_assoc($departments_result)) {

                                            if ($row['department'] === $row_departments['dept_id']) {
                                                $selected = 'selected';
                                            } else {
                                                $selected = '';
                                            }


                                        ?>

                            <option <?php echo $selected; ?> value="<?php echo $row_departments['dept_id']; ?>">
                                <?php echo $row_departments['dept_name']; ?></option>

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

                        <input type="date" class="form-control" id="doj" value="<?php echo $row['doj']; ?>" name="doj"
                            required>

                    </div>


                    <!-- Password -->
                    <div class="col-md-6">

                        <label for="password" class="form-label">
                            Password <span class="text-danger">*</span>
                        </label>

                        <div class="input-group">
                            <input type="password" class="form-control" id="password"
                                value="<?php echo $row['password'] ?>" name="password" placeholder="Enter password"
                                required>

                            <button type="password" class="btn btn-outline-secondary password-toggle"
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
                            <input type="password" class="form-control" id="confirm_password"
                                value="<?php echo $row['password'] ?>" name="confirm_password"
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
                            required><?php echo htmlspecialchars(trim($row['address'])); ?></textarea>

                    </div>

                    <!-- photo -->
                    <div class="col-12">
                        <label class="form-label" for="photo">
                            Chose Photo
                        </label>

                        <input type="file" name="profile_photo" id="photo" class="form-control">
                        <br>
                        <input type="button" value="Remove" id="remove-photo" class=" btn btn-primary d-none">

                    </div>

                    <!-- preview photo -->
                    <div class="col-12">
                        <input type="text" name="uploaded_photo" value="users/uploads/<?php echo $row['photo']; ?>"
                            class="form-control d-none">
                        <img src="users/uploads/<?php echo $row['photo']; ?>" alt="" height="250px" width="250px"
                            id="preview-image">
                    </div>

                </div>


                <!-- Buttons -->
                <div class="mt-4 pt-3 border-top">

                    <button type="submit" class="btn btn-primary" id="updateBtn"
                        data-id="<?php echo $row['user_id']; ?>">
                        <i class="bi bi-pencil me-1"></i>
                        Update User
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

<?php

    }
}

?>