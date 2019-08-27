<?php 
ob_start();
session_start();
include("view/funtion.php");
include("../view/connect.php");

// tạo tài khoản
if(isset($_POST["create"])){

	$table = "admin_acc";
	$_POST["avt"] = $_FILES["avt"]["name"];
	$data = $_POST;
	$email = $_POST["email"];
	$name_acc = $_POST["name_acc"];
	$phone = $_POST["phone"];
	$pass = $_POST["pass"];
	$condition = "avt";
	$file = $_FILES["avt"];
	$part = "../public/image/Admin/";
	$exception = "create";
	// select 
	$selectAll = "SELECT COUNT(*) FROM admin_acc WHERE email = '$email' OR phone = '$phone' OR name_acc = '$name_acc'";
	$result = mysqli_query($connectData,$selectAll) or die("lỗi kết nối cơ sở dữ liệu, xin thử lại");
	
	$rows = mysqli_fetch_row($result);
	if($rows[0] == 0){	
		// tải anh vào thư mục
		uploadFile($file,$part);

		// thêm tài khoản vào database
		$insert = createAcc($data,$table,$exception);
		mysqli_query($connectData,$insert) or die("lỗi chèn cơ sở dữ liệu , xin thử lại");

		// lấy tài khoản vừa tạo để đăng nhập vào admin
		$select = "SELECT * FROM admin_acc WHERE name_acc = '$name_acc' AND email = '$email'";
		$resultAdmin = mysqli_query($connectData,$select) or die("lỗi kết nối cơ sở dữ liệu, xin thử lại");
		$row = mysqli_fetch_row($resultAdmin);
						// lấy tài khoản vùa đăng nhập để gán cho session
		$_SESSION["admin"] = $row[0];
		header("location: index.php");
	}else{
		$errorEmail = "Tài khoản đã tồn tại, Xin thử lại!";
		notification($errorEmail);
	}
}

// quên mật khẩu/đổi mật khẩu
if(isset($_POST["forgot"])){
	$pass = $_POST["newpass"];
	$update = mysqli_query($connectData,"UPDATE admin set pass = '$pass' WHERE email ='". $_SESSION["email"]."'") or die ("lỗi");
	notification("Mật khẩu đã được đổi thành công, vui lòng đăng nhập để vào trang quản trị.");
};
?>
<!DOCTYPE html>
<html>
<!-- Head -->

<head>
	<title>Key Login Form Flat Responsive Widget Template :: W3layouts</title>
	<!-- Meta-Tags -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<meta name="keywords"
	content="Key Login Form a Responsive Web Template, Bootstrap Web Templates, Flat Web Templates, Android Compatible Web Template, Smartphone Compatible Web Template, Free Webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design">
	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>

	<!-- Index-Page-CSS -->
	<link rel="stylesheet" href="css/import/style.css" type="text/css" media="all">
	<!-- //Custom-Stylesheet-Links -->
	<!--fonts -->
	<!-- font awasome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
	<!-- //Font-Awesome-File-Links -->

	<!-- Google fonts -->
	<link href="//fonts.googleapis.com/css?family=Quattrocento+Sans:400,400i,700,700i" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Mukta:200,300,400,500,600,700,800" rel="stylesheet">
	<!-- Google fonts -->
	<link rel="stylesheet" href="../public/bootstrap/css/bootstrap.min.css">
	<!-- //Meta-Tags -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8/dist/sweetalert2.min.js"></script>
	<!-- alert -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
	<!-- hàm đổi mật khẩu/quên mật khẩu -->
	<script>						
		//hàm kiểm tran email đầu vào
		function changePass(value,where){
			var email = $("#"+value).val();
			$.ajax({
				type:"POST",
				url: "view/ajax-add.php",
				data: {"email":email,"where":where,"value":value},
				success: function(act){
					$("#"+where+" .content-bottom").html(act);
				}
			});
		};
		//hàm kiểm tra mã random
		function checkRandom(where,value) {
			var check = $("#"+value).val();
			$.ajax({
				type:"POST",
				url: "view/ajax-add.php",
				data: {"checkRandom":check,"where":where},
				success: function(act){
					$("#"+where+" .content-bottom").html(act);
				}
			});
		};

		function login(){
			var emailAcc = $("#emailAcc").val();
			var passAcc = $("#passAcc").val();
			$.ajax({
				type: "POST",
				url: "view/ajax-add.php",
				data: {"emailAcc":emailAcc,"passAcc":passAcc},
				success : function(acc){
					$("#error").html(acc);
				}
			}) 
		}
	</script> 
	
</head>
<!-- //Head -->
<!-- Body -->

<body>
	<section class="main">
		<div class="layer">
			<!-- <nav bar> -->
				<div class="bottom-grid">
					<div class="logo">
						<h1> <a href="index.html"><span class="fa fa-key"></span> Key</a></h1>
					</div>
					<div class="links">
						<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
							<!-- nav đăng nhập -->
							<li class="nav-item">
								<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#login" role="tab"
								aria-controls="pills-home" aria-selected="true">Đăng nhập</a>
							</li>
							<!--nav đăng ký -->
							<!-- <li class="nav-item">
								<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#create-ac" role="tab"
								aria-controls="pills-profile" aria-selected="false">Đăng ký</a>
							</li> -->
							<!-- nav Đổi mật khẩu -->
							<li class="nav-item">
								<a class="nav-link text-white" style="color: white !important;" id="pills-contact-tab" data-toggle="pill" href="#change-ac" role="tab"
								aria-controls="pills-contact" aria-selected="false">Đổi mật khẩu</a>
							</li>
							<!-- nav Quên mật khẩu -->
							<li class="nav-item">
								<a class="nav-link text-white" id="pills-contact-tab" data-toggle="pill" href="#forgot-pass" role="tab"
								aria-controls="pills-contact" aria-selected="false">Quên mật khẩu ?</a>
							</li>
						</ul>

					</div>
				</div>
				<!-- </nav bar> -->
				<div class="content-w3ls p-3">
					<div class="tab-content" id="">
						<div class="text-center icon">
							<img src="../public/image/xi xao_white.png" alt="" class="w-50">
						</div>
						<!-- đăng nhập -->
						<div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="pills-home-tab">
							<div class="content-bottom p-3">
								<form method="post">
									<div class="field-group">
										<span class="fa fa-user" aria-hidden="true"></span>
										<div class="wthree-field">
											<input name="email" id="emailAcc" type="email" value=""
											placeholder="Email của bạn" required>
										</div>
									</div>
									<div class="field-group">
										<span class="fa fa-lock" aria-hidden="true"></span>
										<div class="wthree-field">
											<input name="password" id="passAcc" pattern="[0-9a-zA-Z]{8,}" title="Mật khẩu yêu cầu 8 ký tự trở lên" id="myInput" type="password" placeholder="Mật khẩu">
										</div>
									</div>
									<!-- lưu tài khoản -->
								<!-- <ul class="list-login">
									<li class="switch-agileits">
										<label class="switch">
											<input type="checkbox">
											<span class="slider round"></span>
											Lưu tài khoản
										</label>
									</li>
									<li class="clearfix"></li>
								</ul> -->
								<div id="error"></div>
								<div class="wthree-field">
									<button type="button" onclick="login()" class="btn">Đăng nhập</button>
								</div>
								
							</form>
						</div>
					</div>
					<!-- đăng ký -->
					<!-- <div class="tab-pane fade" id="create-ac" role="tabpanel" aria-labelledby="pills-profile-tab">
						<div class="content-bottom p-3">
							<form method="post" enctype="multipart/form-data" >
								<div class="avt">
									<input type="file" name="avt" id="avt" accept=".png, .jpg, .jpeg">
									<label for="avt"><i class="fas fa-pen"></i></label>
									<div class="showavt">
									</div>
									<script>
										$(document).ready(function () {
											$("#avt").change(function () {
												upload(this);
											})
										});
									</script>
								</div>
								<div class="field-group">
									<span class="fa fa-user" aria-hidden="true"></span>
									<div class="wthree-field">
										<input name="name" id="text1" type="text" value="" placeholder="Tên người dùng"
										required>
									</div>
								</div>
					
								<div class="field-group">
									<span class="fas fa-envelope" aria-hidden="true"></span>
									<div class="wthree-field">
										<input name="email" id="text1" type="text" value="" placeholder="Email của bạn"
										required>
									</div>
								</div>
								<div class="field-group">
									<span class="fas fa-phone" aria-hidden="true"></span>
									<div class="wthree-field">
					
										<input name="phone" id="text1" value="" placeholder="Số điện thoại của bạn"
										type="text" pattern="[0-9]{10}"
										title="Vui lòng nhập số điện thoại có đúng 10 số"
										oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
									</div>
								</div>
								<div class="field-group">
									<span class="fa fa-user" aria-hidden="true"></span>
									<div class="wthree-field">
										<input name="name_acc" id="text1" type="text" value=""
										placeholder="Tên tài khoản" required>
									</div>
								</div>
								<div class="field-group">
									<span class="fa fa-lock" aria-hidden="true"></span>
									<div class="wthree-field">
										<input name="pass" id="myInput" pattern="[0-9a-zA-Z]{8,}" required
										title="Mật khẩu yêu cầu 8 ký tự trở lên" type="Password"
										placeholder="Mật khẩu">
									</div>
								</div>
					
								<div class="wthree-field">
									<button type="submit" name="create" class="btn">Đăng ký</button>
								</div>
					
							</form>
						</div>
						gửi mã xác nhận email
						<div class="content-bottom p-3">
							<form method="post" enctype="multipart/form-data" >
								<div class="field-group">
									<span class="" aria-hidden="true">Mã</span>
									<div class="wthree-field">
										<input name="name" id="text1" type="text" value="" placeholder="Nhập mã gồm 6 chữ số"
										required>
									</div>
								</div>
								<div class="wthree-field">
									<button type="submit" name="send" class="btn">Gửi</button>
								</div>
					
							</form>
						</div>
					</div> -->
					<!-- đổi mật khẩu -->
					<div class="tab-pane fade" id="change-ac" role="tabpanel" aria-labelledby="pills-contact-tab">
						<div class="content-bottom p-3">
							<!-- gửi email tài khoản -->
							<form method="post">
								<div class="field-group">
									<span class="fa fa-user" aria-hidden="true"></span>
									<div class="wthree-field">
										<input name="email" id="emailChange" type="text" value="" placeholder="Email của bạn"
										required>
									</div>
								</div>
								<div class="wthree-field">
									<button type="button" name="send" class="btn" onclick="changePass('emailChange','change-ac')">Gửi</button>
								</div>
							</form>
						</div>
					</div>
					<!-- quên mật khẩu -->
					<div class="tab-pane fade" id="forgot-pass" role="tabpanel" aria-labelledby="pills-contact-tab">
						<div class="content-bottom p-3">
							<!-- gửi email tài khoản -->
							<form method="post">
								<div class="field-group">
									<span class="fa fa-user" aria-hidden="true"></span>
									<div class="wthree-field">
										<input name="email" id="emailForgot" type="text" value="" placeholder="Email của bạn"
										required>
									</div>
								</div>
								<div class="wthree-field">
									<button type="button" name="send" class="btn" onclick="changePass('emailForgot','forgot-pass')">Gửi</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- bootrap 4.3.1 js-->

		<script src="../public/bootstrap/css/bootstrap-grid.css"></script>

	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
	integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
</body>
<!-- //Body -->

</html>