<?php 
session_start();
//lấy địa chỉ 
$selectProvince = mysqli_query($connectData,"SELECT * FROM province ORDER BY name");
// đăng ký tài khoản
if(isset($_POST["signup"])){
    //lấy địa chỉ 
    $Province = mysqli_query($connectData,"SELECT name FROM province WHERE id =".$_POST["province"]);
    $District = mysqli_query($connectData,"SELECT name FROM district WHERE province_id =".$_POST["province"]);
    $Ward = mysqli_query($connectData,"SELECT name FROM ward WHERE district_id =".$_POST["district"]);

    if($_FILES["avt"]["name"] == ""){
        $_POST["avt"] = "user.png"; 
    }else{
        $_POST["avt"] = $_FILES["avt"]["name"];
    };

    $_POST["allLocation"] = mysqli_fetch_assoc($Province)["name"].', '.mysqli_fetch_assoc($District)["name"].', '.mysqli_fetch_assoc($Ward)["name"];

    $avt = $_POST["avt"];
    $address = $_POST["allLocation"];
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $phone = $_POST["phone"];
    $name = $_POST["name"];

    // kiểm ta trùng tk
    $selectAcc = mysqli_query($connectData,"SELECT * FROM customerr") or ("lỗi truy cập csdl bảng customerr, xin thử lại !");
    // đếm số tài khoản user_acc
    $selectNumAcc = mysqli_query($connectData,"SELECT COUNT(*) FROM customerr") or ("lỗi truy cập csdl bảng user_Acc, xin thử lại !");
    $num = mysqli_fetch_row($selectNumAcc)[0];
    $i = 0;
    // kiểm tra tính hợ lệ của tài khoản
    while ($row = mysqli_fetch_row($selectAcc)) {
        if($row[3] == $email){
            notification("Email đã được sử dụng, Xin thử lại !");
            break;
        }else if($row[4] == $phone){
            notification("Số điện thoại đã tồn tại, xin thử lại !");
            break;
        }else if($row[5] == $name){
            notification("Tên tài đã tồn tại, xin thử lại !");
            break;
        }else{
            $i++;
        }
    }
    if($i == $num){
    // lưu ảnh đại diện
        $file = $_FILES["avt"];
        $part = "public/image/User/";
        uploadFile($file,$part);
    // thêm tài khoản
        mysqli_query($connectData,"INSERT INTO customerr(name,address,email,phone,avt,pass) VALUES  ('$name','$address','$email','$phone','$avt','$pass')") or (notification("Lỗi thêm mới tài khoản, xin thử lại !"));
        notification("Tạo tài khoản thành công !");
        $id = mysqli_insert_id($connectData);
        $_SESSION["user"] = $id;
    }
}
// đăng nhập 
if(isset($_POST["login"])){
    $emailAcc = $_POST["emailAcc"];
    $password = $_POST["pass"];
    $selectLogin = mysqli_query($connectData,"SELECT * FROM customerr WHERE email = '$emailAcc'") or(notification("lỗi truy cập tài khoản."));
    $acc = mysqli_fetch_assoc($selectLogin);

    if($acc["pass"] == $password){
        $_SESSION["user"] = $acc["id"];
        
    }else{
     notification("Email hoặc mật khẩu không hơp lệ.");
 }
}

// lấy tài khoản vừa insert
if(isset($_SESSION["user"])){
    $selectLiveAcc = mysqli_query($connectData,"SELECT * FROM customerr WHERE id =".$_SESSION["user"]) or die(notification("kết nối tài khoản người dùng thất bại."));
}
// đổi mật khẩu
if(isset($_POST["newPass"])){
    $Pass = $_POST["newPassForgot"];
    $emailForgot = $_SESSION["email"];
    mysqli_query($connectData,"UPDATE customerr SET pass = '$Pass' WHERE email = '$emailForgot'") or notification("Đổi mật khẩu thất bại, Xin thử lại.");
    notification("Đổi mật khẩu thành công.");
}

?>
<header>
    <div class="container-fluid px-0">
        <div class="full header">
            <!-- ad respontive -->
            <div id="ad-respons">
                <span><i class="fas fa-times"></i></span>
                <img src="public/image/sale-top/sale-1.png" alt="">
            </div>
            <div class="my-container">
                <!-- nav top -->
                <div id="nav-top">
                    <div class="row h-100 w-100 m-0 overflow-hidden">
                        <div class="col-12 p-0">
                            <!-- nav -->
                            <ul class="nav float-left">
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php">Trang chủ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Giới thiệu về XIXAO</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="modal" data-target="#sigup" class="text-dark">Đăng ký tài khoản</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="full nav-header">
            <div class="my-container">
                <div id="navBar">
                    <!-- nav bar -->
                    <div class="h-100 d-flex">
                        <!-- logo -->
                        <div class="float-left px-0">
                            <div id="logo">
                                <a href="index.php" class="dis-block">
                                    <img src="public/image/xi xao_white.png" alt="">
                                    <img src="public/image/icon-logo-X-white.png" alt="XI XAO">
                                </a>
                            </div>
                        </div>
                        <!-- nav -->
                        <div class=" mr-0 h-100 d-inline-block" id="nav-main">
                            <nav class="navbar navbar-expand-lg navbar-light p-0 h-100">
                                <button class="navbar-toggler" id="button-nav-left" type="button">
                                    <i class="fas fa-align-left"></i>
                                </button>
                                <form class="form-inline my-2 my-lg-0 ">
                                    <div class="input-group w-100 dis-block">
                                        <input type="text" class="form-control border-0" placeholder="Sản phẩm" id="search">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Search</span>
                                        </div>
                                    </div>

                                </form>
                                <div class="collapse navbar-collapse mr-0" id="navbarContent">

                                    <ul class="navbar-nav mr-o w-100">
                                        <!-- đơn hàng -->
                                        <li class="nav-item m-auto mav-follow">
                                            <a class="nav-link" href="index.php?view=follow-cart">
                                                <p>
                                                    <i class="fas fa-clipboard-list"></i>
                                                </p>
                                                <span>Theo dõi đơn hàng</span>
                                            </a>
                                        </li>
                                        <!-- giỏ hàng -->
                                        <?php
                                        $quantity = 0;
                                        if(isset($_SESSION["cart"])){
                                            $cart = $_SESSION["cart"];

                                            ?>
                                            <li class="nav-item m-auto nav-basket position-relative">
                                                <a class="nav-link" href="index.php?view=cart">
                                                    <p>
                                                        <i class="fas fa-shopping-cart"></i>
                                                    </p>
                                                    <span>Giỏ hàng của tôi</span>
                                                </a>
                                                <span id="cart-icon"><?php echo(count($cart)); ?></span>
                                            </li>
                                        <?php }else{
                                            ?>

                                            <li class="nav-item m-auto nav-basket position-relative">
                                                <a class="nav-link" href="index.php?view=cart">
                                                    <p>
                                                        <i class="fas fa-shopping-cart"></i>
                                                    </p>
                                                    <span>Giỏ hàng của tôi</span>
                                                </a>
                                                <span id="cart-icon"><?php echo $quantity; ?></span>
                                            </li>
                                            <?php
                                        } ?>
                                        <?php
                                        if(isset($_SESSION["user"])){
                                            $rowAcc = mysqli_fetch_assoc($selectLiveAcc);

                                        }
                                        ?>
                                        <!-- tài khoản customerr -->
                                        <li class="nav-item m-auto nav-acc">
                                            <a class="nav-link" href="#">
                                                <div class="acc-user">
                                                    <p class="avt-user p-0">
                                                        <img src="public/image/User/<?php echo (isset($_SESSION["user"])) ? $rowAcc["avt"] : "logo-user.png" ?>" alt="acc">
                                                    </p>
                                                    <span data-toggle="tooltip" data-placement="bottom"><?php echo (isset($_SESSION["user"])) ? $rowAcc["name"] : "Đăng nhập tài khoản"?></span>
                                                </div>
                                            </a>
                                            <!-- nav login -->
                                            <?php
                                            if(empty($_SESSION["user"])){
                                                ?>
                                                <div >
                                                    <ul
                                                    class="nav flex-column position-absolute top-0 hover-nav login bg-white pb-1">
                                                    <i class="fas fa-caret-up text-center"></i>
                                                    <li class="nav-item mt-4">
                                                        <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#loginXixao">
                                                            <img class="icon-logo float-left"
                                                            src="public/image/icon-logo-X-white.png" alt="">
                                                            <img class="icon-logo float-left"
                                                            src="public/image/icon-logo-X-green.png" alt="">
                                                        Đăng nhập tài khoản XIXAO</button>
                                                    </li>
                                                    <li class="nav-item with-acc text-secondary  position-relative p-2">
                                                        <span>with</span>
                                                    </li>
                                                    <li class="nav-item">
                                                        <button type="button" class="btn btn-outline-primary">
                                                            <i class="fab fa-facebook-f float-left mt-1"></i>Đăng nhập bằng facebook
                                                        </button>
                                                    </li>
                                                    <li class="nav-item">
                                                        <button type="button" class="btn btn-outline-danger">
                                                            <i class="fab fa-google float-left mt-1"></i>
                                                        Đăng nhập bằng Google</button>
                                                    </li>
                                                    <p data-toggle="modal" data-target="#sigup" class="text-dark">Tạo tài khoản !</p>
                                                </ul>
                                            </div>
                                        <?php }else{ ?>
                                            <div class="login-acc">
                                                <ul class="nav flex-column position-absolute top-0 hover-nav login bg-white">
                                                    <!-- <li>
                                                        <a href=""><i class="fas fa-heart text-danger"></i>Sản phẩm yêu thích</a>
                                                    </li>
                                                    <li>
                                                        <a href=""><i class="far fa-eye text-warning"></i>Sản phẩm đã xem</a>
                                                    </li> -->
                                                    <li>
                                                        <a href=""><i class="fas fa-user-circle text-primary"></i>Thông tin cá nhân</a>
                                                    </li>
                                                    <li>
                                                        <a href="index.php?view=logout"><i class="fas fa-play text-danger"></i>Đăng xuất</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <?php
                                        }

                                        ?>
                                    </li>

                                    <!-- Modal đăng ký  -->
                                    <div class="modal fade" id="sigup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content " id="not-login">
                                            <div class="p-3 d-flex">
                                                <a href=""><img src="public/image/icon-logo-X-white.png" alt=""></a> <h5>ĐĂNG KÝ TÀI KHOẢN</h5>
                                            </div>
                                            <div class="modal-body" id="sigup">
                                                <form method="POST" enctype="multipart/form-data" id="form-signup">
                                                    <!-- ảnh đại diện -->
                                                    <div class="avtUser">
                                                        <input type="file" name="avt" id="avtUser" >
                                                        <label for="avtUser" class="text-secondary"><i class="fas fa-pen"></i>
                                                        </label>
                                                        <div class="showavt">
                                                        </div>
                                                        <script>
                                                            $(document).ready(function () {
                                                                $("#avtUser").change(function () {
                                                                    upload(this,".showavt");
                                                                });
                                                            });
                                                        </script>
                                                    </div>
                                                    <!-- tên đăng nhập và sđt -->
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                          <label for="name-acc">Tên bạn</label>
                                                          <input type="text" required class="form-control" pattern="[0-9a-zA-Z]{,22}" id="name-user" name="name">
                                                      </div>
                                                      <div class="form-group col-md-6">
                                                        <label for="phone">Số điện thoại</label>
                                                        <input type="text" required pattern="[0-9]{10}" class="form-control" id="phone" name="phone">
                                                    </div>
                                                </div>
                                                <!-- địa chỉ -->
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="provice">Tỉnh/Thành phố</label>
                                                        <select id="province" name="province" class="form-control" onchange="changeLocation('#province','#district','district','province_id')" required title="Vui lòng chọn Tỉnh/Thành phố của bạn" >
                                                            <option value="">Tỉnh/Thành phố</option>
                                                            <?php
                                                            foreach ($selectProvince as $key => $value) {
                                                                ?>
                                                                <option value="<?php echo $value["id"]; ?> "><?php echo $value["name"]; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="district">Quận/Huyện</label>
                                                        <select class="form-control" name="district" id="district" onchange="changeLocation('#district','#ward','ward','district_id')" required title="Vui lòng chọn Quận/Huyện của bạn">
                                                            <option value="">--Quận/Huyện--</option>
                                                            
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="ward">Phường/Xã</label>
                                                        <select class="form-control" name="ward" id="ward">
                                                            <option>--Phường/Xã--</option>
                                                        </select>
                                                        
                                                    </div>
                                                </div>
                                                <!-- đại chie email -->
                                                <div class="form-group">
                                                  <label for="email">Email</label>
                                                  <input type="email" required class="form-control" name="email" id="email">
                                              </div>
                                              <!-- tên tài khoản -->
                                              <div class="form-row">

                                                  <!-- mk tài khoản -->
                                                  <div class="form-group col-md-12">
                                                      <label for="pass">Mật khẩu</label>
                                                      <input type="password" required pattern="[0-9a-zA-Z]{8,}" class="form-control" id="pass" name="pass">
                                                  </div>
                                              </div>

                                              <button type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button>
                                              <button type="submit" class="btn btn-success" name="signup">Đăng ký</button>
                                          </form>

                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- Modal đăng nhập với xixao -->
                      <div class="modal fade" id="loginXixao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content" id="login">
                                <div class="p-3 d-flex">
                                    <a href=""><img src="public/image/icon-logo-X-white.png" alt=""></a> <h5>ĐĂNG NHẬP</h5>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" class="mt-3 col-10 mx-auto">
                                        <div class="emailLogin" >
                                          <div class="form-group">
                                            <label for="name_accdk">Email tài khoản</label>
                                            <div>
                                                <input type="text" class="form-control" id="name_accdk" name="emailAcc">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="passLogin">
                                      <div class="form-group">
                                        <label for="passdk">Password</label>
                                        <div>
                                            <input type="password" class="form-control" id="passdk" name="pass">
                                        </div>
                                    </div>
                                </div>
                                <div class="forgot mb-4 mt-2 text-white">
                                    <p>Quên mật khẩu ?</p>
                                </div>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button>
                                <button type="submit" class="btn btn-success" name="login">Đăng nhập</button>
                            </form>
                        </div>
                    </div>
                    <!-- quên mật khẩu -->
                    <div class="modal-content" id="forgot">
                         <div class="p-3 d-flex">
                            <a href=""><img src="public/image/icon-logo-X-white.png" alt=""></a><h5>Quên Mật Khẩu</h5>
                        </div>
                        <div class="modal-body" id="changeFormForgot">
                            <form method="POST" class="mt-3 col-10 mx-auto">
                                <div class="emailLogin" >
                                    <div class="form-group">
                                        <label for="email">Nhập Email</label>
                                        <div>
                                            <input type="email" required class="form-control" id="emailforgot" name="emailForgot">
                                        </div>
                                    </div>
                                </div>
                                <div data-toggle="modal" data-target="#sigup" class="text-white">
                                    <p>Đăng ký tài khoản</p>
                                </div>
                                <button type="button" onclick="changePass('emailforgot','changeFormForgot')" class="btn btn-success" name="forgot">Gửi</button>      
                            </form>
                        </div>
                </div>
                <!-- quên mật khẩu -->
            </div>
        </header>
        <!-- /* nav responsive */ -->
        <div id="nav-respons" class>
            <div class="float-right acc-user bg-success">
                <div class="text-center nav-link">
                    <p class="avt-user acc-left p-0" class="p-0">
                        <img src="public/image/User/<?php echo (isset($_SESSION["user"])) ? $rowAcc["avt"] : "logo-user.png" ?>" alt="acc">
                        <span><i class="fas fa-camera"></i></span>
                    </p>
                    <span><?php echo (isset($_SESSION["user"])) ? $rowAcc["user_name"] : "" ?></span>
                    <br>
                    <span>Email <?php  echo (isset($_SESSION["user"])) ? $rowAcc["email"] : "" ?></span>
                </div>
            </div>
            <div id="nav-left" class="d-inline-block w-100">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="" class="nav-link float-left">Trang chủ</a>
                        <img class="icon-logo m-2 float-left" src="public/image/icon-logo-X-green.png" alt="">
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">Sản phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">Giỏ hàng của tôi</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">Theo dõi đơn hàng</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">Giới thiệu XIXAO</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">Liên hệ XIXAO</a>
                    </li>
                </ul>
            </div>
        </div>
