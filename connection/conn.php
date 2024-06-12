<?php
$conn = mysqli_connect("localhost","root","","se");

if(mysqli_connect_error()){
  echo "failed to connect". mysqli_connect_error();
}
?>