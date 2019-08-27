<style>
	@keyframes notification{
		0%{bottom: 0px; opacity: 0;}
		50%{bottom: 30px; opacity:1;}
		100%{bottom: 0px; opacity: 0;}
	}
</style>
<?php
// hàm thông báo
function notification($char){
	echo "<div class='notifi' style='padding: 10px;
	background-color: white;
	animation: notification 10s;
	text-align: center;
	position: absolute;
	bottom: 0px;
	right: 40px;
	z-index: 2;
	border-radius: 5px;
	box-shadow: 0px 0px 9px 0px #cec7c7;
	opacity: 0;'>
	<span>".$char."</span>
	</div>";
}
// hàm thêm danh mục
function ad($table,$data,$condition,$child,$file,$connect){
	$idparent = $condition["id"];
	$nameparent = $condition["name"];
	$namechild = $child["name"];
		// thêm tên danh mục
	$insertcategory = "INSERT INTO $table(id_category_parent,name) VALUES ('$idparent','$data')";
	mysqli_query($connect,$insertcategory) or die("error connect database. please try again !");
		// thêm banner
	$thisIdChild = mysqli_insert_id($connect);
	for($i = 0;$i < 2;$i++){
		$namefile = $nameparent."/".$data."/".$file["name"][$i];
		$insertbanner = "INSERT INTO banner_img(id_category_child,name_img) VALUES ('$thisIdChild','$namefile')";
		$resoults = mysqli_query($connect,$insertbanner)  or die("error connect database. please try again !");
	}
	
}
// hàm tạo thư mục lưu 1 file
function uploadFile($file,$part){
	if(is_array($file)){
			if(isset($file["type"]) == "image/jpge" || isset($file["type"]) == "image/jpg" || isset($file["type"]) == "image/png"){
				$filename = $file["tmp_name"];
				move_uploaded_file($filename,$part.basename($file["name"]));
			}
		}
	}
//  hàm tạo thư mục lưu nhiểu file
function multiFile($file,$condition,$child){
		//function uploadFile()
	$number = count($file["name"]);
	for($i = 0 ; $i < $number ; $i++){
		if(isset($file)){
			if(isset($file["name"][$i])){
				if(isset($file["type"][$i]) == "image/jpge" || isset($file["type"][$i]) == "image/jpg" || isset($file["type"][$i]) == "image/png" ){
					if(isset($file["error"][$i])){
						$path = "../public/image/$condition/$child/";
						if(is_dir("../public/image/$condition/$child/")){

							$filename = $file["tmp_name"][$i];
							move_uploaded_file($filename,$path.basename($file["name"][$i]));
						}else{
							mkdir("../public/image/$condition/$child/");
							$filename = $file["tmp_name"][$i];
							move_uploaded_file($filename,$path.basename($file["name"][$i]));
						}
					}else{
						echo "error file, please try again!";
					}
				}else{
					echo "not format file image. please choose file image!";
				}
			}

		}
	}

}

//cập nhật banner
function update($condition,$parent,$child,$file,$connect,$i){
	$nameFile = $parent."/".$child."/".$file["name"][$i];
	$updateFile = "UPDATE banner_img SET name_img = '$nameFile' WHERE id = ".$condition;
	$resultFile = mysqli_query($connect,$updateFile) or die("cập nhập banner lỗi, xin thử lại !");
}

//  hàm gửi email
function forgorAcc($user,$content){
	include("../PHPMailer/class.phpmailer.php");
	include("../PHPMailer/class.smtp.php");
	// $file = @fopen('../emailForgot.htm', 'w');
	// if (!$file)
	//     echo "Mở file không thành công";
	// else {
	//     $datas = 'Tôi ghi dòng này vào file nhé!';
	//     fwrite($file, $datas);
	// }
	$body = file_get_contents('../emailForgot.htm');
	$mail = new PHPMailer();

	$mail ->IsSMTP();
	$mail ->Host = 'tls://smtp.gmail.com:587';
	$mail ->SMTPAuth = true;
	$mail ->Username = 'shopxixao@gmail.com';
	$mail ->Password = 'shopxixao01';
	$mail ->Post = 587;
	$mail ->IsHTML(true);
	$mail ->SetFrom('shopxixao@gmail.com','shopxixao@gmail.com');
	$mail ->AddAddress($user,'my user');
	$mail ->CharSet  = "utf-8";
	$mail ->Subject = "Mã của bạn là $content";
	$mail ->Body = $body;
	//$mail ->MsgHTML($body);
	if(!$mail ->send()){
		echo "email chua duoc gui . xin thu lai !";
		echo "loi".$mail->ErrorInfo;

	}else{
		return "true";
	}

}
// hàm thêm tài khoản
function createAcc($data,$table,$exception){
	if(is_array($data)){
		$record = "";
		$field = "";
		$i = 0;
		foreach ($data as $key => $value) {
			if(!($key == $exception)){
				$i++;
				if($i == 1){
					$record .= $key;
					$field .= "'".$value."'";
				}else{
					$record .= ",".$key;
					$field .= ",'".$value."'";
				}
			}
		}
		$insertAcc = "INSERT INTO $table($record) VALUES ($field)";
		return $insertAcc; 
	}
}
?>
<script>
	//hàm chọn ảnh
		function upload(file,show) {
			if (file.files && file.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$(show).css('background-image', 'url(' + e.target.result + ')');
				}
				reader.readAsDataURL(file.files[0]);
			}
		}
</script>