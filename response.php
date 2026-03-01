<?php
include_once 'dbCon.php';
$con = connect();

if (!empty($_POST['semester'])) {
    $semester = $_POST['semester'];

    $stmt = $con->prepare("SELECT * FROM subject_names WHERE semester = ?");
    $stmt->bind_param('s', $semester);
    $stmt->execute();
    $result = $stmt->get_result();
    foreach ($result as $r) {
        ?>
        <option value="">----Subject----</option>
        <option value="<?php echo htmlspecialchars($r['subject_id']); ?>"><?php echo htmlspecialchars($r['subject_name']); ?></option>
        <?php
    }
    $stmt->close();
}
?>
