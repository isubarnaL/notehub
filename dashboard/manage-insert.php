<?php
include_once '../security.php';
session_guard();
csrf_check();

include_once 'dbCon.php';
$con = connect();

// Add university
if (isset($_POST['adduni'])) {
    $uniname = trim($_POST['uniname']);
    $stmt = $con->prepare("INSERT INTO `uni_tables`(`uni_name`) VALUES (?)");
    $stmt->bind_param('s', $uniname);
    if ($stmt->execute()) {
        echo '<script>alert("New university added successfully")</script>';
        echo '<script>window.location="university-add.php"</script>';
    } else {
        error_log('DB error in manage-insert.php: ' . $con->error);
        echo '<script>alert("Database error. Please try again.")</script>';
        echo '<script>window.location.href=window.location.href</script>';
    }
    $stmt->close();
}

// Add notemaker
if (isset($_POST['addnotemaker'])) {
    $notemakername = trim($_POST['notemakername']);
    $stmt = $con->prepare("INSERT INTO `notemaker_tables`(`notemaker_name`) VALUES (?)");
    $stmt->bind_param('s', $notemakername);
    if ($stmt->execute()) {
        echo '<script>alert("New notemaker added successfully")</script>';
        echo '<script>window.location="notemaker-add.php"</script>';
    } else {
        error_log('DB error in manage-insert.php: ' . $con->error);
        echo '<script>alert("Database error. Please try again.")</script>';
        echo '<script>window.location.href=window.location.href</script>';
    }
    $stmt->close();
}
?>
