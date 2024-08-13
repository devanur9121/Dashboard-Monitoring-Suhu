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
            <li class="breadcrumb-item active" aria-current="page">Data User Logs</li>
          </ol>
        </nav>
      </div>
    </div>
    <!--end breadcrumb-->
    <div class="card">
      <div class="card-body">
        <div class="card-title">
          <h4 class="mb-0">User Logs</h4>
        </div>
        <hr />
        <div class="table-responsive">
          <table id="example3" class="table table-striped table-bordered table-hover table-active" style="width:100%">
            <thead>
              <tr>
                <th width="5px">No</th>
                <th>Nama Pengguna</th>
                <th>Email Pengguna</th>
                <th>Waktu Login</th>
                <th>Waktu Logout</th>
                <th>Aktivitas</th>
              </tr>
            </thead>
            <tbody>
              <?php
              include('koneksi.php');
              $sql = "SELECT log_user.login_time, log_user.logout_time, 
              log_user.aktivitas, users.id_user, users.username, users.email FROM `log_user` 
              LEFT JOIN users ON log_user.id_user = users.id_user 
              ORDER BY `login_time` DESC";
              $query = mysqli_query($koneksi, $sql);
              $no = 1;
              while ($row = mysqli_fetch_assoc($query)) {
              ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $row['username']; ?></td>
                  <td><?php echo $row['email']; ?></td>
                  <td>
                    <?php echo date('d-m-Y || H:i:s', strtotime($row['login_time'])); ?>
                  </td>
                  <td>
                    <?php
                    if ($row['logout_time'] !== NULL) {
                      echo date('d-m-Y || H:i:s', strtotime($row['logout_time']));
                    } else {
                      echo ""; // Sel kosong
                    }
                    ?>
                  </td>
                  <td><?php echo $row['aktivitas']; ?></td>
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