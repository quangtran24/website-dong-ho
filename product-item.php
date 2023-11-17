<div class='product-container' onclick="hien_sanpham('<?php echo $row['MãSảnPhẩm']?>')">
	<a data-toggle='modal' href='sanpham.php?masp=<?php echo $row['MãSảnPhẩm'] ?>' data-target='#modal-id'>
		<img src='<?php echo $row['ẢnhChính'] ?>' class='product-img'>
		<img src='images/km_logo.png' class='km-logo'>
		<div class='product-detail'>
			<p>✔ <?php echo $row['ChấtLiệu'] ?><br>
				✔ Bảo hành <?php echo $row['BảoHành'] ?> tháng <br>
			</p>
			<span>Khuyến mãi</span>
			<p>✔ Giảm ngay <?php echo $row['KhuyếnMãi'] ?>&#37;<br>
			</p>
		</div>
		<div class='product-info'>
			<h4><b><?php echo $row['TênSP'] ?></b></h4>
			<i><?php echo $row['XuấtSứ'] ?></i><br>
			<b class='price'>Giá: <?php echo $row['Giá'] ?> VND</b>
		</div>
		<div class='buy'>
			<a class='btn btn-default btn-lg unlike-container'><i class='glyphicon glyphicon-heart unlike'></i></a>
			<a class='btn btn-primary btn-lg cart-container <?php 
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
			<a class='btn btn-success btn-lg' href='order.php?masp=<?php echo $row['MãSảnPhẩm'] ?>'>Mua ngay</a>
		</div>
	</a>
</div>
