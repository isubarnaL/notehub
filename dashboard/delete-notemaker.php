<!-- delete-notemaker.php -->
<?php
include_once '../security.php';
admin_guard();
csrf_check();

include_once 'dbCon.php';
$con = connect();

if (isset($_GET['notemaker_id'])) {
    $notemaker_id = (int) $_GET['notemaker_id'];
    $stmt = $con->prepare("DELETE FROM `notemaker_tables` WHERE notemaker_id = ?");
    $stmt->bind_param('i', $notemaker_id);
    if ($stmt->execute()) {
        echo '<script>alert("DELETED.")</script>';
        echo '<script>window.location.href="notemaker-list.php"</script>';
    } else {
        echo "Error: " . $con->error;
    }
    $stmt->close();
}
?>
