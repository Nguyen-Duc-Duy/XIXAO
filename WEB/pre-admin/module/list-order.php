<?php 
	// lấy thông tin đơn hàng
$selectOrApproval = mysqli_query($connectData,"SELECT * FROM `order` WHERE status = 1")or die("error");
$selectOrDelivering = mysqli_query($connectData,"SELECT * FROM `order` WHERE status = 2")or die("error");
$selectOrSuccess = mysqli_query($connectData,"SELECT * FROM `order` WHERE status = 3")or die("error");
$selectOrCancelled = mysqli_query($connectData,"SELECT * FROM `order` WHERE status = 0")or die("error");
?>
<ul class="nav nav-pills mb-3" role="tablist">
	<li class="nav-item">
		<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#orderWaitingForApproval" role="tab" aria-controls="pills-home" aria-selected="true">Đơn chờ duyệt</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#orderDelivering" role="tab" aria-controls="pills-profile" aria-selected="false">Đơn hàng đang giao</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#orderSuccess" role="tab" aria-controls="pills-contact" aria-selected="false">Giao hàng thành công</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" id="pills-contact" data-toggle="pill" href="#orderCancel" role="tab" aria-controls="pills-contact" aria-selected="false">Đơn hàng đã hủy</a>
	</li>
</ul>
<!-- quá trình các đơn hàng -->
<div class="tab-content" id="actOrder">
	<!-- đơn hàng chờ duyệt -->
	<div class="tab-pane fade active" id="orderWaitingForApproval" role="tabpanel" aria-labelledby="pills-home-tab">
		<div class="list-order" id="approval">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Danh sách đơn hàng</h3>
				</div>
				<!-- /.box-header -->
				<?php 
				if($selectOrApproval->num_rows > 0){
				?>
				<div class="box-body no-padding">
					<table class="table table-condensed">
						<tr>
							<th style="width: 10px">#</th>
							<th>Mã</th>
							<th>Tên người nhận</th>
							<th>Email</th>
							<th>Số điện thoại</th>
							<th>Cập nhật trạng thái</th>
							<th style="width: 40px">Chi tiết</th>
						</tr>
						<tr>
							<?php
							$i = 0;
							foreach ($selectOrApproval as $approval) {
								$i++;
								?>
								<td><?= $i; ?>.</td>
								<td><?= "XX-".$approval["id"]; ?></td>
								<td><?= $approval["name_ship"]; ?></td>
								<td><?= $approval["email_ship"]; ?></td>
								<td><?= $approval["phone_ship"]; ?></td>
								<td>
									<button class="text-white btn btn-success" onclick="order(<?= $approval["id"]; ?>,2)">Nhận giao</button>
									<button class="text-white btn btn-danger" onclick="order(<?= $approval["id"]; ?>,0)">Hủy</button>
								</td>
								<td><a href="index.php?module=order-detail&id=<?php echo $approval["id"]; ?>" class=" btn btn-info">Xem</a></td>
							</tr>
						<?php } ?>
					</table>
				</div>
				<?php }else{
					?>
					<div>
						<h5 style="padding: 12px;">Hiện tại không có đơn hàng nào cần duyệt giao. Bạn có thể đọc một quyển sách, uống một ly trà... và quay lại sau.</h5>
					</div>
					<?php
				} ?>
				<!-- /.box-body -->
			</div>
		</div>
	</div>
	<!-- đơn hàng đang giao -->
	<div class="tab-pane fade" id="orderDelivering" role="tabpanel" aria-labelledby="pills-profile-tab">
		<div class="list-order" id="delivering">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Danh sách đơn hàng</h3>
				</div>
				<?php if($selectOrDelivering->num_rows > 0){ ?>
					<!-- /.box-header -->
					<div class="box-body no-padding">
						<table class="table table-condensed">
							<tr>
								<th style="width: 10px">#</th>
								<th>Mã</th>
								<th>Tên người nhận</th>
								<th>Email</th>
								<th>Số điện thoại</th>
								<th>Cập nhật trạng thái</th>
								<th style="width: 40px">Chi tiết</th>
							</tr>
							<tr>
								<?php
								$i = 0;
								foreach ($selectOrDelivering as $delivering) {
									$i++;
									?>
									<td><?= $i; ?>.</td>
									<td><?= "XX-".$delivering["id"]; ?></td>
									<td><?= $delivering["name_ship"]; ?></td>
									<td><?= $delivering["email_ship"]; ?></td>
									<td><?= $delivering["phone_ship"]; ?></td>
									<td>
										<button class="text-white btn btn-success" onclick="order(<?= $delivering["id"]; ?>,3)">Đã Giao</button>
										<button class="text-white btn btn-danger" onclick="order(<?= $delivering["id"]; ?>,0)">Hủy</button>
									</td>
									<td><a href="index.php?module=order-detail&id=<?php echo $delivering["id"]; ?>" class=" btn btn-info">Xem</a></td>
								</tr>
							<?php } ?>
						</table>
					</div>

				<?php }else{
					?>
					<div>
						<h5 style="padding: 12px;">Hiện tại không có đơn hàng nào đang giao. Vui lòng kiểm tra <a class="nav-link active" data-toggle="pill" href="#orderWaitingForApproval" role="tab" aria-controls="pills-home" aria-selected="true">Đơn hàng chờ duyệt</a> .</h5>
					</div>
					<?php
				} ?>
				<!-- /.box-body -->
			</div>
		</div>
	</div>
	<!-- đơn hàng đã hoàn tất -->
	<div class="tab-pane fade" id="orderSuccess" role="tabpanel" aria-labelledby="pills-contact-tab">
		<div class="list-order" id="success">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Danh sách đơn hàng</h3>
				</div>
				<!-- /.box-header -->
				<?php 
				if($selectOrSuccess->num_rows > 0){
				?>
				<div class="box-body no-padding">
					<table class="table table-condensed">
						<tr>
							<th style="width: 10px">#</th>
							<th>Mã</th>
							<th>Tên người nhận</th>
							<th>Email</th>
							<th>Số điện thoại</th>
							<th style="width: 40px">Chi tiết</th>
						</tr>
						<tr>
							<?php
							$i = 0;
							foreach ($selectOrSuccess as $success) {
								$i++;
								?>
								<td><?= $i; ?>.</td>
								<td><?= "XX-".$success["id"]; ?></td>
								<td><?= $success["name_ship"]; ?></td>
								<td><?= $success["email_ship"]; ?></td>
								<td><?= $success["phone_ship"]; ?></td>
								<td><a href="index.php?module=order-detail&id=<?php echo $success["id"]; ?>" class=" btn btn-info">Xem</a></td>
							</tr>
						<?php } ?>
					</table>
				</div>
				<?php }else{
					?>
					<div>
						<h5 style="padding: 12px;">Chưa có đơn nào được giao thành công, xin kiểm tra lại hệ thống chuyển phát.</h5>
					</div>
					<?php
				} ?>
				<!-- /.box-body -->
			</div>
		</div>
	</div>
	<!-- đơn hàng đã hủy -->
	<div class="tab-pane fade" id="orderCancel" role="tabpanel" aria-labelledby="pills-contact">
		<div class="list-order" id="cancel">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Danh sách đơn hàng</h3>
				</div>
				<!-- /.box-header -->
				<?php 
				if($selectOrCancelled->num_rows > 0){
				?>
				<div class="box-body no-padding">
					<table class="table table-condensed">
						<tr>
							<th style="width: 10px">#</th>
							<th>Mã</th>
							<th>Tên người nhận</th>
							<th>Email</th>
							<th>Số điện thoại</th>
							<th>Cập nhật trạng thái</th>
							<th style="width: 40px">Chi tiết</th>
						</tr>
						<tr>
							<?php
							$i = 0;
							foreach ($selectOrCancelled as $cancel) {
								$i++;
								?>
								<td><?= $i; ?>.</td>
								<td><?= "XX-".$cancel["id"]; ?></td>
								<td><?= $cancel["name_ship"]; ?></td>
								<td><?= $cancel["email_ship"]; ?></td>
								<td><?= $cancel["phone_ship"]; ?></td>
								<td><button class="text-white btn btn-success" onclick="order(<?= $cancel["id"]; ?>,2)">Khôi phục đơn hàng</button></td>
								<td><a href="index.php?module=order-detail&id=<?php echo $cancel["id"]; ?>" class=" btn btn-info">Xem</a></td>
							</tr>
						<?php } ?>
					</table>
				</div>
				<?php }else{
					?>
					<div>
						<h5 style="padding: 12px;">Không có đơn hàng bị hủy bỏ.</h5>
					</div>
					<?php
				} ?>
				<!-- /.box-body -->
			</div>
		</div>
	</div>
</div>

