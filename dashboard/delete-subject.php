<!-- delete-subject.php -->
<?php
include_once '../security.php';
admin_guard();
csrf_check();

include_once 'dbCon.php';
$con = connect();

if (isset($_GET['subject_id'])) {
    $subject_id = (int) $_GET['subject_id'];
    $depart_id  = (int) $_GET['depart_id'];
    $semester   = (int) $_GET['semester'];
    $uni_id     = (int) $_GET['uni_id'];

    $stmt = $con->prepare("DELETE FROM `subject_names` WHERE subject_id = ? AND semester = ? AND depart_id = ?");
    $stmt->bind_param('iii', $subject_id, $semester, $depart_id);
    if ($stmt->execute()) {
        echo '<script>alert("DELETED.")</script>';
        echo '<script>window.location.href="view-subject-list.php?uni_id=' . $uni_id . '"</script>';
    } else {
        echo "Error: " . $con->error;
    }
    $stmt->close();
}
?>
