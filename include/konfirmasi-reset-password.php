<?php
require_once('vendor/autoload.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['reset'])) {
  $email = $_POST['email'];
  $token = $_POST['token'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  // Validasi password
  if ($password != $confirm_password) {
    header('Location: index.php?include=resetpassword&error=password_tidak_sama&email=$email&token=$token');
    exit();
  }

  // Cek apakah token valid
  $sql = "SELECT * FROM users WHERE email='$email' AND token='$token' ";
  $result = mysqli_query($koneksi, $sql);
  if ($result->num_rows == 0) {
    header('Location: index.php?include=resetpassword&error=token_invalid&email=$email&token=$token');
    exit();
  }

  // Enkripsi password
  $password_hash = md5($password);

  // Update password ke database
  $sql = "UPDATE users SET password='$password_hash', token=NULL WHERE email='$email'";
  mysqli_query($koneksi, $sql);

  // redirect ke halaman login jika password berhasil diubah
  if (mysqli_affected_rows($koneksi) > 0) {
    header("Location: index.php?include=login&success=password_berhasil_diubah");
    exit();
  }
}
