<!-- manage-insert1.php -->
<?php
include_once '../security.php';
session_guard();
csrf_check();

include_once 'dbCon.php';
$con = connect();

if (isset($_POST['regasres'])) {
    // Cast all IDs to int — they're used in the filename and SQL
    $uni_id       = (int) $_POST['uni_name'];
    $college_id   = (int) $_POST['college_name'];
    $depart_id    = (int) $_POST['depart_name'];
    $subject_id   = (int) $_POST['subject_name'];
    $semester     = (int) $_POST['semester'];
    $notemaker_id = (int) $_POST['notemaker_name'];

    if (!$uni_id || !$college_id || !$depart_id || !$subject_id || !$semester || !$notemaker_id) {
        echo '<script>alert("Invalid form data. Please select all fields.")</script>';
        echo '<script>window.location="reg.php"</script>';
        exit;
    }

    $approved_status = (int) $_SESSION['role'];

    if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] === UPLOAD_ERR_OK) {
        $targetDirectory = 'note-pdf';
        $original_name   = basename($_FILES['pdf']['name']);
        $file_tmp        = $_FILES['pdf']['tmp_name'];
        $extension       = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));

        // Check real MIME type — extension and $_FILES['type'] are user-controlled
        $finfo    = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($file_tmp);

        if ($extension === 'pdf' && $mimeType === 'application/pdf') {
            // All path components are now validated integers — no traversal possible
            $file_name = 'NoteH-' . $depart_id . $uni_id . $subject_id . $notemaker_id . '-' . $original_name;

            if (!move_uploaded_file($file_tmp, "$targetDirectory/$file_name")) {
                echo '<script>alert("File could not be saved. Check server permissions.")</script>';
                echo '<script>window.location="reg.php"</script>';
                exit;
            }

            $stmt = $con->prepare("INSERT INTO `note_list`(`uni_id`,`college_id`,`depart_id`,`semester`,`subject_id`,`notemaker_id`,`approved_status`,`note`) VALUES (?,?,?,?,?,?,?,?)");
            $stmt->bind_param('iiiiiis', $uni_id, $college_id, $depart_id, $semester, $subject_id, $notemaker_id, $approved_status, $file_name);
            if ($stmt->execute()) {
                echo '<script>alert("Note added successfully")</script>';
                echo '<script>window.location="index.php"</script>';
            } else {
                error_log('Note insert DB error: ' . $con->error);
                echo '<script>alert("Database error. Please try again.")</script>';
                echo '<script>window.location="reg.php"</script>';
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
