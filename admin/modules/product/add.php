

<?php 

  $open = "product";
  require_once __DIR__. "/../../autoload/autoload.php";

  $category = $db ->fetchAll("category");
  
  if($_SERVER["REQUEST_METHOD"] == "POST") {

    $data = [
        "name" => postInput("name"),
        "slug" => to_slug(postInput("name")),
        "category_id" => postInput("category_id"),
        "price" => postInput("price"),
        "number" => postInput("number"),
        "content" => postInput("content"),
        "sale" => postInput("sale")
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
    if(!isset($_FILES['thunbar'])) {
      $error['thunbar'] = "Mời bạn chọn hình ảnh";
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

        $id_insert = $db ->insert("product", $data);
        if($id_insert) {
           move_uploaded_file($file_tmp, $part.$file_name);
           $_SESSION['success'] = "Thêm mới thành công!";
           redirectAdmin("product");
        }
        else {
           $_SESSION['error'] = "Thêm mới thất bại!";
           redirectAdmin("product");
        }

    }
    
}

?>
<?php require_once __DIR__. "/../../layouts/header.php" ?>
<div id="content-wrapper">
  <div class="container-fluid">
      <h1 class="page-header">Thêm mới sản phẩm</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="index.html">Dashboard</a>
      </li>
      <li class="breadcrumb-item">
        <a href="index.php">Sản phẩm</a>
      </li>
      <li class="breadcrumb-item active">Thêm mới</li>
    </ol>
    <div class="clearfix"></div>
    <?php require_once __DIR__. "/../../../partials/notification.php" ?>
    <div class="row">
    <div class="col-md-12">
     <form action="" method="POST" enctype="multipart/form-data">
     <div class="form-group col-sm-8">
            <label for="exampleInputEmail1">Danh mục sản phẩm</label>
            <select name="category_id" class="form-control">
                <option value="">-Mời bạn chọn danh mục sản phẩm-</option>
                <?php foreach ($category as $item): ?>
                    <option value="<?php echo $item['id'] ?>"><?php echo $item['name'] ?></option>
                <?php endforeach ?>
            </select>
            <?php if(isset($error['category_id'])) : ?>
                 <p class="text-danger"><?php echo $error['category_id'] ?></p> 
              <?php endif ?>
        </div>
        <div class="form-group col-sm-8">
            <label for="exampleInputEmail1">Tên sản phẩm</label>
            <input type="text" class="form-control" name="name"   placeholder="Nhập tên sản phẩm">
            <?php if(isset($error['name'])) : ?>
                 <p class="text-danger"><?php echo $error['name'] ?></p> 
              <?php endif ?>
        </div>
        <div class="form-group col-sm-8">
            <label for="exampleInputEmail1">Giá sản phẩm</label>
            <input type="number" class="form-control" name="price"  placeholder="1.000.000 VND">
            <?php if(isset($error['price'])) : ?>
                 <p class="text-danger"><?php echo $error['price'] ?> </p> 
              <?php endif ?>
        </div>
        <div class="row">
          <div class="form-group col-sm-3">
              <label for="exampleInputEmail1">Số tiền giảm giá</label>
              <input type="text" class="form-control " name="sale"  placeholder="10%" >
          </div>
          <div class="form-group col-sm-3">
            <label for="exampleInputEmail1">Hình ảnh</label>
            <input type="file" class="form-control " name="thunbar"  >
            <?php if(isset($error['thunbar'])) : ?>
                 <p class="text-danger"><?php echo $error['thunbar'] ?></p> 
              <?php endif ?>
        </div>
        <div class="form-group col-sm-2">
            <label for="exampleInputEmail1">Số lượng</label>
            <input type="number" class="form-control " name="number"  >
            <?php if(isset($error['number'])) : ?>
                 <p class="text-danger"><?php echo $error['number'] ?></p> 
              <?php endif ?>
        </div>
        </div>
        <div class="form-group col-sm-8">
            <label for="exampleInputEmail1">Nội dung</label>
            <textarea class="form-control" name="content" rows="4"></textarea>
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
