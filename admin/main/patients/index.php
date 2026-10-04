<div class="container-fluid">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">

        <div>
            <h5 class="mb-1">Patients</h5>
            <small class="text-muted">Manage registered patients</small>
        </div>

        <button type="button" class="btn btn-primary btn-sm" id="create-patient">
            <i class="bi bi-person-plus me-1"></i>
            Add Patient
        </button>

    </div>


    <!-- Search & Filter -->
    <div class="card shadow-sm mb-3">

        <div class="card-body">

            <div class="row g-2">

                <!-- Search -->
                <div class="col-md-5">
                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-search"></i>
                        </span>

                        <input type="text" class="form-control" id="patient-search"
                            placeholder="Search by UHID, name or mobile...">

                    </div>
                </div>


                <!-- Gender -->
                <div class="col-md-2">

                    <select class="form-select" id="patient-gender">

                        <option value="">All Gender</option>
                        <option value="1">Male</option>
                        <option value="2">Female</option>
                        <option value="3">Other</option>

                    </select>

                </div>


                <!-- Blood Group -->
                <div class="col-md-2">

                    <select class="form-select" id="patient-blood-group">

                        <option value="">All Blood Group</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>

                    </select>

                </div>


                <!-- Search Button -->
                <div class="col-md-3">

                    <button type="button" class="btn btn-primary w-100" id="search-patient">

                        <i class="bi bi-search me-1"></i>
                        Search

                    </button>

                </div>

            </div>

        </div>

    </div>


    <!-- Patient Table -->
    <div class="card shadow-sm">

        <div class="card-header bg-white d-flex justify-content-between align-items-center">

            <h6 class="mb-0">
                <i class="bi bi-people me-2"></i>
                Patient List
            </h6>

            <span class="badge text-bg-secondary">
                Total: 0
            </span>

        </div>


        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th class="text-center">
                                S.No
                            </th>

                            <th>
                                UHID
                            </th>

                            <th>
                                Patient Name
                            </th>

                            <th>
                                Gender
                            </th>

                            <th>
                                Age
                            </th>

                            <th>
                                Blood Group
                            </th>

                            <th>
                                Mobile
                            </th>

                            <th>
                                Registered On
                            </th>

                            <th class="text-center">
                                Action
                            </th>

                        </tr>

                    </thead>

                    <?php

                    include "../configs/config.php";

                    $sql = "SELECT * FROM patients
                                    LEFT JOIN emergency_contact ON patients.patient_id = emergency_contact.patient_id
                                    LEFT JOIN gender ON patients.gender = gender.gender_id
                                    LEFT JOIN blood_group ON patients.blood_group = blood_group.blood_group_id
                                    ORDER BY patients.patient_id DESC";

                    $result = mysqli_query($connection, $sql) or die();

                    if (mysqli_num_rows($result) > 0) {
                        $sl = 1;

                    ?>

                        <tbody id="patients-table-body">
                            <?php

                            while ($row = mysqli_fetch_assoc($result)) {

                            ?>
                                <!-- Patient rows will load here -->

                                <tr>

                                    <td><?= $sl++; ?></td>
                                    <td><?= $row['uhid']; ?></td>
                                    <td><?= $row['first_name'] . " " . $row['middle_name'] . " " . $row['last_name'] ; ?></td>
                                    <td><?= $row['gender_name']; ?></td>
                                    <td>
                                        <?php
                                            $dob = $row['dob'];
                                            $date_of_birth = new DateTime($dob);
                                            echo $date_of_birth->format("d-m-Y");
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo ($row['blood_group']) ? $row['blood_group_name'] : "Unknown"; ?>
                                    </td>
                                    <td><?= $row['patient_phone']; ?></td>
                                    <td>
                                        <?php
                                            $patient_created_at = $row['patient_created_at'];
                                            $patient_created_date = new DateTime($patient_created_at);
                                            echo $patient_created_date->format("d-m-Y i:m:s");
                                        ?>
                                    </td>
                                    <td>
                                        <a href="#" data-id="<?= $row['patient_id']; ?>"  class="btn btn-sm btn-primary view-patient">View</a>
                                        <a href="" class="btn btn-sm btn-success">Edit</a>
                                        <a href="" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>

                        <?php
                            }
                        }

                        ?>

                        </tbody>

                </table>

            </div>

        </div>


        <!-- Pagination -->
        <div class="card-footer bg-white">

            <div class="d-flex justify-content-between align-items-center">

                <small class="text-muted">
                    Showing 0 to 0 of 0 patients
                </small>


                <nav aria-label="Patient pagination">

                    <ul class="pagination pagination-sm mb-0">

                        <li class="page-item disabled">

                            <a class="page-link" href="#">
                                Previous
                            </a>

                        </li>

                        <li class="page-item active">

                            <a class="page-link" href="#">
                                1
                            </a>

                        </li>

                        <li class="page-item disabled">

                            <a class="page-link" href="#">
                                Next
                            </a>

                        </li>

                    </ul>

                </nav>

            </div>

        </div>

    </div>

</div>