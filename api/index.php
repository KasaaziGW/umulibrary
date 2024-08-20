<?php
session_start();
if (isset($_GET['data'])) {
  // Decode the base64 encoded user data
  $encodedUserData = $_GET['data'];
  $decodedUserData = json_decode(base64_decode($encodedUserData), true);
  $userDetails = $decodedUserData;
  $_SESSION['user'] = $userDetails;
}
include('./sessions.php');
// Suppress errors
// error_reporting(0);
$messages = array();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Dashboard</title>
  <!-- Bootstrap core CSS-->
  <!-- <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
  <!-- Custom fonts for this template-->
  <!-- <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"> -->
  <!-- Page level plugin CSS-->
  <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> -->

  <!-- <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->

  <!-- Custom styles for this template-->
  <!-- <link href="css/sb-admin.css" rel="stylesheet"> -->
  <link href="./css/styles.css" rel="stylesheet">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link rel="icon" href="../images/logo.png">

</head>

<body class="fixed-nav sticky-footer" id="page-top">
  <!-- Navigation-->
  <?php
  include('./nav.php');
  include('./loadCourses.php');
  ?>
  <!-- Navigation-->
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <nav style="--bs-breadcrumb-divider: '|';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="./addCourse.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">My Dashboard</li>
        </ol>
      </nav>
      <!-- Icon Cards-->

      <div class="row">

        <?php
        if ($role == 'user') {
          include('./dbconfig.php');
          $sql = "SELECT * FROM users_course WHERE uid = '$id'";
          $result = mysqli_query($conn, $sql);
          $user = mysqli_fetch_assoc($result);
          $cid = $user['cid'];
        }
        if (!empty($cid)) {
          // retrieving the user's selected course
          $cq = "SELECT c.name AS c_name, c.code AS c_code FROM courses c JOIN users_course uc ON c.id = uc.cid";
          $cd_results = mysqli_query($conn, $cq);
          $course = mysqli_fetch_assoc($cd_results);
          // determining the total number of course units for the user's course
          $cuq = "SELECT COUNT(*) AS total FROM course_units cu JOIN course_course_units ccu ON cu.id = ccu.course_unit JOIN courses c ON ccu.course = c.id WHERE c.id = '$cid'";
          $cuq_result = mysqli_query($conn, $cuq);
          $course_units = mysqli_fetch_assoc($cuq_result);
          // retrieving course_unit names and their total number of past papers in the system
          $ccuq = "SELECT cu.id AS cu_id, cu.name AS course_unit_name, COUNT(e.id) AS total_exams FROM course_units cu JOIN course_course_units ccu ON cu.id = ccu.course_unit JOIN exam_course_units ecu ON cu.id = ecu.course_unit_id JOIN exams e ON ecu.exam_id = e.id WHERE ccu.course = '$cid' GROUP BY cu.name ORDER BY cu.name";
          $ccuq_results = mysqli_query($conn, $ccuq);
        }
        ?>
        <?php if (empty($user['uid']) && $role == 'user'): ?>
          <div class="container">
            <?php include('success.php'); ?>
            <div class="col-md-8">
              <form method="post" action="addCourse.php">
                <div class="row gy-2 overflow-hidden">
                  <div class="input-group ms-2 mb-3">
                    <select class="form-control" id="courseSelect" name="course" style="width: 100%;" required>
                      <option value="">Select a course</option>
                      <?php foreach ($courses as $course): ?>
                        <option value="<?= $course['id'] . '-index-' . $id ?>"><?= $course['name'] . ' - ' . $course['code'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="col-12">
                    <div class="d-grid my-3">
                      <button class="btn btn-primary btn-lg" type="submit" name="saveCourse">Save Course</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        <?php endif ?>
        <?php if (!empty($cid)): ?>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-users" aria-hidden="true"></i>
                </div>
                <div class="mr-5 text-center">
                  <h5 class="mb-0 mt-1"><strong><?= $course_units["total"] ?></strong></h5>
                  <small class="font-light">Total Course Units</small><br>
                  <small class="font-light">For <?= $course["c_code"] ?></small>
                </div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="./viewpapers.php">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fa fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>

          <!-- displaying staff and their verified items -->
          <?php
          if ($ccuq_results->num_rows > 0) {
            // Loop through the results and display them
            while ($row = $ccuq_results->fetch_assoc()) {

              echo '<div class="col-xl-3 col-sm-6 mb-3">';
              echo '<div class="card text-white bg-success o-hidden h-100">';
              echo '<div class="card-body">
                    <div class="mr-5 text-center text-black">
                      <h5 class="mb-0 mt-1"><strong>' . htmlspecialchars($row['total_exams']) . '</strong></h5>';
              echo '<small class="font-light"><strong>' . htmlspecialchars($row['course_unit_name']) . '</strong></small>
                    </div>
              </div>';
              echo '<a class="card-footer text-white clearfix small z-1" href="./viewpapers.php?cu=' . htmlspecialchars($row['cu_id']) . '-' . urlencode(base64_encode(json_encode(htmlspecialchars($row['course_unit_name'])))) . '-' . htmlspecialchars($row['total_exams']) . '">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
                      <i class="fa fa-angle-right"></i>
                    </span></a>';
              echo '</div>';
              echo '</div>';
            }
          } else {
            echo "<p class='fs-4 fst-italic text-success'>The course has no past papers yet! Once they're added, they'll be shown here.</p>";
          }
          ?>
        <?php endif ?>
      </div>
    </div>
  </div>
  <!-- /.container-fluid-->
  <!-- /.content-wrapper-->
  <?php include('footer.php'); ?>
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-angle-up"></i>
  </a>
  <!-- Logout  -->
  <?php include('logout.php'); ?>
  <!-- Logout -->
  <?php include('./passwordModal.php'); ?>
  <!-- Bootstrap core JavaScript-->
  <!-- Core plugin JavaScript-->
  <!-- <script src="vendor/jquery-easing/jquery.easing.min.js"></script> -->
  <!-- <script src="vendor/jquery/jquery.min.js"></script> -->
  <!-- <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->

  <!-- Page level plugin JavaScript-->
  <!-- <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script> -->
  <!-- Custom scripts for all pages-->
  <!-- <script src="js/sb-admin.min.js"></script> -->
  <!-- Custom scripts for this page-->
  <!-- <script src="js/sb-admin-datatables.min.js"></script>
  <script src="js/customjs.js"></script> -->

  <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
  <!-- Include Select2 JS -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Page level plugin JavaScript-->
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>
  <!-- Custom scripts for this page-->
  <script src="js/sb-admin-datatables.min.js"></script>
  <!-- <script src="js/sb-admin-charts.min.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    $(document).ready(function() {
      // Initialize the Select2 plugin
      $('#courseSelect').select2({
        placeholder: "Select a course"
      });
      // Cancel Button Click Event
      document.getElementById('cancelButton').addEventListener('click', function() {
        const confirmCancel = confirm('Are you sure you want to cancel without setting your password?');
        if (confirmCancel) {
          $('#setPasswordModal').modal('hide'); // Close the modal after confirmation
        }
      });
      // Close Button Click Event
      document.getElementById('close').addEventListener('click', function() {
        const confirmCancel = confirm('Are you sure you want to cancel without setting your password?');
        if (confirmCancel) {
          $('#setPasswordModal').modal('hide'); // Close the modal after confirmation
        }
      });
    });
  </script>
</body>

</html>