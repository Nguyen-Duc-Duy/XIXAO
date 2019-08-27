$(function(){
    
    // nav left respons hidden & show
    $("#button-nav-left").click(function(){
        event.stopPropagation(this);
        $("#nav-respons").css("width","200px");
        $(".container-fluid").css({"margin-left":"200px","opacity": ".4"});
    });
    $(window).click(function(){
        $("#nav-respons").css("width","0px");
        $(".container-fluid").css({"margin-left":"0px","opacity": "1"});
    });
    // hidden ad-respons
    $("#ad-respons span").on("click",function(){
        $("#ad-respons").css("display","none");
    });
    $("#nav-respons").on("click",function(){
        event.stopPropagation(this);
    });

    // hover nav menu 

    // hover card img product
    $(".product-item .card").hover(
    function(event){
        //$(".interact-product li .val-stt").css("opacity","1");
        //$(".interact-product li i:last-child").css("transform","scale(1)");
        $(this).children(".interact-product").css("right","6px");
    },function(){
        //$(".interact-product li .val-stt").css("opacity","0");
        //$(".interact-product li i:last-child").css("transform","scale(0.1)");
        $(this).children(".interact-product").css("right","-50px");
    });
    //click stt
     $(".interact-product .stt,.stt-item .stt").click(function(){
        // if($(this).children(".fa-eye")){
        //     alert("ok2");
        // }else{
        //     alert("yes1");
        // }
        if($("input:checked")){
            $(this).children("i:first-child").toggleClass("statused");
            $(this).children("i:last-child").toggleClass("no-status");
        }
     });
     $(".interact-product .stt,.stt-item .stt").click(function(){
        // if($(this).children(".fa-eye")){
        //     alert("ok2");
        // }else{
        //     alert("yes1");
        // }
        $("eye1").attr("checked","check");
            $(this).children("i:first-child").addClass("statused");
            $(this).children("i:last-child").addClass("no-status");
     });
     // scroll nav 
     $(window).scroll(function(){
        if($(this).scrollTop() >50){
            $(".nav-header").addClass("scrollTop");
            
        }else{
            $(".nav-header").removeClass("scrollTop");
        }
     });
     // show ảnh sản phẩm trong product detail
     $(".list-img .nav-item img").click(function(event){
        $atb = $(this).attr("src");
        $(".show-img img").attr("src",$atb);
     })

     $("#forgot").hide();
     $(".forgot p").click(function(){
        $("#login").hide();
        $("#forgot").show();
     })
     // $(".col-4 p:after").addRule({display:"none",color: "red"});
     // if($(".col-4 .orderOk")){
        
     // }else{
     //    alert("false");
     // }
     
});
// hover nav menu
function onstyle(id){
    $('.style-product[name$="'+id+'"]').css("display","block");
    $('.style-product[name$="'+id+'"]').hover(
        function(){
        $(this).css("display","block");

    },
    function(){
        $(this).css("display","none");
    }
    );
}
function offstyle(id){
    $('.style-product[name$="'+id+'"]').css("display","none");
}

// thêm sản phẩm vào rỏ hàng
function adToCart(idPro){

    $.ajax({
        type: "POST",
        url: "../WEB/view/shoping-cart.php",
        data: "idPro="+idPro,
        success: function(cart){
            $("#cart-icon").html(cart);
            
        }
    })
}

