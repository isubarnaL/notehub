<!-- delete-note.php -->
<?php
include_once '../security.php';
admin_guard();
csrf_check();

include_once 'dbCon.php';
$con = connect();

if (isset($_GET['note_id'])) {
    $note_id = (int) $_GET['note_id'];

    // Fetch the filename so we can remove it from disk
    $sel = $con->prepare("SELECT note FROM `note_list` WHERE note_id = ?");
    $sel->bind_param('i', $note_id);
    $sel->execute();
    $sel->bind_result($note_file);
    $sel->fetch();
    $sel->close();

    $stmt = $con->prepare("DELETE FROM `note_list` WHERE note_id = ?");
    $stmt->bind_param('i', $note_id);
    if ($stmt->execute()) {
        // Remove the PDF from disk
        if ($note_file) {
            $path = __DIR__ . '/note-pdf/' . basename($note_file);
            if (file_exists($path)) {
                unlink($path);
            }
        }
        echo '<script>alert("DELETED.")</script>';
        echo '<script>window.location="note-list.php"</script>';
    } else {
        error_log('delete-note DB error: ' . $con->error);
        echo '<script>alert("Delete failed. Please try again.")</script>';
        echo '<script>window.location="note-list.php"</script>';
    }
    $stmt->close();
}
?>
