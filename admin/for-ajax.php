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
function validate_input_sql($conn, $str){
	return mysqli_real_escape_string($conn, $str);
}
$q = "";
if(isset($_POST['q'])){
	$q = $_POST['q'];
}
$fname = "";
if(isset($_GET['fname'])){
	$fname = $_GET['fname'];
}
if($fname == "load_more"){
	load_more();
}
if($fname == "load_more_gd"){
	load_more_gd();
}
//--------------------
function load_more(){
	session_start();
	$cr = '';
	if(isset($_GET['current'])){$cr = $_GET['current'];}
	$st = ($cr+1)*$_SESSION['limit'];
	if($st >= $_SESSION['total'] - $_SESSION['limit']){
		echo "hetcmnrdungbamnua";
	}
	$sql = "SELECT * FROM SảnPhẩm s, DanhMục d WHERE s.MãDanhMục = d.MãDanhMục ORDER BY s.NgàyNhập DESC LIMIT ".$st.",".$_SESSION['limit']."";
	$conn = mysqli_connect('localhost','root','','webl8') or die('Không thể kết nối!');
	mysqli_set_charset($conn, 'utf8');
	$result = mysqli_query($conn, $sql);
	$i = $st;
	while ($row = mysqli_fetch_assoc($result)){
		?>
		<tr>
			<td><?php echo ++$i ?></td>
			<td><?php echo $row['TênSP'] ?></td>
			<td><?php echo $row['Giá'] ?></td>
			<td><?php echo $row['BảoHành'] ?></td>
			<td><?php echo $row['TrọngLượng'] ?></td>
			<td><?php echo $row['ChấtLiệu'] ?></td>
			<td><?php echo $row['ChốngNước'] ?></td>
			<td><?php echo $row['NăngLượng'] ?></td>
			<td><?php echo $row['LoạiBảoHành'] ?></td>
			<td><?php echo $row['KíchThước'] ?></td>
			<td><?php echo $row['Màu'] ?></td>
			<td><?php echo $row['DànhCho'] ?></td>
			<td><?php echo $row['PhụKiện'] ?></td>
			<td><?php echo $row['KhuyếnMãi'] ?></td>
			<td><?php echo $row['TìnhTrạng'] ?></td>
			<td><?php echo $row['Tên'] ?></td>
			<td><img src="../<?php echo $row['ẢnhChính'] ?>"></td>
			<td><?php echo $row['NgàyNhập'] ?></td>
			<td><span class="btn btn-warning" onclick="display_edit_sanpham('<?php echo $row['MãSảnPhẩm'] ?>')">Sửa</span></td>
			<td><span class="btn btn-danger" onclick="xoa_sp('<?php echo $row['MãSảnPhẩm'] ?>')">Xóa</span></td>
		</tr>
		<?php
	}
}

function load_more_gd(){
	session_start();
	$cr = $stt = '';
	if(isset($_GET['current'])){$cr = $_GET['current'];}
	if(isset($_GET['stt'])){$stt = $_GET['stt'];}
	$st = ($cr+1)*$_SESSION['limit'];
	
	if($stt == "dagd"){
		if($st > $_SESSION['gd_dagd'] + 1){
			echo "hetcmnrdungbamnua";
			return;
		}
		$sql = "SELECT * FROM ĐơnHàng WHERE TrạngThái = 'Đã giao hàng' LIMIT ".$st.",".$_SESSION['limit']."";
	} elseif ($stt == "chuagd") {
		if($st > $_SESSION['gd_chua'] + 1){
			echo "hetcmnrdungbamnua";
			return;
		}
		$sql = "SELECT * FROM ĐơnHàng WHERE TrạngThái = 'Chưa giao hàng' LIMIT ".$st.",".$_SESSION['limit']."";
	} else {
		if($st > $_SESSION['gd_all'] + 1){
			echo "hetcmnrdungbamnua";
			return;
		}
		$sql = "SELECT * FROM ĐơnHàng LIMIT ".$st.",".$_SESSION['limit']."";
	}
	$conn = mysqli_connect('localhost','root','','webl8') or die('Không thể kết nối!');
	mysqli_set_charset($conn, 'utf8');
	$result = mysqli_query($conn, $sql);
	$i = $st;
	while ($row = mysqli_fetch_assoc($result)){
		?>
		<tr>
			<td><?php echo ++$i ?></td>
			<td>
				<?php 
				if($row['TrạngThái'] == 'Chưa giao hàng'){
					echo "<h4 class='label label-danger'>Chưa giao hàng</h4>";
				} else {
					echo "<h4 class='label label-success'>Đã giao hàng</h4>";
				} 
				?>
			</td>
			<td><?php echo $row['MãNgườiDùng'] ?></td>
			<td><?php echo $row['NgàyĐặt'] ?></td>
			<td><?php echo $row['TổngSốTiền'] ?></td>
			<td><?php echo $row['TrạngThái'] ?></td>
			<td>
				<?php if($row['TrạngThái'] == 'Chưa giao hàng'){ ?>
				<span class="btn btn-success" onclick="xong('<?php echo $row['MãĐơnHàng'] ?>')">Xong</span>
				<?php } ?>
			</td>
		</tr>
		<?php
	}
}
//---------------------

switch ($q) {
	case 'them_sp':
	them_sp();
	break;
	case 'xoa_sp':
	xoa_sp();
	break;
	case 'them_dm':
	them_dm();
	break;
	case 'xoa_dm':
	xoa_dm();
	break;
	case 'giaodich_chuagh':
	giaodich_chuagh();
	break;
	case 'giaodich_dagh':
	giaodich_dagh();
	break;
	case 'giaodich_tatcagh':
	giaodich_tatcagh();
	break;
	case 'giaodich_xong':
	giaodich_xong();
	break;
	case 'them_admin':
	them_admin();
	break;
	case 'xoa_taikhoan':
	xoa_taikhoan();
	break;
	case 'sua_sp':
	sua_sp();
	break;
}

function them_sp(){
	$conn = connect();
	$tensp = validate_input_sql($conn, $_POST['tensp']);
	$gia = validate_input_sql($conn, $_POST['gia']);
	$baohanh = validate_input_sql($conn, $_POST['baohanh']);
	$trongluong = validate_input_sql($conn, $_POST['trongluong']);
	$chatlieu = validate_input_sql($conn, $_POST['chatlieu']);
	$chongnuoc = validate_input_sql($conn, $_POST['chongnuoc']);
	$nangluong = validate_input_sql($conn, $_POST['nangluong']);
	$loaibh = validate_input_sql($conn, $_POST['loaibh']);
	$kichthuoc = validate_input_sql($conn, $_POST['kichthuoc']);
	$mau = validate_input_sql($conn, $_POST['mau']);
	$danhcho = validate_input_sql($conn, $_POST['danhcho']);
	$phukien = validate_input_sql($conn, $_POST['phukien']);
	$khuyenmai = validate_input_sql($conn, $_POST['khuyenmai']);
	$tinhtrang = validate_input_sql($conn, $_POST['tinhtrang']);
	$madm = validate_input_sql($conn, $_POST['madm']);
	$anhchinh = validate_input_sql($conn, $_POST['anhchinh']);
	mysqli_set_charset($conn,'utf8');
	$now = date('Y-m-d H:i:s');
	$luotmua = rand(200, 1000);
	$luotxem = rand(1001, 5000);
	if($tensp == "" || $gia == ""){
		echo "Tên và giá không được để trống!";
		return 0;	
	}
	$sql = "INSERT INTO SảnPhẩm (TênSP, Giá, BảoHành, TrọngLượng, ChấtLiệu, ChốngNước, NăngLượng, LoạiBảoHành, KíchThước, Màu, DànhCho, PhụKiện, KhuyếnMãi, TìnhTrạng, MãDanhMục, ẢnhChính, LượtMua, LượtXem, NgàyNhập) 
	VALUES ('$tensp', '$gia', $baohanh, $trongluong, '$chatlieu', $chongnuoc, '$nangluong', '$loaibh', '$kichthuoc', '$mau', '$danhcho', '$phukien', '$khuyenmai', '$tinhtrang', $madm, '$anhchinh', $luotmua, $luotxem, '$now')";
	if(mysqli_query($conn, $sql)){
		echo "<script>alert('Thêm thành công sản phẩm!')</script>";
	} else {
		echo "<script>alert('Lỗi thêm vào cơ sở dữ liệu, xin nhập lại!')</script>";
	}
	disconnect($conn);
}

function xoa_sp(){
	$masp = $_POST['masp_xoa'];
	$conn = connect();
	$sql = "DELETE FROM SảnPhẩm WHERE MãSảnPhẩm = $masp";
	if(mysqli_query($conn, $sql)){
		echo "<script>alert('Xóa thành công!')</script>";
	} else {
		echo "<script>alert('Đã xảy ra lỗi!')</script>";
	}
	disconnect($conn);
}
//-----------
function them_dm(){
	$tendm = $_POST['tendm'];
	$xuatsu = $_POST['xuatsu'];
	$conn = connect();
	$sql = "INSERT INTO DanhMục (Tên, MôTả) VALUES ('$tendm', '$xuatsu')";
	if(mysqli_query($conn, $sql)){
		echo "<script>alert('Thêm danh mục thành công!')</script>";
	} else {
		echo "<script>alert('Đã xảy ra lỗi!')</script>";
	}
	disconnect($conn);
}

function xoa_dm(){
	$madm = $_POST['madm_xoa'];
	$conn = connect();
	$sql = "DELETE FROM DanhMục WHERE MãDanhMục = $madm";
	if(mysqli_query($conn, $sql)){
		echo "<script>alert('Xóa thành công!')</script>";
	} else {
		echo "<script>alert('Lỗi! Bạn phải xóa hết những sản phẩm thuộc danh mục này trước!')</script>";
	}
	disconnect($conn);
}

//Danh sach giao dich sap xep
function giaodich_chuagh(){
	session_start();
	$conn = connect();
	mysqli_set_charset($conn, 'utf8');
	echo $_SESSION['limit'];
	$sql = "SELECT * FROM ĐơnHàng WHERE TrạngThái = 'Chưa giao hàng' LIMIT ".$_SESSION['limit'];
	$i = 1;
	$result = mysqli_query($conn, $sql); ?>

	<thead>
		<tr>
			<th>STT</th> <th>Tình trạng</th> <th>Tên</th>
			<th>Quận</th> <th>Địa chỉ</th> <th>Số DT</th>
			<th>Tổng tiền</th> <th>Ngày</th> <th>isDone</th>
		</tr>
	</thead>
	<tbody id="gd_chuagd_body">

		<?php while ($row = mysqli_fetch_assoc($result)){?>


		<tr>
			<td><?php echo $i++ ?></td>
			<td><?php if($row['TrạngThái'] == 'Đã giao hàng') echo "<h4 class='label label-success'>Đã giao hàng</h4>"; else echo "<h4 class='label label-danger'>Chưa giao hàng</h4>";  ?></td>
			<td><?php echo $row['Tên'] ?></td> <td><?php echo $row['user_dst'] ?></td>
			<td><?php echo $row['ĐịaChỉ'] ?></td> <td><?php echo $row['SốĐiệnThoại'] ?></td>
			<td><?php echo $row['TổngSốTiền'] ?></td> <td><?php echo $row['NgàyĐặt'] ?></td>
			<td><span class="btn btn-success" onclick="xong('<?php echo $row['MãĐơnHàng'] ?>')">Xong</span></td>
		</tr>

		<?php }	?>
	</tbody>

	<?php
	disconnect($conn);
}

function giaodich_dagh(){
	session_start();
	$conn = connect();
	mysqli_set_charset($conn, 'utf8');
	$sql = "SELECT * FROM ĐơnHàng WHERE TrạngThái = 'Đã giao hàng' LIMIT ".$_SESSION['limit'];
	$i = 1;
	$result = mysqli_query($conn, $sql); ?>

	<thead>
		<tr>
			<th>STT</th> <th>Tình trạng</th> <th>Tên</th>
			<th>Quận</th> <th>Địa chỉ</th> <th>Số DT</th>
			<th>Tổng tiền</th> <th>Ngày</th> <th>isDone</th>
		</tr>
	</thead>
	<tbody id="gd_dagd_body">

		<?php while ($row = mysqli_fetch_assoc($result)){?>


		<tr>
			<td><?php echo $i++ ?></td>
			<td><?php if($row['TrạngThái'] == 'Đã giao hàng') echo "<h4 class='label label-success'>Đã giao hàng</h4>"; else echo "<h4 class='label label-danger'>Chưa giao hàng</h4>";  ?></td>
			<td><?php echo $row['Tên'] ?></td> <td><?php echo $row['user_dst'] ?></td>
			<td><?php echo $row['ĐịaChỉ'] ?></td> <td><?php echo $row['SốĐiệnThoại'] ?></td>
			<td><?php echo $row['TổngSốTiền'] ?></td> <td><?php echo $row['NgàyĐặt'] ?></td>
			<td></td>
		</tr>

		<?php }	?>
	</tbody>

	<?php
	disconnect($conn);
}
//-------------
function giaodich_tatcagh(){
	session_start();
	$conn = connect();
	mysqli_set_charset($conn, 'utf8');
	$sql = "SELECT * FROM ĐơnHàng LIMIT ".$_SESSION['limit'];
	$i = 1;
	$result = mysqli_query($conn, $sql); ?>

	<thead>
		<tr>
			<th>STT</th> <th>Tình trạng</th> <th>Tên</th>
			<th>Quận</th> <th>Địa chỉ</th> <th>Số DT</th>
			<th>Tổng tiền</th> <th>Ngày</th> <th>isDone</th>
		</tr>
	</thead>
	<tbody id="gd_tatcagd_body">

		<?php while ($row = mysqli_fetch_assoc($result)){?>


		<tr>
			<td><?php echo $i++ ?></td>
			<td><?php if($row['TrạngThái'] == 'Đã giao hàng') echo "<h4 class='label label-success'>Đã giao hàng</h4>"; else echo "<h4 class='label label-danger'>Chưa giao hàng</h4>";  ?></td>
			<td><?php echo $row['Tên'] ?></td> <td><?php echo $row['user_dst'] ?></td>
			<td><?php echo $row['ĐịaChỉ'] ?></td> <td><?php echo $row['SốĐiệnThoại'] ?></td>
			<td><?php echo $row['TổngSốTiền'] ?></td> <td><?php echo $row['NgàyĐặt'] ?></td>
			<td>
				<?php if($row['TrạngThái'] == 'Chưa giao hàng'){ ?>
				<span class="btn btn-success" onclick="xong('<?php echo $row['MãĐơnHàng'] ?>')">Xong</span>
				<?php } ?>
			</td>
		</tr>

		<?php }	?>
	</tbody>

	<?php
	disconnect($conn);
}

function giaodich_xong(){
	$magd = $_POST['magd_xong'];
	$conn = connect();
	mysqli_set_charset($conn, 'utf8');
	$sql = "UPDATE ĐơnHàng SET TrạngThái = 'Đã giao hàng' WHERE MãĐơnHàng = '".$magd."'";
	if(!mysqli_query($conn, $sql)){
		echo "Đã xảy ra lỗi!";
	}
	disconnect($conn);
}

function them_admin(){
	$conn = connect();
	$ten = $_POST['Tên'];
	$tentk = $_POST['TênTàiKhoản'];
	$mk = $_POST['MậtKhẩu'];
	$sql = "INSERT INTO NgườiDùng (Tên, TênTàiKhoản, MậtKhẩu, quyen) VALUES ('$ten', '$tentk', '$mk', '1')";
	if(!mysqli_query($conn, $sql)){
		echo "<script>alert('Tên tài khoản đã tồn tại!')</script>";
	} else {
		echo "<script>alert('Tạo thành công!')</script>";
	}
	disconnect($conn);
}

function xoa_taikhoan(){
	$id = $_POST['id_tk_xoa'];
	$conn = connect();
	$sql = "DELETE FROM NgườiDùng WHERE MãNgườiDùng = '".$id."'";
	if(!mysqli_query($conn, $sql)){
		echo "Đã xảy ra lỗi!";
	} else {
		echo "<script>alert('Xóa xong!')</script>";
	}
	disconnect($conn);
}

function sua_sp(){
	$masp = $_POST['masp_sua'];
	$tensp = $_POST['tensp_ed'];
	$gia = $_POST['gia_ed'];
	$baohanh = $_POST['baohanh_ed'];
	$khuyenmai = $_POST['khuyenmai_ed'];
	$tinhtrang = $_POST['tinhtrang_ed'];
	$set = []; $data = [];
	if($tensp != ""){$data[] = $tensp; $set[] = 'TênSP';}
	if($gia != ""){$data[] = $gia; $set[] = 'Giá';}
	if($baohanh != ""){$data[] = $baohanh; $set[] = 'BảoHành';}
	if($khuyenmai != ""){$data[] = $khuyenmai; $set[] = 'KhuyếnMãi';}
	if($tinhtrang != ""){$data[] = $tinhtrang; $set[] = 'TìnhTrạng';}
	$str = '';
	for ($i=0; $i < count($set); $i++) { 
		$str.= $set[$i]."='".$data[$i]."',";
	}
	$str = trim($str, ',');
	$conn = connect();
	$sql = "UPDATE SảnPhẩm SET ".$str." WHERE MãSảnPhẩm = '".$masp."'";
	if(!mysqli_query($conn, $sql)){
		echo "Đã xảy ra lỗi!";
	} else {
		echo "<script>alert('Sửa thành công!')</script>";
	}
	disconnect($conn);
}
?>