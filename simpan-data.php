<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = ""; // Isi dengan password database Anda jika ada
$dbname = "tilik_kebon";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get data from the request
$data_suhu_udara = $_GET['data_suhu_udara'];
$data_kelembaban_udara = $_GET['data_kelembaban_udara'];
$data_kelembaban_tanah = $_GET['data_kelembaban_tanah'];

// Prepare SQL statement to insert sensor data into the database
$sql = "INSERT INTO data_sensor (data_suhu_udara, data_kelembaban_udara, data_kelembaban_tanah, created_at) 
        VALUES ('$data_suhu_udara', '$data_kelembaban_udara', '$data_kelembaban_tanah', NOW())";

// Execute SQL statement
if (mysqli_query($conn, $sql)) {
  echo "Data successfully saved";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close database connection
mysqli_close($conn);
?>