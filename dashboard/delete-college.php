<?php
include_once '../security.php';
admin_guard();
csrf_check();

include_once 'dbCon.php';
$con = connect();

if (isset($_GET['college_id'])) {
    $college_id = (int) $_GET['college_id'];
    $uni_id     = (int) $_GET['uni_id'];
    $stmt = $con->prepare("DELETE FROM `college_names` WHERE college_id = ?");
    $stmt->bind_param('i', $college_id);
    if ($stmt->execute()) {
        echo '<script>alert("DELETED.")</script>';
        echo '<script>window.location.href="view-college-list.php?uni_id=' . $uni_id . '"</script>';
    } else {
        error_log('DB error in delete-college.php: ' . $con->error);
        echo '<script>alert("Database error. Please try again.")</script>';
        echo '<script>window.location.href=window.location.href</script>';
    }
    $stmt->close();
}
?>
