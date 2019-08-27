<?php
ob_start();

include("view/connect.php");
if(isset($_POST["pay"])){
	header("location: index.php");
}
	//lấy địa chỉ 
	$selectLocation = mysqli_query($connectData,"SELECT * FROM province");

	// lấy thông tin tài khoản
if(isset($_SESSION["user"])){
	$selectUser = mysqli_query($connectData,"SELECT * FROM customerr WHERE id = ".$_SESSION["user"]) or die("lỗi truy xuất thông tin tài khoản");
	$user = mysqli_fetch_assoc($selectUser);
}
//lấy thông tin từ session
if(isset($_SESSION["cart"])){
	$cart = $_SESSION["cart"];
	$subTotalPrice = 0;
	$subTotalSale = 0;
	foreach ($cart as $cartPro) {
		$id = $cartPro["id"];
		$selectPro = mysqli_query($connectData,"SELECT * FROM productt WHERE id =$id") or die (notification("lỗi truy cập bảng sản phẩm, Xin thử lại !"));
		$value = mysqli_fetch_assoc($selectPro);
		$totalPrice = ($value["price"]*$cartPro["number"]);
		$totalSale = ($value["sale"]*$cartPro["number"]);
		$subTotalPrice += $totalPrice;
		$subTotalSale += $totalSale;
	}
}
$idCus = $_SESSION["user"];
if (isset($_POST["sendForMe"])) {
	if(isset($_SESSION["user"])){
		$idCus = $_SESSION["user"];
		//lấy thông tin tài khoản
		$seletCus = mysqli_query($connectData,"SELECT * FROM customerr WHERE id = $idCus");
		$cus = mysqli_fetch_assoc($seletCus);
		$cusName = $cus["name"];
		$cusAdd = $cus["address"];
		$cusPhone = $cus["phone"];
		$cusEmail = $cus["email"];
		$cusId = $cus["id"];
		// thêm thông tin đơn hàng trên csdl
		mysqli_query($connectData,"INSERT INTO `order`(name_ship,phone_ship,address_ship,email_ship,id_customer,`money`) VALUES ('$cusName','$cusPhone','$cusAdd','$cusEmail',$cusId,$subTotalPrice)") or die("error connect database");
		$idOrder = mysqli_insert_id($connectData);
		// lấy sản phẩm theo đặc điểm
		foreach($cart as $cartPro) {
			$idPro = $cartPro["id"];
			$idSize = $cartPro["size"];
			$quantity = $cartPro["number"];
			$reProFeature = mysqli_fetch_assoc(mysqli_query($connectData,"SELECT * FROM product_feature WHERE id_product = $idPro AND id_size = $idSize"));
			$idFeature = $reProFeature["id"];
			// thêm thông tin sản phẩm của order
			mysqli_query($connectData,"INSERT INTO order_detaily(id_product_feature,id_order,quatity) VALUES ($idFeature,$idOrder,$quantity)")or die("error insert database");
			notification("Đơn hàng đã được đăt thành công. Bạn có thể vào <h4>Theo dõi đơn hàng</h4> để biết thông tin về đơn hàng.");
			unset($_SESSION["cart"]);
			
		}
	}else{
		header("location: index.php?view=cart");
	}
	//notification("Đơn hàng đã Đặt hàng thành công.");
	header("location: index.php");
}
// gửi đơn hàng
if(isset($_POST["donate"])){
	$Province = mysqli_fetch_assoc(mysqli_query($connectData,"SELECT name FROM province WHERE id =".$_POST["provice"]));
	$District = mysqli_fetch_assoc(mysqli_query($connectData,"SELECT name FROM district WHERE id =".$_POST["district"]));
	$Ward = mysqli_fetch_assoc(mysqli_query($connectData,"SELECT name FROM ward WHERE id =".$_POST["ward"]));
	$location = $Province["name"].", ".$District["name"].", ".$Ward["name"];
	$cusName = $_POST["nameReceiver"];
	$cusPhone = $_POST["phoneReceiver"];
	$cusEmail = $_POST["emailReceiver"];
	// thêm thông tin đơn hàng trên csdl
		mysqli_query($connectData,"INSERT INTO `order`(name_ship,phone_ship,address_ship,email_ship,id_customer,`money`) VALUES ('$cusName','$cusPhone','$location','$cusEmail',$idCus,$subTotalPrice)") or die("error connect database");
		$idOrder = mysqli_insert_id($connectData);
	// lấy sản phẩm theo đặc điểm
		foreach($cart as $cartPro) {
			$idPro = $cartPro["id"];
			$idSize = $cartPro["size"];
			$quantity = $cartPro["number"];
			$reProFeature = mysqli_fetch_assoc(mysqli_query($connectData,"SELECT * FROM product_feature WHERE id_product = $idPro AND id_size = $idSize"));
			$idFeature = $reProFeature["id"];
			// thêm thông tin sản phẩm của order
			mysqli_query($connectData,"INSERT INTO order_detaily(id_product_feature,id_order,quatity) VALUES ($idFeature,$idOrder,$quantity)")or die("error insert database");
			notification("Đơn hàng đã được đăt thành công. Bạn có thể vào <h4>Theo dõi đơn hàng</h4> để biết thông tin về đơn hàng.");
			unset($_SESSION["cart"]);
			
		}
		//notification("Đơn hàng đã Đặt hàng thành công.");
		header("location: index.php");
}
?>

<!-- thanh toán và đặt hàng -->
<div class="my-container">
	<div class="box-pay">
		<div class="header-cart title-product mt-2">
			<h4>Thanh toán đơn hàng</h4>
		</div>
		<nav>
			<div class="nav nav-tabs bg-white" id="nav-tab" role="tablist">
				<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#buyForMe" role="tab" aria-controls="nav-home" aria-selected="true">Gửi cho tôi</a>
				<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#donate" role="tab" aria-controls="nav-profile" aria-selected="false">Tặng đơn hàng</a>
			</div>
		</nav>
		<div class="tab-content" id="nav-tabContent">
			<div class="tab-pane fade show active" id="buyForMe" role="tabpanel" aria-labelledby="nav-home-tab">
				<div class="row mb-1 mx-0">
					<div class="col-8 buyForMe p-0">
						<h5>Mua cho tôi</h5>
						<div class="cart p-0">
							<h6 class=" py-2">Địa chỉ nhận hàng của tôi</h6>
							<div class="myInfo">
								<p><span><?php echo $user["name"]; ?></span> <span><?php echo $user["email"]; ?></span></p>
								<p><?php echo $user["address"]; ?></p>
							</div>
						</div>
						<div class="filed mt-2">
							<h5>Phương thức thanh toán</h5>
							<div class="d-flex py-0 pl-3">
								<img src="public/image/freeship.png" alt="" style="width: 50px;">
								<p>Thanh toán khi nhận hàng</p>
							</div>
						</div>
					</div>
					<div class="col-4 position-relative">
						<div class="order w-100 pay-price">
							<p>Tổng tiền : <span><?php echo number_format(($subTotalPrice),0,".","."); ?></span></p>
							<p>Tổng khuyến mại : <span style="text-decoration: line-through;"><?php echo number_format(($subTotalSale),0,".","."); ?></span></p>
							<form action="" method="POST">
								<button type="submit" class="btn btn-success" name="sendForMe"> Đặt Hàng</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- tặng hàng -->
			<div class="tab-pane fade" id="donate" role="tabpanel" aria-labelledby="nav-profile-tab">
				<div class="row mx-0">
					<div class="col-12">
						<h5>Tặng hàng</h5>
					</div>
					<div class="col-8">
						<form method="POST">
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="inputEmail4">Tên người nhận</label>
									<input type="text" name="nameReceiver" class="form-control" id="name">
								</div>
								<div class="form-group col-md-6">
									<label for="inputPassword4">Số điện thoại</label>
									<input type="text" name="phoneReceiver" pattern="[0-9]{10}" title="Vui lòng nhập số điện thoại có đúng 10 số"	oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  class="form-control" id="inputPassword4">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail4">Email người nhận</label>
								<input type="email" name="emailReceiver" class="form-control" id="inputEmail4" placeholder="Email">
							</div>
							<div class="form-row">
								<div class="form-group col-md-4">
									<label for="provice-pay">Tỉnh/Thành phố</label>
									<select id="provice-pay" class="form-control" name="provice" onchange="changeLocation('#provice-pay','#district-pay','district','province_id')">
										<option value="">---Tỉnh/Thành phố---</option>
										<?php
										foreach ($selectLocation as $key => $value) {
											?>
											<option value="<?php echo $value['id']; ?> "><?php echo $value["name"]; ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group col-md-4">
									<label for="district-pay">Quận/Huyện</label>
									<select id="district-pay" class="form-control" name="district" onchange="changeLocation('#district-pay','#ward-pay','ward','district_id')">
										<option value="">---Quận/Huyện---</option>

									</select>
								</div>
								<div class="form-group col-md-4">
									<label for="ward-pay">Phường/Xã</label>
									<select id="ward-pay" class="form-control" name="ward">
										<option value="">---Phường/Xã---</option>

									</select>
								</div>
							</div>
							<!-- note -->
							<div class="noteDonate">
								<h4><i class="fas fa-exclamation-circle"></i></h4>
								<p><span> Vui lòng thanh toán đơn hàng tại cửa hàng. Nếu bạn không thanh toán trong 15 ngày đơn hàng sẽ bị hủy.</span></p>
							</div>
						</div>
						<div class="col-4 position-relative">
							<div class="order w-100 pay-price">
								<p>Tổng tiền : <span><?php echo number_format(($subTotalPrice),0,".","."); ?></span></p>
								<p>Tổng khuyến mại : <span style="text-decoration: line-through;"><?php echo number_format(($subTotalSale),0,".","."); ?></span></p>
								<button type="submit" class="btn btn-success" name="donate"> Đặt Hàng</button>
							</div>
						</div>
					</form>

				</div>
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
	<!-- SẢN PHẨM LIÊN QUAN -->
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
									<div class="interact-product">
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
									</div>
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
	<!-- chọn địa chỉ giao hàng -->
	<script>
		$(document).ready(function(){
			$("#district").change(function(){
				var $id = $("#district option:selected").val();
				$.ajax({
					type: "POST",
					url: "pre-admin/module/ajax-add.php",
					data: "idDistrict="+$id,
					success : function(resultDis){
						$("#provice").html(resultDis);
					}
				})
			})
		})
	</script>