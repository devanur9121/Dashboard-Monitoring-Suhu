<?php
include('koneksi.php');

$sql = "SELECT * FROM `data_sensor` ORDER BY `created_at` DESC";
$query = mysqli_query($koneksi, $sql);

if (isset($_POST['id'])) {
  $id = mysqli_real_escape_string($koneksi, $_POST['id']);

  // Query untuk menghapus data
  $delete_query = "DELETE FROM `data_sensor` WHERE `id`='$id'";
  $result_delete = mysqli_query($koneksi, $delete_query);

  // Menampilkan pesan berhasil atau gagal menghapus data
  if ($result_delete) {
    echo "<script>
          Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: 'Data berhasil dihapus.',
            }).then(function() {
                window.location.href='index.php?include=manage-data-sensor';
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
                window.location.href='index.php?include=manage-data-sensor';
            });
          </script>";
    exit();
  }
}
?>

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
            <li class="breadcrumb-item active" aria-current="page">Manage Data Sensor</li>
          </ol>
        </nav>
      </div>
    </div>
    <!--end breadcrumb-->
    <div class="card">
      <div class="card-body">
        <div class="card-title">
          <h4 class="mb-0 text-md-start">Data Sensor</h4>
        </div>
        <hr>
        <div class="table-responsive">
          <table id="example3" class="table table-striped table-bordered table-hover table-active" style="width:100%">
            <thead>
              <tr>
                <th width="5px" class="text-center">No</th>
                <th class="text-center">Suhu Udara</th>
                <th class="text-center">Kelembaban Udara</th>
                <th class="text-center">Kelembaban Tanah</th>
                <th class="text-center">Kondisi</th>
                <th class="text-center">Waktu</th>
                <th class="no-export text-center">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sql = "SELECT data_sensor.*, status_soil.nama FROM data_sensor 
              INNER JOIN status_soil ON data_sensor.id_status_soil = status_soil.id_status_soil 
              ORDER BY data_sensor.created_at DESC";

              // $sql = "SELECT * FROM `data_sensor` ORDER BY created_at DESC";
              $query = mysqli_query($koneksi, $sql);
              $no = 1;
              while ($row = mysqli_fetch_assoc($query)) {
              ?>
                <tr class="text-center">
                  <td><?php echo $no; ?></td>
                  <td><?php echo $row['data_suhu_udara']; ?></td>
                  <td><?php echo $row['data_kelembaban_udara']; ?></td>
                  <td><?php echo $row['data_kelembaban_tanah']; ?></td>
                  <td><?php echo $row['nama']; ?></td>
                  <td><?php echo date('d-m-Y || H:i:s', strtotime($row['created_at'])); ?></td>
                  <td>
                    <a class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $row['id']; ?>"><i class="bx bx-trash"></i></a>
                  </td>
                </tr>
                <!-- Modal Delete -->
                <div class="modal fade" id="deleteModal<?php echo $row['id']; ?>" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Hapus Data Sensor</h5>
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