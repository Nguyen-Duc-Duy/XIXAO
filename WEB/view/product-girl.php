<?php
$pagename = $_GET["view"];
if($pagename == "product-boy" || $pagename == "product-girl"){
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
?>
<!-- <slider & header> -->
	<div class="full">
		<div class="slider-product-man slider">
			<div class="owl-carousel owl-theme position-relative pl-0">
				<div class="item">
					<a href="">
						<img src="public/image/Thời trang nữ/slide/slider-1.png" alt="">
					</a>
				</div>
				<div class="item">
					<a href="">
						<img src="public/image/Thời trang nữ/slide/slider-2.png" alt="">
					</a>
				</div>
				<div class="item">
					<a href="">
						<img src="public/image/Thời trang nữ/slide/slider-7.png" alt="">
					</a>
				</div>
				<div class="item">
					<a href="">
						<img src="public/image/Thời trang nữ/slide/slider-8.png" alt="">
					</a>
				</div>
				<div class="item">
					<a href="">
						<img src="public/image/Thời trang nữ/slide/slider-9.jpg" alt="">
					</a>
				</div>
				<div class="item">
					<a href="">
						<img src="public/image/Thời trang nữ/slide/slider-10.png" alt="">
					</a>
				</div>
			</div>
		</div>
	</div>
	<!-- <content product-man> -->
		<div class="my-container">
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
					<div class="c-item"><a href="">Vest</a></div>
					<div class="c-item"><a href="">Sport</a></div>
					<div class="c-item"><a href="">Short</a></div>
					<div class="c-item"><a href="">Nude</a></div>
					<div class="c-item"><a href="">Winter</a></div>
					<div class="c-item"><a href="">Street</a></div>
					<div class="c-item"><a href="">Overall</a></div>
					<div class="c-item"><a href="">Event</a></div>
				</div>
			</div>
			<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
				<div class="fill ">
					<form action="" class="d-flex">
						<div class="location mx-4">
							<select name="" id="">
								<option value="">Hà Nội</option>
								<option value="">Hà Nội</option>
								<option value="">Hà Nội</option>
								<option value="">Hà Nội</option>
							</select>
						</div>
						<div class="price mx-4">
							<select name="" id="">
								<option value="">Dưới 100k</option>
								<option value="">100k~250k</option>
								<option value="">250k~500k</option>
								<option value="">500k~900k</option>
								<option value="">Trên 900k</option>
							</select>
						</div>
						<div class="color mx-4">
							<select name="" id="">
								<option value="">
									<div class="item-color"></div>Đỏ
								</option>
								<option value="">
									<div class="item-color"></div>Trắng
								</option>
								<option value="">
									<div class="item-color"></div>Vàng
								</option>
								<option value="">
									<div class="item-color"></div>Xanh nước biển
								</option>
								<option value="">
									<div class="item-color"></div>Xám
								</option>
								<option value="">
									<div class="item-color"></div>Đen
								</option>
								<option value="">
									<div class="item-color"></div>Xanh rêu
								</option>
								<option value="">
									<div class="item-color"></div>Xanh ngọc
								</option>
								<option value="">
									<div class="item-color"></div>
								</option>
							</select>
						</div>
						<button class="btn btn-danger py-0 px-4" type="button" name="filling">Lọc</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="product-girl">
		<div class="trend-content mt-2">
			<div class="title-product ml-0">
				<h4>Thịnh Hành</h4>
			</div>
			<div class="box-trend">
				<!-- <trend first> -->
				<div class="trendfirst">
					<div class="row w-100 m-0">
						<!-- banner trend -->
						<div class="col-md-5 banner-girl p-0">
							<div style="background-image: url('public/image/product-girl/slide/banner-15.jpg');"></div>
						</div>
						<!-- trend set -->
						<div class="col-md-4 trend-accessory p-0">
							<div class="flex-column h-100">
								<div class="item-accssory">
									<div class="info-as m-auto text-center px-3">
										<p>Mũ Bucket trắng</p>
										<p>Mũ Bucket tai bèo khiến bạn trở nên dịu dàng ngay thơ một cách tự nhiên.</p>
										<span>90.000đ</span>
									</div>
									<div class="img-as"><img class="w-100" src="public/image/Thời trang nữ/cap/cap-1@.png" alt=""></div>
								</div>
								<div class="item-accssory">
									<div class="info-as m-auto text-center px-3">
										<p>Áo thun trắng</p>
										<p>Chất thun không quá mỏng cũng không quá dài sẽ mang đến cho bạn sự thoải mái khi diện..</p>
										<span>110.000đ</span>
									</div>
									<div class="img-as"><img class="w-100" src="public/image/Thời trang nữ/aothunnu-trang@.jpg.png" alt=""></div>
								</div>
								<div class="item-accssory">
									<div class="info-as m-auto text-center px-3">
										<p>Quần Short ống rộng</p>
										<p>Bạn gầy hay mập thì cũng đều rất phù hợp.</p>
										<span>60.000đ</span>
									</div>
									<div class="img-as"><img class="w-100" src="public/image/Thời trang nữ/short/short-20@.png" alt=""></div>
								</div>
							</div>
						</div>
						<!-- </trend set>-->
						<!-- <type trend> -->
							<div class="col-md-3">
								<div class="flex-column h-100">
									<div class="item-product-more py-2">
										<!-- <product type item> -->
											<div class="w-100 d-flex">
												<div class="box-info-stt pt-2">
													<div class="info-item m-0">
														<p class="type-small">SHORT</p>
														<p class="price">120.000đ</p>
													</div>
													<!-- <div class="stt-item">
														<form action="" class="send-stt">
															<input type="checkbox" id="heart5">
															<label for="heart5" class="stt">
																<i class="fas fa-heart text-danger"></i>
																<i class="far fa-heart text-danger"></i>
															</label>
															<input type="checkbox" id="eye5">
															<label for="eye5" class="stt">
																<i class="fas fa-check text-success"></i>
																<i class="far fa-eye text-warning mr-2"></i>
															</label>
														</form>
													</div> -->
												</div>
												<div class="img-item-small"
												style="background-image: url('public/image/Product-boy/product-3.jpg')">
											</div>
										</div>
										<!-- </product type item> -->
									</div>
								</div>
							</div>
							<!-- <type trend> -->
							</div>
						</div>
						<!-- </trend first> -->
						<div class="sale-girl p-4">
							<div class="w-50 h-100 content-sale text-center m-auto" >
								<h2>ƯU ĐÃI THÁNG 7</h2>
								<p>NHẬN NGAY ƯU ĐÃI KHI MUA CÁC SẢN PHẨM VÀO THÁNG 7. GIẢM NGAY 20% KHI MUA ĐƠN HÀNG TRÊN 500K. MIỄN PHÍ SHIP TOÀN QUỐC.</p>
							</div>
						</div>
						<!-- <trend last> -->
						<div class="trendlast mt-2">
							<div class="row w-100 m-0">
								<!-- banner trend -->
								<div class="col-md-5 banner-girl p-0">
									<div style="background-image: url('public/image/product-girl/overall/banner-overall-4.jpg');"></div>
								</div>
								<!-- trend set -->
								<div class="col-md-4 trend-accessory p-0">
									<div class="flex-column h-100">
										<div class="item-accssory">
											<div class="info-as m-auto text-center px-3">
												<p>Mũ Bucket trắng</p>
												<p>Mũ Bucket tai bèo khiến bạn trở nên dịu dàng ngay thơ một cách tự nhiên.</p>
												<span>90.000đ</span>
											</div>
											<div class="img-as"><img class="w-100" src="public/image/Product-girl/cap/cap-1@.png" alt=""></div>
										</div>
										<div class="item-accssory">
											<div class="info-as m-auto text-center px-3">
												<p>Áo thun trắng</p>
												<p>Chất thun không quá mỏng cũng không quá dài sẽ mang đến cho bạn sự thoải mái khi diện..</p>
												<span>110.000đ</span>
											</div>
											<div class="img-as"><img class="w-100" src="public/image/Product-girl/aothunnu-trang@.jpg.png" alt=""></div>
										</div>
										<div class="item-accssory">
											<div class="info-as m-auto text-center px-3">
												<p>Quần Short ống rộng</p>
												<p>Bạn gầy hay mập thì cũng đều rất phù hợp.</p>
												<span>60.000đ</span>
											</div>
											<div class="img-as"><img class="w-100" src="public/image/Product-girl/short/short-20@.png" alt=""></div>
										</div>
									</div>
								</div>
								<!-- </trend set>-->
								<!-- <type trend> -->
									<div class="col-md-3">
										<div class="flex-column h-100">
											<div class="item-product-more py-2">
												<!-- <product type item> -->
													<div class="w-100 d-flex">
														<div class="box-info-stt pt-2">
															<div class="info-item m-0">
																<p class="type-small">SHORT</p>
																<p class="price">120.000đ</p>
															</div>
															<!-- <div class="stt-item">
																<form action="" class="send-stt">
																	<input type="checkbox" id="heart5">
																	<label for="heart5" class="stt">
																		<i class="fas fa-heart text-danger"></i>
																		<i class="far fa-heart text-danger"></i>
																	</label>
																	<input type="checkbox" id="eye5">
																	<label for="eye5" class="stt">
																		<i class="fas fa-check text-success"></i>
																		<i class="far fa-eye text-warning mr-2"></i>
																	</label>
																</form>
															</div> -->
														</div>
														<div class="img-item-small"
														style="background-image: url('public/image/Product-boy/product-3.jpg')">
													</div>
												</div>
												<!-- </product type item> -->
											</div>
										</div>
									</div>
									<!-- <type trend> -->
									</div>
								</div>
							</div>
						</div>
						<!-- </trend last> -->
				<div class="product mt-2">
						<!-- title  product-->
						<div class="title-product ml-0">
							<h4>Sản Phẩm</h4>
						</div>

						<div class="row mx-0 pl-0">
							<!-- <product item> -->
								<div class="col-md-2 col-6 col-sm-4  pr-0">
									<div class="product-item">
										<!-- <card> -->
											<a href="" class="link-item text-decoration-none">
												<div class="card position-relative">
													<div class="card-img" name="img-item"
													style="background-image: url('public/image/Product-girl/skirt/skirt-3.jpg')">
												</div>
												<div class="card-body p-2">
													<div clas="info-product">
														<h6 class="card-title m-0 text-center" name="card-title">SKIRT</h6>
														<p class="star text-center m-0" name="star">
															<i class="far fa-star"></i>
															<i class="far fa-star"></i>
															<i class="far fa-star"></i>
															<i class="far fa-star"></i>
															<i class="far fa-star"></i>
														</p>
														<p class="card-text text-center">
															120.000đ
															<span class="sale text-secondary" name="sale"></span>
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
								<!-- </product item> -->
							</div>
						</div>
					</div>
					</div>
					
<!-- </slider & header> -->