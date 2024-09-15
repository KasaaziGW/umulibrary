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
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link href="./css/styles.css" rel="stylesheet">
  <style>
    #datepicker:hover {
      cursor: pointer;
    }
  </style>
  <script>
    // Function to set today's date as default value and max date
    function setDate() {
      var now = new Date();
      var day = String(now.getDate()).padStart(2, '0');
      var month = String(now.getMonth() + 1).padStart(2, '0'); // Months are zero-based
      var year = now.getFullYear();

      // Format date as dd-mm-yyyy
      var dateString = `${month}/${day}/${year}`;

      var input = document.getElementById('datepicker');
      input.value = dateString;
      input.max = dateString; // Set max date to today
    }

    // Call the function on page load
    window.onload = setDate;
  </script>
</head>

<body class="fixed-nav sticky-footer" id="page-top">
  <!-- Navigation-->
  <?php
  include('./nav.php');
  include('./loadCourses.php');
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
          <form method="post" action="addpapers.php" enctype="multipart/form-data">
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
                <div class="input-group ms-2 mb-3">
                  <select class="form-control" id="unitSelect" name="course_unit" style="width: 100%;" required>
                    <option value="">Select a course unit</option>
                  </select>
                </div>
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
                  <label class="input-group-text" for="role">Semester</label>
                  <select class="form-select" id="semester" name="semester" required>
                    <option value="">Select semester</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                  </select>
                </span>
              </div>

              <div class="row g-2">
                <span class="input-group ms-2 mb-3 col-sm">
                  <label class="input-group-text" for="role">Campus</label>
                  <select class="form-select" id="campus" name="campus" required>
                    <option value="">Select campus</option>
                    <option value="Masaka">Masaka</option>
                    <option value="Nkozi">Nkozi</option>
                    <option value="Lubaga">Lubaga</option>
                  </select>
                </span>
                <span class="input-group ms-2 mb-3 col-sm">
                  <label class="input-group-text" for="datepicker">Exam Date</label>
                  <input type="datetime" id="datepicker" name="exam_date" placeholder="mm/dd/yyyy" date_format="mm/dd/yyyy" required>
                </span>
              </div>

              <div class="row g-2">
                <span class="input-group ms-2 mb-3 col-sm">
                  <label class="input-group-text" for="formFileLg">Select exam</label>
                  <input class="form-control form-control-lg" id="formFileLg" name="exam" type="file" required />
              </div>
            </div>
            <div class="col-12">
              <div class="d-grid my-3">
                <button class="btn btn-primary btn-lg" type="submit" name="saveDetails">Upload Exam</button>
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
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <!-- Include Select2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
  </script>
  <script>
    // Initialize the Select2 plugin
    $(document).ready(function() {
      $('#courseSelect').select2({
        placeholder: "Select a course"
      });
      $('#unitSelect').select2({
        placeholder: "Select a course unit"
      });
      // loading courses belonging to a selected course unit
      $('#courseSelect').change(function() {
        var courseId = $(this).val();

        // Send AJAX request to fetch course units
        $.ajax({
          url: 'get_course_units.php',
          type: 'POST',
          data: {
            course_id: courseId
          },
          success: function(data) {
            $('#unitSelect').html(data);
          }
        });
      });
      $(function() {
        $("#datepicker").datepicker({
          autoclose: true,
          todayHighlight: true,
          endDate: "today",
          maxDate: "today"
        }).datepicker('update', new Date());

      });
    });
  </script>
</body>

</html>