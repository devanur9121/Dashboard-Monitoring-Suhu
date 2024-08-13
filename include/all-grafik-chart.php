<?php
// Langkah 1: Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$database = "tilik_kebon";

$conn = mysqli_connect($servername, $username, $password, $database);

// Cek koneksi
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

// Langkah 2: Ambil data dari database
$sql = "SELECT created_at, data_suhu_udara, data_kelembaban_udara, data_kelembaban_tanah FROM data_sensor ORDER BY created_at;";
$result = mysqli_query($conn, $sql);

$data_suhu_udara = array();
$data_kelembaban_udara = array();
$data_kelembaban_tanah = array();
$timestamps = array(); // Menyimpan waktu lengkap untuk tooltip

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    array_push($timestamps, $row['created_at']); // Simpan waktu lengkap
    array_push($data_suhu_udara, (float)$row['data_suhu_udara']);
    array_push($data_kelembaban_udara, (float)$row['data_kelembaban_udara']);
    array_push($data_kelembaban_tanah, (float)$row['data_kelembaban_tanah']);
  }
}

mysqli_close($conn);
?>
<div class="page-content-wrapper">
  <div class="page-content">
    <div class="row">
      <div class="col-xl-9 mx-auto">
        <div class="card">
          <div class="card-body">
            <div id="chart11"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- highcharts js -->
<script src="assets/plugins/highcharts/js/highcharts.js"></script>
<script src="assets/plugins/highcharts/js/highcharts-more.js"></script>
<script src="assets/plugins/highcharts/js/variable-pie.js"></script>
<script src="assets/plugins/highcharts/js/solid-gauge.js"></script>
<script src="assets/plugins/highcharts/js/highcharts-3d.js"></script>
<script src="assets/plugins/highcharts/js/cylinder.js"></script>
<script src="assets/plugins/highcharts/js/funnel3d.js"></script>
<script src="assets/plugins/highcharts/js/exporting.js"></script>
<script src="assets/plugins/highcharts/js/export-data.js"></script>
<script src="assets/plugins/highcharts/js/accessibility.js"></script>
<script src="assets/plugins/highcharts/js/highcharts-custom.script.js"></script>

<script>
  Highcharts.chart('chart11', {
    chart: {
      type: 'area',
    },
    credits: {
      enabled: false
    },
    title: {
      text: 'Temperature, Humidity, & Soil Moisture'
    },
    xAxis: {
      categories: <?php echo json_encode(array_map(function ($timestamp) {
                    return date('d M Y', strtotime($timestamp));
                  }, $timestamps)); ?>,
      allowDecimals: false,
      accessibility: {
        rangeDescription: 'Range: 22-02-2024 to 12-06-2024.'
      }
    },
    yAxis: {
      title: {
        text: 'Nilai Sensor'
      }
    },
    tooltip: {
      formatter: function() {
        var pointIndex = this.point.index;
        var timestamp = <?php echo json_encode($timestamps); ?>[pointIndex];
        var date = new Date(timestamp);
        var monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
          "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];
        var formattedTimestamp = date.getDate() + ' ' + monthNames[date.getMonth()] + ' ' + date.getFullYear() + ' ' + ('0' + date.getHours()).slice(-2) + ':' + ('0' + date.getMinutes()).slice(-2) + ':' + ('0' + date.getSeconds()).slice(-2);
        return '<b>' + this.series.name + '</b><br/>' +
          'Nilai Data Yang Terdeteksi: <b>' + this.y + '</b><br/>' +
          'Waktu: <b>' + formattedTimestamp + '</b>';
      }
    },
    plotOptions: {
      area: {
        marker: {
          radius: 5,
          states: {
            hover: {
              enabled: true
            }
          }
        }
      }
    },
    series: [{
      name: 'Suhu Udara',
      data: <?php echo json_encode($data_suhu_udara); ?>,
      color: {
        linearGradient: {
          x1: 0,
          x2: 0,
          y1: 0,
          y2: 1
        },
        stops: [
          [0, 'rgba(255, 0, 0, 0.7)'],
          [1, 'rgba(255, 0, 0, 0.4)']
        ]
      }
    }, {
      name: 'Kelembaban Udara',
      data: <?php echo json_encode($data_kelembaban_udara); ?>,
      color: {
        linearGradient: {
          x1: 0,
          x2: 0,
          y1: 0,
          y2: 1
        },
        stops: [
          [0, 'rgba(0, 255, 0, 0.9)'], // Hijau dengan opasitas 0.9 pada awal
          [1, 'rgba(0, 255, 0, 0.2)'] // Hijau dengan opasitas 0.2 pada akhir
        ]
      }
    }, {
      name: 'Kelembaban Tanah',
      data: <?php echo json_encode($data_kelembaban_tanah); ?>,
      color: {
        linearGradient: {
          x1: 0,
          x2: 0,
          y1: 0,
          y2: 1
        },
        stops: [
          [0, 'rgba(139, 69, 19, 0.8)'],
          [1, 'rgba(139, 69, 19, 0.4)']
        ]
      }
    }]
  });
</script>
<script type="text/javascript">
	window.setTimeout(function() {
		window.location.reload();
	}, 20000);
</script>