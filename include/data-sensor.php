<div class="page-content-wrapper">
  <div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Table</div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="index.php?include=dashboard-user"><i class="bx bx-home-alt"></i></a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Histori Data Sensor</li>
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
                  <td><?php echo $row['data_suhu_udara']; ?> C</td>
                  <td><?php echo $row['data_kelembaban_udara']; ?> %</td>
                  <td><?php echo $row['data_kelembaban_tanah']; ?></td>
                  <td><?php echo $row['nama']; ?></td>
                  <td><?php echo date('d-m-Y || H:i:s', strtotime($row['created_at'])); ?></td>
                </tr>
              <?php $no++;
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>