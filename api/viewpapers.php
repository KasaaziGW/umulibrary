<?php
include('sessions.php');
// include('pserver.php');

// function to return the current time 
function getTime()
{
  // Set the default time zone to Kampala, Uganda
  date_default_timezone_set('Africa/Kampala');
  // return date('H:i:s'); // H for hour, i for minutes, s for seconds
  // Return the current time in h:i:s A format (12-hour format with AM/PM)
  return date('h:i:s A');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>View Past Papers</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="./css/styles.css" rel="stylesheet">

  <link rel="icon" href="../images/logo.png">

  <!-- New code -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.1.1/css/buttons.dataTables.css">
  <!-- New code ends here -->
</head>

<body class="fixed-nav sticky-footer" id="page-top">
  <!-- Navigation-->
  <?php include('./nav.php'); ?>
  <!-- Navigation -->
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <nav style="--bs-breadcrumb-divider: '|';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">View Past Papers Page</li>
        </ol>
      </nav>
      <!-- Users DataTables Card-->
      <div class="card mb-3">
        <?php
        if (isset($_GET['cu'])) {
          $cuDetails = $_GET['cu'];
          $cuInfo = explode("-", $cuDetails);
          $cu_id = $cuInfo[0];
        }
        ?>
        <div class="card-header">
          <div class="row g-2">
            <div class="input-group ms-2 mb-3 col-sm">
              <label class="input-group-text" for="course_unitFilter"><strong>Select Desired Course Unit</strong></label>
              <select id="course_unitFilter" class="form-select" name="course_unit">
                <?php if (isset($_GET['cu'])) : ?>
                  <option value="<?= $cu_id ?>"><?= json_decode(base64_decode($cuInfo[1]), true) . ' - ' . $cuInfo[2] ?></option>
                  <hr style="background-color: red; height: 1px; border: 0" />
                <?php endif ?>
                <?php
                include("./dbconfig.php");
                // retrieving the user's course id
                $sql = "SELECT * FROM users_course WHERE uid = '$id'";
                $result = mysqli_query($conn, $sql);
                $user = mysqli_fetch_assoc($result);
                $cid = $user['cid'];
                // retrieving course_unit names and their total number of past papers in the system
                $ccuq = "SELECT cu.id AS cu_id, cu.name AS course_unit_name, COUNT(e.id) AS total_exams FROM course_units cu JOIN course_course_units ccu ON cu.id = ccu.course_unit JOIN exam_course_units ecu ON cu.id = ecu.course_unit_id JOIN exams e ON ecu.exam_id = e.id WHERE ccu.course = '$cid' GROUP BY cu.name ORDER BY cu.name";
                $ccuq_results = mysqli_query($conn, $ccuq);

                if ($ccuq_results->num_rows > 0) {
                  while ($row = $ccuq_results->fetch_assoc()) {
                    echo '<option value="' . htmlspecialchars($row['cu_id']) . '">' . htmlspecialchars($row['course_unit_name']) . ' - ' . htmlspecialchars($row['total_exams']) . '</option>';
                  }
                }

                // Close the connection
                $conn->close();
                ?>
              </select>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="papersTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <td>Course Unit</td>
                  <td>Caption</td>
                  <td>Exam Date</td>
                  <td>Size</td>
                  <td>Download</td>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Last checked today at <?= getTime() ?></div>
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
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>

    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.flash.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.print.js"></script>
    <script>
      $(document).ready(function() {
        var pastpapers = $("#papersTable").DataTable({
          serverSide: true,
          paging: true,
          pageLength: 50,
          lengthMenu: [
            [50, 100, 200, 300, 500, 1000],
            [50, 100, 200, 300, 500, 1000],
          ],
          ajax: {
            url: "fetchPapers.php",
            dataType: "json",
            type: "POST",
            data: function(d) {
              d.courseUnit = $("#course_unitFilter").val(); // Send the selected course unit to the server
            },
          },
          processing: true,
          columns: [{
              data: "name"
            },
            {
              data: "caption"
            },
            {
              data: "exam_date"
            },
            {
              data: "size"
            },
            {
              data: "download"
            },
          ],
          dom: '<"top "lip>rt<"bottom"ip><"clear">',
        });
        // Event listener for the staff filter dropdown
        $("#course_unitFilter").change(function() {
          pastpapers.ajax.reload(); // Reload the table data when the dropdown selection changes
        });
      });
    </script>
</body>

</html>