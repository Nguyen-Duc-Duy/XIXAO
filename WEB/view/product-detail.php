<?php
$id = $_GET["id"];
if (isset($_GET["view"]) == "product-detail" && isset($_GET["id"])) {
	//lấy sản phẩm có id trên url
	
	$selectPro = mysqli_query($connectData,"SELECT * FROM productt WHERE id =$id") or die (notification("truy xuất sản phẩm lỗi, xin thử lại."));
	$infoPro = mysqli_fetch_assoc($selectPro);
	//lấy danh sách ảnh 
	$selectListImage = mysqli_query($connectData,"SELECT * FROM image_detail WHERE id_product = '$id'") or die (notification("truy xuất ảnh sản phẩm, xin thử lại."));
	//lấy size
	$selectSize = mysqli_query($connectData,"SELECT * FROM product_feature prof
		JOIN size s
		ON s.id = prof.id_size
		WHERE id_product =$id") or die(notification("lỗi truy cập kích thước sản phẩm"));
}
?>
<!-- product detail -->
<div class="my-container">
	<!-- custom service -->
	<!-- 	<div class="row service">
		<div class="col-md-4">
			<div class="sv-img">
				<img src="public/image/Product-Detail/24h.png" alt="">
			</div>
			<div class="sv-title"></div>
		</div>
		<div class="col-md-4">
			<div class="sv-img">
				<img src="public/image/Product-Detail/money.png" alt="">
			</div>
			<div class="sv-title"></div>
		</div>
		<div class="col-md-4">
			<div class="sv-img">
				<img src="public/image/Product-Detail/shiper.png" alt="">
			</div>
			<div class="sv-title"></div>
		</div>
	</div> -->
	<!-- <content product detail> -->
	<div class="content-detail mt-2">
		<!-- type product -->
		<div class="w-100 type-location mb-2 p-2 bg-white">
			<p><span>Nam</span><i class="fas fa-chevron-right"></i><span>áo thun</span></p>
		</div>
		<div class="row bg-white w-100 m-0 p-2">
			<!-- <image product detail>  -->
			<div class="col-md-5 img-detail p-0">
				<div class="box-img">
					<!-- show img -->
					<div class="show-img">
						<img src="public/image/<?php echo $infoPro["image"]; ?>" alt="">
					</div>
					<!-- list img -->
					<div class="list-img">
						<ul class="nav w-100">
							<?php foreach ($selectListImage as $image) {
										
										?>
							<li class="nav-item">
								<img src="public/image/<?php echo $image["image"]  ?>" alt="">
							</li>
							<?php } ?>
						</ul>
					</div>
				</div>
				<!-- interact product detail -->
				<div class="stt-detail">
					<div class="stt-item text-center">
						<form action="" class="send-stt" class="m-auto d-inline-block">
							<input type="checkbox" id="heart-detail-<?php echo $id; ?>">
							<label for="heart-detail-<?php echo $id; ?>" class="stt">
								<i class="fas fa-heart text-danger"></i>
								<i class="far fa-heart text-danger"></i>
								yêu thích
							</label>
							<input type="checkbox" id="fb-detail-<?php echo $id; ?>">
							<label for="fb-detail-<?php echo $id; ?>" class="stt">
								<i class="fas fa-thumbs-up"></i>
								<i class="far fa-thumbs-up"></i>
								like
							</label>
							<input type="checkbox" id="eye-detail-<?php echo $id; ?>">
							<label for="eye-detail-<?php echo $id; ?>" class="stt">
								<a href="" class="text-dark">
									<i class="fas fa-share m-0"></i>
									share
								</a>
							</label>
						</form>
					</div>
				</div>
			</div>
			<!-- </image product detail>  -->
			<!-- <info product detail> -->
			<div class="col-md-5 info-product-detail p-3">
				<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#detail" role="tab"
							aria-controls="pills-home" aria-selected="true">Chi tiết sản phẩm</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#descript" role="tab"
							aria-controls="pills-profile" aria-selected="false">Miêu tả</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#featback" role="tab"
							aria-controls="pills-contact" aria-selected="false">Nhận xét</a>
					</li>
				</ul>

				<div class="tab-content p-3" id="pills-tabContent">
					<!-- <detail info product> -->
					<div class="tab-pane fade show active detail-info" id="detail" role="tabpanel"
						aria-labelledby="pills-home-tab">
						<!-- name -->
						<h6 class="card-title m-0" name="card-title"><?php echo $infoPro["name"] ?></h6>
						<!-- price -->
						<div class="price-detail mb-2">
							<span><?php echo number_format($infoPro["price"],0,",",".")  ?>đ</span>
							<span><s><?php echo $infoPro["sale"] ?>đ</s></span>
						</div>
						<!-- star & stt -->
						<div class="box-star-stt">
							<p class="star m-0 float-left pr-4" name="star">
								<i class="far fa-star"></i>
								<i class="far fa-star"></i>
								<i class="far fa-star"></i>
								<i class="far fa-star"></i>
								<i class="far fa-star"></i>
							</p>
							<div class="stt-detail d-flex pl-3">
								<p>Yêu thích(<span>1</span>)</p>
								<p>Lượt xem(<span>1</span>)</p>
								<p>lượt mua(<span>1</span>)</p>
							</div>
						</div>
						<!-- title -->
						<div class="title-detail">
							<p><?php echo $infoPro["title"] ?></p>
						</div>
						<!-- size -->
						<div class="size-detail d-flex mt-3">
							<span>Kích cỡ : </span>
							<?php foreach ($selectSize as $size) 
											{ ?>
							<div class="size ml-4"><?php echo $size["size"]; ?></div>
							<?php
											} ?>
						</div>
						<!-- quantity -->
						<div class="quantity-detai d-flex  mt-3">
							<span>Số lượng : </span>
							<div class="quantity ml-4"><input type="number" min="1" value="1" onclick="updateNumber(<?php echo $id ?>)">
							</div>
							<div class="price-detail ml-2">
								<span><label
										for=""><?php echo number_format($infoPro["price"],0,",",".")  ?></label>đ</span>
								<span>-<s><?php echo number_format($infoPro["sale"],0,",",".") ?>đ</s></span>
							</div>
						</div>
						<!-- thêm vào giỏ hàng -->
						<div class="mt-4 d-inline-flex">
							<button type="button" name="adcart" class="btn btn-success"
								onclick="adToCart(<?php echo $id; ?>)"> Thêm vào giỏ hàng</button>
							<button type="button" name="buy-product" class="btn btn-warning ml-3">Mua ngay</button>
						</div>
					</div>
					<!-- </detail info product> -->
					<div class="tab-pane fade" id="descript" role="tabpanel" aria-labelledby="pills-profile-tab">
						<?php echo $infoPro["descript"]; ?>
					</div>
					<!-- <featback> -->
					<div class="tab-pane fade" id="featback" role="tabpanel" aria-labelledby="pills-contact-tab">
						<!-- nhận xét -->
						<form action="" type="POST" name="featback" class="featback">
							<h4>Nhận phản hồi</h4>
							<div>
								<textarea name="input-featback" cols="50" rows="4" class="w-100"></textarea>
								<label for="address-<?php echo $id; ?>">Địa chỉ Email</label>
								<input type="email" class="form-control" id="address-<?php echo $id; ?>"
									placeholder="Nhập địa chỉ email của bạn">
								<button class="btn btn-danger mt-2" type="buttom" name="sub-featback">Gửi</button>
							</div>
						</form>
						<!-- help -->
						<form action="" type="POST" name="help" class="mt-4 help">
							<h4>Đặt câu hỏi</h4>
							<div class="form-group">
								<label for="quesion-<?php echo $id; ?>">Câu hỏi</label>
								<input type="text" class="form-control" id="quesion-<?php echo $id; ?>"
									placeholder="Câu hỏi của bạn">
							</div>
							<div class="form-group">
								<label for="mail-quesion-<?php echo $id; ?>">Địa chỉ Email</label>
								<input type="email" class="form-control" id="mail-quesion-<?php echo $id; ?>"
									placeholder="Nhập địa chỉ email của bạn">
							</div>
							<button type="submit" class="btn btn-danger">Gửi</button>
						</form>
					</div>
					<!-- </featback> -->
				</div>
			</div>
			<!-- </info product detail> -->
			<div class="col-md-2">
				<!-- <div class="fb-comment-embed" data-href="https://www.facebook.com/ayem113/posts/908878042804398?comment_id=908889909469878&comment_tracking=%7B%22tn%22%3A%22R%22%7D"
						data-width="200"></div> -->
			</div>
		</div>
	</div>


<!-- </content product detail> -->
<!-- <sản phẩm liên quan> -->
	<?php
		//lấy sản phẩm liên quan
	if(isset($_SESSION["cart"])){
		if(count($_SESSION["cart"]) > 0){
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
		}else{
			$selectPro = mysqli_query($connectData,"SELECT pro.id,pro.name,pro.price,pro.sale,pro.image,pro.star FROM productt pro ORDER BY RAND() LIMIT 6")or die("false");
		}
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
											<input type="checkbox" id="heart1">
											<label for="heart1" class="stt">
												<i class="fas fa-heart text-danger"></i>
												<i class="far fa-heart text-danger"></i>
											</label>
											<div class="val-stt">
												<strong>1</strong>
											</div>
										</li>
										<li class="nav-item mb-2">
											<input type="checkbox" id="cart1">
											<label for="cart1" class="stt">
												<i class="fas fa-vote-yea text-success"></i>
												<i class="fas fa-cart-arrow-down text-success"></i>
											</label>
											<div class="val-stt">
												<strong>1</strong>
											</div>
										</li>
										<li class="nav-item">
											<input type="checkbox" id="eye1">
											<label for="eye1" class="stt eye">
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