<?php
// Mengambil data dari database
$id_user = $_SESSION['id_user'];
$query = "SELECT * FROM users WHERE id_user = $id_user";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

// Menetapkan data dari database ke variabel
$nama = $data['nama'];
$username = $data['username'];
$email = $data['email'];
$foto = "assets/images/uploads/" . $data['foto'];

?>
<!--page-content-wrapper-->
<div class="page-content-wrapper">
  <div class="page-content">
  <?php
if (isset($_GET['status'])) {
  $status = $_GET['status'];

  if ($status == 'success') {
    echo "<script>
          Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: 'Profile anda berhasil diupdate!',
          });
        </script>";
  } elseif ($status == 'error') {
    echo "<script>
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Profile anda gagal diupdate!',
          });
        </script>";
  } elseif ($status == 'empty') {
    echo "<script>
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Harap isi semua kolom!',
          });
        </script>";
  }
}
?>
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Profile Information</h5>
            <form action="index.php?include=konfirmasi-edit-profile" method="post" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>">
              </div>
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>">
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Alamat Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
              </div>
              <div class="mb-3">
                <label for="foto" class="form-label">Foto Profile</label>
                <input type="file" class="form-control" id="foto" name="foto">
              </div>
              <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Profile Picture</h5>
            <img src="<?php echo $foto; ?>" class="img-fluid rounded" alt="User Photo">
          </div>
        </div>
      </div>
    </div>
    <!--end row-->
    <!--end page-content-wrapper-->
  </div>
  <!--end page-wrapper-->
</div>