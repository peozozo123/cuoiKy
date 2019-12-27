

<?php 

  $open = "product";
  require_once __DIR__. "/../../autoload/autoload.php";

    $id = intval(getInput('id'));

    $editProduct = $db ->fetchID("product", $id)  ;
    if( empty($editProduct)) {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin("product");
    }

  $category = $db ->fetchAll("category");
  
  if($_SERVER["REQUEST_METHOD"] == "POST") {

    $data = [
        "name" => postInput("name"),
        "slug" => to_slug(postInput("name")),
        "category_id" => postInput("category_id"),
        "price" => postInput("price"),
        "number" => postInput("number"),
        "content" => postInput("content")
    ];
    $error = [];
    if(postInput('name') == '') {
        $error['name'] = "Mời bạn nhập đầy đủ tên sản phẩm";
    }
    if(postInput('category_id') == '') {
        $error['category_id'] = "Mời bạn chọn tên danh mục";
    }
    if(postInput('price') == '') {
        $error['price'] = "Mời bạn nhập đầy đủ giá sản phẩm";
    }
    if(postInput('number') == '') {
        $error['number'] = "Mời bạn nhập số lượng giá sản phẩm";
    }
    if(postInput('content') == '') {
        $error['content'] = "Mời bạn nhập đầy đủ nội dung";
    }
    



    if(empty($error)) {
        if(isset($_FILES['thunbar'])) {
          $file_name = $_FILES['thunbar']['name'];
          $file_tmp = $_FILES['thunbar']['tmp_name'];
          $file_type = $_FILES['thunbar']['type'];
          $file_erro = $_FILES['thunbar']['error'];

          if($file_erro == 0) {
            $part = ROOT. "product/";
            $data['thunbar'] = $file_name;
          }
        }

        $id_update = $db ->update("product", $data, array("id" =>$id));
        if($id_update > 0) {
          move_uploaded_file($file_tmp, $part.$file_name);
           $_SESSION['success'] = "Cập nhật thành công!";
           redirectAdmin("product"); 
        }
        else {
           $_SESSION['error'] = "Cập nhật thất bại!";
           redirectAdmin("product");
        }

    }
    
}

?>
<?php require_once __DIR__. "/../../layouts/header.php" ?>
<div id="content-wrapper">
  <div class="container-fluid">
      <h1 class="page-header">Chỉnh sửa sản phẩm</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="index.html">Dashboard</a>
      </li>
      <li class="breadcrumb-item">
        <a href="index.php">Sản phẩm</a>
      </li>
      <li class="breadcrumb-item active">Chỉnh sửa</li>
    </ol>
    <div class="clearfix"></div>
    <?php require_once __DIR__. "/../../../partials/notification.php" ?>
    <div class="form-group row">
    <div class="form-group col-md-12">
     <form action="" method="POST" enctype="multipart/form-data">
         <div class="form-group col-sm-4">
          <img src="<?php echo uploads() ?>product/<?php echo $editProduct['thunbar'] ?>" height="400px" width="400px" style="border-radius: 100%" >
         </div>
        <div class="form-group col-sm-8" >
            <label for="exampleInputEmail1">Danh mục sản phẩm</label>
            <select name="category_id" class="form-control">
                <option value="">-Mời bạn chọn danh mục sản phẩm-</option>
                <?php foreach ($category as $item): ?>
                    <option value="<?php echo $item['id'] ?>"  <?php echo $editProduct['category_id'] == $item['id'] ? "selected = 'selected'" : ''  ?>>
                      <?php echo $item['name'] ?>  
                    </option>
                <?php endforeach ?>
            </select>
            <?php if(isset($error['category_id'])) : ?>
                 <p class="text-danger"><?php echo $error['category_id'] ?></p> 
              <?php endif ?>


              <label for="exampleInputEmail1">Tên sản phẩm</label>
            <input type="text" class="form-control" name="name" id="exampleInputEmail1"  placeholder="Nhập tên sản phẩm" value="<?php echo $editProduct['name'] ?>">
            <?php if(isset($error['name'])) : ?>
                 <p class="text-danger"><?php echo $error['name'] ?></p> 
              <?php endif ?>
              <div class="row">
                 <div class="form-group col-sm-2">
                     <label for="exampleInputEmail1">Giá sản phẩm</label>
                    <input type="number" class="form-control" name="price" id="exampleInputEmail1" placeholder="1.000.000" value="<?php echo $editProduct['price'] ?>" >
                    <?php if(isset($error['price'])) : ?>
                     <p class="text-danger"><?php echo $error['price'] ?></p> 
                    <?php endif ?>
                </div>
                <div class="form-group col-sm-2">
                  <label for="exampleInputEmail1">Số tiền giảm giá</label>
                  <input type="text" class="form-control " name="sale" id="exampleInputEmail1"  placeholder="10%" value="<?php echo $editProduct['sale'] ?>" >
                </div>
                <div class="form-group col-sm-2">
                    <label for="exampleInputEmail1">Số lượng</label>
                    <input type="number" class="form-control " name="number" value="<?php echo $editProduct['number'] ?>" >
                    <?php if(isset($error['number'])) : ?>
                     <p class="text-danger"><?php echo $error['number'] ?></p> 
                    <?php endif ?>
                </div>
              </div>
             
              <label for="exampleInputEmail1">Hình ảnh</label>
            <input type="file" class="form-control " name="thunbar"  >
            <?php if(isset($error['thunbar'])) : ?>
                 <p class="text-danger"><?php echo $error['thunbar'] ?></p> 
              <?php endif ?>


               <label for="exampleInputEmail1">Nội dung</label>
            <textarea class="form-control" name="content" rows="4" ><?php echo $editProduct['content'] ?></textarea>
            <?php if(isset($error['content'])) : ?>
                 <p class="text-danger"><?php echo $error['content'] ?></p> 
              <?php endif ?>
        </div>
        <button type="submit" class="btn btn-success">Lưu</button>
    </form>
    </div>
    </div>
   </div>
   
 </div>
 <?php require_once __DIR__. "/../../layouts/footer.php" ?>
</div>
