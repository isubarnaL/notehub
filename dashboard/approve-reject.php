<!-- approve-reject.php -->
<?php
include_once '../security.php';
admin_guard();
csrf_check();

include_once 'dbCon.php';
$con = connect();

// Reject note
if (isset($_GET['reject_id'])) {
    $id = $_GET['note_id'];
    $stmt = $con->prepare("UPDATE note_list SET approved_status = 2 WHERE note_id = ?");
    $stmt->bind_param('s', $id);
    if ($stmt->execute()) {
        echo '<script>alert("Rejected.")</script>';
        echo '<script>window.location="note-list.php"</script>';
    } else {
        echo "Error: " . $con->error;
    }
    $stmt->close();
}

// Approve note
if (isset($_GET['approve_id'])) {
    $id = $_GET['note_id'];
    $stmt = $con->prepare("UPDATE note_list SET approved_status = 1 WHERE note_id = ?");
    $stmt->bind_param('s', $id);
    if ($stmt->execute()) {
        echo '<script>alert("Approved.")</script>';
        echo '<script>window.location="note-list.php"</script>';
    } else {
        echo "Error: " . $con->error;
    }
    $stmt->close();
}
?>
