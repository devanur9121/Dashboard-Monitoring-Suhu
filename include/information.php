<div class="page-content-wrapper">
  <div class="page-content">
    <div class="row">
      <div class="col-8 mx-auto">
        <div class="card radius-15">
          <div class="card-body">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
              <ol class="carousel-indicators">
                <?php
                $query = "SELECT * FROM galeri ORDER BY id";
                $result = mysqli_query($koneksi, $query);
                $indicator_index = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                  $active_class = ($indicator_index == 0) ? 'active' : '';
                  echo '<li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="' . $indicator_index . '" class="' . $active_class . '"></li>';
                  $indicator_index++;
                }
                ?>
              </ol>
              <div class="carousel-inner">
                <?php
                mysqli_data_seek($result, 0); // Mengembalikan penunjuk data ke baris pertama
                $active_class = 'active';
                while ($data = mysqli_fetch_assoc($result)) {
                  $foto = "assets/images/uploads-galeri/" . $data['foto'];
                  echo '<div class="carousel-item ' . $active_class . '">';
                  echo '<img src="' . $foto . '" class="d-block w-100" alt="...">';
                  echo '</div>';
                  $active_class = ''; // Hanya item pertama yang aktif
                }
                ?>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card radius-15">
          <div class="card-body">
            <div id="carouselExampleIndicators2" class="carousel slide" data-bs-ride="carousel">
              <ol class="carousel-indicators">
                <?php
                $query = "SELECT * FROM information ORDER BY id";
                $result = mysqli_query($koneksi, $query);
                $indicator_index = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                  $active_class = ($indicator_index == 0) ? 'active' : '';
                  echo '<li data-bs-target="#carouselExampleIndicators2" data-bs-slide-to="' . $indicator_index . '" class="' . $active_class . '"></li>';
                  $indicator_index++;
                }
                ?>
              </ol>
              <div class="carousel-inner">
                <?php
                mysqli_data_seek($result, 0); // Mengembalikan penunjuk data ke baris pertama
                $active_class = 'active';
                while ($data = mysqli_fetch_assoc($result)) {
                  echo '<div class="carousel-item ' . $active_class . '">';
                  echo '<h5 class="card-title"><strong>' . $data['title'] . '</strong></h5>'; // Ganti $title dengan kolom yang sesuai
                  echo '<p>' . htmlspecialchars_decode($data['deskripsi']) . '</p>';
                  echo '</div>';
                  $active_class = ''; // Hanya item pertama yang aktif
                }
                ?>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators2" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>
    <h6 class="mb-0 text-uppercase">Komponen Yang Digunakan</h6>
    <hr />
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 row-cols-xl-4">
      <?php
      // Query untuk mengambil data dari tabel alat dengan urutan id
      $query = "SELECT * FROM alat ORDER BY id";
      $result = mysqli_query($koneksi, $query);

      // Loop melalui setiap baris hasil query
      while ($row = mysqli_fetch_assoc($result)) {
      ?>
        <div class="col">
          <div class="card" style="border-radius: 15px;">
            <img src="assets/images/uploads-alat/<?php echo $row['foto']; ?>" class="card-img-top" alt="..." width="300" height="200" style="background-color:antiquewhite;">
            <div class="card-body">
              <h6 class="card-title"><?php echo $row['nama']; ?></h6>
              <p class="card-text">
                <?php
                $deskripsi = $row['deskripsi'];
                $deskripsi = strip_tags($deskripsi);
                $deskripsi = html_entity_decode($deskripsi);
                $deskripsi = strlen($deskripsi) > 100 ? substr($deskripsi, 0, 100) . '...' : $deskripsi;
                echo "<p style='text-align: justify;'>$deskripsi</p>";
                ?>
              </p>
              <a class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#deskripsiModal<?php echo $row['id']; ?>">More Details</a>
            </div>
          </div>
        </div>
        <div class="modal fade" id="deskripsiModal<?php echo $row['id']; ?>" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content bg-success">
              <div class="modal-header">
                <h5 class="modal-title text-white"><?php echo $row['nama']; ?></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body text-white">
                <p id="deskripsiDetail"><?php echo htmlspecialchars_decode($row['deskripsi']); ?></p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
    <script>
      // Fungsi untuk menampilkan deskripsi lengkap ke dalam modal
      function tampilkanDeskripsiLengkap(deskripsi) {
        document.getElementById("deskripsiDetail").innerHTML = deskripsi;
      }
    </script>
  </div>
</div>