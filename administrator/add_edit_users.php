<?php
session_start();
require '../koneksi.php';

//middleware
if (empty($_SESSION['EMAIL'])) {
    header("location:../login.php");
}
//jika button save di klik
if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $is_active = $_POST['is_active'];

    $insert = mysqli_query($con, "INSERT INTO users (name, email, password, is_active) VALUES ('$name','$email','$password','$is_active')");
    if ($insert) {
        header("Location: users.php");
    }
}

if (isset($_GET['Edit'])) {
    $id = $_GET['Edit'];

    $qEdit = mysqli_query($con, "SELECT * FROM users WHERE id = $id");
    $rowEdt = mysqli_fetch_assoc($qEdit);
}

if (isset($_POST['edit'])) {
    $id = $_GET['Edit'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $is_active = $_POST['is_active'];
    $qUpdate = mysqli_query($con, "UPDATE users SET name='$name', email='$email', is_active='$is_active'  WHERE id = $id");
    if ($qUpdate) {
        header("location: users.php");
    }
}

// if (isset($_GET['AddRole'])) {
//     $id = $_GET['AddRole'];

//     $qAddRole = mysqli_query($con, "SELECT * FROM roles WHERE id = $id");
//     $rowAddRole = mysqli_fetch_assoc($qAddRole);
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Create User</title>
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
    <?php include '../inc-administrator/navbar.php' ?>

    <!-- ======= Sidebar ======= -->
    <?php include '../inc-administrator/sidebar.php' ?>
    <!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Create User</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="users.php">Dashboard</a></li>
                    <li class="breadcrumb-item">Users</li>
                    <li class="breadcrumb-item active">Create User</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Create</h5>
                            <form action="" method="post">
                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <label for="">Name</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name" placeholder="Enter your fullname" required value="<?php echo isset($_GET['Edit']) ? $rowEdt['name'] : ''; ?>" required>
                                    </div>
                                </div> <!-- Name -->
                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <label for="">Email</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" name="email" placeholder="Enter your email" required value="<?php echo isset($_GET['Edit']) ? $rowEdt['email'] : ''; ?>" required>
                                    </div>
                                </div> <!-- Email-->
                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <label for="">Password</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" name="password" placeholder="Enter your password" required value="<?php echo isset($_GET['Edit']) ? $rowEdt['password'] : ''; ?>" required>
                                    </div>
                                </div> <!-- Password -->

                                <!-- <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <label for="">Role</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <select name="roles" id="" class="form-control">
                                            <option value="Student">Student</option>
                                            <option value="PIC">PIC</option>
                                            <option value="Instructor">Instructor</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Administrator">Administrator</option>
                                        </select>
                                    </div>
                                </div> Roles -->

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