<style>
	/*silder*/
	.box-slider{
		margin: 40px;
		border-radius: 12px;
		background-color: white;
		text-align: center;
		overflow: hidden;
	}
	.box-slider:nth-child(1){
		margin: 70px 40px !important;
	}
	.img-slider{
		height: 100px;
		float: left;
	}
	.plus-silder{
		width: 100px;
		height: 100px;
		background-color: white;
	}
	.plus-silder:hover{
		cursor: pointer;
	}
	.plus-silder p{
		font-size: 70px;
		color: #dfdfdf;
		text-align: center;
	}
	#showSlider{
		width: 100%;
		height: 0px;
	}

	#slider .modal-body i{
		font-size: 20px;
	}
	.imgSlider{
		position: relative;
	}
	.imgSlider .closeSilder{
		display: inline-block;
		position: absolute;
		top: -7px;
		right: 20px;
		color: red;
		font-size: 30px;
	}
	.imgSlider .closeSilder:hover{
		cursor: pointer;
	}
</style>
<?php 
$selectCat = mysqli_query($connectData,"SELECT * FROM category WHERE id_category_parent = 0 ")or die("error");
foreach ($selectCat as $cat) {
		// lấy slider thwo danh mục
	$selectSiler = mysqli_query($connectData,"SELECT * FROM slider_img WHERE id_category_parent =".$cat["id"])or die("error");
	

	?>
	<!-- silder -->
	<div class="box-slider">
		<h3><?= $cat["name"]; ?></h3>
		<?php
		if ($selectSiler->num_rows > 0) {
		foreach ($selectSiler as $slider) {
		?>
		<div class="img-slider<?php echo $cat["id"]; ?>">
			<div class="imgSlider">
				<div class="closeSilder" onclick="deleteSilder(<?= $slider["id"]; ?>,<?= $cat["id"] ?>)">
					<i class="fas fa-times-circle"></i>
				</div>
				<img src="../public/image/slide/<?= $slider["img"]; ?>" alt="">
			</div>
		</div>
	<?php
		} 
	}else{ 
			echo "Danh mục hiện không có ảnh slider nào. Vui lòng thêm ảnh silder. ";
		} 
	?>
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
						<label for="imgSlider<?php echo $cat["id"] ?>"><i class="far fa-plus-square"></i></label>
						<input type="file" name="slider[]" id="imgSlider<?php echo $cat["id"] ?>" accept=".png, .jpg, .jpeg" style="display: none;">
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
				$("#showSlider"+<?php echo $cat["id"]; ?>).css({"height":"200px","width":"500px"});
			});
		});

	</script>
	<?php
}
?>