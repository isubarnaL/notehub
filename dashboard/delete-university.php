<?php
include_once '../security.php';
admin_guard();
csrf_check();

include_once 'dbCon.php';
$con = connect();

if (isset($_GET['uni_id'])) {
    $uni_id = (int) $_GET['uni_id'];
    $stmt = $con->prepare("DELETE FROM `uni_tables` WHERE uni_id = ?");
    $stmt->bind_param('i', $uni_id);
    if ($stmt->execute()) {
        echo '<script>alert("DELETED.")</script>';
        echo '<script>window.location="university-list.php"</script>';
    } else {
        error_log('DB error in delete-university.php: ' . $con->error);
        echo '<script>alert("Database error. Please try again.")</script>';
        echo '<script>window.location.href=window.location.href</script>';
    }
    $stmt->close();
}
?>
