<?php
session_start();
require '../koneksi.php';

$query = mysqli_query($con, "SELECT blogs.*, categories.nama_kategori FROM blogs LEFT JOIN categories ON blogs.id_kategori = categories.id");
$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);
// print_r($rows);
// die;

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $queryBlog = mysqli_query($con, "SELECT * FROM blogs WHERE id = '$id'");
    $rowBlog = mysqli_fetch_assoc($queryBlog);
    unlink('../assets/uploads/');

    $delete = mysqli_query($con, "DELETE FROM blogs WHERE id = $id");
    if ($delete) {
        header("location: blog.php?hapus=berhasil");
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
                            <h5 class="card-title">Data Blog</h5>
                            <div class="table table-responsive">
                                <a class="btn btn-primary mb-2" href="tambah-blog.php">CREATE</a>
                                <table class="table table-bordered" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Kategori</th>
                                            <th>Judul</th>
                                            <th>Penulis</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($rows as $row) {
                                        ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><img width="100" src="../assets/uploads/<?php echo $row['foto']; ?>" alt=""></td>
                                                <td><?php echo $row['nama_kategori'] ?></td>
                                                <td><?php echo $row['judul']; ?></td>
                                                <td><?php echo $row['penulis']; ?></td>
                                                <td><?php
                                                    switch ($row['status']) {
                                                        case '1':
                                                            $label = "<span class='badge bg-primary'>Publish</span>";
                                                            break;

                                                        default:
                                                            $label = "<span class='badge bg-warning'>Draft</span>";
                                                            break;
                                                    }
                                                    echo $label
                                                    ?>
                                                </td>
                                                <td>
                                                    <a class="btn btn-success btn-sm" href="tambah-blog.php?edit=<?php echo $row['id']; ?>">Edit</a>
                                                    <a class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin delete?')" href="blog.php?delete=<?php echo $row['id'] ?>">Delete</a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer fixed-bottom">
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
    <script
        src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

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
    <script src="https://cdn.datatables.net/v/bs5/dt-2.2.2/datatables.min.js" integrity="sha384-k90VzuFAoyBG5No1d5yn30abqlaxr9+LfAPp6pjrd7U3T77blpvmsS8GqS70xcnH" crossorigin="anonymous"></script>
    <script>
        let dataTable = new DataTable("#myTable");
    </script>

</body>

</html>