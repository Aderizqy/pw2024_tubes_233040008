<?php

$conn = mysqli_connect("localhost", "root", "", "pw2024_tubes_233040008");

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
