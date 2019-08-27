<?php
session_start();
include("connect.php");
include("../pre-admin/module/funtion.php");
include("function.php");

// <!-- chọn tỉnh thành phố -->
if(isset($_POST["location"])){
	$table = $_POST["table"];
	$idsql = $_POST["idSQL"];
	$id = $_POST["location"];
	$selectLocation = mysqli_query($connectData,"SELECT * FROM $table WHERE $idsql = '$id' ORDER BY name") or die ("lỗi kết nối csdl, Xin thử lại");
	foreach ($selectLocation as  $value) {
		echo '<option value="'.$value["id"].'">'.$value['name'].'</option>';
	}
}
//lấy email đổi quên mật khẩu
if(isset($_POST["email"]) && isset($_POST["where"])){
	$email = $_POST["email"];
	$where = $_POST["where"];
	// kiểm tra email
	$selectEmail = mysqli_query($connectData,"SELECT * FROM customer WHERE email = '$email'") or (notification("lỗi truy vấy csdl,  xin thử lại"));
	if(mysqli_fetch_row($selectEmail)){
		$random = bin2hex(random_bytes(3));
		echo $random;
		//forgorPass($email,$random);
		$_SESSION["randomUser"] = $random;
		$_SESSION["email"] = $email;
		notification("Vui lòng kiểm tra email và nhập 6 chữ số để đổi mật khẩu mới");
		?>
		<form method="POST" class="mt-3 col-10 mx-auto">
			<div class="emailLogin" >
				<div class="form-group">
					<label for="codeforgot">Nhập mã</label>
					<div>
						<input type="text" required class="form-control" id="codeforgot" name="codeforgot">
					</div>
				</div>
			</div>
			<div data-toggle="modal" data-target="#sigup" class="text-white">
				<p>Đăng ký tài khoản</p>
			</div>
			<button type="button" onclick="checkRandom('<?php echo $where; ?>','codeforgot')" class="btn btn-success">Gửi</button>      
		</form>
		<?php
	}else{
		notification("Email không tồn tại xin thử lại");
		?>
		<form method="POST" class="mt-3 col-10 mx-auto">
			<div class="emailLogin" >
				<div class="form-group">
					<label for="emailforgot">Nhập Email</label>
					<div>
						<input type="email" required class="form-control" id="emailforgot" name="emailForgot">
					</div>
				</div>
			</div>
			<div data-toggle="modal" data-target="#sigup" class="text-white">
				<p>Đăng ký tài khoản</p>
			</div>
			<button type="button" onclick="changePass('emailforgot','changeFormForgot')" class="btn btn-success" name="forgot">Gửi</button>      
		</form>
		<?php
	}
}
// kiểm tra mã random
if(isset($_POST["checkRandom"])){
	$where = $_POST["where"];
	$random = $_POST["checkRandom"];
	$ssRandom = $_SESSION["randomUser"];
	if($random == $ssRandom){

		?>
		<form method="POST" class="mt-3 col-10 mx-auto">
			<div class="emailLogin" >
				<div class="form-group">
					<label for="newPassForgot">Mật khẩu mới</label>
					<div>
						<input type="password" pattern="[0-9a-zA-Z]{8,}" title="Mật khẩu phải chứa ít nhất 8 ký tự" required class="form-control" id="newPassForgot" name="newPassForgot">
					</div>
				</div>
			</div>
			<div data-toggle="modal" data-target="#sigup" class="text-white">
				<p>Đăng ký tài khoản</p>
			</div>
			<button type="submit" class="btn btn-success" name="newPass">Đổi</button>      
		</form>
		<?php
	}else{
		notification("Mã không hợp lệ, xin thử lại");
		?>
		<form method="POST" class="mt-3 col-10 mx-auto">
			<div class="emailLogin" >
				<div class="form-group">
					<label for="codeforgot">Nhập mã</label>
					<div>
						<input type="text" required class="form-control" id="codeforgot" name="codeforgot" placeholder="Nhập mã gồm 6 chữ số">
					</div>
				</div>
			</div>
			<div data-toggle="modal" data-target="#sigup" class="text-white">
				<p>Đăng ký tài khoản</p>
			</div>
			<button type="button" onclick="checkRandom('<?php echo $where; ?>','codeforgot')" class="btn btn-success">Gửi</button>      
		</form>
		<?php
	}
}
//lọc sp theo giá và size
if (isset($_POST["price"])) {
	$price = $_POST["price"]."000";
	$size = $_POST["size"];
	$selectPro2 = mysqli_query($connectData,"SELECT pro.id,pro.name,pro.price,pro.sale,pro.image,pro.id_category_child,s.size FROM productt pro
		JOIN product_feature pf
		ON pf.id_product = pro.id
		JOIN size s
		ON s.id = pf.id_size
		JOIN category c
		ON pro.id_category_child = c.id
		WHERE pro.price < $price  AND s.id = $size AND c.id_category_parent = 1") or die(notification("lỗi kết nối cơ sở dữ liệu."));
	if($selectPro2->num_rows > 0){
		?>
		<?php foreach ($selectPro2 as $Pro2) { ?>
			<div class="col-md-2 col-6 col-sm-4  pr-0">
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

						</div>
					</a>
					<!-- </card>  -->
				</div>
			</div>
		<?php
	}
		}else{
		 ?>
		<h5 class="text-center text-secondary px-3">Không có sản phẩm theo yêu cầu của bạn.</h3>
		<?php
	} }
	?>
	<?php
//lọc sản phẩm theo danh mục con
	if(isset($_POST["catChild"])){
		$idCat = $_POST["catChild"];

		$selectPro2 = mysqli_query($connectData,"SELECT pro.id,pro.name,pro.price,pro.sale,pro.image,pro.id_category_child FROM productt pro
			JOIN category c
			ON pro.id_category_child = c.id
			WHERE c.id = $idCat") or die(notification("lỗi kết nối cơ sở dữ liệu."));
		if($selectPro2->num_rows > 0){
			?>
			<?php foreach ($selectPro2 as $Pro2) { ?>
				<div class="col-md-2 col-6 col-sm-4  pr-0">
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

							</div>
						</a>
						<!-- </card>  -->
					</div>
				</div>
			<?php }
		}else{
			 ?>
			<h5 class="text-center text-secondary px-3">Không có sản phẩm theo yêu cầu của bạn.</h3>
			<?php
		} 
	}
		?>