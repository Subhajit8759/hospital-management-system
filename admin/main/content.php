


<div class="container-fluid dashboard-container">

    <!-- Header -->
    <div class="dashboard-header">

        <div>
            <h4 class="fw-bold mb-1">
                Dashboard
            </h4>

            <p class="text-muted mb-0">
                Hospital Management System
            </p>
        </div>

        <div class="dashboard-date">
            <i class="bi bi-calendar3 me-2"></i>
            <?php echo date("d M Y"); ?>
        </div>

    </div>


    <!-- Module Grid -->
    <div class="row g-3">


        <!-- Departments -->
        <div class="col-6 col-md-4 col-lg-3 col-xl-2">

            <a href="#" class="dashboard-card card-blue menu-link nav-link sidebar-link" data-page="departments/show-department-layout.php">

                <div class="card-icon">
                    <i class="bi bi-building"></i>
                </div>

                <div class="card-content">
                    <h6>Departments</h6>
                    <small>Manage departments</small>
                </div>

                <i class="bi bi-arrow-right card-arrow"></i>

            </a>

        </div>


        <!-- Doctors -->
        <div class="col-6 col-md-4 col-lg-3 col-xl-2">

        <a href="#" class="dashboard-card card-blue menu-link nav-link sidebar-link" data-page="doctors/">

                <div class="card-icon">
                    <i class="bi bi-person-badge"></i>
                </div>

                <div class="card-content">
                    <h6>Doctors</h6>
                    <small>Manage doctors</small>
                </div>

                <i class="bi bi-arrow-right card-arrow"></i>

            </a>

        </div>


        <!-- Patients -->
        <div class="col-6 col-md-4 col-lg-3 col-xl-2">

            <a href="#" class="dashboard-card card-cyan menu-link nav-link sidebar-link" data-page="patients/">

                <div class="card-icon">
                    <i class="bi bi-people"></i>
                </div>

                <div class="card-content">
                    <h6>Patients</h6>
                    <small>Patient records</small>
                </div>

                <i class="bi bi-arrow-right card-arrow"></i>

            </a>

        </div>


        <!-- Appointments -->
        <div class="col-6 col-md-4 col-lg-3 col-xl-2">

            <a href="#" class="dashboard-card card-orange">

                <div class="card-icon">
                    <i class="bi bi-calendar-check"></i>
                </div>

                <div class="card-content">
                    <h6>Appointments</h6>
                    <small>Appointments</small>
                </div>

                <i class="bi bi-arrow-right card-arrow"></i>

            </a>

        </div>


        <!-- Admission -->
        <div class="col-6 col-md-4 col-lg-3 col-xl-2">

            <a href="#" class="dashboard-card card-red">

                <div class="card-icon">
                    <i class="bi bi-hospital"></i>
                </div>

                <div class="card-content">
                    <h6>Admission</h6>
                    <small>Patient admission</small>
                </div>

                <i class="bi bi-arrow-right card-arrow"></i>

            </a>

        </div>


        <!-- Discharge -->
        <div class="col-6 col-md-4 col-lg-3 col-xl-2">

            <a href="#" class="dashboard-card card-purple">

                <div class="card-icon">
                    <i class="bi bi-door-open"></i>
                </div>

                <div class="card-content">
                    <h6>Discharge</h6>
                    <small>Discharge records</small>
                </div>

                <i class="bi bi-arrow-right card-arrow"></i>

            </a>

        </div>


        <!-- Pharmacy -->
        <div class="col-6 col-md-4 col-lg-3 col-xl-2">

            <a href="#" class="dashboard-card card-pink">

                <div class="card-icon">
                    <i class="bi bi-capsule"></i>
                </div>

                <div class="card-content">
                    <h6>Pharmacy</h6>
                    <small>Medicines</small>
                </div>

                <i class="bi bi-arrow-right card-arrow"></i>

            </a>

        </div>


        <!-- Laboratory -->
        <div class="col-6 col-md-4 col-lg-3 col-xl-2">

            <a href="#" class="dashboard-card card-teal">

                <div class="card-icon">
                    <i class="bi bi-eyedropper"></i>
                </div>

                <div class="card-content">
                    <h6>Laboratory</h6>
                    <small>Lab reports</small>
                </div>

                <i class="bi bi-arrow-right card-arrow"></i>

            </a>

        </div>


        <!-- Billing -->
        <div class="col-6 col-md-4 col-lg-3 col-xl-2">

            <a href="#" class="dashboard-card card-yellow">

                <div class="card-icon">
                    <i class="bi bi-receipt"></i>
                </div>

                <div class="card-content">
                    <h6>Billing</h6>
                    <small>Manage billing</small>
                </div>

                <i class="bi bi-arrow-right card-arrow"></i>

            </a>

        </div>


        <!-- Reports -->
        <div class="col-6 col-md-4 col-lg-3 col-xl-2">

            <a href="#" class="dashboard-card card-indigo">

                <div class="card-icon">
                    <i class="bi bi-bar-chart"></i>
                </div>

                <div class="card-content">
                    <h6>Reports</h6>
                    <small>View reports</small>
                </div>

                <i class="bi bi-arrow-right card-arrow"></i>

            </a>

        </div>


        <!-- Users -->
        <div class="col-6 col-md-4 col-lg-3 col-xl-2">

            <a href="#" class="dashboard-card card-dark menu-link nav-link sidebar-link" data-page="users/show-users.php">

                <div class="card-icon">
                    <i class="bi bi-person"></i>
                </div>

                <div class="card-content">
                    <h6>Users</h6>
                    <small>Manage users</small>
                </div>

                <i class="bi bi-arrow-right card-arrow"></i>

            </a>

        </div>


        <!-- Settings -->
        <div class="col-6 col-md-4 col-lg-3 col-xl-2">

            <a href="#" class="dashboard-card card-gray">

                <div class="card-icon">
                    <i class="bi bi-gear"></i>
                </div>

                <div class="card-content">
                    <h6>Settings</h6>
                    <small>System settings</small>
                </div>

                <i class="bi bi-arrow-right card-arrow"></i>

            </a>

        </div>


    </div>

</div>