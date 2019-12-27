    <?php
require_once __DIR__ . "/autoload/autoload.php";

$data = [
    'name' => postInput("name"),
    'email' => postInput("email"),
    'password' => postInput("password"),
    'phone' => postInput("phone"),
    'address' => postInput("address"),
];
$error = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($data['name'] == '') {
        $error['name'] = "Họ và tên không được để trống ! ";
    }

    if ($data['email'] == '') {
        $error['email'] = "Email không được để trống ! ";
    } else {
        $is_check = $db->fetchOne("users", "email = '" . $data['email'] . "' ");
        if ($is_check != null) {
            $_SESSION['error'] = "Email đã tồn tại!";
        }
    }

    if ($data['password'] == '') {
        $error['password'] = "Mật khẩu không được để trống ! ";
    } else {
        $data['password'] = MD5(postInput("password"));
    }

    if ($data['phone'] == '') {
        $error['phone'] = "Số điện thoại không được để trống ! ";
    }

    if ($data['address'] == '') {
        $error['address'] = "Địa chỉ không được để trống ! ";
    }

    if (empty($error)) {
        $id_insert = $db->insert("users", $data);
        if ($id_insert > 0) {
            $_SESSION['success'] = "Đăng kí thành công";
            header("location: dang-nhap.php");
        } else {
            echo "Đăng kí thất bại!";
        }
    }
}
?>

   <?php require_once __DIR__ . "/layouts/header.php";?>

  <section>
        <div class="container clearfix">
            <div class="text-center" style="padding-top: 100px;">
                <h3>ĐĂNG KÝ THÀNH VIÊN</h3>
                <hr>
            </div>
            <form style="padding-left: 200px;" action="" method="POST">
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Họ và tên</label>
                <div class="col-sm-6">
                  <input type="text"  class="form-control" id="staticEmail" name="name" value="<?php echo $data['name'] ?>" placeholder="Nhập họ và tên">
                       <?php if (isset($error['name'])): ?>
                       <p class="text-danger"><?php echo $error['name'] ?></p>
                      <?php endif?>
                </div>
              </div>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-6">
                  <input type="email"  class="form-control" id="staticEmail"  name="email" value="<?php echo $data['email'] ?>" placeholder="Nhập email">
                      <?php if (isset($error['email'])): ?>
                       <p class="text-danger"><?php echo $error['email'] ?></p>
                      <?php endif?>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Mật khẩu</label>
                <div class="col-sm-6">
                  <input type="password" class="form-control" id="inputPassword" value="<?php echo $data['password'] ?>" name="password"
                  placeholder="Nhập mật khẩu">
                     <?php if (isset($error['password'])): ?>
                       <p class="text-danger"><?php echo $error['password'] ?></p>
                      <?php endif?>
                </div>
              </div>
               <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Số điện thoại</label>
                <div class="col-sm-6">
                  <input type="number" class="form-control" id="inputPassword"  name="phone" value="<?php echo $data['phone'] ?>"
                  placeholder="Nhập số điện thoại">
                      <?php if (isset($error['phone'])): ?>
                       <p class="text-danger"><?php echo $error['phone'] ?></p>
                      <?php endif?>
                </div>
              </div>
               <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Địa chỉ</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="inputPassword" value="<?php echo $data['address'] ?>"  name="address"
                  placeholder="Nhập địa chỉ">
                     <?php if (isset($error['address'])): ?>
                       <p class="text-danger"><?php echo $error['address'] ?></p>
                      <?php endif?>
                </div>
              </div>
              <div>
                   <button style="margin-left: 300px" type="submit" class="btn btn-primary">Đăng ký</button>
              </div>
            </form>
        </div>
    </section>
    <?php require_once __DIR__ . "/layouts/footer.php";?>
