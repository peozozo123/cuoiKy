

<?php 

  $open = "user";
  require_once __DIR__. "/../../autoload/autoload.php";
  $data = [
        "name" => postInput("name"),
        "email" => postInput("email"),
        "phone" => postInput("phone"),
        "address" => postInput("address"),
        "password" => md5(postInput("password"))

    ];
  
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $error = [];
    if(postInput('name') == '') {
        $error['name'] = "Mời bạn nhập đầy đủ tên ";
    }
    if(postInput('email') == '') {
        $error['email'] = "Mời bạn nhập đầy đủ email";
    }
    else {
      $is_check = $db ->fetchOne("users", "email = '" .$data['email']."' ");
      if ($is_check != NULL) {
        $error['email'] = "Email đã tồn tại";
      }
    }
    if(postInput('phone') == '') {
        $error['phone'] = "Mời bạn nhập số điện thoại";
    }
    if(postInput('password') == '') {
        $error['password'] = "Mời bạn nhập mật khẩu";
    }
    if(postInput('address') == '') {
        $error['address'] = "Mời bạn nhập địa chỉ";
    }


    if($data['password'] != md5(postInput('re_password'))) {
      $error['re_password'] = "Mật khẩu không khớp";
    }


    if(empty($error)) {
      
        $id_insert = $db ->insert("users", $data);
        if($id_insert) {
          
           $_SESSION['success'] = "Thêm mới thành công!";
           redirectAdmin("user");
        }
        else {
           $_SESSION['error'] = "Thêm mới thất bại!";
           redirectAdmin("user");
        }

    }
    
}

?>
<?php require_once __DIR__. "/../../layouts/header.php" ?>
<div id="content-wrapper">
  <div class="container-fluid">
      <h1 class="page-header">Thêm mới thành viên</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="index.html">Dashboard</a>
      </li>
      <li class="breadcrumb-item">
        <a href="index.php">Thành viên</a>
      </li>
      <li class="breadcrumb-item active">Thêm mới</li>
    </ol>
    <div class="clearfix"></div>
    <?php require_once __DIR__. "/../../../partials/notification.php" ?>
    <div class="row">
    <div class="col-md-12">
     <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group col-sm-8">
            <label for="exampleInputEmail1">Họ và tên</label>
            <input type="text" class="form-control" name="name"   placeholder="Nhập tên" value="<?php echo $data['name'] ?>">
            <?php if(isset($error['name'])) : ?>
                 <p class="text-danger"><?php echo $error['name'] ?></p> 
              <?php endif ?>

              <label for="exampleInputEmail1">Email</label>
            <input type="email" class="form-control" name="email"  placeholder="Nhập email" value="<?php echo $data['email'] ?>">
            <?php if(isset($error['email'])) : ?>
                 <p class="text-danger"><?php echo $error['email'] ?> </p> 
              <?php endif ?>

            <div class="row">
               <div class="form-group col-sm-3">
                <label for="exampleInputEmail1">Mật khẩu</label>
                <input type="password" class="form-control"  placeholder="Nhập mật khẩu" name="password">
                <?php if(isset($error['password'])) : ?>
                     <p class="text-danger"><?php echo $error['password'] ?></p> 
                  <?php endif ?>
            </div>

            <div class="form-group col-sm-3">
                <label for="exampleInputEmail1">Nhập lại mật khẩu</label>
                <input type="password" class="form-control "  placeholder="Nhập lại mật khẩu" name="re_password"  required="">
                <?php if(isset($error['re_password'])) : ?>
                     <p class="text-danger"><?php echo $error['re_password'] ?></p> 
                <?php endif ?>
            </div>
            <div class="form-group col-sm-3">
                  <label for="exampleInputEmail1">Số điện thoại</label>
                  <input type="text" class="form-control " name="phone"   placeholder="Nhập số điện thoại" value="<?php echo $data['phone'] ?>">
                  <?php if(isset($error['phone'])) : ?>
                     <p class="text-danger"><?php echo $error['phone'] ?></p> 
                  <?php endif ?>
              </div>
          </div>
          <label for="exampleInputEmail1">Địa chỉ</label>
              <input type="text" class="form-control " name="address"   placeholder="Nhập địa chỉ" value="<?php echo $data['address'] ?>" >
              <?php if(isset($error['address'])) : ?>
                 <p class="text-danger"><?php echo $error['address'] ?></p> 
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
