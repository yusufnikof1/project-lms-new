<?php
session_start();
require '../koneksi.php';

//middleware
if (empty($_SESSION['EMAIL'])) {
    header("location:../login.php");
}

$majorsQuery = mysqli_query($con, "SELECT * FROM majors");
$usersQuery = mysqli_query($con, "SELECT * FROM users");

//jika button save di klik
if (isset($_POST['save'])) {
    $majors_id = $_POST['majors_id'];
    $user_id = $_POST['user_id'];
    $title = $_POST['title'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $photo = $_FILES['photo'];
    $is_active = $_POST['is_active'];

    if ($photo['error'] == 0) {
        $fileName = uniqid() . "_" . basename($photo['name']);
        $filePath = "../assets/adm-assets/uploads/instructors/" . $fileName;
        move_uploaded_file($photo['tmp_name'], $filePath);

        $insert = mysqli_query($con, "INSERT INTO instructors (majors_id, user_id, title, gender, address, phone, photo, is_active) VALUES ('$majors_id','$user_id','$title', '$gender','$address','$phone','$fileName','$is_active')");
        if ($insert) {
            header("Location: instructors.php");
        }
    }
}

if (isset($_GET['Edit'])) {
    $id = $_GET['Edit'];

    $qEdit = mysqli_query($con, "SELECT * FROM instructors WHERE id = $id");
    $rowEdt = mysqli_fetch_assoc($qEdit);
}

if (isset($_POST['edit'])) {
    $majors_id = $_POST['majors_id'];
    $user_id = $_POST['user_id'];
    $title = $_POST['title'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $photo = $_FILES['photo'];
    $is_active = $_POST['is_active'];

    $fillQupdate = '';
    if ($photo['error'] == 0) {
        $fileName = uniqid() . "_" . basename($photo['name']);
        $filePath = "../assets/adm-assets/uploads/instructors/" . $fileName;
        if (move_uploaded_file($photo['tmp_name'], $filePath)) {
            $checkPhoto = mysqli_query($con, "SELECT photo FROM instructors WHERE id = $id");
            $oldPhoto = mysqli_fetch_assoc($checkPhoto);
            if ($oldPhoto && file_exists("../assets/adm-assets/uploads/instructors/" . $oldPhoto['photo'])) {
                unlink("../assets/adm-assets/uploads/instructors/" . $oldPhoto['photo']);
            }
            $fillQupdate = "photo='$fileName',";
        } else {
            echo "EDIT FAILED";
        }
    }

    $qUpdate = mysqli_query($con, "UPDATE instructors SET $fillQupdate majors_id='$majors_id', user_id='$user_id', title='$title', gender='$gender', address='$address', phone='$phone',photo='$fileName',is_active = '$is_active' WHERE id = $id");
    if ($qUpdate) {
        header("location: instructors.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Create Instructor</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/adm-assets/img/logo-ppkdjp_32x32.jpg" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/adm-assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/adm-assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/adm-assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/adm-assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/adm-assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/adm-assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/adm-assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../assets/adm-assets/css/style.css" rel="stylesheet">

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
    <?php include '../inc-admin-general/navbar.php' ?>

    <!-- ======= Sidebar ======= -->
    <?php include '../inc-admin-general/sidebar.php' ?>
    <!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Create Instructor</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="instructors.php">Dashboard</a></li>
                    <li class="breadcrumb-item">Instructors</li>
                    <li class="breadcrumb-item active">Create Instructor</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Create</h5>
                            <form action="" method="post" enctype='multipart/form-data'>

                                <!-- Major Select Option -->
                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <label for="majors_id">Major</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <select name="majors_id" id="majors_id" class="form-control">
                                            <option value="" disabled selected>Select Major</option>
                                            <?php while ($major = mysqli_fetch_assoc($majorsQuery)) { ?>
                                                <option value="<?php echo $major['id']; ?>"><?php echo $major['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div> <!-- Major -->

                                <!-- User Select Option -->
                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <label for="user_id">User</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <select name="user_id" id="user_id" class="form-control">
                                            <option value="" disabled selected>Select User</option>
                                            <?php while ($user = mysqli_fetch_assoc($usersQuery)) { ?>
                                                <option value="<?php echo $user['id']; ?>"><?php echo $user['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div> <!-- User -->

                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <label for="">Title</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="title" placeholder="Enter your title" required value="<?php echo isset($_GET['Edit']) ? $rowEdt['title'] : ''; ?>" required>
                                    </div>
                                </div> <!-- Title -->

                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <label for="">Gender</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <select name="gender" id="" class="form-control">
                                            <option value="1" selected>Laki-laki</option>
                                            <option value="0">Perempuan</option>
                                        </select>
                                    </div>
                                </div> <!-- Gender -->

                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <label for="">Address</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="address" placeholder="Enter your address" required value="<?php echo isset($_GET['Edit']) ? $rowEdt['address'] : ''; ?>" required>
                                    </div>
                                </div> <!-- Address -->

                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <label for="">Phone</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="phone" placeholder="Enter your number phone" required value="<?php echo isset($_GET['Edit']) ? $rowEdt['phone'] : ''; ?>" required>
                                    </div>
                                </div> <!-- Place of Birth-->

                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <label for="">Photo</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="photo" required>
                                    </div>
                                    <?php if (isset($_GET['Edit'])) {
                                    ?>
                                        <div class="mt-2">
                                            <img width="190" src="../assets/adm-assets/uploads/instructors/<?php echo $rowEdt['photo'] ?>" alt="">
                                        </div>
                                    <?php
                                    } ?>
                                </div> <!-- Photo -->

                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <label for="">Status</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <select name="is_active" id="" class="form-control">
                                            <option value="1" selected>Actived</option>
                                            <option value="0">Not Actived</option>
                                        </select>
                                    </div>
                                </div> <!-- Status -->

                                <div class="row mb-3">
                                    <div class="col-md-2 offset-md-2">
                                        <?php
                                        if (isset($_GET['Edit'])) {
                                        ?>
                                            <button name="edit" class="btn btn-success" type="submit">Edit</button>
                                        <?php
                                        } else {
                                        ?>
                                            <button name="save" class="btn btn-primary" type="submit">Save</button>
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
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            Developed by <a href="">Yusuf Niko Fitranto</a>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="../assets/adm-assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/adm-assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/adm-assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/adm-assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/adm-assets/vendor/quill/quill.js"></script>
    <script src="../assets/adm-assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/adm-assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/adm-assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/adm-assets/js/main.js"></script>

</body>

</html>