<?php
// Must come before header.php so session starts with hardened cookie params.
include 'security.php';
session_guard();   // any logged-in user may upload
include 'template/header.php';
?>
    <body id="page-top">
        <?php include 'template/nav-bar-h.php'; ?>

        <section class="projects-section bg-black" style="padding-top: 100px; padding-bottom: 60px;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">

                        <h2 class="text-white text-center mb-2">Upload Your Notes</h2>
                        <p class="text-white-50 text-center mb-4">
                            Submitted notes are reviewed by admins before going live.
                            Only PDF files are accepted.
                        </p>

                        <?php
                        include 'dbCon.php';
                        $con = connect();
                        $unis      = $con->query("SELECT uni_id, uni_name FROM `uni_tables`")->fetch_all(MYSQLI_ASSOC);
                        $colleges  = $con->query("SELECT college_id, college_name FROM `college_names`")->fetch_all(MYSQLI_ASSOC);
                        $departs   = $con->query("SELECT depart_id, depart_name FROM `depart_tables` ORDER BY id ASC")->fetch_all(MYSQLI_ASSOC);
                        $semesters = $con->query("SELECT semester, sem_name FROM `semester`")->fetch_all(MYSQLI_ASSOC);
                        $subjects  = $con->query("SELECT subject_id, subject_name FROM `subject_names`")->fetch_all(MYSQLI_ASSOC);
                        $notemakers= $con->query("SELECT notemaker_id, notemaker_name FROM `notemaker_tables`")->fetch_all(MYSQLI_ASSOC);
                        ?>

                        <form action="dashboard/manage-insert1.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                            <div class="form-group">
                                <label class="text-white">University</label>
                                <select class="form-control" name="uni_name" required>
                                    <option value="">— Select University —</option>
                                    <?php foreach ($unis as $r): ?>
                                        <option value="<?php echo $r['uni_id']; ?>"><?php echo htmlspecialchars($r['uni_name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="text-white">College</label>
                                <select class="form-control" name="college_name">
                                    <option value="">— Select College —</option>
                                    <?php foreach ($colleges as $r): ?>
                                        <option value="<?php echo $r['college_id']; ?>"><?php echo htmlspecialchars($r['college_name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="text-white">Department</label>
                                <select class="form-control" name="depart_name" required>
                                    <option value="">— Select Department —</option>
                                    <?php foreach ($departs as $r): ?>
                                        <option value="<?php echo $r['depart_id']; ?>"><?php echo htmlspecialchars($r['depart_name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="text-white">Semester</label>
                                <select class="form-control" name="semester" required>
                                    <option value="">— Select Semester —</option>
                                    <?php foreach ($semesters as $r): ?>
                                        <option value="<?php echo $r['semester']; ?>"><?php echo htmlspecialchars($r['sem_name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="text-white">Subject</label>
                                <select class="form-control" name="subject_name" required>
                                    <option value="">— Select Subject —</option>
                                    <?php foreach ($subjects as $r): ?>
                                        <option value="<?php echo $r['subject_id']; ?>"><?php echo htmlspecialchars($r['subject_name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="text-white">Note Maker</label>
                                <select class="form-control" name="notemaker_name" required>
                                    <option value="">— Select Notemaker —</option>
                                    <?php foreach ($notemakers as $r): ?>
                                        <option value="<?php echo $r['notemaker_id']; ?>"><?php echo htmlspecialchars($r['notemaker_name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="text-white">PDF File</label>
                                <input type="file" name="pdf" class="form-control" accept=".pdf" required>
                            </div>

                            <div class="form-group mt-3">
                                <button type="submit" name="regasres" class="btn btn-primary btn-block py-3">Submit Notes</button>
                            </div>
                        </form>

                        <p class="text-white-50 text-center mt-3 small">
                            *Don't see your university or subject? <a href="#contact" class="js-scroll-trigger text-white-50">Contact us</a>.
                        </p>

                    </div>
                </div>
            </div>
        </section>

        <?php include 'template/footer.php'; ?>
        <?php include 'template/script.php'; ?>
    </body>
</html>
