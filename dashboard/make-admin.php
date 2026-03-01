<!-- make-admin.php -->
<?php
include_once '../security.php';
admin_guard();
csrf_check();

include_once 'dbCon.php';
$con = connect();

// Demote to regular user
if (isset($_GET['reject_id'])) {
    $id = (int) $_GET['user_id'];
    $stmt = $con->prepare("UPDATE user_info SET role = 2 WHERE id = ?");
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
        echo '<script>alert("Made User.")</script>';
        echo '<script>window.location="index.php"</script>';
    } else {
        echo "Error: " . $con->error;
    }
    $stmt->close();
}

// Promote to admin
if (isset($_GET['approve_id'])) {
    $id = (int) $_GET['user_id'];
    $stmt = $con->prepare("UPDATE user_info SET role = 1 WHERE id = ?");
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
        echo '<script>alert("Made Admin.")</script>';
        echo '<script>window.location="index.php"</script>';
    } else {
        echo "Error: " . $con->error;
    }
    $stmt->close();
}
?>
