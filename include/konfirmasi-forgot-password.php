<?php
require_once('vendor/autoload.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['forgot'])) {
  $email = $_POST['email'];

  // Cek apakah email terdaftar di database
  $sql = "SELECT * FROM users WHERE email='$email'";
  $result = mysqli_query($koneksi, $sql);
  if ($result->num_rows == 0) {
    header('Location: index.php?include=forgot-password&error=email_not_registered');
    exit();
  }

  // Generate token reset password dan update ke database
  $token = md5(time() . $email . uniqid()); // Menambahkan uniqid() untuk membuat token lebih unik
  $sql = "UPDATE users SET token='$token' WHERE email='$email'";
  mysqli_query($koneksi, $sql);


  // Konfigurasi email dan kirim email
  $mail = new PHPMailer(true);

  $mail->isSMTP();
  $mail->Host       = 'smtp.gmail.com';
  $mail->SMTPAuth   = true;
  $mail->Username   = 'ww.dv.1796@gmail.com'; // Ganti dengan email Anda
  $mail->Password   = 'imqfmemzrezhpbax'; // Ganti dengan password email Anda
  $mail->SMTPSecure = 'tls';
  $mail->Port       = 587;

  $mail->setFrom('ww.dv.1796@gmail.com', 'Tilik Kebon Website'); // Ganti dengan email dan nama Anda
  $mail->addAddress($email);

  $mail->isHTML(true);
  $mail->Subject = 'Reset Password';
  $mail->Body    = "<strong>Kami mengirimkan link untuk mereset password anda.
  Perlu diperhatikan, link ini hanya berlaku satu kali.</strong><br><br> Silakan memasukan password baru 
  dan konfirmasi password baru dengan benar. Apabila password yang anda masukan tidak sama, silakan kembali mengirim permintaan 
  forgot password agar dikirimkan link reset password yang baru.<br><br>
  Klik link berikut untuk mereset password Anda: <a href='http://localhost:80/tilikkebon/index.php?include=resetpassword&email=$email&token=$token'>Reset Password</a>";

  try {
    $mail->send();
    header('Location: index.php?include=forgot-password&success=email_sent');
    exit();
  } catch (Exception $e) {
    header('Location: index.php?include=forgot-password&error=email_not_sent');
    exit();
  }
}
