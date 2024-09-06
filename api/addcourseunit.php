<?php
include('sessions.php');
include('cserver.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Add Course Unit</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="icon" href="../images/logo.png">
  <script src="./js/customjs.js"></script>
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link href="./css/styles.css" rel="stylesheet">
  <style>
  </style>
</head>

<body class="fixed-nav sticky-footer" id="page-top">
  <!-- Navigation-->
  <?php include('./nav.php'); ?>
  <?php include('./loadCourses.php'); ?>
  <!-- Navigation -->
  <div class="content-wrapper">
    <div class="container-fluid">
      <nav style="--bs-breadcrumb-divider: '|';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Add Course Unit Page</li>
        </ol>
      </nav>
      <div class="d-flex">
        <div class="col-md-8">
          <form method="post" action="addcourseunit.php">
            <div class="row gy-2 overflow-hidden">
              <div class="row g-2">
                <div class="input-group ms-2 mb-3">
                  <select class="form-control" id="courseSelect" name="course" style="width: 100%;" required>
                    <option value="">Select a course</option>
                    <?php foreach ($courses as $course): ?>
                      <option value="<?= $course['id'] ?>"><?= $course['name'] . ' - ' . $course['code'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="row g-2">
                <div class="form-floating ms-2 mb-3 col-sm">
                  <input type="text" class="form-control" name="name" id="name" placeholder="Course Unit name" value='<?php if (isset($_POST["name"])) $_POST["name"]; ?>' required autocomplete="off" autocapitalize="on">
                  <label for="name" class="form-label">Course Unit Name</label>
                </div>
              </div>

              <div class="row g-2">
                <span class="form-floating ms-2 mb-3 col-sm">
                  <input type="text" class="form-control" name="code" id="code" placeholder="Course Unit Code" value='<?php if (isset($_POST["code"])) $_POST["code"]; ?>' required>
                  <label for="code" class="form-label">Course Unit Code</label>
                </span>
                <span class="form-floating ms-2 mb-3 col-sm">
                  <input type="text" class="form-control" name="credit_unit" id="credit_unit" placeholder="Credit Unit" value='<?php if (isset($_POST["credit_unit"])) $_POST["credit_unit"]; ?>' required>
                  <label for="credit_unit" class="form-label">Credit Unit</label>
                </span>
              </div>

              <div class="row g-2">
                <span class="input-group ms-2 mb-3 col-sm">
                  <label class="input-group-text" for="role">Year</label>
                  <select class="form-select" id="year" name="year" required>
                    <option value="">Select year</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                    <option value="4">Four</option>
                  </select>
                </span>
                <span class="input-group ms-2 mb-3 col-sm">
                  <label class="input-group-text" for="semester">Semester</label>
                  <select class="form-select" id="semester" name="semester" required>
                    <option value="">Select semester</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                  </select>
                </span>
              </div>

              <div class="col-12">
                <div class="d-grid my-3">
                  <button class="btn btn-primary btn-lg" type="submit" name="saveCourseUnits">Save Details</button>
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
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <!-- Include Select2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
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