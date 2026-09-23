<?php
include "../configs/session_handling.php";
include "../configs/config.php";

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


// username validation

$username = mysqli_real_escape_string($connection, trim($_POST['username']));

if (empty($username)) {

  $errors['username'] = "Username must required.";
} elseif (mb_strlen($username) < 3) {

  $errors['username'] = "Username must be at least 3 characters."; //minimum length

} elseif (mb_strlen($username) > 30) {

  $errors['username'] = "Username must be less than 30 characters."; //maximum length

} elseif (!preg_match('/^[a-zA-Z0-9._]+$/', $username)) {

  $errors['username'] = "Only letters, numbers, dot (.) and underscores (_) are allowed.";
}

if (!isset($errors['username'])) {

  $sql_username = "SELECT username FROM user WHERE username = '{$username}'";

  $result_username = mysqli_query($connection, $sql_username) or die('');

  if (mysqli_num_rows($result_username) > 0) {

    $errors['username'] = "Username already exists.";
  }
}


// email validation
$email = mysqli_real_escape_string($connection, trim($_POST['email']));

if (empty($email)) {

  $errors['email'] = "Email is required";
} elseif (mb_strlen($email) > 100) {

  $errors['email'] = "Email must be under 100 characters.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

  $errors['email'] = "Must enter a valid email ID.";
}

// matchaing email id from data base
if (!isset($errors['email'])) {

  $sql_email = "SELECT email FROM user WHERE email = '{$email}'";

  $result_email = mysqli_query($connection, $sql_email) or die('');

  if (mysqli_num_rows($result_email)) {

    $errors['email'] = "Email is already exists.";
  }
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

    // birth date
    $birth_date = new DateTime($dob);

  // calculate minimum age from dob
  $minimum_joining_date = clone $birth_date;
  $minimum_joining_date->modify('+18 years');

    if ($date > $today) {

      $errors['doj'] = "Date of Joining cannot be a future date.";
    } elseif ($date < $dob) {

      $errors['doj'] = "Date of Joining cannot be before date of birth.";

    } elseif ($date < $minimum_joining_date) {

      $errors['doj'] ="Employee must not be less than 18 years from date of birth.";

    }
  } 
}

// password validation
$password = mysqli_real_escape_string($connection, trim($_POST['password'] ?? ''));

if ($password === '') {

  $errors['password'] = "Password is required.";
} elseif (mb_strlen($password) < 5) {

  $errors['password'] = "Password must be at least 5 characters.";
} elseif (mb_strlen($password) > 20) {

  $errors['password'] = "Password must be less than 20 characters.";
} elseif (!preg_match('/[A-Z]/', $password)) {

  $errors['password'] = "Password must contain at least one uppercase letter.";
} elseif (!preg_match('/[a-z]/', $password)) {

  $errors['password'] = "Password must contain at least one lowercase letter.";
} elseif (!preg_match('/[0-9]/', $password)) {

  $errors['password'] = "Password must contain at least one number.";
} elseif (!preg_match('/[!@#$%&*]/', $password)) {

  $errors['password'] = "Password must contain at least one special character (! @ # $ % & *)";
}

// confirmed password validation
$confirm_password = mysqli_real_escape_string($connection, trim($_POST['confirm_password'] ?? ''));

if ($confirm_password === '') {

  $errors['confirm_password'] = "Please confirm your password.";
} elseif ($password !== $confirm_password) {

  $errors['confirm_password'] = "Passwords do not match.";
}

// password_hashing 

if (empty($errors['password']) and empty($errors['confirm_password'])) {

  $password_hash = password_hash($password, PASSWORD_DEFAULT);
}

// address validation
$address = mysqli_real_escape_string($connection, trim($_POST['address'] ?? ''));

if ($address === '') {

  $errors['address'] = "Address is require.";
} elseif (mb_strlen($address) < 10 && mb_strlen($address) > 255) {

  $errors['address'] = "Address must be at least 10 charcters long and not exceed 255 characters.";
}

// profile photo validation

if (!isset($_FILES['profile_photo']) || $_FILES['profile_photo']['error'] === UPLOAD_ERR_NO_FILE) {

  $errors['profile_photo'] = "Profile photo is required.";
} elseif ($_FILES['profile_photo']['error'] !== UPLOAD_ERR_OK) {

  $errors['profile_photo'] = 'Error uploading profile photo.';
} else {

  $photo = $_FILES['profile_photo'];

  // Allowed extension
  $allowed_extension = ["jpg", "jpeg", "png"];

  $extension = strtolower(pathinfo($photo['name'], PATHINFO_EXTENSION));

  if (!in_array($extension, $allowed_extension)) {

    $errors['profile_photo'] = "Only JPG, JPEG and PNG files are allowed.";
  }
  // File size
  elseif ($photo['size'] > 2 * 1024 * 1024) {

    $errors['profile_photo'] = "Profile photo must not exceed 2 MB.";
  } elseif (getimagesize($photo['tmp_name']) === false) {

    $errors['profile_photo'] = "Inavalid image file.";
  }

  // MIME type validation
  else {

    $finfo = finfo_open(FILEINFO_MIME_TYPE);

    $mime_type = finfo_file($finfo, $photo['tmp_name']);


    $allowed_mime_types = [
      "image/jpeg",
      "image/png"
    ];

    if (!in_array($mime_type, $allowed_mime_types)) {

      $errors['profile_photo'] = "Invalid image file.";
    }
  }
}

if (empty($errors)) {

  $upload_dir = "uploads/";

  if (!is_dir($upload_dir)) {

    mkdir($upload_dir, 0777, true);
  }

  $new_file_name = uniqid('user_', true) . "." . $extension;

  $destination = $upload_dir . $new_file_name;

  if (!move_uploaded_file($photo['tmp_name'], $destination)) {

    $errors['profile_photo'] = "Falied to save profile photo.";
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

// data inserting
$sql = "INSERT INTO user ( role_id, name, email, phone, gender, username, password, address, department, dob, doj, status, photo )
          VALUES (
            {$role}, '{$name}', '{$email}', '{$phone}', '{$gender}', '{$username}', '{$password_hash}', '{$address}',
            {$department}, '{$dob}', '{$doj}', {$status}, '{$new_file_name}'
          )";

$result = mysqli_query($connection, $sql);


// error transfer

if ($result) {
  echo json_encode([
    "status" => true,
    "message" => "User created succesfully."
  ]);
}

