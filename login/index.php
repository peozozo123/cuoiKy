<?php
session_start();
require_once __DIR__ . "/../lib/database.php";
require_once __DIR__ . "/../lib/funtion.php";
$db = new Database;

$data = [
    'email' => postInput("email"),
    'password' => postInput("password"),
];

$error = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($data['email'] == '') {
        $error['email'] = "Vui lòng nhập email ! ";
    }

    if ($data['password'] == '') {
        $error['password'] = "Vui lòng nhập mật khẩu ! ";
    }

    if (empty($error)) {
        $is_check = $db->fetchOne("admin", "email = '" . $data['email'] . "' and password = '" . MD5($data['password']) . "' ");

        if ($is_check != null) {
            $_SESSION['admin_name'] = $is_check['name'];
            $_SESSION['admin_id'] = $is_check['id'];
            header("location: /cuoiky/admin/");
        } else {
            //that bai
            $_SESSION['error'] = "Tên đăng nhập hoặc mật khẩu không đúng !";
        }
    }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>
  <link href="/cuoiky/public/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="/cuoiky/public/admin/css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Đăng nhập</div>
      <div class="card-body">
        <form action="" method="POST">
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email" required="required" autofocus="autofocus">
              <label for="inputEmail">Email</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Mật khẩu" required="required">
              <label for="inputPassword">Mật khẩu</label>
            </div>
          </div>
           <div class="form-group">
            <div class="form-label-group">
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger">
                        <p><?php echo $_SESSION['error'];unset($_SESSION['error']) ?></p>
                    </div>
                <?php endif?>
           </div>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me">
                Remember Password
              </label>
            </div>
          </div>
          <input class="btn btn-primary btn-block" type="submit" value="Đăng nhập" >
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="register.html">Register an Account</a>
          <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
        </div>
      </div>
    </div>
  </div>
  <script src="/cuoiky/public/admin/vendor/jquery/jquery.min.js"></script>
  <script src="/cuoiky/public/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/cuoiky/public/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
