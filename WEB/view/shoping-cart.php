<?php
	ob_start();
	session_start();
	include("connect.php");
	include("../pre-admin/module/funtion.php");
	if(isset($_POST["idPro"])){
		$idPro = $_POST["idPro"];
		$selectPro = mysqli_query($connectData,"SELECT * FROM productt WHERE id =$idPro") or die(notification("kết nối cơ sở dũ liệu thất bại, Xin thử lại !"));
		$Pro = mysqli_fetch_row($selectPro);

	}
	// gán session
		if(empty($_SESSION["cart"])){
			$cart[$idPro] = array(
				"id" => $idPro,
				"number" => 1,
				"size" => 1
			);
		}else{
			$cart = $_SESSION["cart"];
			if(array_key_exists($idPro, $cart)){
				$cart[$idPro] = array(
					"id" => $idPro,
					"number" => (int)$cart[$idPro]["number"] + 1,
					"size" => 1
				);
			}else{
				$cart[$idPro] = array(
					"id" => $idPro,
					"number" => 1,
					"size" => 1
				);
			}
		};
		
		$_SESSION["cart"] = $cart;
		echo(count($cart));
		
	
?>