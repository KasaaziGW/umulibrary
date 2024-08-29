<?php
include('sessions.php');
include('pserver.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Add Past Papers</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="icon" href="../images/logo.png">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
  <link href="./css/styles.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer" id="page-top">
  <!-- Navigation-->
  <?php
  include('./nav.php');
  // include('./loadCourses.php');
  ?>
  <!-- Navigation -->
  <div class="content-wrapper">
    <div class="container-fluid">
      <nav style="--bs-breadcrumb-divider: '|';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Add Past Papers Page</li>
        </ol>
      </nav>
      <div class="d-flex">
        <div class="col-md-8">
          <form method="post" action="register.php" enctype="multipart/form-data">
            <div class="row gy-2 overflow-hidden">
              <div class="row g-2">
                <div class="form-floating ms-2 mb-3 col-sm">
                  <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Fullname goes here" value='<?php if (isset($_POST["fullname"])) {
                                                                                                                                  echo $_POST["fullname"];
                                                                                                                                } ?>'>
                  <label for="fullname" class="form-label">Fullname</label>
                </div>
              </div>

              <div class="row g-2">
                <span class="form-floating ms-2 mb-3 col-sm">
                  <input type="text" class="form-control" name="username" id="username" placeholder="Username goes here" value='<?php if (isset($_POST["username"])) {
                                                                                                                                  echo $_POST["username"];
                                                                                                                                } ?>'>
                  <label for="username" class="form-label">Username</label>
                </span>
                <span class="input-group ms-2 mb-3 col-sm">
                  <label class="input-group-text" for="role">Role</label>
                  <select class="form-select" id="role" name="role" required>
                    <option value="">Select role</option>
                    <option value="admin">Administrator</option>
                    <option value="librarian">Librarian</option>
                  </select>
                </span>
              </div>

              <div class="row g-2">
                <span class="form-floating ms-2 mb-3 col-sm">
                  <input type="password" class="form-control" name="password" id="password" placeholder="Password goes here" value='<?php if (isset($_POST["password"])) {
                                                                                                                                      echo $_POST["password"];
                                                                                                                                    } ?>'>
                  <label for="password" class="form-label">Password</label>
                </span>
                <span class="form-floating ms-2 mb-3 col-sm">
                  <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="Password goes here" value='<?php if (isset($_POST["confirmpassword"])) {
                                                                                                                                                    echo $_POST["confirmpassword"];
                                                                                                                                                  } ?>'>
                  <label for="confirmpassword" class="form-label">Confirm Password</label>
                </span>
              </div>

              <div class="col-12">
                <div class="input-group mb-3">
                  <label class="input-group-text" for="photo">Photo</label>
                  <div class="imageholder">
                    <img class="imageholder" src="./pics/default.jpg" id="imageholder" width="150px" height="150px">
                  </div> &nbsp; &nbsp;
                  <div class="mb-3">
                    <input class="form-control form-control-lg" type="file" name="imgload" id="imgload" onchange="ImagePreview()">
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="d-grid my-3">
                  <button class="btn btn-primary btn-lg" type="submit" name="saveDetails">Create Account</button>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="p-2">
          <?php include('errors.php'); ?>
          <?php include('success.php'); ?>
        </div>
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
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Include Popper.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
  <!-- Core plugin JavaScript-->

  <!-- Custom scripts for all pages-->
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="js/sb-admin.min.js"></script>
  <!-- Include Select2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    // Initialize the Select2 plugin
    $(document).ready(function() {
      $('#courseSelect').select2({
        placeholder: "Select a course"
      });
    });
  </script>
</body>

</html>