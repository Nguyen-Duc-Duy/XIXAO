<?php
// truy vấn đến danh mục cha 
$selectParent = "SELECT * FROM category WHERE id_category_parent = 0";
$resultParent = mysqli_query($connectData,$selectParent) or die ("error connect database xixao, please try again");

// lặp ra các danh mục cha
foreach ($resultParent as $parent) {

  $idparent = $parent["id"];
// lấy thông tin từ bảng product theo danh mục cha
  $selectPro = "SELECT pro.id,pro.name,pro.price,pro.title,pro.sale,pro.image,pro.id_category_child,pro.star,pro.descript,pro.date_create FROM `productt` `pro` JOIN (SELECT `id` AS 'idChild' FROM `category` `c` WHERE `c`.`id_category_parent` = '$idparent') `tk` ON `tk`.`idChild` = `pro`.`id_category_child`";
  $resultPro = mysqli_query($connectData, $selectPro) or die ("lỗi kết nối cơ sở dữ liệu bảng product, xin thử lại!");
  ?>
  <div class="box">
    <div class="box-header">
      <h3 class="box-title"><?php echo $parent["name"]; ?></h3>
      <a href="index.php?module=ad-product" class="btn bg-<?php echo $parent["id"] == 1 ? "red" : "yellow" ?>" style="padding: 3px 5px;"><i class="fas fa-plus"> </i> Thêm</a></button>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="product-<?php echo $parent["id"]; ?>" class="table table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>Tên sản phẩm</th>
            <th>Giá/Khuyến mại</th>
            <th>Sao</th>
            <th>Kích thước</th>
            <th>Tiêu đề</th>
            <th>Ảnh</th>
            <th>Ngày tạo</th>
            <th>Thao tác</th>
          </tr>
        </thead>
        <tbody class="list-pro-<?php echo $parent["id"] ?>">
          <?php
          $i = 0;
            //lặp thông tin sản phẩm
          foreach ($resultPro as $pro)
          {
            $i++;
              // lấy kích thước sản phẩm
            $selectSize = "
            SELECT s.`size` FROM product_feature pc
            JOIN size s
            ON pc.`id_size` = s.`id`
            WHERE pc.`id_product` =".$pro["id"];
            $resultSize = mysqli_query($connectData,$selectSize) or die("lỗi kết nối cơ sở dữ liệu bảng product_size và size");
            $z = 0;
            $listSize = "";
            foreach ($resultSize as $size) {
              $z += 1;
              if($z ==1){
                $listSize .= $size["size"];
              }else{
                $listSize .= ",".$size["size"];
              }
            }   
            ?>
            <tr>
              <!-- thông tin sp -->
              <td><?php echo $i; ?></td>
              <td><?php echo $pro["name"]; ?></td>
              <td><?php echo $pro["price"]." - <s>".$pro["sale"]."</s>"; ?></td>
              <td><?php echo $pro["star"]; ?></td>
              <td><?php echo $listSize; ?></td>
              <td><?php echo $pro["title"]; ?></td>
              <td style="padding: 0;width: 80px;">
                <div class="box-imgPro" style="background-image: url('../public/image/<?php echo $pro["image"]; ?>');"></div>
              </td>
              <td><?php echo $pro["date_create"]; ?></td>
              <!-- thao tác -->
              <td>
                <a href="index.php?module=edit-product&id=<?php echo $pro["id"]; ?>" class="text-white btn btn-success">Sửa</a>
                <a href="index.php?module=delete&idProDel=<?php echo $pro["id"] ?>" class="text-white btn btn-danger float-right">Xóa</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <?php } ?>
  <script>
  $(document).ready(function(){
    $("button").click(function(){
      var id = $(this).attr("id");
      $.ajax({
        type: "POST",
        url : "view/delete.php",
        data: "idPro="+id,
        success : function(result){
          $(".box").load(window.location.href +" .box");
        }
      })
    })
  })
</script>