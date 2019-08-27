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
	?>
	<div class="grap box">
		<div class="tables">
			<!-- tên danh mục cha -->
			<div class="plus-category">
				<h4><?php echo $parent["name"] ?></h4>
				<p data-toggle="modal" data-target="#Modall<?php echo $valuechild["id"]; ?>">Sửa banner</p>
			</div>

			<!-- Danh mục con -->
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Danh mục</th>
						<th></th>
						<th style="text-align: right; margin-right: 20px;">Chỉnh sửa</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<!-- chạy hàm lặp ra danh mục con -->
						<?php 
						$child = menuMultilevel($parent["id"],$connectData);
						$i = 0;
						if(isset($child)){
							foreach ($child as $valuechild) {	
								$i++;

								?>
								<th scope="row"><?php echo $i; ?></th>
								<td><?php  echo $valuechild["name"]; ?></td>
								<td></td>
								<td style="text-align: right;">
									<!-- cập nhật danh mục -->
									<button class="btn btn-success" data-toggle="modal"
									data-target="#Modall<?php echo $valuechild["id"]; ?>">Sửa</button>
								<!-- xóa danh mục -->
									<button class="btn btn-danger"><a href="index.php?view=delete-category&id=<?php echo $valuechild["id"]; ?>">Xóa</a></button>
										<!-- Modal cập nhật danh mục-->
										<div class="modal fade" id="Modall<?php echo $valuechild["id"]; ?>" tabindex="-1" role="dialog"
											aria-labelledby="exampleModalLabel" aria-hidden="true">
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

												//cập nhật banner
															$resultBanner = mysqli_query($connectData,"SELECT id FROM banner_img WHERE id_category_child = ".$valuechild["id"]) or die("lỗi truy vấn bảng banner, xin thử lại!");
															$i=-1;
															while($idChild = mysqli_fetch_assoc($resultBanner)){
																$i += 1;
															update($idChild["id"],$parent["name"],$valuechild["name"],$file,$connectData,$i);
															}
															$number = 2;
															multiFile($file,$parent["name"],$valuechild["name"],$number);
															header("location: index.php?view=list-category");
														}

														?>
														
													</div>
												</form>
											</div>
										</div>
									</td>
								</tr>
								<?php  
							} 
						}else{ 

						} 
						?>
					</tbody>
				</table>
				<!-- thêm danh mục -->
				<button type="button" class="btn btn-primary" data-toggle="modal"
				data-target="#Modal<?php echo $parent['id']; ?>" name="parent-<?php echo $parent['id'] ?>">Thêm</button>
				<!-- Modal -->
				<div class="modal fade" id="Modal<?php echo $parent['id']; ?>" tabindex="-1" role="dialog"
					aria-labelledby="exampleModalLabel" aria-hidden="true">
					<?php
					$ad = "ad-category".$parent['id'];
					if(isset($_POST[$ad])){
						$table = "category";
						$data = $_POST["names"];
						$condition = $parent;
						$file = $_FILES["file"];
						ad($table,$data,$condition,$valuechild,$file,$connectData);
						$number = 2;
						multiFile($file,$parent["name"],$data,$number);
						header("location: index.php?view=list-category");
					}
					?>
					<div class="modal-dialog" role="document">
						<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
							<div class="modal-content">
								<div class="modal-body">
									<div style="text-align: center;">
										<div class="form-body" style="padding: 20px;display: inline-block;">
											<div class="form-group">
												<label for="name" class="col-sm-2 control-label">Name</label>
												<div class="col-sm-9"><input type="text" name="names" class="form-control"
													id="name<?php echo $parent['id']; ?>"></div>
												</div>
												<label for="banner" class="col-sm-2 control-label">Banner</label>
												<div class="col-sm-9"> <input type="file" multiple="multiple" name="file[]" class="form-control"
													id="banner<?php echo $parent['id']; ?>"></div>
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
				</div>
				<?php } ?>