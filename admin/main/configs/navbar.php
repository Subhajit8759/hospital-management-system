<nav class="navbar navbar-expand-lg bg-white shadow-sm hospital-navbar">

    <div class="container-fluid px-3 px-lg-4">

        <!-- =========================
             Left Side
        ========================== -->

        <div class="navbar-left">

            <!-- Mobile Menu Button -->

            <button type="button" id="menuToggle" class="navbar-menu-btn">

                <i class="bi bi-list"></i>

            </button>


            <!-- Title -->

            <h4 class="mb-0 text-primary fw-bold navbar-title">
                🏥 Hospital Management System
            </h4>

        </div>


        <!-- =========================
             Right Side
        ========================== -->

        <div class="d-flex align-items-center ms-auto navbar-right">


            <!-- =========================
                 Search
            ========================== -->

            <div class="navbar-search me-2 me-lg-3">

                <input type="text" class="form-control" placeholder="Search...">

            </div>


            <!-- =========================
                 Notification
            ========================== -->

            <button type="button" class="btn btn-light position-relative navbar-icon-btn me-2 me-lg-3">

                <i class="bi bi-bell fs-5"></i>

                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">

                    5

                </span>

            </button>


            <!-- =========================
                 Message
            ========================== -->

            <button type="button" class="btn btn-light position-relative navbar-icon-btn me-2 me-lg-3">

                <i class="bi bi-envelope fs-5"></i>

                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">

                    2

                </span>

            </button>


            <!-- =========================
                 User Dropdown
            ========================== -->

            <?php



            include "config.php";

            $sql_user = "SELECT * FROM user LEFT JOIN roles ON user.role_id = roles.role_id
                        LEFT JOIN departments ON user.department = departments.dept_id 
                        LEFT JOIN gender ON user.gender = gender.gender_id
                        WHERE user_id = {$_SESSION['user_id']}";

            $result_user = mysqli_query($connection, $sql_user);

            if (mysqli_num_rows($result_user) === 1) {


                while ($row_user = mysqli_fetch_assoc($result_user)) {

            ?>


                    <div class="dropdown">

                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle user-dropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">

                            <img src="users/uploads/<?php echo $row_user['photo']; ?>" width="45" height="45"
                                class="rounded-circle border border-2 border-primary" alt="Profile">


                            <div class="ms-2 user-info">

                                <strong class="text-dark d-block">
                                    <?php echo $row_user['role_name']; ?>
                                </strong>

                                <small class="text-muted">
                                    <?php echo $row_user['name']; ?>
                                </small>

                            </div>

                        </a>


                        <!-- =========================
                     User Dropdown Menu
                ========================== -->

                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-4 user-dropdown-menu">


                            <!-- Profile Header -->

                            <li class="text-center p-4">

                                <img src="users/uploads/<?php echo $row_user['photo']; ?>" class="rounded-circle border border-3 border-primary"
                                    width="80" height="80" alt="Profile">

                                <h5 class="mt-3 mb-1">
                                    <?php echo $row_user['role_name'] ?>
                                </h5>

                                <small class="text-muted">
                                    <?php echo $row_user['name']; ?>
                                </small>

                            </li>


                            <li>
                                <hr class="dropdown-divider">
                            </li>


                            <!-- My Profile -->

                            <li>

                                <a class="dropdown-item py-2" href="#">

                                    <i class="bi bi-person me-2"></i>

                                    My Profile

                                </a>

                            </li>


                            <!-- Change Password -->

                            <li>

                                <a class="dropdown-item py-2" href="#">

                                    <i class="bi bi-key me-2"></i>

                                    Change Password

                                </a>

                            </li>


                            <!-- Notifications -->

                            <li>

                                <a class="dropdown-item py-2" href="#">

                                    <i class="bi bi-bell me-2"></i>

                                    Notifications

                                </a>

                            </li>


                            <!-- Settings -->

                            <li>

                                <a class="dropdown-item py-2" href="#">

                                    <i class="bi bi-gear me-2"></i>

                                    Settings

                                </a>

                            </li>


                            <li>
                                <hr class="dropdown-divider">
                            </li>


                            <!-- Logout -->

                            <li>

                                <form action="../logout.php" method="post">
                                    <input type="hidden" name="username" value="<?php echo $row_user['user_id']; ?>">
                                    <button class="dropdown-item btn btn-sm text-danger py-2" href="#">

                                        <i class="bi bi-box-arrow-right me-2"></i>

                                        Logout

                                    </button>
                                </form>

                            </li>

                        </ul>

                    </div>

            <?php
                }
            }
            ?>


        </div>

    </div>

</nav>