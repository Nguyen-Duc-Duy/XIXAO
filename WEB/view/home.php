
<?php
//lấy sản phẩm 
$selectPro = mysqli_query($connectData,"SELECT * FROM productt ORDER BY RAND() LIMIT 8");
$selectProItem = mysqli_query($connectData,"SELECT * FROM productt ORDER BY RAND() DESC LIMIT 5");
?>
<!-- <home> -->
    <div class="my-container home my-2">
        <div id="nav-menu" class="w-100 d-inline-block">
            <div class="nav-menu col-left float-left">
                <ul class="nav flex-column">
                    <li class="nav-item category">
                        Danh Mục
                    </li>
                    <!-- danh mục cha -->
                    <?php
                    function menuMultilevel($loaicha,$connect){
                        $selects = "SELECT * FROM category WHERE id_category_parent = ".$loaicha;
                        $resoults = mysqli_query($connect,$selects) or die ("lỗi truy vấn csdl");
                        while ($rows = mysqli_fetch_array($resoults)) {
                            echo "<li class='item-style'>".$rows["name"]."</li>";
                            menuMultilevel($rows['id'],$connect);
                        }
                    };
                    $select = "SELECT * FROM category WHERE id_category_parent = 0";
                    $resoult = mysqli_query($connectData,$select);

                    while ($row = mysqli_fetch_array($resoult)) {

                        ?>
                        <li class="nav-item item" onmouseover="onstyle(<?php echo $row['id'] ?>)" onmouseout="offstyle(<?php echo $row['id'] ?>)">
                            <div>
                                <i class="fas fa-male ml-3"></i>
                                <a  href="index.php?view=product-<?= ($row['id']==1) ? "boy" : "girl" ?>" target="_blank" class="m-0 nav-link"><?php echo $row['name']; ?></a>
                                <i class="fas fa-caret-left"></i>
                            </div>
                        </li>
                    <?php } ?>

                    <li class="nav-item item">
                        <div>
                            <i class="fas fa-long-arrow-alt-right" style="line-height: 50px;"></i>
                            <i class="fas fa-long-arrow-alt-right" style="line-height: 34px;"></i>
                            <a href="" class="nav-link">Phong Cách Đôi</a>
                            <i class="fas fa-caret-left"></i>
                        </div>
                    </li>
                    <li class="nav-item item">
                        <div>
                            <i class="fas fa-location-arrow"></i>
                            <a  href="" class="m-0 nav-link">Xu Hướng</a>
                            <i class="fas fa-caret-left"></i>
                        </div>
                    </li>
                    <li class="nav-item item">
                        <div>
                            <i class="fas fa-shoe-prints"></i>
                            <a  href="" class="m-0 nav-link">Phụ Kiện</a>
                            <i class="fas fa-caret-left"></i>
                        </div>
                    </li>

                    <li class="nav-item item">
                        <div>
                            <i class="fas fa-address-card"></i>
                            <a  href="" class="m-0 nav-link"> Giới Thiệu XIXAO</a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="p-0 slider float-right col-right position-relative">
                <!-- style product / danh mục con-->
                <?php  
                $select = "SELECT * FROM category WHERE id_category_parent = 0";
                $result = mysqli_query($connectData,$select);
                while ($row = mysqli_fetch_array($result)) {

                    ?>
                    <div class="style-product" name="<?php echo $row["id"] ?>">
                        <ul class="d-flex" >
                            <div class="style-pro">
                                <h5><?php echo $row["name"] ?></h5>
                                <?php menuMultilevel($row['id'],$connectData); ?>               
                            </div>
                            <div class="banner-style" style="background-image: url('public/image/Thời trang nam/banner-boy/banner_mans_6.jpg');">
                            </div>
                        </ul>
                    </div>
                <?php } ?>
                <!-- slider -->
                <div class="owl-carousel owl-theme position-relative pl-2">
                    <div class="item">
                        <a href="">
                            <img src="public/image/slide/banner.jpg" alt="">
                        </a>
                    </div>
                    <div class="item">
                        <a href="">
                            <img src="public/image/slide/Banner_2.png" alt="">
                        </a>
                    </div>
                    <div class="item">
                        <a href="">
                            <img src="public/image/slide/bg2.jpg" alt="">
                        </a>
                    </div>
                    <div class="item">
                        <a href="">
                            <img src="public/image/slide/slide_man.jpg" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- <respontsive nav home> -->
            <div class="nav-menu-rsps text-center">
                <ul class="nav nav-pills my-3" id="pills-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#fastion-boy" role="tab" aria-controls="pills-home" aria-selected="true">Thời trang nam</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#fashion-gril" role="tab" aria-controls="pills-profile" aria-selected="false">Thời trang nữ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#trend" role="tab" aria-controls="pills-contact" aria-selected="false">Xu hướng</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade" id="fastion-boy" role="tabpanel" aria-labelledby="pills-home-tab">...</div>
              <div class="tab-pane fade" id="fashion-gril" role="tabpanel" aria-labelledby="pills-profile-tab">...</div>
              <div class="tab-pane fade" id="trend" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
          </div>
      </div>
      <!-- </respontsive nav home> -->
      <!-- content home -->
      <!-- <left content> -->
        <div id="left-content" class="col-left float-left mt-2">
            <!--  AD -->
            <div class="AD-left">
                <div class="owl-carousel owl-theme">
                    <div class="item">
                        <!-- <card AD> -->
                            <a href="">
                                <div class="card border-0">
                                    <div class="card-img">
                                        <img class="card-img-top" src="public/image/Content/banner_sale.png"
                                        alt="Card image cap">
                                    </div>
                                    <div class="card-body text-center text-dark pt-0 mb-4">
                                        <p class="card-text">Some quick example text to build on the card title and make up the
                                            bulk
                                        of the card's content.</p>
                                    </div>
                                </div>
                            </a>
                            <!-- </card AD> -->
                        </div>
                        <div class="item">
                            <!-- <card AD> -->
                                <a href="">
                                    <div class="card border-0">
                                        <div class="card-img">
                                            <img class="card-img-top" src="public/image/Content/banner_sale.png"
                                            alt="Card image cap">
                                        </div>
                                        <div class="card-body text-center text-dark pt-0 mb-4">
                                            <p class="card-text">Some quick example text to build on the card title and make up the
                                                bulk
                                            of the card's content.</p>
                                        </div>
                                    </div>
                                </a>
                                <!-- </card AD> -->
                            </div>
                        </div>
                    </div>
                    <!-- </AD> -->
                    <!-- <news> -->
                        <div class="card mt-3 border-0">
                            <h5 class="card-title text-success text-center mt-3 mb-0">Bản tin</h5>
                            <div class="card-body text-success text-center pt-1 px-2">
                                <p class="card-text">Cuộc sống nhộn nhịp thay đổi. Thời trang không phải là thứ lạc hậu.</p>
                                <p class="card-text">Đăng ký với chúng tôi đê luôn cập nhật trend thời thượng mới nhất.
                                nhất.</p>
                            </div>
                            <form class="text-center">
                                <div class="form-group mx-sm-3 mb-2">
                                    <input type="text" class="form-control" id="inputPassword2" placeholder="Email">
                                </div>
                                <div class="form-group mx-sm-3">
                                    <button type="submit" class="btn btn-primary w-100">Nhận</button>
                                </div>
                            </form>
                        </div>
                        <!-- </news> -->
                        <!-- <video>-->
                            <div class="video-fashion">
                                <div class="card mt-3 border-0">
                                    <iframe height="219" src="https://www.youtube.com/embed/A1z_3-5AV1Y?controls=0&rel=0&mute=1&autoplay=1&repeate=5&audio=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                            </div>
                            <!-- </video> -->
                        </div>
                        <!-- </left content> -->
                        <!-- <content> -->
                            <div class="col-right py-3 pr-0 pl-4 float-right">
                                <!-- <banner> -->
                                    <div class="banner">
                                        <div class="row mx-0">
                                            <div class="col">
                                                <a href=""><img src="public/image/banner/Banner-6.png" alt=""></a>
                                            </div>
                                            <div class="col">
                                                <a href=""><img src="public/image/banner/Banner-1.png" alt=""></a>
                                            </div>
                                            <div class="col">
                                                <a href=""><img src="public/image/banner/Banner-2.png" alt=""></a>
                                            </div>
                                            <div class="col">
                                                <a href=""><img src="public/image/banner/Banner-3.png" alt=""></a>
                                            </div>
                                            <div class="col">
                                                <a href=""><img src="public/image/banner/Banner-4.png" alt=""></a>
                                            </div>
                                            <div class="col ">
                                                <a href=""><img src="public/image/banner/Banner-6.png" alt=""></a>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- </banner> -->
                                    <!-- <product> -->
                                        <div class="product mt-2">
                                            <!-- title product -->
                                            <div class="title-product ml-0">
                                                <h4>Sản Phẩm</h4>
                                            </div>
                                            <div class="bg-white text-center p-0">
                                                <div class="row mx-0 pl-0">
                                                    <!-- <product item> -->
                                                        <?php
                                                        if(mysqli_num_rows($selectPro) >0){
                                                            while ($row = mysqli_fetch_assoc($selectPro))
                                                            {
                                                                $postId = $row["id"];
                                                                ?>
                                                                <div class="col-md-3 col-6 col-sm-4  pr-0 my-2">
                                                                    <div class="product-item">
                                                                        <!-- <card> -->
                                                                            <a href="index.php?view=product-detail&id=<?php echo $row["id"] ?>" class="link-item text-decoration-none">
                                                                                <div class="card position-relative">
                                                                                    <div class="card-img" name="img-item"
                                                                                    style="background-image: url('public/image/<?php echo $row["image"] ?>')">
                                                                                </div>
                                                                                <div class="card-body p-2">
                                                                                    <div clas="info-product">
                                                                                        <h6 class="card-title m-0 text-center" name="card-title"><?php echo $row["name"] ?></h6>
                                                                                        <p class="star text-center m-0" name="star">
                                                                                            <i class="far fa-star"></i>
                                                                                            <i class="far fa-star"></i>
                                                                                            <i class="far fa-star"></i>
                                                                                            <i class="far fa-star"></i>
                                                                                            <i class="far fa-star"></i>
                                                                                        </p>
                                                                                        <p class="card-text text-center">
                                                                                            <?php echo number_format($row["price"],0,",","."); ?>
                                                                                            <span class="sale text-secondary" name="sale"> <?php echo number_format($row["sale"],0,",","."); ?></span>
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                                <!--  add stt -->
                                                                                <div class="interact-product">
                                                                                    <form class="send-stt">
                                                                                        <ul class="nav flex-column text-center">
                                                                                            <li class="nav-item mb-2">
                                                                                                <input type="checkbox" id="heart<?php echo $row["id"] ?>">
                                                                                                <label for="heart<?php echo $row["id"] ?>" class="stt">
                                                                                                    <i class="fas fa-heart text-danger"></i>
                                                                                                    <i class="far fa-heart text-danger"></i>
                                                                                                </label>
                                                                                                <div class="val-stt">
                                                                                                    <strong>1</strong>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li class="nav-item mb-2">
                                                                                                <label for="cart<?php echo $row["id"] ?>" class="stt">
                                                                                                    <i class="fas fa-vote-yea text-success"></i>
                                                                                                    <i class="fas fa-cart-arrow-down text-success"></i>
                                                                                                </label>
                                                                                                <div class="val-stt">
                                                                                                    <strong>1</strong>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li class="nav-item">
                                                                                                <label for="eye<?php echo $row["id"] ?>" class="stt eye">
                                                                                                    <i class="fas fa-check text-success"></i>
                                                                                                    <i class="far fa-eye text-warning"></i>
                                                                                                </label>
                                                                                                <div class="val-stt">
                                                                                                    <strong>1</strong>
                                                                                                </div>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                        <!-- </card>  -->
                                                                    </div>
                                                                </div>
                                                                <?php 
                                                            }
                                                        }
                                                        ?>
                                                        <!-- </product item> -->
                                                    </div>
                                                    <div class="row mx-0 pl-0">
                                                        <button class="btn btn-outline-danger show-more m-auto" id="<?php echo $postId ?>" >Xem Thêm</button>
                                                        <p class="btn btn-outline-danger m-0 loading mb-2" style="display: none;">Loading...</p>    
                                                    </div>    
                                                </div>
                                                <!-- </product> -->
                                                <!-- <type product> -->
                                                    <div class="type-product mt-1">
                                                        <div class="row w-100 m-auto">
                                                            <!-- <sản phẩm mới> -->
                                                            <div class="col-md-6">
                                                                <div class="news type-item">
                                                                    <h4>Sản phẩm mới</h4>
                                                                    <!-- <product type item> -->
                                                                        <?php
                                                                        foreach ($selectProItem as $rowItemNew) {
                                                                            ?>
                                                                            <div class="product-item-small w-100 d-flex mt-2">
                                                                                <div class="img-item-small"
                                                                                style="background-image: url('public/image/<?php echo $rowItemNew["image"] ?>')">
                                                                            </div>
                                                                            <div class="info-item">
                                                                                <p class="type-small"><?php echo $rowItemNew["name"]; ?></p>
                                                                                <p class="price"><?php echo number_format($rowItemNew["price"],0,",","."); ?></p>
                                                                            </div>
                                                                            <div class="stt-item">
                                                                                <form action="" class="send-stt">
                                                                                    <input type="checkbox" id="heart-new-<?php echo $rowItemNew["id"] ?>">
                                                                                    <label for="heart-new-<?php echo $rowItemNew["id"]; ?>" class="stt">
                                                                                        <i class="fas fa-heart text-danger"></i>
                                                                                        <i class="far fa-heart text-danger"></i>
                                                                                    </label>
                                                                                    <label for="eye-new-<?php echo $rowItemNew["id"] ?>" class="stt">
                                                                                        <i class="fas fa-check text-success"></i>
                                                                                        <i class="far fa-eye text-warning mr-2"></i>
                                                                                    </label>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    <?php } ?>
                                                                    <!-- </product type item> -->
                                                                </div>
                                                            </div>
                                                            <!-- </sản phẩm mới> -->

                                                            <!-- </thịnh hành> -->
                                                            <div class="col-md-6">
                                                                <div class="abc type-item">
                                                                    <h4>Mua nhiều nhất</h4>
                                                                    <!-- <product type item> -->
                                                                        <?php
                                                                        foreach ($selectProItem as $love){

                                                                            ?>
                                                                            <div class="product-item-small w-100 d-flex mt-2">
                                                                                <div class="img-item-small"
                                                                                style="background-image: url('public/image/<?php echo $love["image"] ?>')">
                                                                            </div>
                                                                            <div class="info-item">
                                                                                <p class="type-small"><?php echo $love["name"] ?></p>
                                                                                <p class="price"><?php echo number_format($love["price"],0,",","."); ?></p>
                                                                            </div>
                                                                            <div class="stt-item">
                                                                                <form action="" class="send-stt">
                                                                                    <input type="checkbox" id="heart-love-<?php echo $love["id"] ?>">
                                                                                    <label for="heart-love-<?php echo $love["id"] ?>" class="stt">
                                                                                        <i class="fas fa-heart text-danger"></i>
                                                                                        <i class="far fa-heart text-danger"></i>
                                                                                    </label>
                                                                                    <label for="eye-love-<?php echo $love["id"] ?>" class="stt">
                                                                                        <i class="fas fa-check text-success"></i>
                                                                                        <i class="far fa-eye text-warning mr-2"></i>
                                                                                    </label>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    <?php } ?>
                                                                    <!-- </product type item> -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- </type product> -->
                                                </div>
                                                <!-- </content> -->
                                            </div>
                                        </div>
                                        <!--  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
