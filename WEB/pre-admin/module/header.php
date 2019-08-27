
<?php
// lấy tài khoản admin
$idAdmin = $_SESSION["admin"];
$select = mysqli_query($connectData,"SELECT * FROM admin where id = '$idAdmin'") or die(notification("lỗi kết nối tài khoản admin"));
$admin = mysqli_fetch_assoc($select);
// hàm cập nhật thông tin tài khoản
if(isset($_POST["save"])){
$file = $_FILES["avt"];
$avt = $_FILES["avt"]["name"];
$email = $_POST["email"];
$name = $_POST["name"];
$part = "../public/image/Admin/";
uploadFile($file,$part);
// cập nhật
mysqli_query($connectData,"UPDATE admin SET avt = '$avt', email = '$email', name = '$name'") or die (notification("lỗi kết nối csdl bảng admin"));
header("location: index.php");
}
  // cập nhật mật khẩu
if(isset($_POST["changePass"])){
  $pass =$_POST["pass"];
  $IDadmin = $_SESSION["admin"];
  mysqli_query($connectData,"UPDATE admin SET pass = '$pass' WHERE id='$IDadmin'") or die ("lỗi cập nhật password");
  notification("Mật khẩu đã được thay đổi.");
}
?>
<!-- header -->
<header class="main-header">

<!-- Logo -->
<a href="index.php" class="logo">
  <!-- logo for regular state and mobile devices -->
  <span class="logo-lg"><b>Admin</b> XIXAO</span>
</a>

<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
    <span class="sr-only">Toggle navigation</span>
  </a>
  <!-- Navbar Right Menu -->
  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <!-- Messages: style can be found in dropdown.less-->
      <li class="dropdown messages-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-envelope-o"></i>
          <span class="label label-success">4</span>
        </a>
        <ul class="dropdown-menu">
          <li class="header">You have 4 messages</li>
          <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu">
              <li><!-- start message -->
                <a href="#">
                  <div class="pull-left">
                    <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                  </div>
                  <h4>
                    Support Team
                    <small><i class="fa fa-clock-o"></i> 5 mins</small>
                  </h4>
                  <p>Why not buy a new awesome theme?</p>
                </a>
              </li>
              <!-- end message -->
              <li>
                <a href="#">
                  <div class="pull-left">
                    <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                  </div>
                  <h4>
                    AdminLTE Design Team
                    <small><i class="fa fa-clock-o"></i> 2 hours</small>
                  </h4>
                  <p>Why not buy a new awesome theme?</p>
                </a>
              </li>
              <li>
                <a href="#">
                  <div class="pull-left">
                    <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                  </div>
                  <h4>
                    Developers
                    <small><i class="fa fa-clock-o"></i> Today</small>
                  </h4>
                  <p>Why not buy a new awesome theme?</p>
                </a>
              </li>
              <li>
                <a href="#">
                  <div class="pull-left">
                    <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                  </div>
                  <h4>
                    Sales Department
                    <small><i class="fa fa-clock-o"></i> Yesterday</small>
                  </h4>
                  <p>Why not buy a new awesome theme?</p>
                </a>
              </li>
              <li>
                <a href="#">
                  <div class="pull-left">
                    <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                  </div>
                  <h4>
                    Reviewers
                    <small><i class="fa fa-clock-o"></i> 2 days</small>
                  </h4>
                  <p>Why not buy a new awesome theme?</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="footer"><a href="#">See All Messages</a></li>
        </ul>
      </li>
      <!-- Notifications: style can be found in dropdown.less -->
      <li class="dropdown notifications-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-bell-o"></i>
          <span class="label label-warning">10</span>
        </a>
        <ul class="dropdown-menu">
          <li class="header">You have 10 notifications</li>
          <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu">
              <li>
                <a href="#">
                  <i class="fa fa-users text-aqua"></i> 5 new members joined today
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                  page and may cause design problems
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fa fa-users text-red"></i> 5 new members joined
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fa fa-user text-red"></i> You changed your username
                </a>
              </li>
            </ul>
          </li>
          <li class="footer"><a href="#">View all</a></li>
        </ul>
      </li>
      <!-- Tasks: style can be found in dropdown.less -->
      <li class="dropdown tasks-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-flag-o"></i>
          <span class="label label-danger">9</span>
        </a>
        <ul class="dropdown-menu">
          <li class="header">You have 9 tasks</li>
          <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu">
              <li><!-- Task item -->
                <a href="#">
                  <h3>
                    Design some buttons
                    <small class="pull-right">20%</small>
                  </h3>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                    <span class="sr-only">20% Complete</span>
                  </div>
                </div>
              </a>
            </li>
            <!-- end task item -->
            <li><!-- Task item -->
              <a href="#">
                <h3>
                  Create a nice theme
                  <small class="pull-right">40%</small>
                </h3>
                <div class="progress xs">
                  <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar"
                  aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                  <span class="sr-only">40% Complete</span>
                </div>
              </div>
            </a>
          </li>
          <!-- end task item -->
          <li><!-- Task item -->
            <a href="#">
              <h3>
                Some task I need to do
                <small class="pull-right">60%</small>
              </h3>
              <div class="progress xs">
                <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar"
                aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                <span class="sr-only">60% Complete</span>
              </div>
            </div>
          </a>
        </li>
        <!-- end task item -->
        <li><!-- Task item -->
          <a href="#">
            <h3>
              Make beautiful transitions
              <small class="pull-right">80%</small>
            </h3>
            <div class="progress xs">
              <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar"
              aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
              <span class="sr-only">80% Complete</span>
            </div>
          </div>
        </a>
      </li>
      <!-- end task item -->
    </ul>
  </li>
  <li class="footer">
    <a href="#">View all tasks</a>
  </li>
</ul>
</li>
<!-- User Account: style can be found in dropdown.less -->
<li class="interactAcc dropdown user user-menu">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
  <div class="avtAcc topAcc" style="background-image: url('../public/image/Admin/<?php echo $admin['avt'] ?>');"></div>
  <span class="hidden-xs" style="font-size: 16px;"><?php echo $admin["name"] ?></span>
</a>
<ul class="dropdowAcc">
  <!-- info acc -->
  <li class="user-header" data-toggle="modal" data-target="#infoAcc">
    Thông tin tài khoản  
  </li>
  <!-- change pass -->
  <li class="user-body" data-toggle="modal" data-target="#changerPass">
    Đổi mật khẩu
  </li>
<!-- Menu Footer-->
  <li class="user-footer">
    <a href="index.php?module=logout">Đăng xuất</a>
  </li>
</ul>
</li>
<!-- Control Sidebar Toggle Button -->
<li>
<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
</li>
</ul>
</div>
</nav>
</header>
<!--modal thông tin tài khoản -->
<div class="modal fade" id="infoAcc">
  <div class="modal-dialog" style="padding: 0px 100px;">
    <div class="modal-content" style="padding: 30px">
      <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <div class="avt">
            <input type="file" name="avt" id="avt" accept=".png, .jpg, .jpeg">
            <label for="avt"><i class="fas fa-pen"></i></label>
            <div class="showavt" style="background-image: url('../public/image/Admin/<?php echo $admin["avt"] ?>')">
            </div>
            <script>
              $(document).ready(function () {
                $("#avt").change(function () {
                  upload(this,".showavt");
                })
              });
            </script>
          </div>
          <label for="name">Tên quản trị</label>
          <input type="text" class="form-control" name="name" value="<?php echo $admin["name"] ?>">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="text" class="form-control" name="email" value="<?php echo $admin["email"] ?>">
        </div>
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="save" style="margin-left: 5px; ">Thay đổi</button>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
</div>
<!-- modal đổi mật khẩu -->
<div class="modal fade" id="changerPass">
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
