<?php
  $db_name = "doctorat";
  $link= mysqli_connect("localhost","root","",$db_name) or die ("Connection Error");

  if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
  }

  
?>
