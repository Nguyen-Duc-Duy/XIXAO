<?php
session_start();
$severname ="localhost";
$username = "root";
$pass = "";
$namedatabase = "xixao";
$connectData = new mysqli($severname,$username,$pass,$namedatabase) or die ("lỗi kết nối cơ sở dữ liệu, xin thử lại !");
mysqli_set_charset($connectData,'UTF8'); 
include("funtion.php");
// select option danh mục
if(isset($_POST["parent"])){
	$id = $_POST["parent"];
	$idSeleted = $_POST["selected"];
	$sql = mysqli_query($connectData,"SELECT * FROM category WHERE id_category_parent =  $id");
	foreach ($sql as $value) {
		if($idSeleted == $value["id"]){
		echo '<option selected value="'.$value["id"].'">'.$value['name'].'</option>';
		}else{
			echo '<option value="'.$value["id"].'">'.$value['name'].'</option>';
		}
	}
}
?>
<?php
// thêm ảnh slider
if(isset($_POST["imgSlider"])){
	$cat = $_POST["cat"];
	$img  = $_POST["imgSlider"];
	// thêm silder
	$insertSlider = mysqli_query($connectData,"INSERT INTO slider_img(id_category_parent,img) VALUES  ($cat,'$img')") or die ("lỗi kết nối csdl");
 	// lấy slider theo danh mục
	$selectSilerCat = mysqli_query($connectData,"SELECT * FROM slider_img WHERE id_category_parent = $cat")or die("error");
	header("location: index.php?module=silder");
	foreach ($selectSilerCat as $slider) {

		?>
		<div class="img-slider<?php echo $cat; ?>">
			<div class="imgSlider">
				<div class="closeSilder" onclick="deleteSilder(<?= $slider["id"]; ?>,<?= $cat; ?>)">
					<i class="fas fa-times-circle"></i>
				</div>
				<img src="../public/image/slide/<?= $slider["img"]; ?>" alt="">
			</div>
		</div>
		<?php
	}
	
}
// xóa ảnh slider
if (isset($_POST["deleteSilder"])) {
	$id = $_POST["deleteSilder"];
	$idCat = $_POST["idCat"];
	mysqli_query($connectData,"DELETE FROM slider_img WHERE id = $id")or die("DELETE slider_img WHERE id = $id");
	// lấy slider theo danh mục
	$selectSiler = mysqli_query($connectData,"SELECT * FROM slider_img WHERE id_category_parent = $idCat")or die("error");
	header("location: index.php?module=silder");
	foreach ($selectSiler as $slider) {
		if ($selectSiler->num_rows > 0) {
				
			 ?>
			<div class="img-slider<?php echo $idCat; ?>">
				<div class="imgSlider">
					<div class="closeSilder" onclick="deleteSilder(<?= $slider["id"]; ?>,<?= $idCat; ?>)">
						<i class="fas fa-times-circle"></i>
					</div>
					<img src="../public/image/slide/<?= $slider["img"]; ?>" alt="">
				</div>
			</div>
		<?php
		}else{ echo "Danh mục hiện không có ảnh slider nào. Vui lòng thêm ảnh silder. ";}
	}
}
?>
<?php
// load more sản phẩm 
if(isset($_POST["loadMore"])){
	$id = $_POST["loadMore"];
	$selectPro = mysqli_query($connectData,"SELECT COUNT(*) AS 'row' FROM productt");
	$row = mysqli_fetch_assoc($selectPro);

	$totalRow = $row["row"];
	$limitPro = (floor($totalRow/4))*4;
	$selectProMore = mysqli_query($connectData,"SELECT * FROM productt ORDER BY RAND()  LIMIT $limitPro");
	?>

	<?php foreach ($selectProMore as $rowMore){
		$postId = $rowMore["id"]; ?>
		<div class="col-md-3 col-6 col-sm-4  pr-0 my-2">
			<div class="product-item">
				<!-- <card> -->
					<a href="index.php?view=product-detail&id=<?php echo $rowMore["id"] ?>" class="link-item text-decoration-none">
						<div class="card position-relative">
							<div class="card-img" name="img-item"
							style="background-image: url('public/image/<?php echo $rowMore["image"] ?>')">
						</div>
						<div class="card-body p-2">
							<div clas="info-product">
								<h6 class="card-title m-0 text-center" name="card-title"><?php echo $rowMore["name"] ?></h6>
								<p class="star text-center m-0" name="star">
									<i class="far fa-star"></i>
									<i class="far fa-star"></i>
									<i class="far fa-star"></i>
									<i class="far fa-star"></i>
									<i class="far fa-star"></i>
								</p>
								<p class="card-text text-center">
									<?php echo $rowMore["price"] ?>
									<span class="sale text-secondary" name="sale"> <?php echo $rowMore["sale"] ?></span>
								</p>
							</div>
						</div>
						<!--  add stt -->
						<div class="interact-product">
							<form class="send-stt">
								<ul class="nav flex-column text-center">
									<li class="nav-item mb-2">
										<input type="checkbox" id="heart<?php echo $rowMore["id"] ?>">
										<label for="heart<?php echo $rowMore["id"] ?>" class="stt">
											<i class="fas fa-heart text-danger"></i>
											<i class="far fa-heart text-danger"></i>
										</label>
										<div class="val-stt">
											<strong>1</strong>
										</div>
									</li>
									<li class="nav-item mb-2">
										<input type="checkbox" id="cart<?php echo $rowMore["id"] ?>">
										<label for="cart<?php echo $rowMore["id"] ?>" class="stt">
											<i class="fas fa-vote-yea text-success"></i>
											<i class="fas fa-cart-arrow-down text-success"></i>
										</label>
										<div class="val-stt">
											<strong>1</strong>
										</div>
									</li>
									<li class="nav-item">
										<input type="checkbox" id="eye<?php echo $rowMore["id"] ?>">
										<label for="eye<?php echo $rowMore["id"] ?>" class="stt eye">
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

		<?php 
	}
	?>
	<!-- </product item> -->
	<button class="btn btn-outline-danger show-more m-auto" id="<?php echo $postId; ?>" >Xem Thêm</button>
	<p class="btn btn-outline-danger m-0 loading mb-2" style="display: none;">Loading...</p>
	<?php
}
?>
<?php
// phuowng thuc ddawng nhap
if (isset($_POST["emailAcc"]) && isset($_POST["passAcc"])) {
	$email = $_POST["emailAcc"];
	$pass = $_POST["passAcc"];
// đăng nhập admin
// truy cập tài khoản từ csdl
	$selectAcc = "SELECT * FROM admin WHERE email = '$email'";
	$resultAcc = mysqli_query($connectData,$selectAcc) or die("lỗi kết nối bảng admin_acc, xin thử lại!");
	$Acc = mysqli_fetch_assoc($resultAcc);
	$rowAcc = mysqli_num_rows($resultAcc);
	if($pass == $Acc["pass"]){
		$_SESSION["admin"] = $Acc["id"];
		echo "<script> window.location.assign('http://localhost/MyPHP/XIXAO/WEB/pre-admin/index.php')</script>";
	}else{
		notification("Tên tài khoản hoặc mật khẩu sai, Xin thử lại!");
	}
}
// quên mật khẩu và đổi mật khẩu
if(isset($_POST["email"])){
	$email = $_POST["email"];
	$value = $_POST["value"];
	$where = $_POST["where"];
	$selectAcc = mysqli_query($connectData,"SELECT * FROM admin WHERE email = '$email'") or die (notification("lỗi kết nối bảng admin, Xin thử lại !"));
	if($rowAdmin = mysqli_fetch_row($selectAcc)){
		$random = bin2hex(random_bytes(3));
		forgorAcc($email,$random);
		$_SESSION["random"] = $random;
		$_SESSION["email"] = $email;
		notification("Vui lòng kiểm tra email và nhập 6 chữ số để đổi mật khẩu mới");
		?>
		<!-- form nhập mã random -->
		<form method="post">
			<div class="field-group" id="forgot">
				<span class="fa fa-lock" aria-hidden="true"></span>
				<div class="wthree-field">
					<input name="key" type="text" id="random-<?php echo $where ?>" name="random" placeholder="Nhập mã gồm 6 ký tự">
				</div>
			</div>
			<div class="wthree-field">

				<button type="button" name="forgot" class="btn" onclick="checkRandom('<?php echo $where; ?>','random-<?php echo $where ?>')">Gửi</button>
			</div>

		</form>
		<?php
	}else{
		?>
		<!-- form nhập email -->
		<form method="post">
			<div class="field-group">
				<span class="fa fa-user" aria-hidden="true"></span>
				<div class="wthree-field">
					<input name="email" id="<?php echo $value; ?>" type="text" value="" placeholder="Email của bạn"
					required>
				</div>
			</div>
			<div class="wthree-field">
				<button type="button" name="send" class="btn" onclick="changePass('<?php echo $value ?>','<?php echo $where ?>')">Gửi</button>
			</div>
		</form>
		<?php
		notification("Email không tồn tại, xin thử lại !");
	}
}
// quên mật khẩu admin
if(isset($_POST["passOld"])){
	$passOld = $_POST["passOld"];
	$selectAcc = mysqli_query($connectData,"SELECT * FROM admin WHERE id=".$_SESSION["admin"]) or die ("lỗi kết nối tài khoản admin");
	$rowAdmin = mysqli_fetch_assoc($selectAcc);
	if($passOld == $rowAdmin["pass"]){
		?>
		<div class="modal-body" style="width: 400px; margin: auto;">
			<form method="POST">										    
				<div class="form-group">
					<label for="exampleInputPassword1">Mật khẩu mới</label>
					<input pattern="[0-9a-zA-Z]{8,}" title="Mật khẩu yêu cầu 8 ký tự trở lên"  type="password" name="pass" class="form-control" placeholder="Password">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
					<button type="submit" name="changePass"class="btn btn-primary">Đổi</button>
				</form>
			</div>
		</div>

		<?php
	}else{
		notification("Mật khẩu không hợp lệ xin thử lại.")
		?>
		<div class="modal-body" style="width: 400px; margin: auto;">
			<form>										    
				<div class="form-group">
					<label for="exampleInputPassword1">Mật khẩu cũ</label>
					<input pattern="[0-9a-zA-Z]{8,}" title="Mật khẩu yêu cầu 8 ký tự trở lên"  type="password" class="form-control" id="passOld" placeholder="Password">
				</div>
			</form>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
			<button type="button" onclick="checkPass()" class="btn btn-primary">Gửi</button>
		</div>
		<?php
	}
}
// kiểm tra mã người dung
if(isset($_POST["checkRandom"])){
	$check = $_POST["checkRandom"];
	$where = $_POST["where"];
	if($_SESSION["random"] == $check){

		?>
		<form method="post">
			<div class="field-group">
				<span class="fa fa-user" aria-hidden="true"></span>
				<div class="wthree-field">
					<input name="newpass" pattern="[0-9a-zA-Z]{8,}" title="Mật khẩu yêu cầu 8 ký tự trở lên" type="password" placeholder="Mật khẩu mới"
					required>
				</div>
			</div>
			<div class="wthree-field">
				<button type="submit" name="forgot" class="btn">Đổi</button>
			</div>
		</form>
		<?php
	}else{
		notification("Vui lòng nhập đúng mã được gửi trong Email.");
		?>
		<!-- form nhập mã random -->
		<form method="post">
			<div class="field-group" id="forgot">
				<span class="fa fa-lock" aria-hidden="true"></span>
				<div class="wthree-field">
					<input name="key" type="text" id="random-<?php echo $where ?>" name="random" placeholder="Nhập mã gồm 6 ký tự">
				</div>
			</div>
			<div class="wthree-field">

				<button type="button" name="forgot" class="btn" onclick="checkRandom('<?php echo $where; ?>','random-<?php echo $where ?>')">Gửi</button>
			</div>

		</form>
		<?php
	}
}
?>

<?php
// phương thức xóa sản phẩm
if(isset($_POST["deletePro"])){
	$id = $_POST["deletePro"];
	$idparent = $_POST["cat"];
	// xóa ảnh chi tiết 
	mysqli_query($connectData,"DELETE FROM image_detail WHERE id_product = $id") or die("lỗi xóa ảnh chi tiết xin thử lại !");
	// xóa id sản phẩm  và id kích thước tại bảng product_feature
	mysqli_query($connectData,"DELETE FROM product_feature WHERE id_product = $id") or die("lỗi xóa thông tin bảng product_feature xin thử lại !");
	// xóa sản phẩm
	mysqli_query($connectData,"DELETE FROM productt WHERE id = $id") or die("lỗi xóa sản phẩm xin thử lại !");
	// lấy thông tin từ bảng product theo danh mục cha
	  $selectPro = "SELECT pro.id,pro.name,pro.price,pro.title,pro.sale,pro.image,pro.id_category_child,pro.star,pro.descript,pro.date_create FROM `productt` `pro` JOIN (SELECT `id` AS 'idChild' FROM `category` `c` WHERE `c`.`id_category_parent` = '$idparent') `tk` ON `tk`.`idChild` = `pro`.`id_category_child`";
	  $resultPro = mysqli_query($connectData, $selectPro) or die ("lỗi kết nối cơ sở dữ liệu bảng product, xin thử lại!");
	$i = 0;
            //lặp thông tin sản phẩm
	foreach ($resultPro as $pro)
	{
		$i++;
              // lấy kích thước sản phẩm
		$selectSize = "SELECT s.`size` FROM product_feature pc
		JOIN size s
		ON pc.`id_size` = s.`id`
		WHERE pc.`id_product` =".$pro["id"];
		$resultSize = mysqli_query($connectData,$selectSize) or die("lỗi kết nối cơ sở dữ liệu bảng product_size và size");
		$z = 0;
		$listSize = "";
		foreach ($resultSize as  $size) {
			$z += 1;
			if($z ==1){
				$listSize .= $size["size"];
			}else{
				$listSize .= ",".$size["size"];
			}
		}   
		?>
		<tr>
			<!-- thông tin sp -->
			<td><?php echo $i; ?></td>
			<td><?php echo $pro["name"]; ?></td>
			<td><?php echo $pro["price"]." - <s>".$pro["sale"]."</s>"; ?></td>
			<td><?php echo $pro["star"]; ?></td>
			<td><?php echo $listSize; ?></td>
			<td><?php echo $pro["title"]; ?></td>
			<td style="padding: 0;">
				<div>
					<img src="../public/image/<?php echo $pro["image"]; ?>" alt="" style="width: 80px;">
				</div>
			</td>
			<td><?php echo $pro["date_create"]; ?></td>
			<!-- thao tác -->
			<td>
				<a href="index.php?module=edit-product&id=<?php echo $pro["id"]; ?>" class="text-white btn btn-success">Sửa</a>
				<button onclick="deletePro(<?php echo $pro["id"]; ?>,<?php echo $idparent; ?>)" class="btn btn-danger float-right" id="<?php echo $pro["id"]; ?>">
					Xóa
				</button>
			</td>
		</tr>
	<?php 
	} 
}
// duyệt đơn hàng
if(isset($_POST["idOrder"])){
	$idOrder = $_POST["idOrder"];
	$stt = $_POST["stt"];
	// thay đổi trạng thái 
	mysqli_query($connectData,"UPDATE `order` SET status = $stt WHERE id = $idOrder") or die("lỗi cập nhập order");
}
?>
