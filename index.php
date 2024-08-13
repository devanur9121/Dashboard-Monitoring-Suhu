<?php
session_start();
include 'koneksi.php';
if (isset($_GET["include"])) {
  $include = $_GET["include"];
  if ($include == "konfirmasi-login") {
    include("include/konfirmasi-login.php");
  } else if ($include == "logout") {
    include("include/logout.php");
  } else if ($include == "konfirmasi-register") {
    include("include/konfirmasi-register.php");
  } else if ($include == "konfirmasi-forgot-password") {
    include("include/konfirmasi-forgot-password.php");
  } else if ($include == "konfirmasi-reset-password") {
    include("include/konfirmasi-reset-password.php");
  } else if ($include == "konfirmasi-edit-profile") {
    include("include/konfirmasi-edit-profile.php");
  } else if ($include == "konfirmasi-edit-master-alat") {
    include("include/konfirmasi-edit-master-alat.php");
  } else if ($include == "konfirmasi-add-master-alat") {
    include("include/konfirmasi-edit-master-alat.php");
  }
}
?>

<!doctype html>
<html lang="en" class="semi-dark">

<head>
  <?php include("layouts/head.php") ?>
</head>

<?php
if (isset($_GET["include"])) {
  $include = $_GET["include"];
  if (isset($_SESSION['id_user'])) {
?>

    <body>
      <!--wrapper-->
      <div class="wrapper">
        <!--sidebar wrapper -->
        <?php include("layouts/sidebar.php") ?>
        <!--end sidebar wrapper -->
        <!--start header -->
        <?php include("layouts/header.php") ?>
        <!--end header -->
        <!--start page wrapper -->
        <div class="page-wrapper">
          <div class="page-content">
            <?php
            if ($include == "dashboard-admin") {
              include("include/dashboard-admin.php");
            } else if ($include == "dashboard-user") {
              include("include/dashboard-user.php");
            } else if ($include == "profile") {
              include("include/profile.php");
            } else if ($include == "manage-data-sensor") {
              include("include/manage-data-sensor.php");
            } else if ($include == "data-sensor") {
              include("include/data-sensor.php");
            } else if ($include == "user-logs") {
              include("include/user-logs.php");
            } else if ($include == "information") {
              include("include/information.php");
            } else if ($include == "information-admin") {
              include("include/information-admin.php");
            } else if ($include == "user-account") {
              include("include/user-account.php");
            } else if ($include == "manage-galeri") {
              include("include/manage-galeri.php");
            } else if ($include == "manage-komponen") {
              include("include/manage-komponen.php");
            } else if ($include == "all-grafik-chart") {
              include("include/all-grafik-chart.php");
            }
            ?>
          </div>
        </div>
        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        <footer class="page-footer">
          <p class="mb-0">Copyright © 2024. All right reserved.</p>
        </footer>
      </div>
      <!--end wrapper-->
      <!--start switcher-->
      <?php include("layouts/switcher.php") ?>
      <!--end switcher-->
      <?php include("layouts/scripts.php") ?>
    </body>
<?php
  } else {
    if ($include == "register") {
      include("include/register.php");
    } else if ($include == "forgot-password") {
      include("include/forgot-password.php");
    } else if ($include == "resetpassword") {
      include("include/resetpassword.php");
    } else {
      include("include/login.php");
    }
  }
} else {
  include("include/login.php"); // Jika tidak ada include yang diatur, maka akan menampilkan halaman home.php
}
?>

</html>