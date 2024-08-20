<?php
include('sessions.php');
include('userver.php');
include('functions.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>View Users</title>
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
          <li class="breadcrumb-item active">View Users Page</li>
        </ol>
      </nav>
      <!-- Users DataTables Card-->
      <div class="card mb-3">
        <?php include('success.php'); ?>
        <div class="card-header">
          <i class="fa fa-table"></i> All Users
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Fullname</th>
                  <th>Username</th>
                  <th>Branch</th>
                  <th>Photo</th>
                  <th>Login Status</th>
                  <th>Account Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Fullname</th>
                  <th>Username</th>
                  <th>Branch</th>
                  <th>Photo</th>
                  <th>Login Status</th>
                  <th>Account Status</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                <?php
                include("dbconfig.php");
                $user_check_query = "SELECT * FROM staff";
                if ($result = mysqli_query($conn, $user_check_query)) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    $status = $row['status'] == 1 ? "Online" : "Offline";
                    $id = $row['uid'];
                    $action = $row['accstatus'] == 1 ? "Deactivate" : "Activate";
                    $accstat = $row['accstatus'] == 1 ? "Active" : "Inactive";
                    if ($row['role'] == 'admin') {
                      echo '<tr> 
                            <td>' . $row['fullname'] . '</td> 
                            <td>' . $row['username'] . '</td>
                            <td>' . $row['branch'] . '</td>';
                      if (file_exists("./pics/" . $row['photo'])) {
                        if (empty($row['photo'])) {
                          echo '<td><img src="./pics/default.png" style="width:80px; height:80px;"></td>';
                        } else {
                          echo '<td><img src="./pics/' . $row['photo'] . '" style="width:80px; height:80px; border-radius:45px;"></td>';
                        }
                      }
                      echo '<td>' . $status . '</td>
                            <td>' . $accstat . ' </td>
                            <td><a href="updateaccount.php?eid=' . $id . '"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update</a> </td> 
                          </tr>';
                    } else {
                      echo '<tr> 
                            <td>' . $row['fullname'] . '</td> 
                            <td>' . $row['username'] . '</td>
                            <td>' . $row['branch'] . '</td>';
                      if ($row['photo'] == 'null') {
                        echo '<td><img src="./pics/default.png" style="width:80px; height:80px;"></td>';
                      } else {
                        echo '<td><img src="./pics/' . $row['photo'] . '" style="width:80px; height:80px; border-radius:45px;"></td>';
                      }
                      echo ' <td>' . $status . '</td>
                            <td>' . $accstat . ' </td>
                            <td><a href="updateaccount.php?eid=' . $id . '"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update</a> | <a href="viewusers.php?did=' . $action . ' ' . $id . '"><i class="fa fa-ban" aria-hidden="true"></i> ' . $action . '</a> </td> 
                          </tr>';
                    }
                  }
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
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
  </div>
</body>

</html>