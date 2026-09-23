<?php

include "../configs/session_handling.php";

?>

<div class="container-fluid users-page mt-4">

    <div class="card users-card shadow-sm border-0">

        <!-- Header -->
        <div class="card-header users-header bg-white">

            <div>
                <h4 class="mb-0 users-title">
                    <i class="bi bi-people-fill me-2"></i>
                    Users
                </h4>

                <small class="text-muted">
                    Manage hospital users
                </small>
            </div>

            <button type="button" class="btn btn-primary" id="addUserBtn">
                <i class="bi bi-plus-circle me-1"></i>
                Add New User
            </button>

        </div>


        <!-- Body -->
        <div class="card-body users-body">

            <?php
            include "../configs/config.php";

            // PAGINATION
            $limit = 15;

            $page = isset($_POST['page']) ? (int) $_POST['page'] : 1;

            if ($page < 1) {
                $page = 1;
            }

            $offset = ($page - 1) * $limit;

            // Total count users
            $sql_count = "SELECT count(*) as total FROM user";

            $result_count = mysqli_query($connection, $sql_count);

            $row_count = mysqli_fetch_assoc($result_count);

            $total_users = (int) $row_count['total'];

            // total pages
            $total_pages = ceil($total_users / $limit);

            // ALL USERS
            $sql = "SELECT * FROM user 
                    LEFT JOIN departments 
                    ON user.department = departments.dept_id 
                    LEFT JOIN roles 
                    ON user.role_id = roles.role_id 
                    ORDER BY user.user_id DESC 
                    LIMIT {$limit} OFFSET {$offset}";

            $result = mysqli_query($connection, $sql);

            $sl = 1;

            if (mysqli_num_rows($result) > 0) {
            ?>

            <div class="table-responsive users-table-wrapper">

                <table id="usersTable" class="table table-bordered table-hover align-middle mb-0 users-table">

                    <thead class="table-primary">

                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>

                        <tr>

                            <td>
                                <?php echo $sl++; ?>
                            </td>

                            <td class="user-name-cell">
                                <?php echo htmlspecialchars($row['name']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($row['username']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($row['email']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($row['phone']); ?>
                            </td>

                            <td>
                                <span class="badge bg-primary">
                                    <?php echo htmlspecialchars($row['role_name']); ?>
                                </span>
                            </td>

                            <td>

                                <?php if ($row['status'] == 1) { ?>

                                <span class="badge bg-success status-badge">
                                    Active
                                </span>

                                <?php } else { ?>

                                <span class="badge bg-danger status-badge">
                                    In-Active
                                </span>

                                <?php } ?>

                            </td>

                            <td>

                                <div class="user-actions">

                                    <button type="button" class="btn btn-sm btn-primary view-btn"
                                        data-id="<?php echo $row['user_id']; ?>" title="View User">

                                        <i class="bi bi-eye"></i>

                                    </button>


                                    <button type="button" class="btn btn-sm btn-warning edit-btn"
                                        data-id="<?php echo $row['user_id']; ?>" title="Edit User">

                                        <i class="bi bi-pencil"></i>

                                    </button>

                                    <?php
                                            if ($_SESSION['role_name'] === "admin") {
                                            ?>

                                    <?php
                                            }
                                            ?>

                                    <button type="button" class="btn btn-sm btn-danger delete-btn"
                                        data-id="<?php echo $row['user_id']; ?>" title="Delete User">

                                        <i class="bi bi-trash"></i>

                                    </button>


                                </div>

                            </td>

                        </tr>

                        <?php
                            }
                            ?>

                    </tbody>

                </table>

                <nav class="mt-5">

                    <ul class="pagination justify-content-center">
                        <!-- previous page -->
                        <li class="page-item <?php echo ($page <= 1) ? 'disabled' : '' ?>">
                            <a href="#" class="page-link user-pagination" data-page="<?= $page - 1; ?>">
                                Previous
                            </a>
                        </li>

                        <!-- PAGE NUMBER -->
                        <?php
                                for ($i = 1; $i <= $total_pages; $i++) :
                            ?>
                        <li class="page-item <?php echo ($i == $page) ? "active" : ""; ?>">
                            <a href="#" class="page-link user-pagination" data-page="<?php echo $i; ?>">
                                <?= $i ?>
                            </a>
                        </li>
                        <?php endfor; ?>


                        <!-- next page -->
                        <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                            <a href="#" class="page-link user-pagination" data-page="<?= $page + 1; ?>">Next</a>
                        </li>


                        
                    </ul>

                </nav>

            </div>

            <?php
            } else {
            ?>

            <div class="no-users">
                <i class="bi bi-people"></i>
                <p>No users found.</p>
            </div>

            <?php
            }
            ?>

        </div>

    </div>

</div>