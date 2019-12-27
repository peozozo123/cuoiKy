

<?php 
    $open = "category";
    require_once __DIR__. "/../../autoload/autoload.php";
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
          $isset= $db ->fetchOne("category", "name = '".$data['name']."' ");
          if(count($isset) > 0) {
            $_SESSION['error'] = "Thu muc da ton tai!";
          }
          else {
            $id_insert = $db -> insert("category", $data);
            if($id_insert > 0) {
                $_SESSION['success'] = "Them moi thanh cong!";
                redirectAdmin("category");
            }
            else {
                //them thaat bai
                $_SESSION['error'] = "Them moi that bai!";
            }
          }
        }
        
    }

?>
<?php require_once __DIR__. "/../../layouts/header.php" ?>
    <div id="content-wrapper">
      <div class="container-fluid">
          <h1 class="page-header">Thêm mới danh mục</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.html">Dashboard</a>
          </li>
          <li class="breadcrumb-item">
            <a href="index.php">Danh mục</a>
          </li>
          <li class="breadcrumb-item active">Thêm mới</li>
        </ol>
        <div class="clearfix"></div>
        <?php require_once __DIR__. "/../../../partials/notification.php" ?>
        <div class="row">
        <div class="col-md-12">
         <form action="" method="POST">
            <div class="form-group col-sm-8">
                <label for="exampleInputEmail1">Tên danh mục</label>
                <input type="text" class="form-control" name="name"  placeholder="Nhập tên danh mục">
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
