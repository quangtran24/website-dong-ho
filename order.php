<?php 
require_once 'layout/second_header.php';
require_once 'backend-index.php';
$masp = $q = "";
$_SESSION['cost'] = array();
if(isset($_GET['masp'])){
  $masp = $_GET['masp'];
  $_SESSION['buynow'] = $masp;
}
if(isset($_GET['q'])){
  $q = $_GET['q'];
  if($q == 'multi'){
    if($_SESSION['rights'] == "default"){
      if(isset($_SESSION['client_cart']) && count($_SESSION['client_cart']) > 1){
        $tmpArr = $_SESSION['client_cart'];
        array_shift($tmpArr);
        $x = '('.implode(',',$tmpArr).')';
        $sql = "SELECT * FROM SảnPhẩm WHERE MãSảnPhẩm IN ".$x."";
      }else {
        echo "<script>alert('Giỏ hàng trống!')</script>";
        return 0;
      }
    } else {
      $tmpArr = $_SESSION['user_cart'];
      array_shift($tmpArr);
      $x = '('.implode(',',$tmpArr).')';
      $sql = "SELECT * FROM SảnPhẩm WHERE MãSảnPhẩm IN ".$x."";
    }
  } elseif($q = 'buylikepr'){
    $tmpArr = $_SESSION['like'];
    array_shift($tmpArr);
    $x = '('.implode(',',$tmpArr).')';
    $sql = "SELECT * FROM SảnPhẩm WHERE MãSảnPhẩm IN ".$x."";
  } else {
    $_SESSION['buynow'] = $masp;
  }
} else {
  $sql = "SELECT * FROM SảnPhẩm WHERE MãSảnPhẩm = '".$masp."'";
}

$conn = connect();
mysqli_set_charset($conn, 'utf8');

$result = mysqli_query($conn, $sql);
?>

<script type="text/javascript">window.onload = function() {tinh_tien() }</script>
<form action="giaodich.php" method="POST" role="form">
  <div class="container-fluid form" style="margin-top: -23px; padding: 20px">
    <div class="row">
      <div class="col-lg-3"></div>
      <div class="col-lg-6">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>ẢNH</th><th>TÊN SẢN PHẨM</th><th>ĐƠN GIÁ</th><th>SỐ LƯỢNG</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
              <td><img src="<?php echo $row['ẢnhChính'] ?>" style="width: 70px"></td>
              <td><?php echo $row['TênSP'] ?></td>
              <td class="cost" data-val="<?php echo $row['Giá'] ?>">
                <?php echo $row['Giá']; $_SESSION['cost'][] = $row['Giá']; ?></td>
                <td width="30px"><input type="number" name="sl[]" value='1' min="0" onchange="tinh_tien()"></td>
              </tr>
              <?php } ?>
              <tr style="color: green; font-size: 18px;"><th colspan="2">Tổng tiền</th><th id="tong_tien"></th><th>VND</th></tr>
            </tbody>
          </table>
          <legend>Thông tin giao hàng</legend>
          <p class="errorMes">Giao hàng tận nhà chỉ áp dụng ở Hà Nội</p>
          <div class="form-group">
            <label for="">Tên: </label>
            <input type="text" class="form-control" id="s_ten" name="ten" value="<?php 
            if($_SESSION['rights'] == 'user'){
              echo $_SESSION['user']['Tên'];
            }
            ?>">
          </div>
          <div class="form-group">
            <label for="">Quận: </label>
            <select class="form-control" name="quan" id="s_quan">
              <option value="q1">Quận Ba Đình</option>
              <option value="q2">Quận Hoàn Kiếm</option>
              <option value="q3">Quận Hai Bà Trưng</option>
              <option value="q4">Quận Đống Đa</option>
              <option value="q5">Quận Tây Hồ</option>
              <option value="q6">Quận Cầu Giấy</option>
              <option value="q7">Quận Thanh Xuân</option>
              <option value="q8">Quận Hoàng Mai</option>
              <option value="q9">Quận Long Biên</option>
              <option value="q10">Quận Nam Từ Liêm</option>
              <option value="q11">Quận Bắc Từ Liêm</option>
              <option value="q12">Quận Hà Đông</option>
              <option value="qtd">Quận Thanh Trì</option>
              <option value="qbt">Quận Gia Lâm</option>
              <option value="qgv">Quận Đông Anh</option>
              <option value="qtb">Quận Sóc Sơn</option>
              <option value="qbt">Quận Hải Ba Trưng</option>
            </select>
          </div>
          <div class="form-group">
            <label for="">Địa chỉ: </label>
            <input type="text" class="form-control" name="dc" id="s_dc"  value="<?php 
            if($_SESSION['rights'] == 'user'){
              echo $_SESSION['user']['ĐịaChỉ'];
            }
            ?>">
          </div>
          <div class="form-group">
            <label for="">Số điện thoại: </label>
            <input type="text" class="form-control" name="sodt" id="s_sdt" value="<?php 
            if($_SESSION['rights'] == 'user'){
              echo $_SESSION['user']['SốĐiệnThoại'];
            }
            ?>">
          </div>
          <div class="form-group">
            <label for="">Phương thức thanh toán: </label>
            <select class="form-control" name="payment_method">
              <?php
              $conn = connect();
              $sql = "SELECT * FROM PhươngThứcThanhToán";
              $result = mysqli_query($conn, $sql);
              while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['PhươngThứcThanhToán'] . "'>" . $row['Tên'] . "</option>";
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="">Phương thức vận chuyển: </label>
            <select class="form-control" name="shipping_method">
              <?php
              $conn = connect();
              $sql = "SELECT * FROM VậnChuyển";
              $result = mysqli_query($conn, $sql);
              while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['MãVậnChuyển'] . "'>" . $row['TênVậnChuyển'] . "</option>";
              }
              ?>
            </select>
          </div>
          <button onclick="check_before_submit()" class="btn btn-primary" type="submit">Đặt Hàng</button><br><br>
        </form>
      </div>
    </div>
  </div>	
<?php require_once 'layout/second_footer.php' ?>
