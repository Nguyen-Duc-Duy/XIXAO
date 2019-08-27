<?php 
// lấy thông tin
if(isset($_GET["view"]) == "edit-category")
{
	$idPro = $_GET["id"];
	// select size
	$selectSize = "SELECT * FROM size";
	$resultSize = mysqli_query($connectData,$selectSize) or die ("lỗi kết nối cơ sở dữ liệu bảng size, xin thử lại !");
	// select product feature
	$selectProSize = "SELECT * FROM product_feature WHERE id_product =  '$idPro'";
	$resultProSize = mysqli_query($connectData,$selectProSize) or die ("lỗi kết nối cơ sở dữ liệu bảng product_size, xin thử lại !"); 
	// select product
	$selectPro = "SELECT p.name,p.price,p.sale,p.image,p.star,p.descript,p.date_create,p.title,s.size FROM productt p JOIN product_feature pc ON p.id = pc.id_product JOIN size s ON pc.id_size = s.id WHERE p.id =$idPro";
	$resultPro = mysqli_query($connectData,$selectPro) or die ("lỗi kết nối cơ sở dữ liệu bảng product, xin thử lại !");
	 $rs = mysqli_fetch_assoc($resultPro);

}

// cập nhật thông tin
if(isset($_POST["updatePro"]))
{	
	$_POST["image"] = $_FILES["image"];
	$_POST["listImage"] = $_FILES["listImage"];
	$name = $_POST["name"];
	$price = $_POST["price"];
	$sale = $_POST["sale"];
	$title = $_POST["title"];
	$descript = $_POST["descript"];
	$data = $_POST;
	// cập nhật  sản phẩm
	$updatePro = "UPDATE productt SET title = '$title', name = '$name',price = '$price',sale = '$sale',descript = '$descript' WHERE id = $idPro";
	mysqli_query($connectData,$updatePro) or die ("lỗi kết nối cơ sở dữ liệu bảng product, xin thử lại !");
	// xóa các mục kích thước có sp
	$deleteSize = mysqli_query($connectData,"DELETE FROM product_feature WHERE id_product = '$idPro'") or die("lỗi kết nối cơ sở dữ liệu bảng product_size, xin thử lại !");
		// thêm kích thước sp
		$numRowsSize = count($_POST["size"]);
		for($y = 0;$y < $numRowsSize;$y++){
			$idSize = $_POST["size"][$y];
			print_r($idSize);
			// $insertSize = "INSERT INTO product_feature(id_product,id_size) VALUES ('$idPro','$idSize')";
			// mysqli_query($connectData,$insertSize) or die("lỗi kết nối cơ sở dữ liệu bảng size, xin thử lại !");
		}
		header("location: index.php?view=list-product");
	
}

?>

		<div class="grid-1  box">
	<div class="form-body">
		<form class="form-horizontal" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label for="name" class="col-sm-2 control-label">Tên sản phẩm</label>
				<div class="col-sm-8">
					<input type="text" class="form-control1" id="name" placeholder="Tên sản phẩm" name="name" value="<?php echo $rs['name']; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="price" class="col-sm-2 control-label">Giá</label>
				<div class="col-sm-8">
					<input type="text" class="form-control1" id="price" name="price" pattern="[0-9]{1,}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $rs['price']; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="sale" class="col-sm-2 control-label">Giá khuyến mại</label>
				<div class="col-sm-8">
					<input type="text" class="form-control1" id="sale" name="sale" pattern="[0-9]{1,}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $rs['sale']; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="checkbox" class="col-sm-2 control-label">Size</label>
				<div class="col-sm-8">
					<?php //lặp ra kích thước
						foreach ($resultSize as $size) 
						{
					?>
					<div class="checkbox-inline">
						<label>
							<input type="checkbox" name="size[]" value="<?php echo $size['id']; ?>"
							<?php
							//kiểm tra xem kích thước nào đã chọn
								foreach ($resultProSize as  $checkedSize) 
								{
									echo ($size["id"] ==$checkedSize["id_size"]) ? "checked" : "";
								};
							?>
							 ><?php echo $size["size"] ?>
						</label>
					</div>
					<?php } ?>
					
				</div>
			</div>
			<div class="form-group">
				<label for="smallinput" class="col-sm-2 control-label label-input-sm">Ảnh</label>
				<div class="col-sm-8">
					<input type="file" class="form-control1" id="image" name="image">
				</div>
			</div>
			<div class="form-group">
					<label for="smallinput" class="col-sm-2 control-label label-input-sm">Ảnh chi tiết</label>
					<div class="col-sm-8">
						<input type="file" multiple="multiple" class="form-control1" id="listImage" name="listImage[]">
					</div>
				</div>
				<div class="form-group">
					<label for="title" class="col-sm-2 control-label">Tiêu đề</label>
					<div class="col-sm-8">
						<input type="text" class="form-control1" id="title" name="title" value=" <?php echo $rs['title']; ?>">
					</div>
				</div>
			<div class="form-group">
				<label for="txtarea1" class="col-sm-2 control-label">Mô tả</label>
				<div class="col-sm-8">
					<textarea name="descript" id="editor1" rows="10" cols="50">
							<?php echo $rs['descript']; ?>
						</textarea>
				</div>
			</div>
			<div style="text-align: center;">
				<button type="submit" class="btn btn-primary" name=""><a href="index.php?view=list-product">Hủy</a></button>
				<button type="submit" class="btn btn-primary big" name="updatePro">Lưu</button>
			</div>
		</form>
	</div>

</div>
<script>
		var config = {};
		config.entities_latin = false;
	config.toolbarGroups = [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard', groups: [ 'undo', 'clipboard' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		'/',
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		'/',
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] }
	];

	config.removeButtons = 'CreateDiv,Source,Preview,Templates,Find,SelectAll,Scayt,HiddenField,ImageButton,Button,Select,Form,CopyFormatting,RemoveFormat,BidiRtl,BidiLtr,Anchor,PageBreak,ShowBlocks';
		CKEDITOR.replace( 'editor1',config);
	</script>
