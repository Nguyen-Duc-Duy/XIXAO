
<div class="my-container">
	<div class="follow-cart">
		<div class="header-cart title-product mt-2">
			<h4>Theo dõi đơn hàng</h4>
		</div>
	</div>
	<div class="box-cart-following w-100 bg-white p-0">
	<?php
		if(isset($_SESSION["user"])){
			// lấy đơn hàng
			$idCus = $_SESSION["user"];
			$order = mysqli_query($connectData,"SELECT o.id,o.name_ship,o.phone_ship,o.address_ship,o.email_ship,o.id_customer,o.money,o.status,o.date_create FROM `order` o WHERE o.id_customer = $idCus") or die("error");
			foreach ($order as $key => $reOrder)
			{
				
				
	?>
		
		<div>
			<!-- thông tin người nhận -->
		<div class="infoOrderUser w-100 bg-light p-0 mb-4">
			<div class="row m-0">
				<div class="col-6">
					<p>Người nhận: <span><?= $reOrder["name_ship"]; ?></span></p>
					<p>Địa chỉ: <span><?= $reOrder["address_ship"]; ?></span></p>
				</div>
				<div class="col-6">
					<p>Tổng tiền: <span><?= number_format($reOrder["money"],0,",","."); ?></span></p>
					<p>Ngày tạo: <span><?= $reOrder["date_create"]; ?></span></p>
				</div>
			</div>
		</div>
			<!-- quá trình của đơn hàng -->
			<div class="row position-relative">
				<div class="col-4 wartingCart text-right">
					<img src="public/image/question.png" alt="" style="<?= ($reOrder["status"]==1) ? "\"class=\"orderOk" : "filter: grayscale(100%);"; ?>">
					<p>Chờ duyệt</p>
				</div>
				<div class="col-4 deliveringCart text-center ">
					<img src="public/image/delivery-clipart-shipper-24.png" alt="" style="<?= ($reOrder["status"]==2) ? "\"class=\"orderOk" : "filter: grayscale(100%);"; ?>">
					<p>Đang vận chuyển</p>
				</div>
				<div class="line"></div>
				<div class="col-4 successOrder text-left">
					<img src="public/image/Tick_Mark_Dark-512.png" alt="" style="<?= ($reOrder["status"]==3) ? "\"class=\"orderOk" : "filter: grayscale(100%);"; ?>">
					<p>Hoàn thành</p>
				</div>
			</div>
			<?php
			if ($reOrder["status"]==0){
				?>
					<div class="w-100">
						<p>Đơn hàng của bạn đã bị hủy. Chúng tôi rất tiếc vì điều này. Có thể sản phẩm trong đơn hàng đang hết, hoặc có chút vấn đề trong việc vận chuyển.</p>
					</div>
				<?php
			}else{
			?>
			<!-- thông tin của đươn hàng -->
			<div class="boxProOrder p-2 mb-4">
				<?php
					// lấy đơn hàng chi tiết
					$selectOrDetail = mysqli_query($connectData,"SELECT * FROM order_detaily WHERE id_order =".$reOrder["id"]);
					foreach ($selectOrDetail as $orderDetail) {
						// echo "<pre>";
						// print_r($orderDetail);
						// lấy thông tin sản phẩm
						$selectProFeaOrd = mysqli_query($connectData,"SELECT pro.name,pro.image,pro.price,pro.sale,s.size FROM product_feature proFe
							JOIN productt pro
							ON pro.id = proFe.id_product
							JOIN size s
							ON s.id = proFe.id_size
							WHERE proFe.id = ".$orderDetail["id_product_feature"]) or die("error");
						foreach ($selectProFeaOrd as $proOrd) {
							//print_r($proOrd);
				?>
				<!-- sản phẩm trong trong đơn hàng -->
				<div class="boxPro">
					<div class="row my-2">
						<!-- ảnh sp -->
						<div class="col-1">
							<img src="public/image/<?= $proOrd["image"]; ?>" alt="<?= $proOrd["name"]; ?>" style="width: 50px; height: 50px;">
						</div>
						<div class="col-5">
							<!-- tên sp -->
							<p><?= $proOrd["name"];  ?></p>
						</div>
						<div class="col-4">
							<!-- giá sp -->
							<p><span><?= $proOrd["price"];  ?></span>-<s><?= $proOrd["sale"];  ?></s></p>
						</div>
						<div class="col-1">
							<!-- kích thước -->
							<p><?= $proOrd["size"];  ?></p>
						</div>
					</div>
				</div>
			<?php } } ?>
			</div>
		</div>
	<?php } ?>
	
	<?php
			}
		}else{
				?>
				<div class="w-100 bg-danger p-2">
					<h5 class="text-white m-0">Bạn cần đăng nhập để kiểm tra đơn hàng của mình.</h5>	
				</div>
				<?php
			}
	?>
	</div>
<?php
// lấy sp
$selectPro = mysqli_query($connectData,"SELECT pro.id,pro.name,pro.price,pro.sale,pro.image,pro.star FROM productt pro LIMIT 6")or die("false");
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