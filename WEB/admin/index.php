
<?php 
	ob_start();
	session_start();
	if(!isset($_SESSION["admin"])){
		header("location: login.php");
	}
	include("../view/connect.php");
	include("view/funtion.php");
	
?>
<!-- trang admin -->
<!DOCTYPE HTML>
<html>
<head>
	<title>Admin</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Augment Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
	Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<!-- Bootstrap Core CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!-- Custom CSS -->
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<!-- Graph CSS -->
	<!-- font awasome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
	<link href="css/font-awesome.css" rel="stylesheet"> 
	<!-- jQuery -->
	<!-- lined-icons -->
	<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
	<!-- //lined-icons -->
	<!-- jquery -->
	<script src="http://localhost/MyPHP/XIXAO/WEB/public/js/jquery-3.4.1.min.js"></script>
	<!-- bootstrap js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	<!-- Ck editor -->
	 <script src="http://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>
	<!--skycons-icons-->
	
	<!--//skycons-icons-->
	<script>
		CKEDITOR.replace('editor1',{
			filebrowserUploadUrl: "upload.php"
		});
	</script>
	<script src="js/scripts.js"></script>
</head> 
<body>
	<div class="page-container">
		<!--/content-inner-->
		<div class="left-content">
			<div class="inner-content">
				<?php
				include('view/header.php');
				if(isset($_GET['view'])){
					$link = $_GET['view'];
					include('view/'.$link.'.php');
				}else{
					include('view/home.php');
				}
				?>
				
				<!--footer section end-->
			</div>
		</div>
		<!--//content-inner-->
		<?php 
			// nav-left
			include('view/nav-left.php');
		
		?>
		<div class="clearfix"></div>		
	</div>
	<script>
		var toggle = true;

		$(".sidebar-icon").click(function() {                
			if (toggle)
			{
				$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
				$("#menu span").css({"position":"absolute"});
			}
			else
			{
				$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
				setTimeout(function() {
					$("#menu span").css({"position":"relative"});
				}, 400);
			}

			toggle = !toggle;
		});
	</script>
	</body>
	<!--js -->
	<script src="js/scripts.js"></script>

	<script>
		//hàm đổi mật khẩu admin
		function checkPass(){
			var passOld = $("#passOld").val();
			$.ajax({
				type: "POST",
				url: "view/ajax-add.php",
				data: "passOld="+passOld,
				success: function(result){
					$(".passOld").html(result);
				}
			})
		}
		// hàm xóa sản phẩm
		function deletePro(id,cat){
			alert(cat);
			$.ajax({
				type: "POST",
				url: "view/ajax-add.php",
				data: {"deletePro":id, "cat":cat},
				success: function(pro){
					$(".graph.box .list-pro-"+cat).html(pro);
				}
			})
		}
		// thêm ảnh slider
		function addSLider(cat){
		var imgSlider = $("#imgSlider"+cat).val();
		$.ajax({
			type: "POST",
			url: "view/ajax-add.php",
			data: {"imgSlider":imgSlider,"cat":cat},
			success: function(img){
				$("#img-slider"+cat).html(img);
			}
		})
	}
	</script>	
</body>
</html>