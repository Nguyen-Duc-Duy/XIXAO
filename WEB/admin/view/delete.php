<?php 
	include('../../view/connect.php');
	$id = $_POST["idPro"];
	$deleteSize = mysqli_query($connectData,"DELETE FROM product_size WHERE id_product = '$id'");
	$deleteColor = mysqli_query($connectData,"DELETE FROM product_color WHERE id_product = '$id'");
	$deleteListImage = mysqli_query($connectData,"DELETE FROM list_img WHERE id_product = '$id'");
	$deletePro = mysqli_query($connectData,"DELETE FROM product WHERE id = '$id'");

?>