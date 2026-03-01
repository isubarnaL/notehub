<?php
include_once 'dbCon.php';
$con = connect();

if (!empty($_POST['depart_id'])) {
    $depart_id = $_POST['depart_id'];

    $stmt = $con->prepare("SELECT * FROM `subject_names` WHERE depart_id = ? ORDER BY semester ASC");
    $stmt->bind_param('s', $depart_id);
    $stmt->execute();
    $result = $stmt->get_result();
    foreach ($result as $r) {
        echo '<option value="' . htmlspecialchars($r['subject_id']) . '">' . htmlspecialchars($r['subject_name']) . '</option>';
    }
    $stmt->close();
}
