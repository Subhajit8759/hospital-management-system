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

    <?php

    include "../configs/config.php";

    $limit = 10;

    $page = (isset($_POST['page'])) ? $_POST['page'] : 1;

    $offset = ($page - 1) * $limit;

    $sql_total_records = "SELECT COUNT(*) AS total_count FROM patients";

    $result_total_records = mysqli_query($connection, $sql_total_records);

    $total_records = mysqli_fetch_assoc($result_total_records);

    $total_patients = $total_records['total_count'];

    $total_pages = ceil($total_patients / $limit);

    $sl = $offset + 1;

    ?>


    <!-- Patient Table -->
    <div class="card shadow-sm">

        <div class="card-header bg-white d-flex justify-content-between align-items-center">

            <h6 class="mb-0">
                <i class="bi bi-people me-2"></i>
                Patient List
            </h6>

            <span class="badge text-bg-secondary">
                Total: <?= $total_records['total_count']; ?>
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

                    $sql = "SELECT * FROM patients
                                    LEFT JOIN emergency_contact ON patients.patient_id = emergency_contact.patient_id
                                    LEFT JOIN gender ON patients.gender = gender.gender_id
                                    LEFT JOIN blood_group ON patients.blood_group = blood_group.blood_group_id
                                    ORDER BY patients.patient_id DESC LIMIT {$limit} OFFSET {$offset}";

                    $result = mysqli_query($connection, $sql) or die();

                    if (mysqli_num_rows($result) > 0) {

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
                                        <a href="" class="btn btn-sm btn-success edit-patient" data-id="<?= $row['patient_id']; ?>">Edit</a>
                                        <a href="" class="btn btn-sm btn-danger delete-patient" data-id="<?= $row['patient_id']; ?>">Delete</a>
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
                    Showing <?= $offset + 1; ?> to <?= ($limit + $offset > $total_patients) ? $total_patients : ($limit + $offset); ?> of <?= $total_patients ?> patients
                </small>


                <nav aria-label="Patient pagination">

                    <ul class="pagination pagination-sm mb-0">

                        <li class="page-item <?= ($page <= 1) ? "disabled" : "" ?>">

                            <a class="page-link patient-pagination" href="#" data-page="<?= $page - 1 ?>">
                                Previous
                            </a>

                        </li>

                        <?php
                            for ($i = 1; $i <= $total_pages; $i++) {
                        ?>
                        <li class="page-item <?= ($i == $page) ? "active" : ""; ?>">

                            <a class="page-link patient-pagination" href="#" data-page="<?= $i ?>">
                                <?= $i ?>
                            </a>

                        </li>

                        <?php } ?>

                        <li class="page-item <?= ($page >= $total_pages)  ? "disabled" : "" ?>">

                            <a class="page-link patient-pagination" href="#" data-page="<?= $page + 1 ?>">
                                Next
                            </a>

                        </li>

                    </ul>

                </nav>

            </div>

        </div>

    </div>

</div>