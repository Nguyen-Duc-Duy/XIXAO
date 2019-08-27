
<?php
	$severname ="localhost";
	$username = "root";
	$pass = "";
	$namedatabase = "xixao";
	$connectData = new mysqli($severname,$username,$pass,$namedatabase) or die ("lỗi kết nối cơ sở dữ liệu, xin thử lại !");
	mysqli_set_charset($connectData,'UTF8');
?>