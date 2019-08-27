<?php
ob_start();
session_start();
include("connect.php");
if(isset($_POST["id"])){
	$idPro = $_POST["id"];
	$size = $_POST["size"];
	if(isset($_SESSION["cart"])){
		$cart = $_SESSION["cart"];
		if(array_key_exists($idPro, $cart)){
			print_r($cart);
			if($_POST["num"] > 0){
				$cart[$idPro] = array(
					"id" => $idPro,
					"number" => $_POST["num"],
					"size" => $size
					
				);
			}else{
				unset($cart[$idPro]);
			}
			$_SESSION["cart"] = $cart;

		}
	}
}

?>