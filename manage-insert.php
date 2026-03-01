<!-- manage-insert.php -->
<?php
include_once 'security.php';
csrf_check();

include_once 'dbCon.php';
$con = connect();

if (isset($_POST['regascus'])) {
    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];
    $role     = 2;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script>alert("Invalid email address.")</script>';
        echo '<script>window.location="registration.php"</script>';
        exit;
    }

    if (strlen($password) < 8) {
        echo '<script>alert("Password must be at least 8 characters.")</script>';
        echo '<script>window.location="registration.php"</script>';
        exit;
    }

    // Check for existing email
    $stmt = $con->prepare("SELECT id FROM `user_info` WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo '<script>alert("This Email Already Exists.")</script>';
        echo '<script>window.location="login.php"</script>';
    } else {
        $stmt->close();
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $ins = $con->prepare("INSERT INTO `user_info`(`user_name`, `email`, `password`, `role`) VALUES (?, ?, ?, ?)");
        $ins->bind_param('sssi', $name, $email, $hashed, $role);
        if ($ins->execute()) {
            echo '<script>alert("You are registered. Please log in.")</script>';
            echo '<script>window.location="login.php"</script>';
        } else {
            error_log('Registration DB error: ' . $con->error);
            echo '<script>alert("Registration failed. Please try again.")</script>';
            echo '<script>window.location="registration.php"</script>';
        }
        $ins->close();
    }
}
