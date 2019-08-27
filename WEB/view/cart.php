<?php
ob_start();
if(isset($_POST["pay"])){
	if(isset($_SESSION["user"])){
		header("location: index.php?view=order-pay");
	}else{
		notification("Bạn cần đăng nhập để có thể thanh toán");
	}
}
// hiển thi đơn hàng
if(isset($_SESSION["cart"])){
	$cart = $_SESSION["cart"];
	if(!array_keys($cart)){
		?>
		<div id="notfound">
			<div class="notfound">
				<div class="notfound-404">
					<h1><i class="fas fa-shopping-cart"></i></h1>
					<h2>Giỏ hàng trống</h2>
				</div>
				<a href="index.php">Mua hàng</a>
			</div>
		</div>
		<?php
	}else{

	?> 
	<!-- Giỏ hàng -->
	<div class="my-container">

		<div class="box-cart">
			<div class="header-cart title-product mt-2">
				<h4>Giỏ hàng của tôi</h4>
			</div>
			<!-- sản  phẩm trong giỏ hàng -->
			<div class="cart row mx-0 mt-2">
				<?php
				$i = 0;
				$subTotalPrice = 0;
				$subTotalSale = 0;
				foreach ($cart as $cartPro) {
					$i++;
					$id = $cartPro["id"];
					$selectPro = mysqli_query($connectData,"SELECT * FROM productt WHERE id =$id") or die (notification("lỗi truy cập bảng sản phẩm, Xin thử lại !"));
					$value = mysqli_fetch_assoc($selectPro);
					$totalPrice = ($value["price"]*$cartPro["number"]);
					$totalSale = ($value["sale"]*$cartPro["number"]);
					$subTotalPrice += $totalPrice;
					$subTotalSale += $totalSale;
					?>
					<div class="col-9" name="<?php echo $id ?>">
						<div class="cart-pro mx-2">
							<h4>Sản phẩm <?php echo $i; ?></h4>
							<button class="btn btn-danger mb-2" onclick="deleteCart(<?php echo $id; ?>)"><span>Xóa</span></button>
						</div>
						<!-- sản phẩm  -->
						<div class="cart-detail d-flex">
							<!-- image -->
							<a href="index.php?view=product-detail&id=<?php echo $value["id"] ?>">
								<div class="img-cart m-2" style="background-image: url('public/image/<?php echo $value["image"] ?>');">
								</div>
							</a>
							<!-- name -->
							<div class="name-cart p-2">
								<p><?php echo $value["name"]; ?></p>
							</div>
							<div class="color-size box-info-cart pl-3 pt-2">
								<!-- lấy kích thước -->
								<span>Cỡ : </span>
								<div class="size-cart d-flex">
									<div class="box-info d-flex">
										<?php
										$selectSize = mysqli_query($connectData,"SELECT s.size,s.id FROM product_feature proc JOIN size s ON s.id = proc.id_size WHERE proc.id_product =".$cartPro["id"]) or die(notification("lối truy vấn bảng color, xin thử lại"));
										foreach ($selectSize as $size) {
										?>
										<div class="checkbox-inline mx-3">
											<label>
												<input type="radio" name="size<?php echo $value["id"] ?>" <?php
												if(isset($_SESSION["cart"])){
												 echo ($cart[$value["id"]]["size"] == $size["id"]) ? "checked" : "no";
												};?> value="<?php echo $size["id"]; ?>" onchange="updateSize(<?php echo $value["id"]; ?>)"><?php echo $size["size"];?>
											</label>
											
										</div>
										<?php } ?>
									</div>
								</div>
							</div>
							<!-- qutity -->
							<div class="quatity-cart box-info-cart pl-3 pt-2">
								<div class="mt-2 mb-3">
									<span>Số lượng : </span>
									<input type="number" value="<?php echo $cartPro["number"]; ?>" onclick="updateNumber(<?php echo $id ?>)" id="pro<?php echo $id ?>">
								</div>
								<div class="price-cart">
									<p>Giá :<?php echo number_format(($value["price"]*$cartPro["number"]),0,",",".");; ?></p>
									<p>Giảm : -<span><?php echo number_format(($value["sale"]*$cartPro["number"]),0,",","."); ?></span></p>
								</div>
								
							</div>
						</div>
					</div>
				<?php }?>
				<div class="col-3 pay">
					<p>Đặt hàng</p>
					<div class="pay-price">
						<p>Tổng giá : <span><?php echo number_format($subTotalPrice,0,",","."); ?></span></p>
						<p>Tổng Khuyến mại : <span><?php echo number_format($subTotalSale,0,",","."); ?></span></p>
					</div>
					<form action="" method="POST">
						<button type="submit" class="btn btn-success" name="pay">Thanh toán</button>
					</form>
				</div>
			</div>
		</div>
	
	<?php
		//lấy sản phẩm liên quan
	if(isset($_SESSION["cart"])){
		$cart = $_SESSION["cart"];
		// lấy danh mục
		foreach ($cart as $key => $value) {
			$id = $value["id"];
			$selectCat = mysqli_query($connectData,"SELECT productt.id_category_child FROM productt WHERE id = '$id'") or die("false1");
			$row = mysqli_fetch_assoc($selectCat);
			$cat = $row["id_category_child"];
			
			
		}
		// lấy sp
		$selectPro = mysqli_query($connectData,"SELECT pro.id,pro.name,pro.price,pro.sale,pro.image,pro.star FROM productt pro JOIN category c ON c.id = pro.id_category_child WHERE pro.id_category_child = '$cat' LIMIT 6")or die("false");
	}
	?>
	<div class="product relate">
		<div class="header-cart title-product mt-2">
			<h4>Sản phẩm liên quan</h4>
		</div>
		<div class="row m-0">
		<!-- <product item> -->
			<?php foreach ($selectPro as $Pro) {
			?>
			<div class="col-md-2 col-6 col-sm-2  pr-0">
				<div class="product-item">
					<!-- <card> -->

					<a href="index.php?view=product-detail&id=<?php echo $Pro['id'] ?>" class="link-item text-decoration-none">
							<div class="card position-relative">
								<div class="card-img" name="img-item"
								style="background-image: url('public/image/<?php echo $Pro["image"]  ?>')">
							</div>
							<div class="card-body p-2">
								
									<h6 class="card-title m-0 text-center" name="card-title"><?php echo $Pro["name"] ?></h6>
									<div>
										<p class="star text-center m-0" name="star">
											<i class="far fa-star"></i>
											<i class="far fa-star"></i>
											<i class="far fa-star"></i>
											<i class="far fa-star"></i>
											<i class="far fa-star"></i>
										</p>
										<p class="card-text text-center">
											<?php echo $Pro["price"] ?>
											<span class="sale text-secondary" name="sale"><?php echo $Pro["sale"] ?></span>
										</p>
									</div>
								
							</div>
							<!--  add stt -->
							<!-- <div class="interact-product">
								<form class="send-stt">
									<ul class="nav flex-column text-center">
										<li class="nav-item mb-2">
											<input type="checkbox" id="heart<?php echo $Pro["id"] ?>">
											<label for="heart<?php echo $Pro["id"] ?>" class="stt">
												<i class="fas fa-heart text-danger"></i>
												<i class="far fa-heart text-danger"></i>
											</label>
											<div class="val-stt">
												<strong>1</strong>
											</div>
										</li>
										<li class="nav-item mb-2">
											<input type="checkbox" id="cart<?php echo $Pro["id"] ?>">
											<label for="cart<?php echo $Pro["id"] ?>" class="stt">
												<i class="fas fa-vote-yea text-success"></i>
												<i class="fas fa-cart-arrow-down text-success"></i>
											</label>
											<div class="val-stt">
												<strong>1</strong>
											</div>
										</li>
										<li class="nav-item">
											<input type="checkbox" id="eye<?php echo $Pro["id"] ?>">
											<label for="eye<?php echo $Pro["id"] ?>" class="stt eye">
												<i class="fas fa-check text-success"></i>
												<i class="far fa-eye text-warning"></i>
											</label>
											<div class="val-stt">
												<strong>1</strong>
											</div>
										</li>
									</ul>
								</form>
							</div> -->
						</div>
					</a>
					<!-- </card>  -->
				</div>
			</div>
			<?php } ?>
			<!-- </product item> -->
		</div>
	</div>
		</div>
		<?php 
		}
	}else{
		?>
		<div id="notfound">
			<div class="notfound">
				<div class="notfound-404">
					<h1><i class="fas fa-shopping-cart"></i></h1>
					<h2>Giỏ hàng trống</h2>
				</div>
				<a href="index.php">Mua hàng</a>
			</div>
		</div>
		<?php
	}
	?>