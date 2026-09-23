<?php include "../configs/session_handling.php" ?>

<?php

include "../configs/config.php";

// PAGINATION
if (isset($_POST['page']) && $_POST['page']) {
    $page = (int) $_POST['page'];
} else {
    $page = 1;
}

$limit = 5;

$offset = ($page - 1) * $limit;

$sql_pagination = "SELECT COUNT(*) AS total FROM doctor";

$result_pagination = mysqli_query($connection, $sql_pagination);

$row_count = mysqli_fetch_assoc($result_pagination);

$total_doctors = $row_count['total'];

$total_pages = ceil($total_doctors / $limit);

// FIND DOCTOR
$sql_doctor = "
                SELECT * FROM doctor 
                LEFT JOIN user ON doctor.doctor_user_id = user.user_id
                LEFT JOIN departments ON departments.dept_id = user.department
                LEFT JOIN gender ON gender.gender_id = user.gender WHERE user.role_id = 1
                ";

$result_doctor = mysqli_query(
    $connection,
    $sql_doctor
);

?>

<div class="card shadow-sm">

    <!-- Header -->
    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            <i class="bi bi-person-badge me-2"></i>
            doctor
        </h5>

        <button type="button" class="btn btn-primary btn-sm" id="addDoctorBtn">

            <i class="bi bi-plus-lg me-1"></i>
            Add Doctor

        </button>

    </div>


    <!-- Body -->
    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-light">

                    <tr>

                        <th>#</th>

                        <th>Photo</th>

                        <th>Doctor Name</th>

                        <th>Username</th>

                        <th>Phone</th>

                        <th>Department</th>

                        <th>Qualification</th>

                        <th>Fees</th>

                        <th>Status</th>

                        <th class="text-center">Action</th>

                    </tr>

                </thead>


                <tbody>

                    <?php

                if ($result_doctor &&
                    mysqli_num_rows($result_doctor) > 0) {

                    $serial = 1;

                    while ($doctor = mysqli_fetch_assoc($result_doctor)) {

                ?>

                    <tr>

                        <!-- Serial -->
                        <td>
                            <?= $serial++; ?>
                        </td>


                        <!-- Photo -->
                        <td>

                            <img src="users/uploads/<?= htmlspecialchars($doctor['photo']); ?>" alt="Doctor Photo"
                                width="50" height="50" class="rounded-circle" style="object-fit: cover;">

                        </td>


                        <!-- Doctor Name -->
                        <td>

                            <strong>
                                <?= htmlspecialchars($doctor['name']); ?>
                            </strong>

                        </td>


                        <!-- Username -->
                        <td>
                            <?= htmlspecialchars($doctor['username']); ?>
                        </td>


                        <!-- Phone -->
                        <td>
                            <?= htmlspecialchars($doctor['phone']); ?>
                        </td>


                        <!-- Department -->
                        <td>

                            <span class="badge bg-info text-dark">

                                <?= htmlspecialchars(
                                    $doctor['dept_name'] ?? 'N/A'
                                ); ?>

                            </span>

                        </td>


                        <!-- Qualification -->
                        <td>
                            <?= htmlspecialchars(
                                $doctor['doctor_qualification']
                            ); ?>
                        </td>


                        <!-- Fees -->
                        <td>

                            <?php

                            if ($doctor['doctor_fees'] !== null &&
                                $doctor['doctor_fees'] !== '') {

                                echo '₹' .
                                    number_format(
                                        (float)$doctor['doctor_fees'],
                                        2
                                    );

                            } else {

                                echo 'N/A';

                            }

                            ?>

                        </td>


                        <!-- Status -->
                        <td>

                            <?php if ($doctor['status'] == 1) { ?>

                            <span class="badge bg-success">
                                Active
                            </span>

                            <?php } else { ?>

                            <span class="badge bg-secondary">
                                Inactive
                            </span>

                            <?php } ?>

                        </td>


                        <!-- Action -->
                        <td class="text-center">
                            <!-- View -->
                            <button type="button" class="btn btn-sm btn-info view-doctor"
                                data-id="<?= $doctor['user_id']; ?>" title="View">

                                <i class="bi bi-eye"></i>

                            </button>


                            <!-- Edit -->
                            <button type="button" class="btn btn-sm btn-warning edit-doctor"
                                data-id="<?= $doctor['user_id']; ?>" title="Edit">

                                <i class="bi bi-pencil-square"></i>

                            </button>


                            <!-- Delete -->
                            <button type="button" class="btn btn-sm btn-danger delete-doctor"
                                data-id="<?= $doctor['user_id']; ?>" title="Delete">

                                <i class="bi bi-trash"></i>

                            </button>

                        </td>

                    </tr>

                    <?php

                    }

                } else {

                ?>

                    <tr>

                        <td colspan="10" class="text-center text-muted py-4">

                            <i class="bi bi-person-x fs-3 d-block mb-2"></i>

                            No doctor found.

                        </td>

                    </tr>

                    <?php

                }

                ?>

                </tbody>

            </table>

            <nav class="mt-5">

                <ul class="pagination justify-content-end">

                    <!-- PREV -->
                    <li class="page-item <?= ($page < 1) ? 'disabled' : ''; ?>">
                        <a href="#" class="page-link doctor-pagination" data-page="<?= $page - 1; ?>">
                            Prev
                        </a>
                    </li>

                    <!-- PAGES -->
                    <?php for ($i = 1; $i <= $total_pages; $i++) : ?>

                    <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">
                        <a href="#" class="page-link doctor-pagination" data-page="<?= $i ?>"><?= $i ?></a>
                    </li>

                    <?php endfor ?>


                    <!-- NEXT -->
                    <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                        <a href="#" class="page-link doctor-pagination" data-page="<?= $page + 1; ?>">
                            Next
                        </a>
                    </li>
                </ul>

            </nav>

        </div>

    </div>

</div>