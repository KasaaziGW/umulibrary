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
error_reporting(0);
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
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="./css/styles.css" rel="stylesheet">
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
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">My Dashboard</li>
        </ol>
      </nav>
      <!-- Icon Cards-->

      <div class="row">

        <?php
        include('./dbconfig.php');
        $sql = "SELECT * FROM users_course WHERE uid = '$id'";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($result);
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
  <script src="js/customjs.js"></script>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <!-- Include Select2 JS -->
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