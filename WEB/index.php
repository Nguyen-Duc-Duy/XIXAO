<?php 
ob_start();
include("view/connect.php");
include("pre-admin/module/funtion.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>XI XAO</title>
    <!-- icon logo XIXAO -->
    <link rel="icon" href="public/image/icon-logo-X-green.png">
    <!-- font awasome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <!-- bootrap 4.3.1 css-->
    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
    <!-- carousel css -->
    <link rel="stylesheet" href="public/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="public/owl-carousel/owl.theme.default.min.css">
    <!-- Start WOWSlider.com HEAD section -->
    <!-- <link rel="stylesheet" type="text/css" href="public/engine1/style.css"/> -->

    <!-- End WOWSlider.com HEAD section -->
    <!-- my css -->
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/media.css">
    <link rel="stylesheet" href="public/css/home.css">
    <link rel="stylesheet" href="public/css/product-boy.css">
    <link rel="stylesheet" href="public/css/prodyct-girl.css">
    <link rel="stylesheet" href="public/css/product-detail.css">
    <link rel="stylesheet" href="public/css/cart.css">
    <!-- jquery -->
    <script src="public/js/jquery-3.4.1.min.js"></script>
<script>
    //chon địa chỉ người dùng 
    function changeLocation(select,whereChange,table,idSql){
        var idLocation = $(select+" option:selected").attr("value");
        $.ajax({
            type: "POST",
            url: "view/ajax.php",
            data: {"location":idLocation,"table":table,"idSQL":idSql},
            success: function(relocation){
                $(whereChange).html(relocation);
            }
        })
    }
    //hàm kiểm tra email đầu vào
        function changePass(value,where){
            var email = $("#"+value).val();
            $.ajax({
                type: "POST",
                url: "view/ajax.php",
                data: {"email":email,"where":where,"value":value},
                success: function(act){
                    $("#"+where).html(act);
                }
            });
        };
        //hàm kiểm tra mã random
        function checkRandom(where,value) {
            var check = $("#"+value).val();
            $.ajax({
                type: "POST",
                url: "view/ajax.php",
                data: {"checkRandom":check,"where":where},
                success: function(act){
                    $("#"+where).html(act);
                }
            });
        };

</script>
</head>
<body>
    <div id="noti">
        
    </div>

    <!-- header -->
    <?php include ('view/header.php')?>

    <!-- content -->
    <?php
    if(isset($_GET["view"])){
        $page = $_GET["view"];
        include('view/'.$page.'.php');
    }else{
        include ('view/home.php');
    }
    ?>

    <!-- footer -->
    <?php include ('view/footer.php')?>




    <!-- bootrap 4.3.1 js-->

    <script src="public/bootstrap/js/bootstrap.min.js"></script>

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<!-- carousel -->
<script src="public/owl-carousel/owl.carousel.js"></script>
<!-- <script type="text/javascript" src="public/engine1/jquery.js"></script> -->
<!-- <script src="public/engine1/wowslider.js"></script>
    <script src="public/engine1/script.js"></script> -->
    <!-- nhúng comment fb -->
    <div id="fb-root"></div>
    <script async defer src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6"></script>
    <!-- my js -->
    <script src="public/js/script.js"></script>
    <script src="public/js/my-owl-carousel.js"></script>
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <script>
        //hàm lọc sản phẩm
        function fill(price,size){
            var valSize = $(size+" option:selected").attr("value");
            var valPrice = $(price+" option:selected").attr("value");
            $.ajax({
                type: "POST",
                url: "view/ajax.php",
                data: {"size":valSize,"price":valPrice},
                success: function(re){
                    $(".pro-boy .row").html(re);
                }
            })
        }
        function fillCat(idCat){
            $.ajax({
                type: "POST",
                url: "view/ajax.php",
                data: "catChild="+idCat,
                success: function(re){
                    $(".pro-boy .row").html(re);
                }
            })
        }
        // hàm load thêm sản phẩm
        $(function(){
            $(".show-more").click(function(){
                var id  = $(this).attr("id");
                $(".show-more").hide();
                $(".loading").show();
                $.ajax({
                    type: "POST",
                     url: "pre-admin/module/ajax-add.php",
                    data: "loadMore="+id,
                    success: function(html){
                        $(".product .bg-white .row:last-child").html(html);
                    }
                })              
            })                            
        })
        // hàm cập nhật số sản phẩm và xóa sản phẩm khi sl = 0
        function updateNumber(id){
            var num = $("#pro"+id).val();
            var valSize = $("input[type='radio']:checked").val();
            $.post('view/updateNumber.php',{'size':valSize,'id':id,'num':num},function(data){
                $(".box-cart").load("index.php?view=cart .box-cart")
            })
        }
        function updateSize(id){
            var valSize = $("input[type='radio']:checked").val();
             var num = $("#pro"+id).val();
            $.post(
                'view/updateNumber.php',
                {'id':id,'size':valSize,'num':num},
                function(data){
                    $(".box-cart").load("index.php?view=cart .box-cart");
            })
        }
        function deleteCart(id){
            num = $("#pro"+id).val();
            $.post('view/updateNumber.php',{'id':id,'num':0},function(data){
                 $(".box-cart").load("index.php?view=cart .box-cart");
            })
        }
    </script>

</body>

</html>