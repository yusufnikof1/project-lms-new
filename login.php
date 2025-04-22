<?php
session_start();
require 'koneksi.php';

//

//Jika button login di click
if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  // Cari atau pilih di dalam tabel user, dimana nilai email adalah diambil dari inputan dan nilai password diambil dari inputan
  $queryLogin = mysqli_query($con, "SELECT * FROM users WHERE email = '$email' AND password = '$password'");
  $row = mysqli_fetch_assoc($queryLogin);

  //Jika datanya ada maka buat session dan redirect ke dashboard (True)
  if (mysqli_num_rows($queryLogin) > 0) {
    $_SESSION['EMAIL'] = $email;
    $_SESSION['NAME'] = $row['name'];
    $roles = $row['roles'];
    //Redirect berdasarkan level
    switch ($row['roles']) {
      case 'Administrator':
        header("Location: administrator/administrator_dashboard.php");
        break;
      case 'Admin':
        header("Location: admin-general/admin_dashboard.php");
        break;
      case 'PIC':
        header("Location: pic/pic_dashboard.php");
        break;
      case 'Instructor':
        header("Location: instructor/instructor_dashboard.php");
        break;
      case 'Student':
        header("Location: student/student_dashboard.php");
        break;
    }
    // header('location: admin/index.php');
  } else {
    //Kalo gagal, login ke redirect ke halaman login awal (False)
    header('location: login.php?error=login');
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login LMS</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/adm-assets/img/logo-ppkdjp_32x32.jpg" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/adm-assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/adm-assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/adm-assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/adm-assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/adm-assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/adm-assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/adm-assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/adm-assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.php" class="logo d-flex align-items-center w-auto">
                  <img src="assets/adm-assets/img/logo-ppkdjp_32x32.jpg" alt="">
                  <span class="d-none d-lg-block">LMS PPKDJP</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your email</p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate action="" method="post">

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Email *</label>
                      <div class="input-group has-validation">
                        <input type="text" name="email" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your email.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password *</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name="login">Login</button>
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                Developed by <a href="">Yusuf Niko Fitranto</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/adm-assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/adm-assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/adm-assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/adm-assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/adm-assets/vendor/quill/quill.js"></script>
  <script src="assets/adm-assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/adm-assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/adm-assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/adm-assets/js/main.js"></script>

</body>

</html>