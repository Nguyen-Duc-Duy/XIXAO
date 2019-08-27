<?php
ob_start();
include('../view/connect.php');
	// lấy thông tin admin
if(isset($_SESSION["admin"])){
	$nameAdmin = $_SESSION["admin"];
	$selectAdmin = "SELECT * FROM admin WHERE id = '$nameAdmin'";
	$resultAdmin = mysqli_query($connectData,$selectAdmin) or die ("lối kết nối csdl xin thử lại !");
}
	// cập nhật mật khẩu
if(isset($_POST["changePass"])){
	$pass =$_POST["pass"];
	$admin = $_SESSION["admin"];
	mysqli_query($connectData,"UPDATE admin SET pass = '$pass' WHERE id='$admin'") or die ("lỗi cập nhật password");
	notification("Mật khẩu đã được thay đổi.");
}
?>

<!-- header-starts -->
<div class="header-section">
	<!--menu-right-->
	<div class="top_menu">
		<div class="main-search">
			<form>
				<input type="text" value="Search" onFocus="this.value = '';" onBlur="if (this.value == '') {this.value = 'Search';}" class="text"/>
				<input type="submit" value="">
			</form>
			<div class="close"><img src="images/cross.png" /></div>
		</div>
		<!-- <div class="srch"><button></button></div> -->
		<script type="text/javascript">
			$('.main-search').hide();
			$('button').click(function (){
				$('.main-search').show();
				$('.main-search text').focus();
			}
			);
			$('.close').click(function(){
				$('.main-search').hide();
			});
		</script>
		<!--/profile_details-->
		<div class="float-right">
			<ul class="nofitications-dropdown">
				<?php
				foreach ($resultAdmin as $value) {

					?>
					<li class="dropdown note float-right">
						<div class="box-acc">
							<div class="user_img" style="background-image: url('../public/image/Admin/<?php echo $value['avt']; ?>'); ">
							</div>
							<div class="notification_desc">
								<p><?php echo $value["name"]; ?></p>
							</div>
						</div>
						<ul class="nav-dropdown">
							<li class="item-acc"><a href="index.php?view=info-admin">Thông tin tài khoản</a></li>
							<li class="item-acc"><a href="" data-toggle="modal" data-target="#exampleModal">Đổi mật khẩu</a></li>
							<li class="item-acc"><a href="index.php?view=logout">Đăng xuất</a></li>
						</ul>
						<!-- modal đổi mật khẩu -->
						<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Đổi mật khẩu</h5>
									</div>
									<div class="passOld">
										<div class="modal-body" style="width: 400px; margin: auto;">
											<form>										    
												<div class="form-group">
													<label for="exampleInputPassword1">Mật khẩu cũ</label>
													<input type="password" class="form-control" id="passOld" placeholder="Password" pattern="[0-9a-zA-Z]{8,}" title="Mật khẩu yêu cầu 8 ký tự trở lên" >
												</div>
											</form>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
											<button type="button" onclick="checkPass()" class="btn btn-primary">Gửi</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>
				<?php } ?>
				<li class="dropdown note">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell-o"></i> <span class="badge">5</span></a>

					<ul class="dropdown-menu two">
						<li>
							<div class="notification_header">
								<h3>You have 5 new notification</h3>
							</div>
						</li>
						<li><a href="#">
							<div class="user_img"><img src="" alt=""></div>
							<div class="notification_desc">
								<p>Lorem ipsum dolor sit amet</p>
								<p><span>1 hour ago</span></p>
							</div>
							<div class="clearfix"></div>	
						</a></li>
						<li class="odd"><a href="#">
							<div class="user_img"><img src="" alt=""></div>
							<div class="notification_desc">
								<p>Lorem ipsum dolor sit amet </p>
								<p><span>1 hour ago</span></p>
							</div>
							<div class="clearfix"></div>	
						</a></li>
						<li><a href="#">
							<div class="user_img"><img src="" alt=""></div>
							<div class="notification_desc">
								<p>Lorem ipsum dolor sit amet </p>
								<p><span>1 hour ago</span></p>
							</div>
							<div class="clearfix"></div>	
						</a></li>
						<li>
							<div class="notification_bottom">
								<a href="#">See all notification</a>
							</div> 
						</li>
					</ul>
				</li>	
				<li class="dropdown note">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-tasks"></i> <span class="badge blue1">9</span></a>
					<ul class="dropdown-menu two">
						<li>
							<div class="notification_header">
								<h3>You have 9 pending task</h3>
							</div>
						</li>
						<li><a href="#">
							<div class="task-info">
								<span class="task-desc">Database update</span><span class="percentage">40%</span>
								<div class="clearfix"></div>	
							</div>
							<div class="progress progress-striped active">
								<div class="bar yellow" style="width:40%;"></div>
							</div>
						</a></li>
						<li><a href="#">
							<div class="task-info">
								<span class="task-desc">Dashboard done</span><span class="percentage">90%</span>
								<div class="clearfix"></div>	
							</div>

							<div class="progress progress-striped active">
								<div class="bar green" style="width:90%;"></div>
							</div>
						</a></li>
						<li><a href="#">
							<div class="task-info">
								<span class="task-desc">Mobile App</span><span class="percentage">33%</span>
								<div class="clearfix"></div>	
							</div>
							<div class="progress progress-striped active">
								<div class="bar red" style="width: 33%;"></div>
							</div>
						</a></li>
						<li><a href="#">
							<div class="task-info">
								<span class="task-desc">Issues fixed</span><span class="percentage">80%</span>
								<div class="clearfix"></div>	
							</div>
							<div class="progress progress-striped active">
								<div class="bar  blue" style="width: 80%;"></div>
							</div>
						</a></li>
						<li>
							<div class="notification_bottom">
								<a href="#">See all pending task</a>
							</div> 
						</li>
					</ul>
				</li>		   							   		
				<div class="clearfix"></div>	
			</ul>
		</div>
		<div class="clearfix"></div>	
		<!--//profile_details-->
	</div>
	<!--//menu-right-->
	<div class="clearfix"></div>
</div>