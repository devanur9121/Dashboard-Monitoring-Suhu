<?php
// Proses form tambah data
if (isset($_POST['submit'])) {
  // check if a new photo has been uploaded
  if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $foto = $_FILES['foto']['name'];
    $tmp_name = $_FILES['foto']['tmp_name'];
    $foto_baru = "assets/images/uploads-galeri/" . $foto;
    move_uploaded_file($tmp_name, $foto_baru);
    // set foto_baru as the new filename without its path
    $foto_baru = basename($foto_baru);
  }
    // Mengecek apakah semua field telah diisi
    if (empty($foto_baru)) {
      // Jika ada field yang kosong, tampilkan pesan error
      echo "<script>
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Data gagal ditambah. Harap lengkapi semua kolom!',
            }).then(function() {
              window.location.href='index.php?include=manage-galeri';
            });
            </script>";
      exit(); // Hentikan proses jika ada field yang kosong
  }

  // Masukkan data ke database
  $sql = "INSERT INTO `galeri` (`foto`) VALUES ('$foto_baru')";
  $result = mysqli_query($koneksi, $sql);

  if ($result) {
    echo "<script>
          Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: 'Data berhasil ditambah.',
            }).then(function() {
                window.location.href='index.php?include=manage-galeri';
            });
          </script>";
    exit();
  } else {
    echo "<script>
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Data Gagal Ditambah.',
            }).then(function() {
                window.location.href='index.php?include=manage-galeri';
            });
          </script>";
    exit();
  }
}

// Proses form edit data
if (isset($_POST['edit'])) {
  $id = $_POST['id'];
  $sql = "SELECT * FROM `galeri` WHERE `id`='$id'";
  $result = mysqli_query($koneksi, $sql);
  if ($result) {
    $row = mysqli_fetch_assoc($result);
    $foto_lama = $row['foto'];
  }

  // check if a new photo has been uploaded
  if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $foto = $_FILES['foto']['name'];
    $tmp_name = $_FILES['foto']['tmp_name'];
    $foto_baru = "assets/images/uploads-galeri/" . $foto;
    move_uploaded_file($tmp_name, $foto_baru);
    if (file_exists($foto_lama)) {
      unlink($foto_lama);
    }
    // set foto_baru as the new filename without its path
    $foto_baru = basename($foto_baru);
  } else {
    $foto_baru = $foto_lama;
  }

  // Mengecek apakah semua field telah diisi
  if (empty($foto_baru)) {
    // Jika ada field yang kosong, tampilkan pesan error
    echo "<script>
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Data gagal diupdate. Harap isi kolom dengan benar!',
          }).then(function() {
            window.location.href='index.php?include=manage-galeri';
          });
          </script>";
    exit(); // Hentikan proses jika ada field yang kosong
}


  $sql = "UPDATE `galeri` SET `foto`='$foto_baru' WHERE `id`='$id'";
  $result_edit = mysqli_query($koneksi, $sql);

  if ($result_edit) {
    echo "<script>
          Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: 'Data berhasil diupdate.',
            }).then(function() {
                window.location.href='index.php?include=manage-galeri';
            });
          </script>";
    exit();
  } else {
    echo "<script>
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Data Gagal Diupdate.',
            }).then(function() {
                window.location.href='index.php?include=manage-galeri';
            });
          </script>";
    exit();
  }
}

if (isset($_POST['id'])) {
  $id = mysqli_real_escape_string($koneksi, $_POST['id']);

  // Query untuk menghapus data
  $delete_query = "DELETE FROM `galeri` WHERE `id`='$id'";
  $result_delete = mysqli_query($koneksi, $delete_query);

  // Menampilkan pesan berhasil atau gagal menghapus data
  if ($result_delete) {
    echo "<script>
          Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: 'Data berhasil dihapus.',
            }).then(function() {
                window.location.href='index.php?include=manage-galeri';
            });
          </script>";
    exit();
  } else {
    echo "<script>
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Data Gagal Dihapus.',
            }).then(function() {
                window.location.href='index.php?include=manage-galeri';
            });
          </script>";
    exit();
  }
}

?>

<!--page-content-wrapper-->
<div class="page-content-wrapper">
  <div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Table</div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="index.php?include=dashboard-admin"><i class="bx bx-home-alt"></i></a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Manage Data Galeri</li>
          </ol>
        </nav>
      </div>
    </div>
    <!--end breadcrumb-->
    <div class="card">
      <div class="card-body">
        <div class="card-title">
          <h4 class="mb-0 text-md-start">Data Galeri
            <button class="btn btn-sm float-end" style="background-color:#b7d5ac" data-bs-toggle="modal" data-bs-target="#addModal"><i class="bx bx-plus" style="color: white"></i></button>
          </h4>
        </div>

        <!-- Modal Tambah Alat -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Galeri</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form method="POST" action="" enctype="multipart/form-data">
                  <div class="mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <hr>
        <div class="table-responsive">
          <table id="example3" class="table table-striped table-bordered table-hover table-active" style="width:100%">
            <thead>
              <tr>
                <th width="5px" class="text-center">No</th>
                <th class="text-center">Foto</th>
                <th class="no-export text-center">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sql = "SELECT * FROM `galeri` ORDER BY id DESC";
              $query = mysqli_query($koneksi, $sql);
              $no = 1;
              while ($row = mysqli_fetch_assoc($query)) {
                $foto = "assets/images/uploads-galeri/" . $row['foto'];
              ?>
                <tr>
                  <td class="text-center"><?php echo $no; ?></td>
                  <td><img src="<?php echo $foto; ?>" alt="Foto Galeri" width="400px"></td>
                  <td>
                    <a class="btn btn-sm" style="background-color:darkorange" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row['id']; ?>"><i class="bx bx-edit" style="color: white"></i></a>
                    <a class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $row['id']; ?>"><i class="bx bx-trash"></i></a>
                  </td>
                </tr>
                <!-- Edit Modal -->
                <div class="modal fade" id="editModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Data Galeri</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form method="POST" action="" enctype="multipart/form-data">
                        <div class="modal-body">
                          <div class="mb-3">
                            <label for="foto" class="form-label">Foto yang Tersimpan</label>
                            <img src="<?php echo $foto; ?>" alt="Current Photo" class="img-thumbnail" style="max-width: 200px;">
                          </div>
                          <div class="mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto">
                          </div>
                          <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" name="edit" class="btn btn-primary">Save changes</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- Modal Delete -->
                <div class="modal fade" id="deleteModal<?php echo $row['id']; ?>" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Hapus Data Galeri</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <strong>Anda yakin ingin menghapus data ini?</strong>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <form id="deleteForm" method="POST">
                          <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                          <button type="" class="btn btn-danger">Hapus</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              <?php $no++;
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>