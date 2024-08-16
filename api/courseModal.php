<!-- <div class="modal fade" id="setCourseModal" tabindex="-1" role="dialog" aria-labelledby="courseModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-center" id="courseModalLabel">Select Course</h3>
                <button type="button" class="close" id="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="POST">
                <?php
                include("./dbconfig.php");
                // Fetch courses from the database
                $sql = "SELECT uid, fullname FROM users";
                $result = $conn->query($sql);

                $courses = [];
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $courses[] = $row;
                    }
                }

                $conn->close();
                ?>
                <div class="modal-body">
                    <form id="courseForm">
                        <div class="form-group">
                            <label for="courseSelect">Courses</label>
                            <select class="form-control" id="courseSelect" style="width: 100%;">
                                <option value="">Select a course</option>
                                <?php foreach ($courses as $course): ?>
                                    <option value="<?= $course['uid']; ?>"><?= $course['fullname']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </form>

                    <hr style="color: red; border: thick double red;">
                    <div class="col-12">
                        <div class="d-grid my-3">
                            <button type="submit" class="btn btn-danger" name="savePassword">Save Password</button>
                        </div>
                        <div class="d-grid my-3">
                            <button type="button" class="btn btn-secondary" id="cancelButton" data-dismiss="modal" aria-label="Close">Cancel</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div> -->
<div class="modal fade" id="courseModal" tabindex="-1" role="dialog" aria-labelledby="courseModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="courseModalLabel">Select a Course</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="courseForm">
                    <div class="form-group">
                        <label for="courseSelect">Courses</label>
                        <select class="form-control" id="courseSelect" style="width: 100%;">
                            <option value="">Select a course</option>
                            <option>BSIT</option>
                            <option>BSCS</option>
                            <option>BAM</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveCourse">Save</button>
            </div>
        </div>
    </div>
</div>