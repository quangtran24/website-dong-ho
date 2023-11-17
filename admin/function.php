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
//Danh sach thanh vien
function member_list(){
	$conn = connect();
	mysqli_set_charset($conn, 'utf8');
	$sql = "SELECT * FROM NgườiDùng ORDER BY MãNgườiDùng DESC";
	$result = mysqli_query($conn, $sql); ?>

	<thead>
		<tr>
			<th>ID</th> <th>Tên</th> <th>Tên tài khoản</th>
			<th>Mật khẩu</th> <th>Địa chỉ</th> <th>Số điện thoại</th>
			<th>Email</th> <th>Quyền</th>
			<th></th>
		</tr>
	</thead>
	<tbody>

		<?php while ($row = mysqli_fetch_assoc($result)){?>


		<tr>
			<td><?php echo $row['MãNgườiDùng'] ?></td> <td><?php echo $row['Tên'] ?></td>
			<td><?php echo $row['TênTàiKhoản'] ?></td> <td>*****</td>
			<td><?php echo $row['ĐịaChỉ'] ?></td> <td><?php echo $row['SốĐiệnThoại'] ?></td>
			<td><?php echo $row['Email'] ?></td> 
			<td><?php if($row['quyen'])echo "Admin"; else echo "User";  ?></td>
			<td><span class="btn btn-danger" onclick="xoa_taikhoan('<?php echo $row["MãNgườiDùng"] ?>')">Xóa</span></td>
		</tr>

		<?php }	?>
	</tbody>
	<?php
	disconnect($conn);
}
//Danh sach giao dich
function exchange_list(){
	$conn = connect();
	mysqli_set_charset($conn, 'utf8');
	$sql = "SELECT * FROM ĐơnHàng WHERE TrạngThái = '0' LIMIT ".$_SESSION['limit']."";
	$i = 1;
	$result = mysqli_query($conn, $sql); ?>

	<thead>
		<tr>
			<th>STT</th> <th>Trạng thái</th> <th>Tên</th>
			<th>Quận</th> <th>Địa chỉ</th> <th>Số điện thoại</th>
			<th>Tổng số tiền</th> <th>Ngày đặt</th> <th>isDone</th>
		</tr>
	</thead>
	<tbody id="body-gd-list">

		<?php while ($row = mysqli_fetch_assoc($result)){?>


		<tr>
			<td><?php echo $i++ ?></td>
			<td><?php if($row['TrạngThái']) echo "<h4 class='label label-success'>Đã giao hàng</h4>"; else echo "<h4 class='label label-danger'>Chưa giao hàng</h4>";  ?></td>
			<td><?php echo $row['Tên'] ?></td> <td><?php echo $row['Quận'] ?></td>
			<td><?php echo $row['ĐịaChỉ'] ?></td> <td><?php echo $row['SốĐiệnThoại'] ?></td>
			<td><?php echo $row['TổngSốTiền'] ?></td> <td><?php echo $row['NgàyĐặt'] ?></td>
			<td>
				<?php if($row['TrạngThái'] == '0'){ ?>
				<span class="btn btn-success" onclick="xong('<?php echo $row['MãĐơnHàng'] ?>')">Xong</span>
				<?php } ?>
			</td>
		</tr>

		<?php }	?>
		<div class="container-fluid text-center lmbtnctn">
			<button onclick="load_more_gd(0, 'body-gd-list','chuagd')" id="loadmorebtngd">Load more</button>
		</div>
	</tbody>
	
	<?php
	disconnect($conn);
}
//Danh sach danh muc san pham
function type_list(){
	$conn = connect();
	mysqli_set_charset($conn, 'utf8');
	$sql = "SELECT * FROM DanhMục";
	$result = mysqli_query($conn, $sql); ?>

	<thead>
		<tr>
			<th>STT</th>
			<th>Tên danh mục</th><th>Mô tả</th>
			<th></th>
		</tr>
	</thead>
	<tbody>

		<?php while ($row = mysqli_fetch_assoc($result)){?>


		<tr>
			<td><?php echo $row['MãDanhMục'] ?></td> <td><?php echo $row['Tên'] ?></td>
			<td><?php echo $row['MôTả'] ?></td>
			<td>
				<span class="btn btn-danger" onclick="xoa_dm('<?php echo $row['MãDanhMục'] ?>')">Xóa</span>
			</td>
		</tr>

		<?php }	?>
	</tbody>

	<?php
}
//Danh sach san pham
function product_list(){
	$conn = connect();
	mysqli_set_charset($conn, 'utf8');
	$sql = "SELECT * FROM SảnPhẩm s, DanhMục d WHERE s.MãDanhMục = d.MãDanhMục ORDER BY NgàyNhập DESC LIMIT ".$_SESSION['limit']."";
	$i = 1;
	$result = mysqli_query($conn, $sql); ?>
	<thead>
		<tr>
			<th>STT</th>
			<th>Tên</th> <th>Giá</th> <th>Bảo hành</th>
			<th>Trọng lượng</th> <th>Chất liệu</th> <th>Chống nước</th>
			<th>Năng lượng</th> <th>Loại bảo hành</th> <th>Kích thước</th>
			<th>Màu</th> <th>Dành cho</th> <th>Phụ kiện</th>
			 <th>Khuyến mãi</th> <th>Tình trạng</th> <th>Ngày nhập</th>
			<th>Danh mục</th>
			<th></th> <th></th>
		</tr>
	</thead>
	<tbody id='body-sp-list'>

		<?php while ($row = mysqli_fetch_assoc($result)){?>


		<tr>
			<td><?php echo $i++ ?></td> <td><?php echo $row['TênSP'] ?></td>
			<td><?php echo $row['Giá'] ?></td> <td><?php echo $row['BảoHành'] ?></td>
			<td><?php echo $row['TrọngLượng'] ?></td> <td><?php echo $row['ChấtLiệu'] ?></td>
			<td><?php echo $row['ChốngNước'] ?></td> <td><?php echo $row['NăngLượng'] ?></td>
			<td><?php echo $row['LoạiBảoHành'] ?></td> <td><?php echo $row['KíchThước'] ?></td>
			<td><?php echo $row['Màu'] ?></td> <td><?php echo $row['DànhCho'] ?></td>
			<td><?php echo $row['PhụKiện'] ?></td> <td><?php echo $row['KhuyếnMãi'] ?></td>
			<td><?php echo $row['TìnhTrạng'] ?></td> <td><?php echo $row['NgàyNhập'] ?></td>
			<td><?php echo $row['Tên'] ?></td>
			<td><span onclick="display_edit_sanpham('<?php echo $row['MãSảnPhẩm'] ?>')"><a class="btn btn-warning" href="#sua_sp-area">Sửa</a></span></td>
			<td><span class="btn btn-danger" onclick="xoa_sp('<?php echo $row['MãSảnPhẩm'] ?>')">Xóa</span></td>
		</tr>

		<?php }	?>
	</tbody>
	<?php
	disconnect($conn);
}

//In ra danh sach coupon
// In ra danh sách coupon
function coupon_list(){
    $conn = connect();
    mysqli_set_charset($conn, 'utf8');
    $sql = "SELECT * FROM Coupon";
    $i = 1;
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?php echo $i++ ?></td>
            <td><?php echo $row['MãCoupon'] ?></td>
            <td><?php echo $row['MãSảnPhẩm'] ?></td>
            <td><?php echo $row['MãNgườiDùng'] ?></td>
            <td><?php echo $row['MãGiỏHàng'] ?></td>
            <td><?php echo $row['Code'] ?></td>
            <td><?php echo $row['GiảmGiá'] ?></td>
            <td><span onclick="display_edit_coupon('<?php echo $row['MãCoupon'] ?>')"><a class="btn btn-warning" href="#sua_coupon-area">Sửa</a></span></td>
            <td><span class="btn btn-danger" onclick="xoa_coupon('<?php echo $row['MãCoupon'] ?>')">Xóa</span></td>
        </tr>
        <?php
    }
    disconnect($conn);
}



//In ra danh sach danh muc san pham cho phan them san pham
function list_type_pr_for_add(){
	$conn = connect();
	mysqli_set_charset($conn, 'utf8');
	$sql = "SELECT * FROM DanhMục";
	?>	<select class="form-control" id="MãDanhMục"> <?php
	$result = mysqli_query($conn, $sql); ?>
	<?php while ($row = mysqli_fetch_assoc($result)){?>
	<option value="<?php echo $row['MãDanhMục'] ?>"><?php echo $row['Tên'] ?></option>
	<?php }	?>
</select>
<?php
}
?>
