<?php
session_start();
require '../koneksi.php';

//middleware
if (empty($_SESSION['EMAIL'])) {
    header("location:../login.php");
}

$querySetting = mysqli_query($con, "SELECT * FROM setting WHERE id = 1");
$rowEdt = mysqli_fetch_assoc($querySetting);
//jika button simpan di klik
if (isset($_POST['simpan'])) {
    $nama_website = $_POST['nama_website'];
    $alamat_website = $_POST['alamat_website'];
    $email = $_POST['email'];
    $tlpn = $_POST['tlpn'];
    $alamat = $_POST['alamat'];
    $logo = $_FILES['logo'];

    //jika sudah mempunyai data, maka update selain itu insert
    //tampilkan / pilih data dari tabel setting dimana nama_website = 'nilai dari nama website'
    //tampilkan data terbaru dari tabel user

    if (mysqli_num_rows($querySetting) > 0) {
        //update
        $fillQupdate = '';
        if ($logo['error'] == 0) {
            $fileName = uniqid() . "_" . basename($logo['name']);
            $filePath = "../assets/uploads/" . $fileName;
            if (move_uploaded_file($logo['tmp_name'], $filePath)) {
                $rowLogo = $rowEdt['Logo'];
                if ($rowLogo && file_exists("../assets/uploads/" . $rowLogo)) {
                    unlink("../assets/uploads/" . $rowEdt['Logo']);
                }
            } else {
                echo "GAGAL UPLOAD";
            }
        }
        $fillQupdate = "logo='$fileName'";
        $update = mysqli_query($con, "UPDATE setting SET nama_website = '$nama_website', alamat_website='$alamat_website',email='$email',tlpn = '$tlpn', alamat='$alamat', $fillQupdate WHERE id = 1");
        header("location:setting.php?ubah=berhasil");
    } else {
        //insert
        if ($logo['error'] == 0) {
            $fileName = uniqid() . "_" . basename($logo['name']);
            $filePath = "../assets/uploads/" . $fileName;
            move_uploaded_file($logo['tmp_name'], $filePath);

            $insert = mysqli_query($con, "INSERT INTO setting(nama_website, alamat_website, email, tlpn, alamat, logo)VALUES('$nama_website', '$alamat_website','$email','$tlpn','$alamat','$fileName')");
            header("location:setting.php?tambah=berhasil");
        }
    }
}
if (isset($_GET['idDel'])) {
    $id = $_GET['idDel'];

    if ($rowEdt['logo']) {
        unlink("../assets/uploads/" . $rowEdt['logo']);
        $delete = mysqli_query($con, "DELETE FROM setting WHERE id = '$id'");
        $alterAI = mysqli_query($con, "ALTER TABLE setting AUTO_INCREMENT = 1");
        if ($delete && $alterAI) {
            header("location:setting.php?hapus=berhasil");
        }
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
                            <h5 class="card-title">Pengaturan Umum</h5>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <label for="">Nama Website</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nama_website" placeholder="Masukkan Nama Website" required value="<?php echo isset($_GET['tambah']) && $_GET['tambah'] == 'berhasil' || isset($_GET['sidebar']) && $_GET['sidebar'] == "setting" ? $rowEdt['nama_website'] : (isset($_GET['ubah']) && $_GET['ubah'] == "berhasil" ? $rowEdt['nama_website'] : ''); ?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <label for="">URL Website</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="alamat_website" placeholder="Masukkan Alamat Website" required value="<?php echo isset($_GET['tambah']) && $_GET['tambah'] == 'berhasil' || isset($_GET['sidebar']) && $_GET['sidebar'] == "setting" ? $rowEdt['alamat_website'] : (isset($_GET['ubah']) && $_GET['ubah'] == "berhasil" ? $rowEdt['alamat_website'] : ''); ?>" ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <label for="">Email</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" name="email" placeholder="ex:admin@site.com" required value="<?php echo isset($_GET['tambah']) && $_GET['tambah'] == 'berhasil' || isset($_GET['sidebar']) && $_GET['sidebar'] == "setting" ? $rowEdt['email'] : (isset($_GET['ubah']) && $_GET['ubah'] == "berhasil" ? $rowEdt['email'] : ''); ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <label for="">No Telepon</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="tlpn" placeholder="Masukkan Nomor Telepon" required value="<?php echo isset($_GET['tambah']) && $_GET['tambah'] == 'berhasil' || isset($_GET['sidebar']) && $_GET['sidebar'] == "setting" ? $rowEdt['tlpn'] : (isset($_GET['ubah']) && $_GET['ubah'] == "berhasil" ? $rowEdt['tlpn'] : ''); ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <label for="">Alamat</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <textarea name="alamat" id="" class="form-control"><?php echo isset($_GET['tambah']) && $_GET['tambah'] == 'berhasil' || isset($_GET['sidebar']) && $_GET['sidebar'] == "setting" ? $rowEdt['alamat'] : (isset($_GET['ubah']) && $_GET['ubah'] == "berhasil" ? $rowEdt['alamat'] : ''); ?></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <label for="">Logo</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" name="logo">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-2 offset-md-2">
                                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                                        <?php
                                        if (isset($_GET['tambah']) && $_GET['tambah'] == "berhasil" || isset($_GET['ubah']) && $_GET['ubah'] == "berhasil") {
                                        ?>
                                            <a onclick="return confirm('Yakin ingin mendelete?')" href="setting.php?idDel=<?php echo $rowEdt['id']; ?>" class="btn btn-danger">Hapus</a>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
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