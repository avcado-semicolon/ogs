<?php
include './connection/db_connection.php';
//include the name
if(isset($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $user = $dataObj->selectUserById($id);
}
else {
    header("Location:login.php");
}

$_SESSION = [];
session_unset();
session_destroy();
header("Location: login.php");
?>
