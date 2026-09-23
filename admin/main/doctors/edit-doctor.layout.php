<?php
include "../configs/session_handling.php";
include "../configs/config.php";

$user_id = $_POST['user_id'];

$sql = "SELECT * FROM user
        LEFT JOIN doctor ON doctor.doctor_user_id = user.user_id
         WHERE user_id = {$user_id}";

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
                Update Doctor
            </h4>

            <button type="button" class="btn btn-secondary back-to-doctor" id="backHome">
                <i class="bi bi-arrow-left me-1"></i>
                Back
            </button>

        </div>


        <!-- Form -->
        <div class="card-body create-user-body">

            <form id="updateDoctorForm" class="create-user-form">

                <div class="row g-3">


                    <input type="hidden" value="<?php echo $row['user_id']; ?>" class="form-control" name="user_id">

                    <!-- Name -->
                    <div class="col-md-6">

                        <label for="name" class="form-label">
                            Full Name <span class="text-danger">*</span>
                        </label>

                        <input type="text" class="form-control" id="name" name="name"
                            value="<?php echo $row['name']; ?>" disabled>

                    </div>


                    <!-- Username -->
                    <div class="col-md-6">

                        <label for="username" class="form-label">
                            Username <span class="text-danger">*</span>
                        </label>

                        <input type="text" class="form-control" id="username" name="username"
                            value="<?php echo $row['username']; ?>" placeholder="Enter username" disabled>

                    </div>


                    <!-- Email -->
                    <div class="col-md-6">

                        <label for="email" class="form-label">
                            Email Address <span class="text-danger">*</span>
                        </label>

                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Enter email address" value="<?php echo $row['email']; ?>" disabled >

                    </div>


                    <!-- Mobile -->
                    <div class="col-md-6">

                        <label for="phone" class="form-label">
                            Mobile Number <span class="text-danger">*</span>
                        </label>

                        <input type="text" class="form-control" id="phone" name="phone"
                            placeholder="Enter mobile number" value="<?php echo $row['phone']; ?>" disabled>

                    </div>


                  


                    


                    

                    <!-- Status -->
                    <div class="col-md-3">

                        <label for="status" class="form-label">
                            Status <span class="text-danger">*</span>
                        </label>

                        <select class="form-select" id="status" name="doctor_status" required>


                            <?php
                                    if ($row['doctor_status'] == 1) {
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


                    <!-- DOCTOR QUALIFICATION -->
                    <div class="col-md-3">
                        <label class="form-label" for="doctor_qualification">Doctor Qualification</label>
                        <input type="text" value="<?= $row['doctor_qualification']; ?>" name="doctor_qualification" class="form-control">
                    </div>
                    
                    <!-- DOCTOR REGISTRATION NUMBER -->
                    <div class="col-md-3">
                        <label class="form-label">Doctor Registration Number</label>
                        <input type="text" name="doctor_registration_number" value="<?= $row['doctor_registration_number']; ?>" class="form-control" />
                    </div>


                    <!-- DOCTOR FEES -->
                    <div class="col-md-3">
                        <label for="doctor_fees" class="form-label">Doctor Fees</label>
                        <input type="number" name="doctor_fees" value="<?= $row['doctor_fees']; ?>" id="" class="form-control">
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

                    <button type="submit" class="btn btn-primary" id="update-doctor-button"
                        data-id="<?php echo $row['user_id']; ?>">
                        <i class="bi bi-pencil me-1"></i>
                        Update Doctor
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