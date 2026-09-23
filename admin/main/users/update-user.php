<?php
include "../configs/session_handling.php";
include "../configs/config.php";

if (isset($_POST['user_id'])) {

    $user_id = trim($_POST['user_id']);

    // declare global error variable for showing message
    $errors = [];

    // Name Validation
    $name = mysqli_real_escape_string($connection, trim($_POST['name']));

    if (empty($name)) {

        $errors['name'] = "Full Name is required."; //required

    } elseif (mb_strlen($name) < 3) {

        $errors['name'] = "Name must be at least 3 characters."; //minimum length

    } elseif (mb_strlen($name) > 30) {

        $errors['name'] = "Name must be less than 30 characters."; //maximum length

    } elseif (!preg_match('/^[a-zA-Z ]+$/', $name)) {

        $errors['name'] = "Only letters and spaces are allowed."; //Only letters, space and dot allowed.

    }

    // phone number validation
    $phone = mysqli_real_escape_string($connection, trim($_POST['phone']));

    if (empty($phone)) {

        $errors['phone'] = "Please enter a phone number";
    } elseif (!preg_match('/^[6-9][0-9]{9}$/', $phone)) {

        $errors['phone'] = 'Please enter a valid 10 digit mobile number.';
    }

    // gender validation
    $gender = mysqli_real_escape_string($connection, trim($_POST['gender'] ?? ''));

    $gender = (int) $gender;

    $allowed_gender = [1, 2, 3, 4];

    if (empty($gender)) {

        $errors['gender'] = "Please select a gender.";
    } elseif (!in_array($gender, $allowed_gender, true)) {

        $errors['gender'] = "Please select a valid gender.";
    }

    // date of birth validation
    $dob = mysqli_real_escape_string($connection, trim($_POST['dob'] ?? ''));

    if (empty($dob)) {

        $errors['dob'] = "Please enter a valid date of birth.";
    } else {

        $date = DateTime::createFromFormat('Y-m-d', $dob);

        if (!$date || $date->format('Y-m-d') !== $dob) {

            $errors['dob'] = "Please enter a valid date of birth.";
        } else {

            $today = new DateTime('today');

            if ($date > $today) {

                $errors['dob'] = 'Date of birth cannot be future date.';
            } elseif ($date->diff($today)->y < 18) {

                $errors['dob'] = "User must be at least 18 years old.";
            }
        }
    }


    // role validation
    $role = mysqli_real_escape_string($connection, trim($_POST['role'] ?? ''));

    if (empty($role)) {

        $errors['role'] = "Please select a role.";
    } elseif (!ctype_digit($role) || (int) $role <= 0) {

        $errors['role'] = "Invalid role selected";
    }

    if (!isset($errors['role'])) {

        $sql_role = "SELECT role_id FROM roles WHERE role_id = {$role}";

        $role_result = mysqli_query($connection, $sql_role) or die('');

        if (mysqli_num_rows($role_result) < 1) {

            $errors['role'] = "Role does not exists.";
        }
    }

    // status validation
    $status = mysqli_real_escape_string($connection, trim($_POST['status'] ?? ''));

    if ($status === "") {

        $errors['status'] = "Please select a status";
    } elseif (!in_array($status, ['1', '2'], true)) {
        $errors['status'] = "Please select a valid status";
    }

    // department validation
    $department = mysqli_real_escape_string($connection, trim($_POST['department'] ?? ''));

    // $department = (int) $department;

    if (empty($department)) {

        $errors['department'] = "Please select a department";
    } elseif (!ctype_digit($department)) {

        $errors['department'] = "Please select a valid department.";
    }

    if (!empty($department) && ctype_digit($department)) {

        $department_id = (int) $department;

        $sql_department = "SELECT dept_id FROM departments WHERE dept_id = {$department_id}";

        $department_result = mysqli_query($connection, $sql_department) or die('');

        if (mysqli_num_rows($department_result) === 0) {

            $errors['department'] = "Department does not exists.";
        }
    }

    // date of joining validation
    $doj = mysqli_real_escape_string($connection, trim($_POST['doj'] ?? ''));

    if ($doj === '') {

        $errors['doj'] = "Date of Joining is required.";
    } else {

        $date = DateTime::createFromFormat('Y-m-d', $doj);

        if (!$date || $date->format('Y-m-d') !== $doj) {

            $errors['doj'] = "Please enter a valid joining date.";
        } else {

            $today = new DateTime('today');

            if ($date > $today) {

                $errors['doj'] = "Date of Joining cannot be a future date.";
            } elseif ($date < $dob) {

                $errors['doj'] = "Date of Joining cannot be before date of birth.";
            }
        }
    }

    // address validation
    $address = mysqli_real_escape_string($connection, trim($_POST['address'] ?? ''));

    if ($address === '') {

        $errors['address'] = "Address is require.";
    } elseif (mb_strlen($address) < 10 && mb_strlen($address) > 255) {

        $errors['address'] = "Address must be at least 10 charcters long and not exceed 255 characters.";
    }

    // old photo
    $sql_old_photo = "SELECT photo FROM user WHERE user_id = {$user_id}";

    $result_old_photo = mysqli_query($connection, $sql_old_photo);

    if (mysqli_num_rows($result_old_photo) === 0) {

        echo json_encode([
            'status' => false,
            'message' => "User not found."
        ]);

        exit;
    }

    $row_old_photo = mysqli_fetch_assoc($result_old_photo);

    $old_photo = $row_old_photo['photo'];


    // Default: old photo থাকবে
    $new_file_name = $old_photo;


    // =========================
    // Profile Photo
    // =========================

    if (
        isset($_FILES['profile_photo']) &&
        $_FILES['profile_photo']['error'] !== UPLOAD_ERR_NO_FILE
    ) {

        $photo = $_FILES['profile_photo'];

        // Upload error
        if ($photo['error'] !== UPLOAD_ERR_OK) {

            $errors['profile_photo'] = "Error uploading profile photo.";
        } else {

            // Allowed extension
            $allowed_extension = ["jpg", "jpeg", "png"];

            $extension = strtolower(
                pathinfo($photo['name'], PATHINFO_EXTENSION)
            );

            if (!in_array($extension, $allowed_extension, true)) {

                $errors['profile_photo'] =
                    "Only JPG, JPEG and PNG files are allowed.";
            } elseif ($photo['size'] > 2 * 1024 * 1024) {

                $errors['profile_photo'] =
                    "Profile photo must not exceed 2 MB.";
            } elseif (getimagesize($photo['tmp_name']) === false) {

                $errors['profile_photo'] =
                    "Invalid image file.";
            } else {

                // MIME validation
                $finfo = finfo_open(FILEINFO_MIME_TYPE);

                $mime_type = finfo_file(
                    $finfo,
                    $photo['tmp_name']
                );

                finfo_close($finfo);

                $allowed_mime_types = [
                    "image/jpeg",
                    "image/png"
                ];

                if (!in_array($mime_type, $allowed_mime_types, true)) {

                    $errors['profile_photo'] =
                        "Invalid image file.";
                }
            }
        }


        // =========================
        // Upload New Photo
        // =========================

        if (!isset($errors['profile_photo'])) {

            $upload_dir = "uploads/";

            if (!is_dir($upload_dir)) {

                mkdir($upload_dir, 0777, true);
            }

            $new_file_name =
                uniqid('user_', true) . "." . $extension;

            $destination =
                $upload_dir . $new_file_name;


            if (move_uploaded_file(
                $photo['tmp_name'],
                $destination
            )) {

                // New photo successfully uploaded
                // এখন old photo delete হবে

                if (
                    !empty($old_photo) &&
                    file_exists($upload_dir . $old_photo)
                ) {

                    unlink($upload_dir . $old_photo);
                }
            } else {

                $errors['profile_photo'] =
                    "Failed to save profile photo.";

                // Old photo থাকবে
                $new_file_name = $old_photo;
            }
        }
    }

    // OLD PASSWORD

    $sql_old_password = "SELECT password FROM user WHERE user_id = {$user_id}";

    $result_old_password = mysqli_query($connection, $sql_old_password);

    if (mysqli_num_rows($result_old_password) === 0) {

        echo json_encode([
            'status' => false,
            'message' => 'User not found'
        ]);

        exit;
    }

    $row_old_password = mysqli_fetch_assoc($result_old_password);

    $old_password_hash = $row_old_password['password'];

    // New Password
    $password = trim($_POST['password'] ?? '');

    if ($password !== '') {

        if (mb_strlen($password) < 5) {

            $errors['password'] = "Password must be at least 5 characters.";
        } elseif (mb_strlen($password) > 64) {

            $errors['password'] = "Password must be less than 64 characters.";
        } elseif (!preg_match('/[A-Z]/', $password)) {

            $errors['password'] =
                "Password must contain at least one uppercase letter.";
        } elseif (!preg_match('/[a-z]/', $password)) {

            $errors['password'] =
                "Password must contain at least one lowercase letter.";
        } elseif (!preg_match('/[0-9]/', $password)) {

            $errors['password'] =
                "Password must contain at least one number.";
        } elseif (!preg_match('/[!@#$%&*]/', $password)) {

            $errors['password'] =
                "Password must contain at least one special character.";
        }
    }


    // Confirm Password
    $confirm_password = trim($_POST['confirm_password'] ?? '');


    // Only check confirm password when new password is entered
    if ($password !== '') {

        if ($confirm_password === '') {

            $errors['confirm_password'] =
                "Please confirm your password.";
        } elseif ($password !== $confirm_password) {

            $errors['confirm_password'] =
                "Passwords do not match.";
        }
    }


    // Create new hash only when password is valid
    if (
        $password !== '' &&
        !isset($errors['password']) &&
        !isset($errors['confirm_password'])
    ) {

        if ($password === $old_password_hash) {

            $password_hash = $password;
            

        } else {
            $password_hash = password_hash(
                $password,
                PASSWORD_DEFAULT
            );
        }

        
    }


    // error handling

    if (!empty($errors)) {

        echo json_encode([
            'status' => false,
            'message' => $errors
        ]);

        exit;
    }

    $sql = "UPDATE user 
            SET name = '{$name}',
            phone = '{$phone}',
            gender = {$gender},
            dob = '{$dob}',
            role_id = {$role},
            status = {$status},
            department= '{$department}',
            doj = '{$doj}',
            address = '{$address}',
            password = '{$password_hash}',
            photo = '{$new_file_name}',
            user_updated_at = NOW()
            WHERE user_id = {$user_id}
            ";

    $result = mysqli_query($connection, $sql);

    // error transfer

    if ($result) {

        echo json_encode([
            "status" => true,
            "message" => "User updated succesfully.",
            "updated_at" => date("Y-m-d H:i:s")
        ]);
    }
}