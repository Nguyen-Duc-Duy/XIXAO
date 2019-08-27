<?php
	// lấy danh mục
	$selectCat = mysqli_query($connectData,"SELECT * FROM category WHERE id_category_parent = 0 ") or die("lỗi kết nối bảng category");
	foreach ($selectCat as $cat) {
?>
<!-- silder -->
<div class="box-slider">
	<h4><?php echo $cat["name"]; ?></h4>
	<div class="img-slider<?php echo $cat["id"] ?>">
		<div>
			<img src="" alt="">
		</div>
	</div>
	<!-- thêm silder -->
	<div class="plus-silder" data-toggle="modal" data-target="#slider<?php echo $cat["id"] ?>">
		<p>+</p>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="slider<?php echo $cat["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Thêm silder</h5>
				</div>
				<div class="modal-body">
					<form action="" method="POST" enctype="multipart/form-data">
						<label for="imgSlider<?php echo $cat["id"] ?>"><i class="far fa-plus-square"></i></label>
						<input type="file" name="slider" id="imgSlider<?php echo $cat["id"] ?>" accept=".png, .jpg, .jpeg" style="display: none;">
					</form>
					<div id="showSlider<?php echo $cat["id"] ?>">

					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
					<button type="button" class="btn btn-primary" onclick="addSLider(<?php echo $cat["id"] ?>)">Lưu</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function () {
		$("#imgSlider"+<?php echo $cat["id"] ?>).change(function () {
			upload(this,"#showSlider"+<?php echo $cat["id"]; ?>);
			$("#showSlider"+<?php echo $cat["id"]; ?>).css("height","200px");
		});
	});
	
</script>
<?php } ?>
