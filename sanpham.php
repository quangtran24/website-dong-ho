<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<?php
require_once 'backend-index.php';
$masp = "";
if (isset($_GET['masp'])) {
	$masp = $_GET['masp'];
}
$conn = connect();
mysqli_set_charset($conn, 'utf8');
$sql = "SELECT * FROM SảnPhẩm sp, DanhMục dm WHERE sp.MãDanhMục = dm.MãDanhMục AND MãSảnPhẩm = '".$masp."'";
$result = mysqli_query($conn, $sql);
$loaisp = "";
while ($row = mysqli_fetch_assoc($result)) {
	$loaisp = $row['MãDanhMục'];
	?>
	<div class="container-fluid form" style="margin-top: -23px; padding: 20px">
		<div class="row">
			<div class="col-sm-12">
				<div class="main-prd">
					<img src="<?php echo $row['ẢnhChính'] ?>" class="main-prd-img">
					<div class="basic-info">
						<h2><?php echo $row['TênSP'] ?></h2>
						<span class="main-prd-price"><?php echo $row['Giá'] ?> VND</span>
						<h4><b>Thông tin cơ bản</b></h4>
						<ul>
							<li>Xuất xứ: <?php echo $row['MôTả'] ?></li>
							<li>Màu sắc: <?php echo $row['Màu'] ?></li>
							<li>Năng lượng sử dụng: <?php echo $row['NăngLượng'] ?></li>
							<li>Chống nước: <?php if ($row['ChốngNước']) {echo "Có";} else {echo "Không";} ?></li>
							<li>Bảo hành: <?php echo $row['BảoHành'] ?> tháng</li>
							<li><span class="km">Khuyến mãi: <?php echo $row['KhuyếnMãi'] ?> %</span></li>
							<br><a class="btn btn-primary" href="order.php?masp=<?php echo $masp ?>">Mua ngay</a>
						</ul>
					</div>
				</div>

				<div style="clear: both;"></div>

				<div class="introduce-prd">
					<h3>Thông số kỹ thuật</h3>
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Đặc điểm</th>
								<th>Giá trị</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Bảo hành</td>
								<td><?php echo $row['BảoHành'] ?> tháng</td>
							</tr>
							<tr>
								<td>Trọng lượng(g)</td>
								<td><?php echo $row['TrọngLượng'] ?></td>
							</tr>
							<tr>
								<td>Chất liệu</td>
								<td><?php echo $row['ChấtLiệu'] ?></td>
							</tr>
							<tr>
								<td>Loại hình bảo hành</td>
								<td><?php echo $row['LoạiBảoHành'] ?></td>
							</tr>
							<tr>
								<td>Kích thước (d x r x c) (cm)</td>
								<td><?php echo $row['KíchThước'] ?></td>
							</tr>
							<tr>
								<td>Màu</td>
								<td><?php echo $row['Màu'] ?></td>
							</tr>
							<tr>
								<td>Dành cho</td>
								<td><?php echo $row['DànhCho'] ?></td>
							</tr>
							<tr>
								<td>Phụ kiện đi kèm</td>
								<td><?php echo $row['PhụKiện'] ?></td>
							</tr>
							<tr>
								<td>Khuyễn mãi/ Quà tặng</td>
								<td><?php echo $row['KhuyếnMãi'] ?> %</td>
							</tr>
							<tr>
								<td>Tình trạng</td>
								<td><?php echo $row['TìnhTrạng'] ?></td>
							</tr>
						</tbody>
					</table>
				</div>
				
				<div class="comment-section">
   <h3>Bình luận</h3>
    <?php
        // Truy vấn dữ liệu bình luận và tên người dùng từ bảng BìnhLuận và NgườiDùng
        $sql_comment = "SELECT bl.*, nd.Tên, nd.TênTàiKhoản FROM BìnhLuận bl JOIN NgườiDùng nd ON bl.MãNgườiDùng = nd.MãNgườiDùng WHERE bl.MãSảnPhẩm = '".$masp."'";
        $result_comment = mysqli_query($conn, $sql_comment);
        
        // Hiển thị nội dung bình luận
        while ($row_comment = mysqli_fetch_assoc($result_comment)) {
            echo '<div class="comment">';
            echo '<p><b>Người dùng: </b>'.$row_comment['Tên'].' </p>';
            echo '<p>'.$row_comment['NộiDung'].'</p>';
            echo '<p><i>Ngày bình luận: </i>'.$row_comment['NgàyBìnhLuận'].'</p>';
            echo '</div>';
        }
        
        // Kiểm tra xem có bình luận nào hay không
        if (mysqli_num_rows($result_comment) == 0) {
            echo '<p>Chưa có bình luận cho sản phẩm này.</p>';
        }
    ?>
</div>

			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
<?php } ?>
