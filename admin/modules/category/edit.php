<?php 
    require_once __DIR__. "/../../autoload/autoload.php";

    $open = "category";
    $id = intval(getInput('id'));

    $editCategory = $db ->fetchID("category", $id)  ;
    if( empty($editCategory)) {
        $_SESSION['error'] = "Du lieu khong ton tai!";
        redirectAdmin("category");
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {

        $data = [
            "name" => postInput("name"),
            "slug" => to_slug(postInput("name"))
        ];
        $error = [];
        if(postInput('name') == '') {
            $error['name'] = "Moi ban nhap day du ten danh muc";
        }

        if(empty($error)) {
          if($editCategory['name'] != $data['name']) {
            $isset= $db ->fetchOne("category", "name = '".$data['name']."' ");
            if(count($isset) > 0) {
              $_SESSION['error'] = "Thu muc da ton tai!";
            }
          } else {
            $id_update = $db -> update("category", $data, array("id"=>$id));
            if($id_update > 0) {
                $_SESSION['success'] = "Cap nhat thanh cong!";
                redirectAdmin("category");
            }
            else {
                //them thaat bai
                $_SESSION['error'] = "Du lieu khong thay doi";
                redirectAdmin("category");
            }
          }
          
         
    }
  }

    

?>
<?php require_once __DIR__. "/../../layouts/header.php" ?>
<div id="content-wrapper">
  <div class="container-fluid">
      <h1 class="page-header">Chỉnh sửa danh mục</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="index.html">Dashboard</a>
      </li>
      <li class="breadcrumb-item">
        <a href="index.php">Danh mục</a>
      </li>
      <li class="breadcrumb-item active">Chỉnh sửa</li>
    </ol>
    <div class="clearfix"></div>
        <?php require_once __DIR__. "/../../../partials/notification.php" ?>
    <div class="row">
    <div class="col-md-12">
     <form action="" method="POST">
        <div class="form-group col-sm-8">
            <label for="exampleInputEmail1">Tên danh mục</label>
            <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập tên danh mục" value="<?php echo $editCategory['name'] ?>">
            <?php if(isset($error['name'])) : ?>
                 <p class="text-danger"><?php echo $error['name'] ?></p> 
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