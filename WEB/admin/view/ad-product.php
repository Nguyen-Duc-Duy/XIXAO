
<?php
		// select size
	$selectSize = "SELECT * FROM size";
	$resultSize = mysqli_query($connectData,$selectSize) or die ("lỗi kết nối cơ sở dữ liệu bảng size, xin thử lại !");
	//select category
	$selectparent = "SELECT * FROM category WHERE id_category_parent = 0";
	$resultparent = mysqli_query($connectData,$selectparent) or die ("error connect database xixao, please try again");
	// hàm lặp ra danh mục con
	function menuMultilevel($loaicon,$connect){
		$selectchild = "SELECT * FROM category WHERE id_category_parent =".$loaicon;
		$results = mysqli_query($connect,$selectchild) or die ("lỗi kết nối cơ sở dữ liệu, xin thử lại !");
		foreach ($results as $values) {
			return $results;
		}
	};
if(isset($_GET["view"]) == "ad-product"){
	if (isset($_POST["save"])) {

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
		$img = $catParent."/".$catChild."/".$_FILES["image"]["name"];
		// thêm thông tin sản phẩm
		$insertPro = "INSERT INTO productt(name,price,sale,image,title,id_category_child,descript) VALUES ('$name','$price','$sale','$img','$title','$idChild','$descript')";
		mysqli_query($connectData,$insertPro) or die("lỗi kết nối cơ sở dữ liệu bảng product, xin thử lại !");
		$idPro = mysqli_insert_id($connectData);
		// thêm ảnh chi tiết của sp
		for($i= 0;$i < $numRow;$i++){
			$list = $catParent."/".$catChild."/".$_FILES["listImage"]["name"][$i];
			$insertListImage = "INSERT INTO image_detail(id_product,image) VALUES ('$idPro','$list')";
			mysqli_query($connectData,$insertListImage) or die("lỗi kết nối cơ sở dữ liệu bảng list_img, xin thử lại !");
		}
		// thêm kích thước sp
		$numRowsSize = count($size);
		for($y = 0;$y < $numRowsSize;$y++){
			$insertSize = "INSERT INTO product_feature(id_product,id_size) VALUES ('$idPro',$size[$y])";
			mysqli_query($connectData,$insertSize) or die("lỗi kết nối cơ sở dữ liệu bảng size, xin thử lại !");
		}
		// lưu ảnh
		$path = "../public/image/".$catParent."/".$catChild."/";
		// tải 1 file lên thư mục
		uploadFile($file,$path);
		// tải danh sách ảnh chi tiết lên thư mục;
		multiFile($listFile,$catParent,$catChild);

		header("location: index.php?view=list-product");
	}

};
?>
<div class="grid-1  box">
	<div class="form-body">
		<form class="form-horizontal" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label for="name" class="col-sm-2 control-label">Tên sản phẩm</label>
				<div class="col-sm-8">
					<input type="text" class="form-control1" id="name"name="name" value="">
				</div>
			</div>
			<div class="form-group">
				<label for="name" class="col-sm-2 control-label">Loại</label>
				<div class="col-sm-3">
					<select name="parent" id="parent">
						<option value=""> -- chọn danh mục --</option>
					<?php foreach ($resultparent as $parent){ ?>
						<option value="<?php echo $parent['id']; ?>"><?php echo $parent["name"]; ?></option>
					<?php } ?>
					</select>
				</div>
				<div class="col-sm-3">
					<script>
						$(function(){
							$("#parent").change(function(){
								var id = $("#parent option:selected").attr("value");
								$.ajax({
									type: 'POST',
									url: 'view/ajax-add.php',
									data: 'parent='+id,
									success : function (result){
                        				$('#result').html(result);
                   					}
								});
							});
						});
					</script>
					<select name="child" id="result">

					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="price" class="col-sm-2 control-label">Giá</label>
				<div class="col-sm-8">
					<input type="text" class="form-control1" id="price" name="price" pattern="[0-9]{0,20}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="">
				</div>
			</div>
			<div class="form-group">
				<label for="sale" class="col-sm-2 control-label">Giá khuyến mại</label>
				<div class="col-sm-8">
					<input type="text" class="form-control1" id="sale" name="sale" pattern="[0-9]{0,20}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
				</div>
			</div>
			<div class="form-group">
				<label for="checkbox" class="col-sm-2 control-label">Size</label>
				<div class="col-sm-8">
					<!-- kích thước  -->
					<?php
					foreach ($resultSize as $size) {
						?>
						<div class="checkbox-inline">
							<label>
								<input type="checkbox" name="size[]" value="<?php echo $size["id"]; ?>"><?php echo $size["size"]; ?>
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
						<input type="text" class="form-control1" id="title" name="title" value="">
					</div>
				</div>
				<div class="form-group">
					<label for="txtarea1" class="col-sm-2 control-label">Mô tả</label>
					<div class="col-sm-8">
						<textarea name="descript" id="editor1" rows="10" cols="50">
						</textarea>
					</div>
				</div>
				<div style="text-align: center;">
					<button type="submit" class="btn btn-primary big" name="save">Lưu</button>
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