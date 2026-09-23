<?php
include "../configs/session_handling.php";
?>
<div class="container-fluid p-4">

    <!-- =========================
             Page Header
        ========================== -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h4 class="page-title mb-1">
                <i class="bi bi-person-vcard"></i>
                View User
            </h4>

            <small class="text-muted">
                View complete user information
            </small>

        </div>

        <div class="d-flex gap-2">

            <button type="button" class="btn btn-light border back-btn">

                <i class="bi bi-arrow-left me-1"></i>
                Back

            </button>


        </div>

    </div>

    <?php

    include "../configs/config.php";

    $user_id = mysqli_real_escape_string($connection, trim($_POST['user_id']));

    $sql_user = "SELECT * FROM user LEFT JOIN roles ON roles.role_id = user.role_id
                 LEFT JOIN departments ON departments.dept_id = user.department
                 LEFT JOIN gender ON gender.gender_id = user.gender
                 WHERE user.user_id = {$user_id}";

    $result_user = mysqli_query($connection, $sql_user);

    if (mysqli_num_rows($result_user)) {

        while ($row = mysqli_fetch_assoc($result_user)) {

            $photo = "uploads/" . $row['photo'];

            function formatDateTime($date)
            {

                if (empty($date)) {

                    return '-';
                }

                return (new DateTime($date))->format('jS F Y, h:i:A');
            }

    ?>

            <!-- =========================
             Profile Header
        ========================== -->

            <div class="profile-card p-4 mb-4">

                <div class="row align-items-center">

                    <!-- Profile Image -->

                    <div class="col-md-2 text-center">

                        <img src="users/<?php echo $photo; ?>" alt="Profile Photo" class="profile-image">

                    </div>


                    <!-- User Basic Information -->

                    <div class="col-md-7 mt-3 mt-md-0">

                        <div class="user-name">
                            <?php echo $row['name']; ?>
                            <button class="btn btn-sm btn-primary edit-btn" data-id="<?php echo $row['user_id']; ?>">Edit</button>
                            <button class="btn btn-sm btn-danger delete-btn" data-id="<?php echo $row['user_id']; ?>">Delete</button>
                        </div>

                        <div class="username mb-3">
                            <i class="bi bi-person me-1"></i>
                            <?php echo $row['username']; ?>
                        </div>

                        <div class="d-flex flex-wrap gap-4">

                            <div>

                                <small class="text-muted d-block">
                                    User ID
                                </small>

                                <strong>
                                    <?php echo $row['user_id']; ?>
                                </strong>

                            </div>

                            <div>

                                <small class="text-muted d-block">
                                    Role
                                </small>

                                <strong>
                                    <?php echo $row['role_name']; ?>
                                </strong>

                            </div>

                            <div>

                                <small class="text-muted d-block">
                                    Department
                                </small>

                                <strong>
                                    <?php echo $row['dept_name']; ?>
                                </strong>

                            </div>

                        </div>

                    </div>


                    <!-- Status -->

                    <div class="col-md-3 text-md-end mt-3 mt-md-0">

                        <?php
                        if ($row['status'] == 1) {
                        ?>
                            <span class="badge bg-success">
                                Active
                            </span>
                        <?php
                        } else {
                        ?>
                            <span class="badge bg-danger">
                                In-Active
                            </span>
                        <?php
                        }
                        ?>

                    </div>

                </div>

            </div>


            <!-- =========================
             Personal Information
        ========================== -->

            <div class="section-card mb-4">

                <div class="p-4 border-bottom">

                    <div class="section-title">

                        <i class="bi bi-person-vcard me-2"></i>
                        Personal Information

                    </div>

                </div>


                <div class="p-4">

                    <div class="row g-4">

                        <!-- Name -->

                        <div class="col-md-4">

                            <div class="info-item">

                                <span class="info-label">
                                    Full Name
                                </span>

                                <div class="info-value">
                                    <?php echo $row['name']; ?>
                                </div>

                            </div>

                        </div>


                        <!-- Email -->

                        <div class="col-md-4">

                            <div class="info-item">

                                <span class="info-label">
                                    Email Address
                                </span>

                                <div class="info-value">
                                    <?php echo $row['email']; ?>
                                </div>

                            </div>

                        </div>


                        <!-- Phone -->

                        <div class="col-md-4">

                            <div class="info-item">

                                <span class="info-label">
                                    Phone Number
                                </span>

                                <div class="info-value">
                                    +91 <?php echo $row['phone']; ?>
                                </div>

                            </div>

                        </div>


                        <!-- Gender -->

                        <div class="col-md-4">

                            <div class="info-item">

                                <span class="info-label">
                                    Gender
                                </span>

                                <div class="info-value">
                                    <?php echo $row['gender_name']; ?>
                                </div>

                            </div>

                        </div>


                        <!-- DOB -->

                        <div class="col-md-4">

                            <div class="info-item">

                                <span class="info-label">
                                    Date of Birth
                                </span>

                                <div class="info-value">
                                    <?php echo formatDateTime($row['dob']); ?>
                                </div>

                            </div>

                        </div>


                        <!-- Address -->

                        <div class="col-md-4">

                            <div class="info-item">

                                <span class="info-label">
                                    Address
                                </span>

                                <div class="info-value">
                                    <?php echo $row['address']; ?>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- =========================
             Employment Information
        ========================== -->

            <div class="section-card mb-4">

                <div class="p-4 border-bottom">

                    <div class="section-title">

                        <i class="bi bi-briefcase me-2"></i>
                        Employment Information

                    </div>

                </div>


                <div class="p-4">

                    <div class="row g-4">

                        <!-- Role -->

                        <div class="col-md-4">

                            <div class="info-item">

                                <span class="info-label">
                                    Role
                                </span>

                                <div class="info-value">
                                    <?php echo $row['role_name']; ?>
                                </div>

                            </div>

                        </div>


                        <!-- Department -->

                        <div class="col-md-4">

                            <div class="info-item">

                                <span class="info-label">
                                    Department
                                </span>

                                <div class="info-value">
                                    <?php echo $row['dept_name']; ?>
                                </div>

                            </div>

                        </div>


                        <!-- DOJ -->

                        <div class="col-md-4">

                            <div class="info-item">

                                <span class="info-label">
                                    Date of Joining
                                </span>

                                <div class="info-value">
                                    <?php echo formatDateTime($row['doj']); ?>
                                </div>

                            </div>

                        </div>


                        <!-- Status -->

                        <div class="col-md-4">

                            <div class="info-item">

                                <span class="info-label">
                                    Account Status
                                </span>

                                <?php
                                if ($row['status'] == 1) {
                                ?>
                                    <span class="badge bg-success">
                                        Active
                                    </span>
                                <?php
                                } else {
                                ?>
                                    <span class="badge bg-danger">
                                        In-Active
                                    </span>
                                <?php
                                }
                                ?>

                            </div>

                        </div>


                        <!-- Created -->

                        <div class="col-md-4">

                            <div class="info-item">

                                <span class="info-label">
                                    Created At
                                </span>

                                <div class="info-value">
                                    <?php echo formatDateTime($row['user_created_at']); ?>
                                </div>

                            </div>

                        </div>


                        <!-- Updated -->

                        <div class="col-md-4">

                            <div class="info-item">

                                <span class="info-label">
                                    Last Updated
                                </span>

                                <div class="info-value">
                                    <?php echo formatDateTime($row['user_updated_at']); ?>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- =========================
             Account Information
        ========================== -->

            <div class="section-card mb-4">

                <div class="p-4 border-bottom">

                    <div class="section-title">

                        <i class="bi bi-shield-lock me-2"></i>
                        Account Information

                    </div>

                </div>


                <div class="p-4">

                    <div class="row g-4">

                        <div class="col-md-4">

                            <span class="info-label">
                                Username
                            </span>

                            <div class="info-value">
                                <?php echo $row['username']; ?>
                            </div>

                        </div>


                        <div class="col-md-4">

                            <span class="info-label">
                                User ID
                            </span>

                            <div class="info-value">
                                <?php echo $row['user_id']; ?>
                            </div>

                        </div>


                        <div class="col-md-4">

                            <span class="info-label">
                                Account Status
                            </span>

                            <?php
                            if ($row['status'] == 1) {
                            ?>
                                <span class="badge bg-success">
                                    Active
                                </span>
                            <?php
                            } else {
                            ?>
                                <span class="badge bg-danger">
                                    In-Active
                                </span>
                            <?php
                            }
                            ?>

                        </div>

                    </div>

                </div>

            </div>


    <?php

        }
    }

    ?>

</div>