<?php

session_start();
// mysqli_connect('nama host', 'username host', 'password host', 'database');
$conn = mysqli_connect("localhost", "root", "root", "warehouse");

// apabila koneksi gagal, maka akan muncul error
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL : " . mysqli_connect_error();
  exit();
}
