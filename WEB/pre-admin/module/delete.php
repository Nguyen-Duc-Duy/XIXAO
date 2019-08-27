<?php
function removeAllFile($dir){
    if (is_dir($dir))
    {
        $structure = glob(rtrim($dir, "/").'/*');
        if (is_array($structure)) {
            foreach($structure as $file) {
            	print_r($file);
                if (is_dir($file)) recursiveRemove($file);
                else if (is_file($file)) @unlink($file);
            }
        }
    }
}
	// xóa damh mục
// xóa danh mục
if(isset($_GET["idCat"])){
	$idCat = $_GET["idCat"];
	//xóa thư mục tương ứng
		//lấy tên danh mục cha và con tương ứng
	$selectCat = mysqli_query($connectData,"
		SELECT c.id,c.id_category_parent,cc.name AS 'catParent',c.name FROM category c
		JOIN category cc
		ON c.id_category_parent = cc.id
		WHERE c.id = $idCat")
		or die("error");
	$Cat = mysqli_fetch_assoc($selectCat);
	$pathPa = $Cat["catParent"];
	$pathCh = $Cat["name"];
	removeAllFile("../public/image/$pathPa/$pathCh");
	rmdir("../public/image/$pathPa/$pathCh") or die("../public/image/$pathPa/$pathCh");
	// xóa
	
	mysqli_query($connectData,"DELETE FROM banner_img WHERE id_category_child = $idCat") or die("error");
	mysqli_query($connectData,"DELETE FROM category WHERE id = $idCat") or die("error")or die("error");
	
	header("location: index.php?module=category");
}
// xóa sản phẩm
if(isset($_GET["idProDel"])){
	$id = $_GET["idProDel"];
	// xóa ảnh chi tiết 
	mysqli_query($connectData,"DELETE FROM image_detail WHERE id_product = $id") or die("lỗi xóa ảnh chi tiết xin thử lại !");
	// xóa id sản phẩm  và id kích thước tại bảng product_feature
	mysqli_query($connectData,"DELETE FROM product_feature WHERE id_product = $id") or die("lỗi xóa thông tin bảng product_feature xin thử lại !");
	// xóa sản phẩm
	mysqli_query($connectData,"DELETE FROM productt WHERE id = $id") or die("lỗi xóa sản phẩm xin thử lại !");
	header("location: index.php?module=product");
}
?>