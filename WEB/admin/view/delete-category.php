<?php
	if(isset($_GET["view"]) && isset($_GET["id"])){
		$deleteCat = "DELETE FROM category WHERE id =".$_GET["id"];
		$deleteBanner = "DELETE FROM banner WHERE id_category_child =".$_GET["id"];
		$resultBanner = mysqli_query($connectData,$deleteBanner);
		$resultCat = mysqli_query($connectData,$deleteCat);
		header("location: index.php?view=list-category");
	}
?>