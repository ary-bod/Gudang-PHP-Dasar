<?php

include('connection.php');

if ($_GET) {
  $id = $_GET['id'];
  $query_delete = "DELETE FROM books WHERE id=$id";

  if (mysqli_query($conn, $query_delete)) {
    echo true;
  } else {
    echo "Error deleting record: " . mysqli_error($conn);
  }
}
