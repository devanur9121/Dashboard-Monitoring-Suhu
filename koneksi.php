<?php

$koneksi = mysqli_connect('localhost', 'root', '', 'tilik_kebon');

if (!$koneksi) {
  die("Error koneksi " . mysqli_connect_errno());
}
