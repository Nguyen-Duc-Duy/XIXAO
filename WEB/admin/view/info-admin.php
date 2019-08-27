<?php
// lấy tài khoản admin
$idAdmin = $_SESSION["admin"];
$select = mysqli_query($connectData,"SELECT * FROM admin where id = '$idAdmin'") or die(notification("lỗi kết nối tài khoản admin"));
$admin = mysqli_fetch_assoc($select);
// hamf caapj nhaatj thoong tin admin
if(isset($_POST["save"])){
	$file = $_FILES["avt"];
	$avt = $_FILES["avt"]["name"];
	$email = $_POST["email"];
	$name = $_POST["name"];
	$part = "../public/image/Admin/";
	uploadFile($file,$part);
	// cập nhật
	mysqli_query($connectData,"UPDATE admin SET avt = '$avt', email = '$email', name = '$name'") or die (notification("lỗi kết nối csdl bảng admin"));
	header("location: index.php");
}
?>
<div class="box-infoAdmin">
	<form method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<div class="avt">
				<input type="file" name="avt" id="avt" accept=".png, .jpg, .jpeg">
				<label for="avt"><i class="fas fa-pen"></i></label>
				<div class="showavt" style="background-image: url('../public/image/Admin/<?php echo $admin["avt"] ?>')">
				</div>
				<script>
					$(document).ready(function () {
						$("#avt").change(function () {
							upload(this);
						})
					});
				</script>
			</div>
			<label for="name">Tên quản trị</label>
			<input type="text" class="form-control" id="name" name="name" value="<?php echo $admin["name"] ?>">
		</div>
		<div class="form-group">
			<label for="email">Email</label>
			<input type="text" class="form-control" id="email" name="email" value="<?php echo $admin["email"] ?>">
		</div>
		<button type="submit" class="btn btn-primary" name="save">Thay đổi</button>
	</form>
</div>