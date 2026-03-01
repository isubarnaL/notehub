<!-- delete-note.php -->
<?php
include_once '../security.php';
admin_guard();
csrf_check();

include_once 'dbCon.php';
$con = connect();

if (isset($_GET['note_id'])) {
    $note_id = (int) $_GET['note_id'];
    $stmt = $con->prepare("DELETE FROM `note_list` WHERE note_id = ?");
    $stmt->bind_param('i', $note_id);
    if ($stmt->execute()) {
        echo '<script>alert("DELETED.")</script>';
        echo '<script>window.location="note-list.php"</script>';
    } else {
        echo "Error: " . $con->error;
    }
    $stmt->close();
}
?>
