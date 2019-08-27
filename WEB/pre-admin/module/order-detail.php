<?php
	$idOr = $_GET["id"];
	$reOrder = mysqli_query($connectData,"SELECT od.id_product_feature,od.id_order,od.quatity,pf.id,pf.id_product,pf.id_size,p.name AS 'namePro',p.image,p.price,p.sale,p.id_category_child,s.size,cat.name AS 'nameCat',o.name_ship,o.phone_ship,o.address_ship,o.email_ship,o.money,o.`status`,o.date_create FROM order_detaily od
		JOIN product_feature pf
		ON od.id_product_feature = pf.id
		JOIN productt p
		ON p.id = pf.id_product
		JOIN size s
		ON s.id = pf.id_size
		JOIN category cat
		ON cat.id = p.id_category_child
		JOIN `order` o
		on o.id = od.id_order
		WHERE id_order = $idOr")or die("flase");
	$infoReceiver = mysqli_fetch_assoc($reOrder);

?>
<div class="order-detail">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Đơn hàng mã <span>XX-<?php print_r(mysqli_fetch_assoc($reOrder)["id_order"]);  ?></span></h3>
				</div>
					<!-- /.box-header -->
					<div class="box-body no-padding">
						<table class="table table-condensed">
							<tr>
								<th style="width: 10px">#</th>
								<th>Tên sản phẩm</th>
								<th>Ảnh</th>
								<th>Giá/Khuyến mại</th>
								<th>Kích thước</th>
								<th>Số lượng</th>
								<th>Tên danh mục</th>
							</tr>
							<?php
							$i = 0;
								foreach ($reOrder as $detail) {
									$i++;
							?>
							<tr>
								<td><?= $i;  ?></td>
								<td><?= $detail["namePro"]; ?></td>
								<td>
									<img style="width: 50px; height: 60px;" src="../public/image/<?= $detail["image"] ?>" alt="">
								</td>
								<td><?= $detail["price"]."/<s>".$detail["sale"]."<s>"; ?></td>
								<td><?= $detail["size"];  ?></td>
								<td><?=  $detail["quatity"] ?></td>
								<td><?= $detail["nameCat"];  ?></td>
								
							</tr>
							<?php } ?>
						</table>
					</div>
					<!-- thông tin người nhận -->
					<div class="infoReceiver">
						<h4>Thông tin người nhận</h4>
						<div>
							<p><?= $infoReceiver["name_ship"]."  |  ".$infoReceiver["email_ship"];  ?></p>
							<p><?= $infoReceiver["address_ship"]?></p>
							<p><?= $infoReceiver["phone_ship"]?></p>
							<p>Tổng tiền: <?= number_format($infoReceiver["money"],0,",",".")." VND"; ?></p>
							<p>Trạng thái: 
								<?php
									if($infoReceiver["status"]==1){
										echo "Chờ duyệt";
									}else if($infoReceiver["status"]==2){
										echo "Đang giao";
									}
									else if($infoReceiver["status"]==3){
										echo "Hoàn tất";
									}else{
										echo "Đã hủy";
									}
								?>
								</p>
							<p>Ngày tạo: <?= $infoReceiver["date_create"]?></p>
						</div>
					</div>
				<!-- /.box-body -->
			</div>
		</div>