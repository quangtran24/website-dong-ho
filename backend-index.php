<?php 

$conn;
function connect(){
	$conn = mysqli_connect('localhost','root','','webl8') or die('Không thể kết nối!');
	/*$conn = mysqli_connect("localhost","k2739nvdu_qlbh","cuchuoi258","k2739nvdu_qlbh") or die('Không thể kết nối!');*/
	return $conn;
}
function disconnect($conn){
	mysqli_close($conn);
}

// Sản phẩm mới nhất, chạy ngang đầu web
function get_3_newest(){
	$conn = connect();
	mysqli_set_charset($conn, 'utf8');
	$sql = "SELECT * FROM SảnPhẩm ORDER BY NgàyNhập DESC LIMIT 4";
	$result = mysqli_query($conn, $sql);
	$i = 1;
	while ($row = mysqli_fetch_assoc($result)) {
		if($i == 3){ ?>
		<div class='item active'>
			<img src="<?php echo $row['ẢnhChính'] ?>">
			<div class='container'>
				<div class='carousel-caption'>
					<p><a class='btn btn-md btn-primary' href='order.php?masp=<?php echo $row['MãSảnPhẩm'] ?>' role='button'>Mua ngay</a></p>
				</div>
			</div>
		</div>
		<?php } else { ?>
		<div class='item'>
			<img src="<?php echo $row['ẢnhChính'] ?>">
			<div class='container'>
				<div class='carousel-caption'>
					<p><a class='btn btn-md btn-primary' href='order.php?masp=<?php echo $row['MãSảnPhẩm'] ?>' role='button'>Mua ngay</a></p>
				</div>
			</div>
		</div>
		<?php }
		$i++;
	}
	disconnect($conn);
}

// Mua nhiều nhất
function get_buy_the_most(){
	$conn = connect();
	mysqli_set_charset($conn, 'utf8');
	$sql = "SELECT * FROM SảnPhẩm sp, DanhMục dm WHERE sp.MãDanhMục = dm.MãDanhMục ORDER BY sp.LượtMua DESC LIMIT 8";
	$result = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_assoc($result)) { ?>
	<div class='product-container' onclick="hien_sanpham('<?php echo $row['MãSảnPhẩm']?>')">
		<a data-toggle='modal' href='sanpham.php?masp=<?php echo $row['MãSảnPhẩm'] ?>' data-target='#modal-id'>
			<div style="text-align: center;" class='product-img'>
				<!-- <div class='rate'>
					for($i = 0; $i < 5; $i++){
						?><h6 class="glyphicon glyphicon-star"></h6>
					}
				</div> -->
				<img src='<?php echo $row['ẢnhChính'] ?>'>
			</div>
			<div class='product-info'>
				<h4><b><?php echo $row['TênSP'] ?></b></h4>
				<b class='price'>Giá : <?php echo $row['Giá'] ?> VND</b>
				<div class='buy'>
					<a onclick="like_action('<?php echo $row['MãSảnPhẩm'] ?>')" class='btn btn-default btn-md unlike-container  <?php
					if($_SESSION['rights'] == 'user'){
						if(in_array($row['MãSảnPhẩm'],$_SESSION['like'])){
							echo 'liked';
						}
					}
					?>'>
					<i class='glyphicon glyphicon-heart unlike'></i>
				</a>
				<a class='btn btn-primary btn-md cart-container <?php 
				if($_SESSION['rights'] == "default"){
					if(in_array($row['MãSảnPhẩm'],$_SESSION['client_cart'])){
						echo 'cart-ordered';
					} 
				} else {
					if(in_array($row['MãSảnPhẩm'],$_SESSION['user_cart'])){
						echo 'cart-ordered';
					}
				} ?> '  onclick="addtocart_action('<?php echo $row['MãSảnPhẩm'] ?>')">
				<i title='Thêm vào giỏ hàng' class='glyphicon glyphicon-shopping-cart cart-item'></i></a>
				<a class="snip0050" href='order.php?masp=<?php echo $row['MãSảnPhẩm'] ?>'><span>Mua ngay</span><i class="glyphicon glyphicon-ok"></i></a>
			</div>
		</div>
	</a></div>
	<?php

}
disconnect($conn);
}
// gần đây nhất
function get_the_most_recent(){
	$conn = connect();
	mysqli_set_charset($conn, 'utf8');
	$sql = "SELECT * FROM SảnPhẩm sp, DanhMục dm WHERE sp.MãDanhMục = dm.MãDanhMục ORDER BY sp.NgàyNhập DESC LIMIT 8";
	$result = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_assoc($result)) {?>
	<div class='product-container' onclick="hien_sanpham('<?php echo $row['MãSảnPhẩm']?>')">
		<a data-toggle='modal' href='sanpham.php?masp=<?php echo $row['MãSảnPhẩm'] ?>' data-target='#modal-id'>
			<div style="text-align: center;" class='product-img'>
				<img src='<?php echo $row['ẢnhChính'] ?>'>
			</div>
			<div class='product-info'>
				<h4><b><?php echo $row['TênSP'] ?></b></h4>
				<b class='price'>Giá gần đây nhất: <?php echo $row['Giá'] ?> VND</b>
				<div class='buy'>
					<a onclick="like_action('<?php echo $row['MãSảnPhẩm'] ?>')" class='btn btn-default btn-md unlike-container  <?php
					if($_SESSION['rights'] == 'user'){
						if(in_array($row['MãSảnPhẩm'],$_SESSION['like'])){
							echo 'liked';
						}
					}
					?>'>
					<i class='glyphicon glyphicon-heart unlike'></i>
				</a>
				<a class='btn btn-primary btn-md cart-container <?php 
				if($_SESSION['rights'] == "default"){
					if(in_array($row['MãSảnPhẩm'],$_SESSION['client_cart'])){
						echo 'cart-ordered';
					} 
				} else {
					if(in_array($row['MãSảnPhẩm'],$_SESSION['user_cart'])){
						echo 'cart-ordered';
					}
				} ?> '  onclick="addtocart_action('<?php echo $row['MãSảnPhẩm'] ?>')">
				<i title='Thêm vào giỏ hàng' class='glyphicon glyphicon-shopping-cart cart-item'></i></a>
				<a class="snip0050" href='order.php?masp=<?php echo $row['MãSảnPhẩm'] ?>'><span>Mua ngay</span><i class="glyphicon glyphicon-ok"></i></a>
			</div>
		</div>
	</a></div>
	<?php
}
disconnect($conn);
}

//Xu ly user


$q = "";
if(isset($_POST['query'])){
	$q = $_POST['query'];
}
$m = "";
if(isset($_POST['masp_to_display'])){
	$m = $_POST['masp_to_display'];
}

switch ($q) {
	case 'dang_nhap':
		signin();
		break;
	case 'dang_xuat':
		signout();
		break;
	case 'dang_ky':
		signup();
		break;
	case 'addtocart_action':
		addtocart_action();
		break;
	case 'hien_sanpham':
		hien_sanpham($m);
		break;
	case 'tinh_tien':
		tinh_tien();
		break;
	case 'like':
		like();
		break;
	case 'thongtin_user':
		thongtin_user();
		break;
	case 'php_edit_info_db':
		php_edit_info_db();
		break;
}

function validate_input_sql($conn, $str){
	return mysqli_real_escape_string($conn, $str);
}

function signin(){
	session_start();
	$conn = connect();
	mysqli_set_charset($conn, 'utf8');
	$un = $pw = $isR = "";
	if(isset($_POST['un'])){
		$un = $_POST['un'];
	}
	if(isset($_POST['isR'])){
		$isR = $_POST['isR'];
	}
	if(isset($_POST['pw'])){
		$pw = $_POST['pw'];
	}
	if($un == "" || $pw == ""){
		echo "<div class='errorMes'>Không được để trống!</div>";
		require_once 'signIn.php';
		return 0;
	}
	$sql = "SELECT * FROM NgườiDùng WHERE TênTàiKhoản = '".$un."' AND MậtKhẩu = '".$pw."'";
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result) == 0){
		echo "<div class='errorMes'>Sai tên tài khoản hoặc mật khẩu!</div>";
		require_once 'signIn.php';
		return 0;
	} else {
		while ($row = mysqli_fetch_assoc($result)) {
			if($row['quyen'] == 1){
				$_SESSION['admin'] = true;
				echo "<script>window.location.replace('admin/foradmin.php');</script>";
				return 0;
			}
			if($isR == "true"){
				echo "vao roi ne";
				$cookie_name = "usidtf";
				$cookie_value = $row['MãNgườiDùng'];
				setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
			}
			$_SESSION['user'] = $row;
			echo "<script>location.reload()</script>";
		}
	}
}


function signout(){
	session_start();
	session_destroy();
	setcookie("usidtf", "", time() - (86400 * 30), "/");
	echo "<script>location.reload()</script>";
}

function signup(){
	session_start();
	$conn = connect();
	mysqli_set_charset($conn, 'utf8');
	$name = $un = $pw = $cpw = $addr = $tel = $email = "";
	if(isset($_POST['name'])){
		$name = $_POST['name'];
	}
	if(isset($_POST['un'])){
		$un = $_POST['un'];
	}
	if(isset($_POST['pw'])){
		$pw = $_POST['pw'];
	}
	if(isset($_POST['cpw'])){
		$cpw = $_POST['cpw'];
	}
	if(isset($_POST['addr'])){
		$addr = $_POST['addr'];
	}
	if(isset($_POST['tel'])){
		$tel = $_POST['tel'];
	}
	if(isset($_POST['email'])){
		$email = $_POST['email'];
	}

	if($name == "" ||$un == "" || $pw == "" || $cpw == "" || $addr == "" || $tel == "" || $email == ""){
		echo "<div class='errorMes'>Không được để trống!</div>";
		require_once 'signUp.php';
		return 0;
	}

	if($pw != $cpw){
		echo "<div class='errorMes'>Mật khẩu nhập lại không trùng khớp!</div>";
		require_once 'signUp.php';
		return 0;
	}

	$name = validate_input_sql($conn, $name);
	$un = validate_input_sql($conn,$un);
	$pw = validate_input_sql($conn,$pw);
	$addr = validate_input_sql($conn,$addr);
	$tel = validate_input_sql($conn,$tel);
	$email = validate_input_sql($conn,$email);

	$sqla = "SELECT TênTàiKhoản FROM NgườiDùng WHERE TênTàiKhoản = '".$un."'";
	$resulta = mysqli_query($conn, $sqla);
	if(mysqli_num_rows($resulta) > 0){
		echo "<div class='errorMes'>Tên tài khoản đã tồn tại!</div>";
		require_once 'signUp.php';
		return 0;
	}

	$sql = "INSERT INTO NgườiDùng (MãNgườiDùng, Tên, TênTàiKhoản, Email, MậtKhẩu, ĐịaChỉ, SốĐiệnThoại) 
			VALUES ('', '".$name."','".$un."','".$email."','".$pw."','".$addr."','".$tel."')";
	$result = mysqli_query($conn, $sql);
	if(!$result){
		echo "<div class='errorMes'>".mysqli_error($conn)."</div>";	
		require_once 'signUp.php';
		return 0;
	} else {
		$sql = "SELECT * FROM NgườiDùng WHERE TênTàiKhoản = '".$un."'";
		$result = mysqli_query($conn, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			$_SESSION['user'] = $row;
			echo "<script>location.reload()</script>";
		}
	}
}


// ------------------------------------
function addtocart_action(){
	session_start();
	$masp = "";
	if(isset($_POST['masp'])){
		$masp = $_POST['masp'];
	}	
	$pos = $cart_name = "";
	if($_SESSION['rights'] == "default"){
		$cart_name = "client_cart";
	} else {
		$cart_name = "user_cart";
	}
	$pos = array_search($masp, $_SESSION[$cart_name]);
	if($pos !== false){
		unset($_SESSION[$cart_name][$pos]);
		echo count($_SESSION[$cart_name])-1;
	} else {
		$_SESSION[$cart_name][] = $masp;
		echo count($_SESSION[$cart_name])-1;
	}
	
	if($_SESSION['rights'] == "user"){
		$conn = connect();
		$sql = "";
		if($pos !== false){
			$sql = "DELETE FROM GiỏHàng WHERE MãNgườiDùng = '".$_SESSION['user']['MãNgườiDùng']."' AND MãSảnPhẩm = '".$masp."'"; 
		} else {
			$sql = "INSERT INTO GiỏHàng (MãNgườiDùng, MãSảnPhẩm, SốLượng) VALUES ('".$_SESSION['user']['MãNgườiDùng']."','".$masp."','1')";
		}
		$result = mysqli_query($conn, $sql);
		if(!$result){echo "Lỗi thêm giỏ hàng";}
	}
}

function hien_sanpham($m){
	$_GET['masp'] = $m;
	require_once 'sanpham.php';
}

function like(){
	session_start();
	$masp = "";
	if(isset($_POST['masp_to_like'])){
		$masp = $_POST['masp_to_like'];
	}
	$pos = "";
	$pos = array_search($masp, $_SESSION['like']);
	if($pos !== false){
		unset($_SESSION['like'][$pos]);
		echo count($_SESSION['like'])-1;
	} else {
		$_SESSION['like'][] = $masp;
		echo count($_SESSION['like'])-1;
	}
	$conn = connect();

	$sql = "";
	if($pos !== false){
		$sql = "DELETE FROM SảnPhẩmYêuThích WHERE MãNgườiDùng = '".$_SESSION['user']['MãNgườiDùng']."' AND MãSảnPhẩm = '".$masp."'"; 
	} else {
		$sql = "INSERT INTO SảnPhẩmYêuThích (MãNgườiDùng, MãSảnPhẩm) VALUES ('".$_SESSION['user']['MãNgườiDùng']."','".$masp."')";
	}
	$result = mysqli_query($conn, $sql);
	if(!$result){echo "Lỗi thêm sản phẩm yêu thích";}
}
//-----------------------------------
function thongtin_user(){
	session_start();
	?>
	<script type="text/javascript">
		function edit_info(){
			$($('#info-user').children()[2]).replaceWith("<h4>Tên: <input type='text' id='name2c'></h4>");
			$($('#info-user').children()[4]).replaceWith("<h4>Mật khẩu: <input type='password' id='pw2c'></h4>");
			$($('#info-user').children()[5]).replaceWith("<h4>Địa chỉ: <input type='text' id='dc2c'></h4>");
			$($('#info-user').children()[6]).replaceWith("<h4>Số điện thoại: <input type='text' id='sdt2c'></h4>");
			$($('#info-user').children()[7]).replaceWith("<h4>Email: <input type='text' id='email2c'></h4>");
			$('#edit-btn').replaceWith("<div class='btn btn-success' onclick='ajax_edit_info()' id='edit-btn'>Lưu lại</div>");
			$('#edit-btn').after("<div class='btn btn-primary' style='margin-left:10px'  onclick='call_to_thongtin()' id='edit-btn'>Hủy bỏ</div>");
		}
		function ajax_edit_info(){
			var ten = $('#name2c').val();
			var mk = $('#pw2c').val();
			var dc = $('#dc2c').val();
			var sdt = $('#sdt2c').val();
			var email = $('#email2c').val();
			$.ajax({
				url : "backend-index.php",
				type : "post",
				dataType:"text",
				data : {
					query: 'php_edit_info_db', ten, mk, dc, sdt, email
				},
				success : function (result){
					$('#edit-info-error').html(result);
				}
			});
		}
	</script>
	<div class="contaner">
		<div class="row" style="margin: 0!important">
			<div class="col-md-3"></div>
			<div class="col-md-6" style="margin-bottom: 20px" id="info-user">
				<div id="edit-info-error"></div>
				<h4>ID: <span class="label label-default"><?php echo $_SESSION['user']['MãNgườiDùng'] ?></span></h4>
				<h4>Tên: <span class="label label-primary"><?php echo $_SESSION['user']['Tên'] ?></span></h4>
				<h4>Tên tài khoản: <span class="label label-primary"><?php echo $_SESSION['user']['TênTàiKhoản'] ?></span></h4>
				<h4>Mật khẩu: <span class="label label-primary">**********</span></h4>
				<h4>Địa chỉ: <span class="label label-primary"><?php echo $_SESSION['user']['ĐịaChỉ'] ?></span></h4>
				<h4>Số điện thoại: <span class="label label-primary"><?php echo $_SESSION['user']['SốĐiệnThoại'] ?></span></h4>
				<h4>Email: <span class="label label-primary"><?php echo $_SESSION['user']['Email'] ?></span></h4>
				
				<div class="btn btn-success" onclick="edit_info()" id='edit-btn'>Chỉnh sửa thông tin</div>
			</div>
		</div>
	</div>
	
	<?php
}

function php_edit_info_db(){
	session_start();
	$ten = $mk = $dc = $sdt = $email = "";
	if(isset($_POST['ten'])){
		$ten = $_POST['ten'];
	}
	if(isset($_POST['dc'])){
		$dc = $_POST['dc'];
	}
	if(isset($_POST['sdt'])){
		$sdt = $_POST['sdt'];
	}
	if(isset($_POST['email'])){
		$email = $_POST['email'];
	}
	if(isset($_POST['mk'])){
		$mk = $_POST['mk'];
	}
	$n = [];
	$data = [];
	$set = '';
	if($ten != ""){
		$n[] = 'Tên';
		$data[] = validate_input_sql($ten);
	}
	if($mk != ""){
		$n[] = 'MậtKhẩu';
		$data[] = validate_input_sql($mk);
	}
	if($dc != ""){
		$n[] = 'ĐịaChỉ';
		$data[] = validate_input_sql($dc);
	}
	if($sdt != ""){
		$n[] = 'SốĐiệnThoại';
		$data[] = validate_input_sql($sdt);
	}
	if($email != ""){
		$n[] = 'Email';
		$data[] = validate_input_sql($email);
	}
	for($i = 0; $i < count($n); $i++){
		$set .= $n[$i]."='".$data[$i]."',";
		$_SESSION['user'][$n[$i]] = $data[$i];
	}
	$set = trim($set, ',');
	$sql = "UPDATE NgườiDùng SET $set WHERE MãNgườiDùng = '".$_SESSION['user']['MãNgườiDùng']."'";
	$conn = connect();
	if(!mysqli_query($conn, $sql)){
		echo "<span class='label label-danger'>Đã xảy ra lỗi trong quá trình gửi dữ liệu, vui lòng thử lại!</span>";
	} else {
		?> <script type="text/javascript">alert("Thay đổi thông tin THÀNH CÔNG!");location.reload()</script> <?php
	}
}


