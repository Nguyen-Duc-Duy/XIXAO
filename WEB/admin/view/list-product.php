<?php
if(isset($_GET["view"]) == "list-product"){
	// lấy danh mục cha
	$resultCat = mysqli_query($connectData,"SELECT * FROM category WHERE id_category_parent = 0") or die ("lỗi kết nối cơ sở dữ liệu bảng category, xin thử lại!");
}

?>
<?php
foreach ($resultCat as $key => $category) {
	  $idparent = $category["id"];
// lấy thông tin từ bảng product theo danh mục cha
  $selectPro = "SELECT pro.id,pro.name,pro.price,pro.title,pro.sale,pro.image,pro.id_category_child,pro.star,pro.descript,pro.date_create FROM `productt` `pro` JOIN (SELECT `id` AS 'idChild' FROM `category` `c` WHERE `c`.`id_category_parent` = '$idparent') `tk` ON `tk`.`idChild` = `pro`.`id_category_child`";
  $resultPro = mysqli_query($connectData, $selectPro) or die ("lỗi kết nối cơ sở dữ liệu bảng product, xin thử lại!");
?>
<div class="graph box">
	<div style="display: flex;">
		<h4 style="flex: auto; text-align: left;padding: 12px 12px 6px 12px;">
			<?php
			
			?>
		</h4>
			<a class="btn btn-primary" style="margin: 12px 12px;line-height: 2;
" href="index.php?view=ad-product">Thêm</a>
	</div>
	<div class="tables">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>#</th>
					<th>Tên sản phẩm</th>
					<th>Giá/Khuến mại</th>
					<th>Sao</th>
					<th>Size</th>
					<th>Ảnh</th>
					<th>Ngày tạo</th>
					<th>Thao tác</th>
				</tr>
			</thead>
			<tbody class="list-pro-<?php echo $idparent; ?>">
				<?php
				if(mysqli_num_rows($resultPro) > 0){
					$i = 0;
					foreach ($resultPro as $value) {
						$i++;
						?>
						<tr>
							<th scope="row"><?php echo $i; ?></th> 
							<td><?php echo $value["name"]; ?></td>
							<td><?php echo $value["price"]."/".$value["sale"]; ?></td>
							<td><?php echo $value["star"]; ?></td>
							<td>
								<?php
								// lấy kích thước từ bảng product_size và size
								$selectSize = "
								SELECT s.`size` FROM product_feature pc
								JOIN size s
								ON pc.`id_size` = s.`id`
								WHERE pc.`id_product` =".$value["id"];
								$resultSize = mysqli_query($connectData,$selectSize) or die("lỗi kết nối cơ sở dữ liệu bảng product_size và size");
								$z = 0;
								$listSize = "";
								foreach ($resultSize as $key =>  $size) {
									$z += 1;
									if($z ==1){
										$listSize .= $size["size"];
									}else{
										$listSize .= ",".$size["size"];
									}
									
								}
								echo $listSize;
								?>
							</td>
							<td class="img"><img src="../../WEB/public/image/<?php echo $value['image'] ?>" alt=""></td>
							<td><?php echo $value["date_create"]; ?></td>
							<td>
								<a href="index.php?view=edit-product&id=<?php echo $value["id"]; ?>" class="text-white btn btn-success">Sửa</a>
								<p onclick="deletePro(<?php echo $value["id"]; ?>,<?php echo $idparent; ?>)" class="btn btn-danger float-right" id="<?php echo $value["id"]; ?>">
									Xóa
								</p>
							</td>
						</tr>
						<?php
					}
				} 
				?>
			</tbody>
		</table>
	</div>
</div>
<?php } ?>
<script>
	$(document).ready(function(){
		$("button").click(function(){
			var id = $(this).attr("id");
			$.ajax({
				type: "POST",
				url : "view/delete.php",
				data: "idPro="+id,
				success : function(result){
					$(".box").load(window.location.href +" .box");
				}
			})
		})
	})
</script>