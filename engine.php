<?php
require_once("include.php");

$errors = [];
$old = [];

// ########## LOGIN
if (isset($_POST["login"])) {
    $username = trim($_POST["username"] ?? '');
    $password = $_POST["password"] ?? '';
    $old = ["username" => $username];
    if (empty($username)) {
        $errors["username"] = "Username is required.";
    }
    if (empty($password)) {
        $errors["password"] = "Password is required.";
    }
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old']    = $old;

        header("Location: login.php");
        exit();
    }
    $stmt = mysqli_prepare($conn, "SELECT * FROM `users` WHERE `username` = ? LIMIT 1");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $user   = mysqli_fetch_assoc($result);

    // 5. Verify username existence and password
    if (!$user) {
        $errors["username"] = "Username does not exist.";
    } elseif (!password_verify($password, $user["password"])) {
        $errors["password"] = "Wrong password.";
    }

    // 6. Handle final redirect based on results
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old']    = $old;
        header("Location: login.php");
        exit();
    }

    // 7. Success: Store user session (avoid storing password hash in session)
    unset($user['password']);
    $_SESSION["user"] = $user;

    // Clear any leftover errors/old inputs
    unset($_SESSION['errors'], $_SESSION['old']);

    header("Location: home.php");
    exit();
}
// ########## REGISTER
if (isset($_POST["register"])) {
    $username         = trim($_POST['username'] ?? '');
    $email            = trim($_POST['email'] ?? '');
    $password         = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    $old = [
        'username' => $username,
        'email'    => $email
    ];

    if (empty($username)) {
        $errors['username'] = "Username is required.";
    } elseif (strlen($username) < 3 || strlen($username) > 20) {
        $errors['username'] = "Username must be between 3 and 20 characters.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        $errors['username'] = "Username can only contain letters, numbers, and underscores.";
    }

    $re_username = re($conn, $_POST["username"]);
    $check_username = mysqli_num_rows(mysqli_query($conn, "SELECT null FROM `users` WHERE `username` = '$re_username'"));
    if ($check_username) {
        $errors['username'] = "Username $re_username already exist";
    }

    if (empty($email)) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Please enter a valid email address.";
    }

    if (empty($password)) {
        $errors['password'] = "Password is required.";
    } elseif (strlen($password) < 8) {
        $errors['password'] = "Password must be at least 8 characters long.";
    }

    if (empty($confirm_password)) {
        $errors['confirm_password'] = "Please confirm your password.";
    } elseif ($password !== $confirm_password) {
        $errors['confirm_password'] = "Passwords do not match.";
    }

    if (!empty($errors)) {
        // Save errors and old inputs in session flash memory
        $_SESSION['errors'] = $errors;
        $_SESSION['old']    = $old;

        header("Location: register.php");
        exit();
    }



    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // TODO: Database insertion logic here
    $re_email = re($conn, $_POST["email"]);
    $auth = $HOTEL_NAME . auth_ticket();

    mysqli_query($conn, "INSERT INTO `users` (`username`, `password`, `mail`, `auth_ticket`) VALUES ('$re_username', '$hashed_password', '$re_email', '$auth')");

    // Clear any previous error session data if successful
    unset($_SESSION['errors'], $_SESSION['old']);

    // Log the user in or set a success session, then redirect to home
    $user_data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `users` WHERE `username` = '$re_username'"));
    $_SESSION["user"] = $user_data;
    header("Location: home.php");
    exit();
} else {
    header("Location: index.php");
    exit();
}

function auth_ticket()
{
    return bin2hex(random_bytes(16));
}
