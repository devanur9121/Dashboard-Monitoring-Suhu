<?php
include('koneksi.php');

$sql = "SELECT* FROM `data_sensor`";
$query = mysqli_query($koneksi, $sql);
while ($data = mysqli_fetch_assoc($query)) {
	$id = $data['id'];
	$data_suhu_udara = $data['data_suhu_udara'];
	$data_kelembaban_udara = $data['data_kelembaban_udara'];
	$data_kelembaban_tanah = $data['data_kelembaban_tanah'];
	$created_at = $data['created_at'];
	// Mengatur id_status berdasarkan nilai sensor
	if ($data_kelembaban_tanah > 700) {
		$id_status_soil = 1;
	} else if ($data_kelembaban_tanah >= 400 && $data_kelembaban_tanah <= 700) {
		$id_status_soil = 2;
	} else {
		$id_status_soil = 3;
	}

	$sql2 = "SELECT `nama` from `status_soil` WHERE `id_status_soil` = '$id_status_soil'";
	$query2 = mysqli_query($koneksi, $sql2);
	while ($data = mysqli_fetch_assoc($query2)) {
		$status = $data['nama'];
	}

	$sql3 = "UPDATE `data_sensor` SET `id_status_soil` = '$id_status_soil' WHERE `id` = '$id'";
	$query3 = mysqli_query($koneksi, $sql3);
	if (!$query3) {
		die(mysqli_error($koneksi));
	}

	$sql4 = "SELECT COUNT(*) AS total_user FROM users";
	$query4 = mysqli_query($koneksi, $sql4);
	if (!$query4) {
		die(mysqli_error($koneksi));
	} else {
		$data = mysqli_fetch_assoc($query4);
		$total_user = $data['total_user'];
	}
}
?>
<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
	<div class="col">
		<div class="card radius-10 bg-gradient-deepblue">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<h6 class="mb-0 text-white">Jumlah User</h6>
					<div class="ms-auto">
						<i class='bx bxs-user-detail bx-flashing fs-3 text-white'></i>
					</div>
				</div>
				<div class="progress my-2 bg-white-transparent" style="height:4px;">
					<div class="progress-bar bg-white" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
				<div class="d-flex align-items-center text-white">
					<p class="mb-0">Total</p>
					<p class="mb-0 ms-auto"><?php echo $total_user; ?> Users</p>
				</div>
			</div>
		</div>
	</div>
	<div class="col">
		<div class="card radius-10 bg-gradient-ohhappiness">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<h6 class="mb-0 text-white">Suhu & Hum. Udara</h6>
					<div class="ms-auto">
						<i class='bx bx-wind bx-flashing fs-3 text-white'></i>
					</div>
				</div>
				<div class="progress my-2 bg-white-transparent" style="height:4px;">
					<div class="progress-bar bg-white" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
				<div class="d-flex align-items-center text-white">
					<p class="mb-0">Suhu : <?php echo $data_suhu_udara; ?> C</p>
					<p class="mb-0 ms-auto">Humidity: <?php echo $data_kelembaban_udara; ?> %</p>
				</div>
			</div>
		</div>
	</div>
	<div class="col">
		<div class="card radius-10 bg-gradient-ibiza">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<h6 class="mb-0 text-white">Soil Moisture</h6>
					<div class="ms-auto">
						<i class='bx bx-water bx-flashing fs-3 text-white'></i>
					</div>
				</div>
				<div class="progress my-2 bg-white-transparent" style="height:4px;">
					<div class="progress-bar bg-white" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
				<div class="d-flex align-items-center text-white">
					<p class="mb-0">Kelembaban Tanah</p>
					<p class="mb-0 ms-auto"><?php echo $data_kelembaban_tanah; ?></p>
				</div>
			</div>
		</div>
	</div>
	<div class="col">
		<div class="card radius-10 bg-gradient-moonlit">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<h6 class="mb-0 text-white">Status Soil Moisture</h6>
					<div class="ms-auto">
						<i class='bx bx-stats bx-flashing fs-3 text-white'></i>
					</div>
				</div>
				<div class="progress my-2 bg-white-transparent" style="height:4px;">
					<div class="progress-bar bg-white" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
				<div class="d-flex align-items-center text-white">
					<p class="mb-0">Kondisi</p>
					<p class="mb-0 ms-auto"><?php echo $status; ?></p>
				</div>
			</div>
		</div>
	</div>
</div><!--end row-->
<br>
<div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-2">
	<div class="col">
		<h6 class="mb-0 text-uppercase">Monitoring Tilik Kebon</h6>
		<hr />
		<div class="card" style="background-image: url('assets/images/Kebun.jpeg'); background-size: cover; background-position: center;">
			<div class="card-body">
				<h4 class="text-center text-white">Status Soil Moisture</h4>
				<div class="text-justify text-white" style="display: flex; align-items: center;">
					<i class='bx bx-water' style='color:#ffffff; font-size: 25px; margin-right: 5px;'></i>
					<p style="margin: 0; width: 200px"> Nilai Kelembaban Tanah</p>
					<p style="margin: 0;">: <?php echo $data_kelembaban_tanah; ?></p>
				</div>
				<div class="text-justify text-white" style="display: flex; align-items: center;">
					<i class='bx bxs-time' style='color:#ffffff; font-size: 25px; margin-right: 5px;'></i>
					<p style="margin: 0; width: 200px">Tanggal & Waktu</p>
					<p style="margin: 0;">: <?php echo date('d-m-Y H:i:s', strtotime($created_at)); ?></p>
				</div>
				<div class="text-justify text-white" style="display: flex; align-items: center;">
					<i class='bx bx-stats' style='color:#ffffff; font-size: 25px; margin-right: 5px;'></i>
					<p style="margin: 0; width: 200px;"> Status Kondisi Tanah</p>
					<p style="margin: 0;">: <?php echo $status; ?></p>
				</div>
				<div class="text-justify text-white" style="display: flex; align-items: center;">
					<i class='bx bx-radar' style='color:#ffffff; font-size: 25px; margin-right: 5px;'></i>
					<?php
					if ($id_status_soil == 1) {
						echo "<p style='margin: 0; width: 200px;'> Status Kondisi Pompa</p>";
						echo "<p style='margin: 0;'>: Pompa Aktif</p>";
					} elseif ($id_status_soil == 2) {
						echo "<p style='margin: 0; width: 200px;'> Status Kondisi Pompa</p>";
						echo "<p style='margin: 0;'>: Pompa Aktif</p>";
					} else {
						echo "<p style='margin: 0; width: 200px;'> Status Kondisi Pompa</p>";
						echo "<p style='margin: 0;'>: Pompa Mati</p>";
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="col">
		<h6 class="mb-0 text-uppercase">Informasi Singkat Monitoring Tilik Kebon</h6>
		<hr />
		<div class="card">
			<div class="card-body">
				<ul class="nav nav-tabs nav-danger" role="tablist">
					<li class="nav-item" role="presentation">
						<a class="nav-link active" data-bs-toggle="tab" href="#dangerhome" role="tab" aria-selected="true">
							<div class="d-flex align-items-center">
								<div class="tab-icon"><i class='bx bx-radar font-18 me-1' undefined></i>
								</div>
								<div class="tab-title">Sensor</div>
							</div>
						</a>
					</li>
					<li class="nav-item" role="presentation">
						<a class="nav-link" data-bs-toggle="tab" href="#dangerhomes" role="tab" aria-selected="true">
							<div class="d-flex align-items-center">
								<div class="tab-icon"><i class='bx bxs-sun font-18 me-1'></i>
								</div>
								<div class="tab-title">Kering</div>
							</div>
						</a>
					</li>
					<li class="nav-item" role="presentation">
						<a class="nav-link" data-bs-toggle="tab" href="#dangerprofile" role="tab" aria-selected="false">
							<div class="d-flex align-items-center">
								<div class="tab-icon"><i class='bx bx-cloud font-18 me-1'></i>
								</div>
								<div class="tab-title">Normal</div>
							</div>
						</a>
					</li>
					<li class="nav-item" role="presentation">
						<a class="nav-link" data-bs-toggle="tab" href="#dangercontact" role="tab" aria-selected="false">
							<div class="d-flex align-items-center">
								<div class="tab-icon"><i class='bx bx-water font-18 me-1'></i>
								</div>
								<div class="tab-title">Basah</div>
							</div>
						</a>
					</li>
				</ul>
				<div class="tab-content py-3">
					<div class="tab-pane fade show active" id="dangerhome" role="tabpanel">
						<p style="text-align: justify;">
							Sensor kelembaban tanah YL-69 menggunakan prinsip resistansi tanah untuk
							mengukur tingkat kelembaban. Ketika kondisi tanah kering, resistansi tanah meningkat
							yang artinya output yang dihasilkan semakin tinggi, dan kondisi tanah basah, resistansi
							tanah menurun yang artinya output yang dihasilkan semakin rendah.
						</p>
					</div>
					<div class="tab-pane fade" id="dangerhomes" role="tabpanel">
						<p style="text-align: justify;">Kondisi tanah dianggap kering dapat terjadi ketika output dari sensor kelembaban tanah YL-69 melebihi nilai 700.</p>
					</div>
					<div class="tab-pane fade" id="dangerprofile" role="tabpanel">
						<p style="text-align: justify;">Kondisi tanah dianggap normal dapat terjadi ketika output dari sensor kelembaban tanah YL-69 berada dalam rentang nilai antara 400 hingga 700.</p>
					</div>
					<div class="tab-pane fade" id="dangercontact" role="tabpanel">
						<p style="text-align: justify;">Kondisi tanah dianggap basah dapat terjadi ketika output dari sensor kelembaban tanah YL-69 bernilai kurang dari 400.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<hr>
<div class="card">
	<div class="card-body">
		<div class="card-title">
			<h4 class="mb-0 text-md-start">Data Kelembaban Tanah</h4>
		</div>
		<hr>
		<div class="table-responsive">
			<table id="example" class="table table-striped table-bordered table-hover table-active" style="width:100%">
				<thead>
					<tr>
						<th width="5px" class="text-center">No</th>
						<th class="text-center">Waktu</th>
						<th class="text-center">Kelembaban Tanah</th>
						<th class="text-center">Kondisi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$sql = "SELECT data_sensor.*, status_soil.nama FROM data_sensor 
					INNER JOIN status_soil ON data_sensor.id_status_soil = status_soil.id_status_soil 
					ORDER BY data_sensor.created_at DESC LIMIT 5";
					$query = mysqli_query($koneksi, $sql);
					$no = 1;
					while ($row = mysqli_fetch_assoc($query)) {
					?>
						<tr class="text-center">
							<td><?php echo $no; ?></td>
							<td><?php echo date('d-m-Y || H:i:s', strtotime($row['created_at'])); ?></td>
							<td><?php echo $row['data_kelembaban_tanah']; ?></td>
							<td><?php echo $row['nama']; ?></td>
						</tr>
					<?php $no++;
					} ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<br>


<script type="text/javascript">
	window.setTimeout(function() {
		window.location.reload();
	}, 20000);
</script>