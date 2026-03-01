<!-- manage-insert1.php -->
<?php
include_once '../security.php';
session_guard();
csrf_check();

include_once 'dbCon.php';
$con = connect();

if (isset($_POST['regasres'])) {
    $uni_id          = $_POST['uni_name'];
    $college_id      = $_POST['college_name'];
    $depart_id       = $_POST['depart_name'];
    $subject_id      = $_POST['subject_name'];
    $semester        = $_POST['semester'];
    $notemaker_id    = $_POST['notemaker_name'];
    $approved_status = (int) $_SESSION['role'];

    if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] === UPLOAD_ERR_OK) {
        $targetDirectory = 'note-pdf';
        $original_name   = basename($_FILES['pdf']['name']);
        $file_name       = 'NoteH-' . $depart_id . $uni_id . $subject_id . $notemaker_id . $original_name;
        $file_tmp        = $_FILES['pdf']['tmp_name'];
        $extension       = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if ($extension === 'pdf') {
            move_uploaded_file($file_tmp, "$targetDirectory/$file_name");

            $stmt = $con->prepare("INSERT INTO `note_list`(`uni_id`,`college_id`,`depart_id`,`semester`,`subject_id`,`notemaker_id`,`approved_status`,`note`) VALUES (?,?,?,?,?,?,?,?)");
            $stmt->bind_param('ssssssis', $uni_id, $college_id, $depart_id, $semester, $subject_id, $notemaker_id, $approved_status, $file_name);
            if ($stmt->execute()) {
                echo '<script>alert("Note added successfully")</script>';
                echo '<script>window.location="index.php"</script>';
            } else {
                echo "Error: " . $con->error;
            }
            $stmt->close();
        } else {
            echo '<script>alert("Only PDF files are allowed.")</script>';
            echo '<script>window.location="reg.php"</script>';
        }
    } else {
        echo '<script>alert("No file uploaded or upload error.")</script>';
        echo '<script>window.location="reg.php"</script>';
    }
}
?>
