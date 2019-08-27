
<!-- danh mục sp-->
<?php 
// truy vấn đến danh mục cha 
$selectParent = "SELECT * FROM category WHERE id_category_parent = 0";
$resultParent = mysqli_query($connectData,$selectParent) or die ("error connect database xixao, please try again");
// hàm lặp ra danh mục con
function menuMultilevel($loaicha,$connect){
	$selectChild = "SELECT * FROM category WHERE id_category_parent =".$loaicha;
	$resultChild = mysqli_query($connect,$selectChild) or die ("lỗi kết nối cơ sở dữ liệu bảng danh mục, xin thử lại !");
	foreach ($resultChild as $values) {
		return $resultChild;
	}
}

// lặp ra các danh mục cha
foreach ($resultParent as $parent) {
	// thêm danh mục
$ad = "ad-category".$parent['id'];
if(isset($_POST[$ad])){

	$table = "category";
	$data = $_POST["names"];
	$condition = $parent;
	$idPa = $parent["id"];
	$file = $_FILES["file"];
		// kiểm tra danh mục trong csdl
	$checkCat = mysqli_query($connectData,"SELECT COUNT(*) AS 'numRow' FROM category WHERE id_category_parent = $idPa AND name = '$data'");
	// $re = mysqli_fetch_row($checkCat);
	// echo count($re);
	if(mysqli_fetch_assoc($checkCat)["numRow"] == 0){
		ad($table,$data,$condition,$valuechild,$file,$connectData);
		$number = 2;
		multiFile($file,$parent["name"],$data,$number);
		header("location: index.php?module=category");
	}else{
		notification("Danh mục đã tồn tại. Xin thử lại");
	}
}
	?>
	<div class="box" style="padding: 50px">
		<div class="box-header">
			<h3 class="box-title"><?php echo $parent["name"] ?></h3>
			<!-- <button><i class="fas fa-plus"></i>Banner</button> -->
			<button type="button" class="btn bg-<?php echo $parent["id"] == 1 ? "red" : "yellow" ?>" style="padding: 3px 5px;" data-toggle="modal" data-target="#adModal<?php echo $parent["id"]; ?>">
				<i class="fas fa-plus"></i> Thêm</button>
				<!-- modal thêm mới -->

				<div class="modal fade text-center" id="adModal<?php echo $parent['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
							<div class="modal-content">
								<div class="modal-body">
									<div style="text-align: center;">
										<div class="form-body" style="padding: 20px;display: inline-block;">
											<div class="form-group">
												<label for="name" class="col-sm-2 control-label">Name</label>
												<div class="col-sm-9"><input type="text" required pattern="[0-9a-zA-Z]{1,100}" name="names" class="form-control"></div>
											</div>
											<label for="banner" class="col-sm-2 control-label">Banner</label>
											<div class="col-sm-9"> <input type="file" required  multiple="multiple" name="file[]" class="form-control"></div>
											<div class="col-sm-offset-2"></div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
									<button type="submit" class="btn btn-primary"
									name="ad-category<?php echo $parent['id']; ?>">Lưu</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

			<!-- /.box-header -->
			<div class="box-body no-padding">
				<table class="table table-striped">
					<tr>
						<th style="width: 10px">#</th>
						<th>Tên danh mục</th>
						<th>Ảnh banner</th>
						<th style="width: 40px">Chỉnh sửa</th>
					</tr>
					<!-- chạy hàm lặp ra danh mục con -->
					<?php 
					$child = menuMultilevel($parent["id"],$connectData);
					$i = 0;
					if(isset($child)){
						foreach ($child as $valuechild) {	
							$i++;
							// lấy ảnh banner
							$selectBanner = mysqli_query($connectData,"SELECT * FROM banner_img WHERE id_category_child = ".$valuechild["id"]) or die("error");
							$imgBanner = mysqli_fetch_assoc($selectBanner);
							?>
							<tr class="item-cat">
								<td><?php echo $i; ?></td>
								<td><?php  echo $valuechild["name"]; ?></td>
								<td>
									<div style="display: inline-block;">
										<?php
										foreach ($selectBanner as $banner) {

											?>
											<div class="box-img img-banner" style="background-image: url('../public/image/<?php echo $banner["name_img"] ?>');">

											</div>
										<?php } ?>
									</div>
								</td>
								<td>
									<!-- cập nhật danh mục -->
									<button class="btn btn-success" data-toggle="modal"
									data-target="#Modall<?php echo $valuechild["id"]; ?>">Sửa</button>
									<!-- xóa danh mục -->
									<button type="button" class="btn btn-danger"><a href="index.php?module=delete&idCat=<?php echo $valuechild["id"]; ?>" class="btn-delete">Xóa</a></button>
								</td>
								<!-- Modal cập nhật danh mục-->
								<div class="modal fade" id="Modall<?php echo $valuechild["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<form action="" method="POST" enctype="multipart/form-data">
											<div class="modal-content">
												<div class="modal-body">
													<div class="form-body" style="padding: 20px;display: inline-block;">
														<div class="form-group">

															<label for="name" class="col-sm-2 control-label">Name</label>
															<div class="col-sm-9">
																<input type="text" value="<?php echo $valuechild['name'] ?>"
																name="name" class="form-control"
																id="name<?php echo $valuechild['id']; ?>">
															</div>
														</div>
														<label for="banner" class="col-sm-2 control-label">Banner</label>
														<div class="col-sm-9">
															<input type="file" multiple="multiple" name="file[]" class="form-control" id="banner<?php echo $valuechild['id']; ?>">
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary"
													data-dismiss="modal">Hủy</button>
													<button type="submit" class="btn btn-primary"
													name="update<?php echo $valuechild['id']; ?>">Lưu</button>
												</div>
												<?php

												
												$up = "update".$valuechild['id']; 
												if(isset($_POST[$up])){
													$name = $_POST["name"];
													$file = $_FILES["file"];

												//cập nhật danh mục
													$updateCat = "UPDATE category SET name = '$name' WHERE id = ".$valuechild["id"];
													$resultCat = mysqli_query($connectData,$updateCat) or die("cập nhập danh mục lỗi, xin thử lại !");
													rename("../public/image/".$parent["name"]."/".$valuechild['name'], "../public/image/".$parent["name"]."/".$name);
													if(!$_FILES["file"]["name"][0] == ""){
												//cập nhật banner
														$resultBanner = mysqli_query($connectData,"SELECT id FROM banner_img WHERE id_category_child = ".$valuechild["id"]) or die("lỗi truy vấn bảng banner, xin thử lại!");
														$i=-1;
														while($idChild = mysqli_fetch_assoc($resultBanner)){
															$i += 1;
															update($idChild["id"],$parent["name"],$valuechild["name"],$file,$connectData,$i);
														}
														$number = 2;
														multiFile($file,$parent["name"],$valuechild["name"],$number);
													}
													header("location:index.php?module=category");
												}

												?>

											</div>
										</form>
									</div>
								</div>
							</tr>
							<?php
						} 
					}
					?>
				</table>
			</div>
			<!-- /.box-body -->
		</div>
		<?php
	}
	?>
