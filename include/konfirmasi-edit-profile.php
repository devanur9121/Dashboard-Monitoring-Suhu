<?php
if (isset($_SESSION['id_user'])) {
  $id_user = $_SESSION['id_user'];
  // get the user data from the database
  $sql = "SELECT * FROM `users` WHERE `id_user`='$id_user'";
  $result = mysqli_query($koneksi, $sql);
  if ($result) {
    $row = mysqli_fetch_assoc($result);
    $foto_lama = $row['foto'];
  }

  // get the updated data from the form
  $nama = $_POST['nama'];
  $username = $_POST['username'];
  $email = $_POST['email'];

  // check if any input is empty
  if (empty($nama) || empty($username) || empty($email)) {
    // redirect to the profile page with an error message
    header('location: index.php?include=profile&status=empty');
    exit(); // stop the script execution
  }

  // check if a new photo has been uploaded
  if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $foto = $_FILES['foto']['name'];
    $tmp_name = $_FILES['foto']['tmp_name'];
    $foto_baru = "assets/images/uploads/" . $foto;
    move_uploaded_file($tmp_name, $foto_baru);
    if (file_exists($foto_lama)) {
      unlink($foto_lama);
    }
    // set foto_baru as the new filename without its path
    $foto_baru = basename($foto_baru);
  } else {
    $foto_baru = $foto_lama;
  }
  // update the user data in the database
  $sql = "UPDATE `users` SET `nama`='$nama', `username`='$username', `email`='$email', `foto`='$foto_baru' WHERE `id_user`='$id_user'";
  $result = mysqli_query($koneksi, $sql);

  if ($result) {
    // redirect to the profile page with a success message
    header('location: index.php?include=profile&status=success');
  } else {
    // redirect to the profile page with an error message
    header('location: index.php?include=profile&status=error');
  }
}
