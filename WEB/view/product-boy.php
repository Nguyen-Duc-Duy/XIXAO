<!-- product man -->
<!-- <slider & header> -->
<?php
	$pagename = $_GET["view"];
	if($pagename == "product-boy"){
		echo "<style type='text/css' media='screen'>
		.container-fluid.px-0{
			position: absolute;
			z-index: 99999;
			top: 0;
		}
		.full.nav-header{
			background-color: transparent;
		}
		.full.header{
			background-color: transparent;
		}
		</style> ";
	}
	//lấy ảnh silder 
	$selectSlider = mysqli_query($connectData,"SELECT * FROM slider_img WHERE id_category_parent = 1") or die("error");
	$selectPro = mysqli_query($connectData,"SELECT pro.id,pro.name,pro.price,pro.sale,pro.image,pro.id_category_child FROM productt pro
JOIN category c
ON c.id = pro.id_category_child
WHERE c.id_category_parent = 1 ORDER BY RAND() LIMIT 5") or die(notification("lỗi kết nối cơ sở dữ liệu."));
	$selectCat = mysqli_query($connectData,"SELECT * FROM category WHERE id_category_parent = 1");
	$selectBanner1 = mysqli_query($connectData,"SELECT * FROM banner_img bi
JOIN category c
ON bi.id_category_child = c.id WHERE c.id_category_parent = 1 ORDER BY RAND() LIMIT 1") or die(notification("lỗi kết nối bảng category"));
	$selectBanner2 = mysqli_query($connectData,"SELECT * FROM banner_img bi
JOIN category c
ON bi.id_category_child = c.id WHERE c.id_category_parent = 1 ORDER BY RAND() LIMIT 1") or die(notification("lỗi kết nối bảng category"));
	
	?>
<div class="full">
	<div class="slider-product-man slider">
		<div class="owl-carousel owl-theme position-relative pl-0">
			<div class="item">
				<a href="">
					<img src="public/image/Thời trang nam/slide-boy/slider-man-8.jpg" alt="">
				</a>
			</div>
			<div class="item">
				<a href="">
					<img src="public/image/Thời trang nam/slide-boy/slider-man-9@.png" alt="">
				</a>
			</div>
			<div class="item">
				<a href="">
					<img src="public/image/Thời trang nam/slide-boy/slider-man-14.jpg" alt="">
				</a>
			</div>
			<div class="item">
				<a href="">
					<img src="public/image/Thời trang nam/slide-boy/slider-man-11@.png" alt="">
				</a>
			</div>
			<div class="item">
				<a href="">
					<img src="public/image/Thời trang nam/slide-boy/slider-man-7.jpg" alt="">
				</a>
			</div>
		</div>
	</div>
</div>
<!-- </slider & header> -->
<!-- <content product-man> -->
<div class="my-container">
	
	<!-- </category> -->
	<!-- <product> -->
	<div class="product-man">
		<!-- product trend -->
		<div class="trend-content">
			<div class="title-product ml-0">
				<h4>Thịnh Hành</h4>
			</div>
			<?php
				foreach ($selectBanner1 as $banner1) {
				
			?>
			<div class="product-pro pro-left">
				<div class="box-pro row">
					<!-- banner product-man -->
					<div class="banner-product-trend col-6">
						<div class="row w-100 h-100">
							<!-- banner product -->
							<div class="col-md-8 banner-product">
								<a href="">
									<div class="img-banner"
										style="background-image: url('public/image/<?= $banner1["name_img"] ?>')">
									</div>
								</a>
							</div>
							<!-- trend -->
							<!-- <div class="col-md-4 trend-detail">

							</div> -->
						</div>
					</div>
					<!-- slide product -->
					
					<div class="slider-product-item col-6">
						<div class="owl-carousel owl-theme">
							<?php
								foreach ($selectPro as $Pro) {
								
							?>
							<div class="item">
								<div class="product-item">
									<!-- <card> -->
									<a href="index.php?view=product-detail&id=<?php echo $Pro["id"] ?>" class="link-item text-decoration-none">
										<div class="card position-relative">
											<div class="card-img" name="img-item"
												style="background-image: url('public/image/<?= $Pro["image"]; ?>')">
											</div>
											<div class="card-body p-2">
												<div clas="info-product">
													<h6 class="card-title m-0 text-center" name="card-title"><?= $Pro["name"];  ?></h6>
													<p class="star text-center m-0" name="star">
														<i class="far fa-star"></i>
														<i class="far fa-star"></i>
														<i class="far fa-star"></i>
														<i class="far fa-star"></i>
														<i class="far fa-star"></i>
													</p>
													<p class="card-text text-center">
														<?=  number_format($Pro["price"],0,",",".");  ?>
														<span class="sale text-secondary" name="sale"><?=  number_format($Pro["sale"],0,",",".");  ?></span>
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
															<label for="eye1" class="stt">
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
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
			<?php
				foreach ($selectBanner2 as $banner2) {
				
			?>
			<div class="product-pro pro-right">
				<div class="box-pro row">
					<!-- slide product -->
					<div class="slider-product-item col-6">
						<div class="owl-carousel owl-theme">
							<?php
								foreach ($selectPro as $Pro) {
								
							?>
							<div class="item">
								<div class="product-item">
									<!-- <card> -->
									<a href="index.php?view=product-detail&id=<?php echo $Pro["id"] ?>" class="link-item text-decoration-none">
										<div class="card position-relative">
											<div class="card-img" name="img-item"
												style="background-image: url('public/image/<?= $Pro["image"]; ?>')">
											</div>
											<div class="card-body p-2">
												<div clas="info-product">
													<h6 class="card-title m-0 text-center" name="card-title"><?= $Pro["name"]; ?></h6>
													<p class="star text-center m-0" name="star">
														<i class="far fa-star"></i>
														<i class="far fa-star"></i>
														<i class="far fa-star"></i>
														<i class="far fa-star"></i>
														<i class="far fa-star"></i>
													</p>
													<p class="card-text text-center">
														<?=  number_format($Pro["price"],0,",","."); ?>
														<span class="sale text-secondary" name="sale"><?=  number_format($Pro["sale"],0,",","."); ?></span>
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
															<label for="eye1" class="stt">
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
											<!--  add stt -->
										</div>
									</a>
									<!-- </card>  -->
								</div>
							</div>
						<?php } ?>
						</div>
					</div>
					<!-- banner product-man -->
					<div class="banner-product-trend col-6">
						<div class="row w-100 h-100">
							<!-- trend -->
							<!-- <div class="col-md-4 trend-detail">

							</div> -->
							<!-- banner product -->
							<div class="col-md-8 banner-product">
								<a href="">
									<div class="img-banner"
										style="background-image: url('public/image/<?= $banner1["name_img"] ?>')">
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>

		</div>
		<?php
			$selectPro2 = mysqli_query($connectData,"SELECT pro.id,pro.name,pro.price,pro.sale,pro.image,pro.id_category_child FROM productt pro
				JOIN category c
				ON c.id = pro.id_category_child
				WHERE c.id_category_parent = 1 ORDER BY RAND() LIMIT 12") or die(notification("lỗi kết nối cơ sở dữ liệu."));
			
			
		?>
		<!-- <type product> -->
	<div class="menu-product">
		<div class="type-product">
			<ul class="nav nav-pills" id="pills-tab" role="tablist">
				<li class="nav-item">
					<a class="nav-link pb-0 active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
						aria-controls="pills-home" aria-selected="true">
						<h5>Thể Loại</h5>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link pb-0" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
						aria-controls="pills-profile" aria-selected="false">
						<h5>Lọc Theo</h5>
					</a>
				</li>
			</ul>
		</div>
		<div class="tab-content pb-2" id="pills-tabContent">
			<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
				<div class="item-category">
					<?php
						foreach ($selectCat as $cat) {
					?>
					<div class="c-item" onclick="fillCat(<?php echo $cat["id"] ?>)"><?php echo $cat["name"]; ?></div>
					<?php } ?>
				</div>
			</div>
			<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
				<div class="fill ">
					<form action="" class="d-flex">
						<div class="price mx-4">
							<select name="price" id="price">
								<option value="100">Dưới~100k</option>
								<option value="250">Dưới~250k</option>
								<option value="500">Dưới~500k</option>
								<option value="">Dưới~900k</option>
								<option value="">Trên 900k</option>
							</select>
						</div>
						<div class="color mx-4">
							<select name="size" id="size">
								<option value="">
									<div class="item-color">-- Cỡ --</div>
								</option>
								<option value="1">
									<div class="item-color">X</div>
								</option>
								<option value="2">
									<div class="item-color">M</div>
								</option>
								<option value="3">
									<div class="item-color">L</div>
								</option>
								<option value="4">
									<div class="item-color">XL</div>
								</option>
							</select>
						</div>
						<button class="btn btn-danger py-0 px-4" type="button" name="filling" onclick="fill('#price','#size')">Lọc</button>
					</form>
				</div>
			</div>
		</div>
	</div>
		<!-- <all product man> -->
		<div class="product mt-2 pro-boy">
			<!-- title  product-->
			<div class="title-product ml-0">
				<h4>Sản Phẩm</h4>
			</div>

			<div class="row mx-0 pl-0">
				<!-- <product item> -->
					<?php foreach ($selectPro2 as $Pro2) { ?>
				<div class="col-md-2 col-6 col-sm-4  pr-0 mt-3">
					<div class="product-item">
						<!-- <card> -->
						<a href="index.php?view=product-detail&id=<?php echo $Pro["id"] ?>" class="link-item text-decoration-none">
							<div class="card position-relative">
								<div class="card-img" name="img-item"
									style="background-image: url('public/image/<?= $Pro2["image"]; ?>')">
								</div>
								<div class="card-body p-2">
									<div clas="info-product">
										<h6 class="card-title m-0 text-center" name="card-title"><?= $Pro2["name"]; ?></h6>
										<p class="star text-center m-0" name="star">
											<i class="far fa-star"></i>
											<i class="far fa-star"></i>
											<i class="far fa-star"></i>
											<i class="far fa-star"></i>
											<i class="far fa-star"></i>
										</p>
										<p class="card-text text-center">
											<?= number_format($Pro2["price"],0,",","."); ?>
											<span class="sale text-secondary" name="sale"><?= number_format($Pro2["sale"],0,",","."); ?></span>
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
												<label for="eye1" class="stt">
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
</div>

