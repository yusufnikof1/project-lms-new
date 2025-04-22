<?php
session_start();
require '../koneksi.php';

//middleware
if (empty($_SESSION['EMAIL'])) {
    header("location:../login.php");
}

if (isset($_POST['simpan'])) {
    $nama_skill = $_POST['nama_skill'];
    $persentase = $_POST['persentase'];

    $insert = mysqli_query($con, "INSERT INTO skill (nama_skill, persentase) VALUES ('$nama_skill', '$persentase')");
    if ($insert) {
        header("location: skill.php");
    } else {
        header("location: add_edit_skill.php");
    }
}

if (isset($_GET['idEdit'])) {
    $id = $_GET['idEdit'];
    $selectSkill = mysqli_query($con, "SELECT * FROM skill WHERE id = $id");
    $row = mysqli_fetch_assoc($selectSkill);
    // var_dump($row); 
}

if (isset($_POST['edit'])) {
    $id = $_GET['idEdit'];
    $nama_skill = $_POST['nama_skill'];
    $persentase = $_POST['persentase'];

    $q_Update = mysqli_query($con, "UPDATE skill SET nama_skill='$nama_skill', persentase='$persentase' WHERE id = $id");

    if ($q_Update) {
        header("location: skill.php");
    } else {
        echo "EDIT GAGAL";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Components / Accordion - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <?php include '../inc/navbar.php' ?>

    <!-- ======= Sidebar ======= -->
    <?php include '../inc/sidebar.php' ?>
    <!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Blank Page</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Pages</li>
                    <li class="breadcrumb-item active">Blank</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo isset($_GET['idEdit']) ? 'EDIT' : 'ADD SKILL'; ?></h5>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <label for="">Nama Skill</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nama_skill" placeholder="Masukkan Skill Anda" value="" required>
                                    </div>
                                </div> <!-- Nama Skill -->
                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <label for="">Persentase</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="persentase" placeholder="Masukkan Persentase Skill Anda" value="" required>
                                    </div>
                                </div> <!-- Persentase -->
                                <div class="row mb-3">
                                    <div class="col-md-2 offset-md-2">
                                        <?php if (isset($_GET['idEdit'])) {
                                        ?>
                                            <button type="submit" class="btn btn-primary" name="edit">Edit</button>
                                        <?php
                                        } else {
                                        ?>
                                            <button name="simpan" class="btn btn-primary" type="submit">Simpan</button>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div> <!-- Button Simpan -->
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>