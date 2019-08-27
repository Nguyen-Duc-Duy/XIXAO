
<?php

$idProSel = $_GET["id"];
// select size
$selectSize = "SELECT * FROM size";
$resultSize = mysqli_query($connectData,$selectSize) or die ("lỗi kết nối cơ sở dữ liệu bảng size, xin thử lại !");

	// hàm lặp ra danh mục con
	function menuMultilevel($loaicon,$connect){
		$selectchild = "SELECT * FROM category WHERE id_category_parent =".$loaicon;
		$results = mysqli_query($connect,$selectchild) or die ("lỗi kết nối cơ sở dữ liệu, xin thử lại !");
		foreach ($results as $values) {
			return $results;
		}
	};

// lấy tất cả danh mục cha
$selectparent = "SELECT * FROM category WHERE id_category_parent = 0";
$resultparent = mysqli_query($connectData,$selectparent) or die ("error connect database xixao, please try again");
// lấy danh mục cha của sản phẩm
$selectParentPro = mysqli_query($connectData,"SELECT c.id_category_parent FROM productt pro JOIN category c ON c.id = pro.id_category_child
WHERE pro.id = $idProSel") or die ("lỗi kết nối csdl");
$resultParentPro = mysqli_query($connectData,$selectparent) or die ("error connect database xixao, please try again");
$cat = mysqli_fetch_assoc($selectParentPro);
// lấy sản phẩm 
$selectPro = mysqli_query($connectData,"SELECT * FROM productt WHERE id = $idProSel") or die ("error connect database xixao, please try again");
$pro = mysqli_fetch_assoc($selectPro);
// lấy size sản phẩm
$sizePro = mysqli_query($connectData,"SELECT * FROM product_feature WHERE id_product = $idProSel") or die ("lỗi kết nối cơ sở dữ liệu bảng size, xin thử lại !");

// lưu sản phẩm
	if (isset($_POST["updatePro"])) {
		
		$name = $_POST["name"];
		$idChild = $_POST["child"];
		$idParent = $_POST["parent"];
		$price = $_POST["price"];
		$sale = $_POST["sale"];
		$size = $_POST["size"];
		$title = $_POST["title"];
		$descript = $_POST["descript"];
		$numRow = count($_FILES["listImage"]["name"]);
		$file = $_FILES["image"];
		$listFile = $_FILES["listImage"];
		// lấy danh mục 
		$selectCat = "SELECT c.id,c.name,tk.parent FROM category c
		JOIN (SELECT cc.id AS 'ids', cc.name AS 'parent' FROM category cc WHERE id_category_parent = 0) tk
		ON tk.ids = c.id_category_parent
		WHERE id = $idChild";
		$resultCat = mysqli_query($connectData,$selectCat) or die("lỗi kết nối cơ sở dữ liệu bảng category, xin thử lại !");
		while($rowCat = mysqli_fetch_assoc($resultCat)){
			$catParent = $rowCat["parent"];
			$catChild = $rowCat["name"];
		}
		// cập nhật thông tin sản phẩm
		$img = $catParent."/".$catChild."/".$_FILES["image"]["name"];
		$insertPro = "UPDATE productt SET name = '$name',price = $price,sale = $sale,title = '$title',id_category_child = $idChild,descript = '$descript' WHERE id = $idProSel";
		mysqli_query($connectData,$insertPro) or die("lỗi kết nối cơ sở dữ liệu bảng product, xin thử lại !");
		// cập nhật ảnh sản phẩm
		if(!$_FILES["image"]["name"] == ""){
			mysqli_query($connectData,"UPDATE productt SET image = '$img' WHERE id = $idProSel") or die("lỗi kết nối cơ sở dữ liệu bảng product, xin thử lại !");
		}
		// cập nhật ảnh chi tiết của sp
		if(!$_FILES["listImage"]["name"][0] == ""){
			//xóa ảnh chi tiết
			mysqli_query($connectData,"DELETE FROM image_detail WHERE id_product = $idProSel") or die ("xóa mục tại bảng image_detail thất bại");
				// insert
			for($i= 0;$i < $numRow;$i++){
				$list = $catParent."/".$catChild."/".$_FILES["listImage"]["name"][$i];
				$insertListImage = "INSERT INTO image_detail(id_product,image) VALUES ('$idProSel','$list')";
				mysqli_query($connectData,$insertListImage) or die("lỗi kết nối cơ sở dữ liệu bảng list_img, xin thử lại !");
			}
		}
		// cập nhật kích thước sp
			//xóa kích thước sản phẩm
			mysqli_query($connectData,"DELETE FROM product_feature WHERE id_product = $idProSel") or die ("xóa mục tại bảng product_feature thất bại");
			$numRowsSize = count($size);
			//insert
			for($y = 0;$y < $numRowsSize;$y++){
				$insertSize = "INSERT INTO product_feature(id_product,id_size) VALUES ('$idProSel',$size[$y])";
				mysqli_query($connectData,$insertSize) or die("lỗi kết nối cơ sở dữ liệu bảng size, xin thử lại !");
			}

		// lưu ảnh
		$path = "../public/image/".$catParent."/".$catChild."/";
		//tải 1 file lên thư mục
		uploadFile($file,$path);
		// tải danh sách ảnh chi tiết lên thư mục;
		multiFile($listFile,$catParent,$catChild);
		header("location: index.php?module=product");
};
    
?>
<div class="grid-1  box">
	<div class="form-body">
		<h3>Thêm mới sản</h3>
		<form class="form-horizontal row" method="POST" enctype="multipart/form-data">
			<div class="col-sm-6">
				<!-- tên sản phẩm -->
				<div class="form-group row">
					<label for="name" class="col-sm-3 control-label">Tên sản phẩm</label>
					<div class="col-sm-9">
						<input type="text" class="form-control1" id="name"name="name" value="<?php echo $pro["name"] ?>" style="width: 100%;" >
					</div>
				</div>
				<!-- danh mục -->
				<div class="form-group row">
					<label for="name" class="col-sm-3 control-label">Loại</label>
					<div class="col-sm-5">
						<select name="parent" id="parent">
							<option value=""> -- chọn danh mục --</option>
							<?php foreach ($resultparent as $parent){ ?>
								<option value="<?php echo $parent['id']; ?>" <?php echo ($cat["id_category_parent"] == $parent['id']) ? "selected" : ""  ?> ><?php echo $parent["name"]; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-sm-4">
						<script>
							$(function(){
								$("#parent").change(function(){
									var id = $("#parent option:selected").attr("value");
									$.ajax({
										type: 'POST',
										url: 'module/ajax-add.php',
										data: 'parent='+id,
										success : function (result){
											$('#result').html(result);
										}
									});
								});
								var id = $("#parent option:selected").attr("value");
									$.ajax({
										type: 'POST',
										url: 'module/ajax-add.php',
										data: {'parent':id,'selected':<?php echo $pro["id_category_child"] ?>},
										success : function (result){
											$('#result').html(result);
										}
									});
							});
						</script>
						<select name="child" id="result">
							<option value="">--Danh mục con--</option>
						</select>
					</div>
				</div>
				<!-- giá / khuyến mại -->
				<div class="form-group row">
					<label for="price" class="col-sm-3 control-label">Giá</label>
					<div class="col-sm-4">
						<input type="text" class="form-control1" id="price" name="price" pattern="[0-9]{0,20}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $pro["price"] ?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="sale" class="col-sm-3 control-label p-0">Khuyến mãi</label>
					<div class="col-sm-4">
						<input type="text" class="form-control1" id="sale" name="sale" pattern="[0-9]{0,20}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $pro["sale"] ?>">
					</div>
				</div>
				<!-- kích thước -->
				<div class="form-group row">
					<label for="checkbox" class="col-sm-3 control-label">Size</label>
					<div class="col-sm-8">
						<!-- kích thước  -->
						<?php
						foreach ($resultSize as $size) {
							?>
							<div class="checkbox-inline">
								<label>
									<input type="checkbox" name="size[]" value="<?php echo $size["id"]; ?>" 
									<?php
										// kiểm tra kích thước đã chọn
									foreach ($sizePro as $reSizePro) {
										echo ($size["id"] == $reSizePro["id_size"]) ? "checked" : "";
									}
									?>
									>
									<?php echo $size["size"]; ?>
								</label>
							</div>
						<?php } ?>
					</div>
				</div>
				<!-- ảnh -->
				<div class="form-group row">
					<label for="smallinput" class="col-sm-3 control-label label-input-sm">Ảnh</label>
					<div>
						<input type="file" class="form-control1" id="image" name="image">
					</div>
					<label for="image">
						<div class="showImage">

						</div>
						<div class="plus-img">
							<p>+</p>
						</div>
					</label>
				</div>
				<!-- ảnh chi tiết -->
				<div class="form-group row">
					<label for="smallinput" class="col-sm-3 control-label label-input-sm">Ảnh chi tiết</label>
					<div>
						<input type="file" multiple="multiple" class="form-control1" id="listImage" name="listImage[]">
					</div>
					<label for="listImage">
						<div class="box-listImg">

						</div>
						<div class="plus-img">
							<p>+</p>
						</div>
					</label>
				</div>
				<!-- tiêu đề -->
				<div class="form-group row">
					<label for="title" class="col-sm-3 control-label">Tiêu đề</label>
					<div class="col-sm-9">
						<textarea type="text" class="form-control1" rows="2" cols="120" id="title" name="title" style="width: 100%" ><?php echo $pro["title"] ?></textarea>
					</div>
				</div>
				<!-- save -->
				<div class=" col-sm-12" style="text-align: center; margin-bottom: 10px;">
					<!-- <button type="submit" class="btn btn-primary big" name="save">Lưu</button> -->
					<button type="submit" class="btn btn-primary" name="updatePro">Lưu thay đổi</button>
				</div>
			</div>
			<!-- mô tả -->
			<div class="col-sm-6">
				<div class="form-group row">
					<label for="txtarea1" class="col-sm-12 control-label" style="text-align: center;">Mô tả</label>
					<div class="col-sm-12">
						<textarea name="descript" id="editor1">
							<?php echo $pro["descript"] ?>
						</textarea>
					</div>
				</div>
			</div>
		</form>
	</div>

</div>

<script>
	var config = {};

	config.entities_latin = false;
	CKEDITOR.editorConfig = function( config ) {
		config.toolbarGroups = [
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		'/',
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		'/',
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'about', groups: [ 'about' ] },
		'/',
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'others', groups: [ 'others' ] }
		];

		config.removeButtons = 'Source,Save,NewPage,Preview,Print,Templates,Find,Replace,SelectAll,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,CopyFormatting,RemoveFormat,CreateDiv,BidiLtr,BidiRtl,Language,Flash,Iframe,ShowBlocks,BGColor,TextColor,PageBreak,SpecialChar,Unlink,Anchor,Indent,Outdent,Blockquote';
	};
	CKEDITOR.replace( 'editor1',config);

	$("#image").change(function () {
		upload(this,".showImage");
		$(".showImage").css({"width": "40px","height": "40px"});
	});
	$("#listImage").change(function () {
		for (var i = 0; i < $(this).get(0).files.length; i++) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$($.parseHTML('<div class="showListImage">')).css('background-image', 'url('+e.target.result+')').appendTo('div.box-listImg');
			}
			reader.readAsDataURL(this.files[i]);
			$(".showListImage").css({"width": "40px","height": "40px"});
		}
		
	});

</script>