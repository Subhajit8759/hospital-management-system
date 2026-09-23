<?php
    include "../configs/session_handling.php";
?>
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Departments</h5>

        <button type="button" class="btn btn-primary add-department-btn">
            <i class="bi bi-plus-lg"></i>
            Add Department
        </button>
    </div>

    <div class="card-body">

        <?php
        include "../configs/config.php";

        // PAGINATION
        if (isset($_POST['page']) && $_POST['page']) {
            $page = (int) $_POST['page'];
        } else {
            $page = 1;
        }

        $limit = 15;

        $offset = ($page - 1) * $limit;

        $sql_pagination = "SELECT COUNT(*) AS total FROM departments";

        $result_pagination = mysqli_query($connection, $sql_pagination);

        $row_count = mysqli_fetch_assoc($result_pagination);

        $total_departments = $row_count['total'];

        // total pages
        $total_pages = ceil($total_departments / $limit);


    // DEPARTMENT SQL
        $sql_departments = "SELECT * FROM departments ORDER BY dept_name LIMIT {$limit} OFFSET {$offset}";

        $result_department = mysqli_query($connection, $sql_departments);

        if (mysqli_num_rows($result_department) > 0) {
            $sl = $offset + 1;
        ?>
            <div class="table-responsive">

                <table class="table table-hover table-sm table-bordered table-striped align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Department Name</th>
                            <th>CODE</th>
                            <!-- <th>Description</th> -->
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php

                        while ($row_department = mysqli_fetch_assoc($result_department)) {
                            
                        ?>



                            <tr>
                                <td><?php echo $sl++; ?></td>

                                <td><?php echo $row_department['dept_name']; ?></td>

                                <td><?php echo $row_department['dept_code']; ?></td>

                                <!-- <td><?php echo $row_department['dept_description']; ?></td> -->

                                <td><?php echo $row_department['dept_created_at']; ?></td>

                                <td><?php echo $row_department['dept_updated_at']; ?></td>



                                <td>

                                    <?php
                                    if ($row_department['dept_status'] == 1) {
                                    ?>
                                        <span class="badge bg-success">
                                            Active
                                        </span>
                                    <?php
                                    } elseif ($row_department['dept_status'] == 2) {
                                    ?>
                                        <span class="badge bg-danger">
                                            Inactive
                                        </span>
                                    <?php
                                    } else {
                                    ?>
                                        <span class="badge bg-warning">
                                            Not selected
                                        </span>
                                    <?php
                                    }
                                    ?>


                                </td>

                                <td class="text-center">



                                    <button class="btn btn-warning btn-sm edit-department" data-id="<?php echo $row_department['dept_id']; ?>">
                                        <i class="bi bi-pencil"></i>
                                    </button>

                                    <button class="btn btn-danger btn-sm delete-department" data-id="<?php echo $row_department['dept_id']; ?>">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>

                <nav class="mt-5">
                    <ul class="pagination justify-content-end">
                        <!-- previous -->
                        <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                            <a href="#" class="page-link department-pagination" data-page="<?= $page - 1; ?>">Previous</a>
                        </li>

                        <!-- pages -->
                        <?php

                            for ($i = 1; $i <= $total_pages; $i++) :

                        ?>
                        <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">
                            <a href="#" class="page-link department-pagination" data-page="<?= $i ?>">
                                    <?= $i; ?>
                            </a>
                        </li>

                        <?php endfor ?>

                        <!-- NEXT -->
                        <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : ''; ?>">
                            <a href="#" class="page-link department-pagination " data-page="<?= $page + 1; ?>">
                                Next
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>
        <?php
        }
        ?>



    </div>
</div>