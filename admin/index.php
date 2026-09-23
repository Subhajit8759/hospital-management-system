
<?php

// VALIDATE USER
    if (isset($_GET['error']) && $_GET['error'] === "userNotFound") {

        echo "<script>alert('User not Fuond')</script>";

    } 


    // PASSWORD
    if (isset($_GET['error']) && $_GET['error'] === "invalidPassword") {

        echo "<script>alert('Wrong Password')</script>";

    }

?>

<?php

session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0");

$error = [];

if (isset($_SESSION['user_id'])) {
    header("Location: http://localhost/hospital/admin/main/");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    #CONNECTON
    $connection = mysqli_connect("localhost", "root", "", "hospital_management");

    if (!$connection) {

        die("Database connection failed");
    }

    // Get username and passwords
    $username = trim($_POST['username'] ?? "");
    $password = trim($_POST['password'] ?? "");

    // Basic validation
    if ($username === "" || $password === "") {

        header("Location: index.php");
        exit;
    }

    // Find user by username
    $username = mysqli_real_escape_string($connection, $username);

    $sql = "SELECT * FROM user
            LEFT JOIN gender ON gender.gender_name = user.gender
            LEFT JOIN departments ON departments.dept_id = user.department
            LEFT JOIN roles ON roles.role_id = user.role_id
            WHERE user.username = '{$username}' LIMIT 1";

    $result = mysqli_query($connection, $sql);

    if ($result && mysqli_num_rows($result) === 1) {

        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {

            // Store session
            $_SESSION['username'] = $row['username'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['role_name'] = $row['role_name'];
            $_SESSION['role_id'] = $row['role_id'];

            // Login successfull
            header("Location: http://localhost/hospital/admin/main/");
            
            exit;
        } else {

            // Wrong password
            header("Location: index.php?error=invalidPassword");
            exit;
        }

    } else {

        // User not found
        header("Location: index.php?error=userNotFound");
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Management System | Admin Login</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.26.25/sweetalert2.css">

    <link rel="stylesheet" href="public/css/style.css">

</head>

<body>

    <div class="card login-card">

        <div class="card-body p-5">

            <div class="logo">
                <i class="bi bi-hospital"></i>
            </div>

            <h3 class="text-center mt-4 hospital-name">
                Hospital Management System
            </h3>

            <p class="text-center text-muted mb-4">
                Administrator Login
            </p>

            <form id="loginForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

                <div class="mb-3">
                    <label class="form-label">User ID</label>
                    <input type="text" name="username" class="form-control" placeholder="Enter User ID">
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter password">
                </div>

                <div class="d-flex justify-content-between mb-4">

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-label">
                            Remember Me
                        </label>
                    </div>

                    <a href="#" class="text-decoration-none">
                        Forgot Password?
                    </a>

                </div>

                <button type="submit" class="btn btn-primary w-100 btn-login">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Login
                </button>

            </form>

            <hr>

            <p class="text-center footer-text mb-0">
                © 2026 Hospital Management System
            </p>

        </div>

    </div>

    <script>
    window.addEventListener("pageshow", function(event) {
        if (event.persisted) {
            window.location.reload();
        }
    })
    </script>
    

</body>

</html>