<?php
// Proses form tambah data
if (isset($_POST['submit'])) {
  $title = $_POST['title'];
  $deskripsi = $_POST['deskripsi'];

   // Mengecek apakah semua field telah diisi
   if (empty($title) || empty($deskripsi)) {
    // Jika ada field yang kosong, tampilkan pesan error
    echo "<script>
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Data gagal ditambah. Harap lengkapi semua kolom!',
          }).then(function() {
            window.location.href='index.php?include=information-admin';
          });
          </script>";
    exit(); // Hentikan proses jika ada field yang kosong
}

  $query = "INSERT INTO information (title, deskripsi) VALUES ('$title', '$deskripsi')";

  $result = mysqli_query($koneksi, $query);

  if ($result) {
    echo "<script>
          Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: 'Data berhasil ditambah.',
            }).then(function() {
                window.location.href='index.php?include=information-admin';
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
                window.location.href='index.php?include=information-admin';
            });
          </script>";
    exit();
  }
}

// Proses form edit data
if (isset($_POST['edit'])) {
  $id = $_POST['id'];
  $title = $_POST['title'];
  $deskripsi = $_POST['deskripsi'];

  // Mengecek apakah semua field telah diisi
  if (empty($title) || empty($deskripsi)) {
    // Jika ada field yang kosong, tampilkan pesan error
    echo "<script>
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Data gagal diupdate. Harap isi kolom dengan benar!',
          }).then(function() {
            window.location.href='index.php?include=information-admin';
          });
          </script>";
    exit(); // Hentikan proses jika ada field yang kosong
}
  $query = "UPDATE information SET title='$title', deskripsi='$deskripsi' WHERE id=$id";

  $result_edit = mysqli_query($koneksi, $query);

  if ($result_edit) {
    echo "<script>
          Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: 'Data berhasil diupdate.',
            }).then(function() {
                window.location.href='index.php?include=information-admin';
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
                window.location.href='index.php?include=information-admin';
            });
          </script>";
    exit();
  }
}

if (isset($_POST['id'])) {
  $id = mysqli_real_escape_string($koneksi, $_POST['id']);

  // Query untuk menghapus data
  $delete_query = "DELETE FROM `information` WHERE `id`='$id'";
  $result_delete = mysqli_query($koneksi, $delete_query);

  // Menampilkan pesan berhasil atau gagal menghapus data
  if ($result_delete) {
    echo "<script>
          Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: 'Data berhasil dihapus.',
            }).then(function() {
                window.location.href='index.php?include=information-admin';
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
                window.location.href='index.php?include=information-admin';
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
            <li class="breadcrumb-item active" aria-current="page">Manage Data Information</li>
          </ol>
        </nav>
      </div>
    </div>
    <!--end breadcrumb-->
    <div class="card">
      <div class="card-body">
        <div class="card-title">
          <h4 class="mb-0 text-md-start">Data Information
            <button class="btn btn-sm float-end" style="background-color:#b7d5ac" data-bs-toggle="modal" data-bs-target="#addModal"><i class="bx bx-plus" style="color: white"></i></button>
          </h4>
        </div>

        <!-- Modal Tambah Alat -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form method="POST" action="">
                  <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title">
                  </div>
                  <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea type="text" class="form-control" id="deskripsi" name="deskripsi"></textarea>
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
                <th width="5px">No</th>
                <th>Title</th>
                <th>Deskripsi</th>
                <th class="no-export">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sql = "SELECT * FROM `information` ORDER BY id DESC";
              $query = mysqli_query($koneksi, $sql);
              $no = 1;
              while ($row = mysqli_fetch_assoc($query)) {
              ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td>
                    <?php
                      $title = $row['title'];
                      echo strlen($title) > 50 ? substr($title, 0, 50) . '...' : $title;
                    ?>
                  </td>
                  <td>
                    <?php
                      $deskripsi = $row['deskripsi'];
                      echo strlen($deskripsi) > 50 ? substr($deskripsi, 0, 50) . '...' : $deskripsi;
                    ?>
                  </td>
                  <td>
                    <a class="btn btn-sm" style="background-color:darkorange" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row['id']; ?>"><i class="bx bx-edit" style="color: white"></i></a>
                    <a class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $row['id']; ?>"><i class="bx bx-trash"></i></a>
                  </td>
                </tr>
                <!-- Edit Modal -->
                <div class="modal fade" id="editModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Data Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form method="POST" action="">
                        <div class="modal-body">
                          <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="<?php echo $row['title']; ?>">
                          </div>
                          <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea type="text" class="form-control" id="deskripsi" name="deskripsi" value=""><?php echo $row['deskripsi']; ?></textarea>
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
                        <h5 class="modal-title">Hapus Data Information</h5>
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