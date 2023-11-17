<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$_SESSION['rights'] = "default";
$_SESSION['limit'] = 8;
$conn = mysqli_connect('localhost','root','','webl8') or die('Không thể kết nối!');
mysqli_set_charset($conn, 'utf8');
$_SESSION['sql'] = "SELECT * FROM SảnPhẩm";
$sql = "SELECT * FROM SảnPhẩm";
$result = mysqli_query($conn, $sql);
$_SESSION['total'] = mysqli_num_rows($result);
require_once 'backend-index.php';
if(!isset($_SESSION['client_cart'])){
  $_SESSION['client_cart'] = array();
}
$_SESSION['user_cart'] = "";
$_SESSION['user_cart'] = array();
if(isset($_SESSION['user'])){
  $_SESSION['rights'] = "user";
  $_SESSION['like'] = "";
  $_SESSION['like'] = array();
  $conn = mysqli_connect('localhost','root','','webl8') or die('Không thể kết nối!');
  mysqli_set_charset($conn, 'utf8');
  $sql = "SELECT MãSảnPhẩm, SốLượng FROM GiỏHàng WHERE MãNgườiDùng = '".$_SESSION['user']['MãNgườiDùng']."'";
  $result = mysqli_query($conn, $sql);  
  while ($row = mysqli_fetch_assoc($result)) {
    $_SESSION['user_cart'][] = $row['MãSảnPhẩm'];
  }
  $sql = "SELECT MãSảnPhẩm FROM SảnPhẩmYêuThích WHERE MãNgườiDùng = '".$_SESSION['user']['MãNgườiDùng']."'";
  $result = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_assoc($result)) {
    $_SESSION['like'][] = $row['MãSảnPhẩm'];
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title> 9XWatch - Thể hiện sự lịch lãm của phái mạnh! </title>
  <meta charset="utf-8">
  <!-- <link rel="SHORTCUT ICON"  href=> -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <script type="text/javascript" src="libs/script/script.js"></script>
  <link rel="stylesheet" href="libs/css/style.css">

  <!-- File css -> file js -> file jquery -->
  <link rel="stylesheet" href="libs/bootstrap/css/bootstrap.css">
  <script src="libs/jquery/jquery-latest.js"></script>
  <script type="text/javascript" src="libs/bootstrap/js/bootstrap.min.js"></script>

  <!-- font used in this site -->
  <link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
</head>
<body>
  <header>
    <a href="index.php"><img src="images/logo.png"><h2 class="logo"><div class="">L8Watch</div></h2></a>
    <div class="header-detail">
      <p>L8Watch, 295 Lê Duẩn, Quận Đống Đa, Thành phố Hà Nội, Việt Nam<br>
        <i>8h - 22h Hằng ngày, kể cả Ngày lễ và Chủ nhật</i>
      </p>
    </div>
  </header>