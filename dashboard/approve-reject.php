<!-- approve-reject.php -->
<?php
include_once '../security.php';
admin_guard();
csrf_check();

include_once 'dbCon.php';
$con = connect();

$note_id = isset($_GET['note_id']) ? (int) $_GET['note_id'] : 0;
if (!$note_id) {
    http_response_code(400);
    die('Invalid note ID.');
}

// Reject note
if (isset($_GET['reject_id'])) {
    $stmt = $con->prepare("UPDATE note_list SET approved_status = 2 WHERE note_id = ?");
    $stmt->bind_param('i', $note_id);
    if ($stmt->execute()) {
        echo '<script>alert("Rejected.")</script>';
        echo '<script>window.location="note-list.php"</script>';
    } else {
        error_log('approve-reject DB error: ' . $con->error);
        echo '<script>alert("Database error.")</script>';
        echo '<script>window.location="note-list.php"</script>';
    }
    $stmt->close();
}

// Approve note
if (isset($_GET['approve_id'])) {
    $stmt = $con->prepare("UPDATE note_list SET approved_status = 1 WHERE note_id = ?");
    $stmt->bind_param('i', $note_id);
    if ($stmt->execute()) {
        echo '<script>alert("Approved.")</script>';
        echo '<script>window.location="note-list.php"</script>';
    } else {
        error_log('approve-reject DB error: ' . $con->error);
        echo '<script>alert("Database error.")</script>';
        echo '<script>window.location="note-list.php"</script>';
    }
    $stmt->close();
}
?>
