    <?php 
        require_once __DIR__. "/autoload/autoload.php";

         $data = [
            'email' => postInput("email"),
            'password' => postInput("password")
        ];

        $error= [];
         if($_SERVER["REQUEST_METHOD"] == "POST") {
            
            if($data['email'] == '') {
                $error['email'] = "Vui lòng nhập email ! ";
            }

           
            if($data['password'] == '') {
                $error['password'] = "Vui lòng nhập mật khẩu ! ";
            }

            if(empty($error)) {
              $is_check = $db ->fetchOne("users", "email = '".$data['email']."' and password = '".MD5($data['password'])."' ");

              if($is_check != NULL) {
                   $_SESSION['name_user'] = $is_check['name'];
                   $_SESSION['name_id'] = $is_check['id'];
                   header("location: index.php");
            }
              else {
                //that bai
                 $_SESSION['error'] = "Đăng nhập thất bại !";
              }
            }
        }
     ?>

   <?php   require_once __DIR__. "/layouts/header.php"; ?>

     <section>
        <div class="container clearfix">
            <div class="text-center" style="padding-top: 100px;">
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success">
                        <h2><?php echo $_SESSION['success'] ; unset($_SESSION['success']) ?></h2>
                    </div>
                <?php endif ?>
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger">
                        <h2><?php echo $_SESSION['error'] ; unset($_SESSION['error']) ?></h2>
                    </div>
                <?php endif ?>
                <h3>ĐĂNG NHẬP</h3>
                <hr>
            </div>
            <form style="padding-left: 200px;" action="" method="POST">
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-6">
                  <input type="email"  name="email" class="form-control" id="staticEmail" value="" placeholder="Nhập email ">
                   <?php if(isset($error['email'])) : ?>
                       <p class="text-danger"><?php echo $error['email'] ?></p> 
                      <?php endif ?>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Mật khẩu</label>
                <div class="col-sm-6">
                  <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Nhập mật khẩu">
                   <?php if(isset($error['password'])) : ?>
                       <p class="text-danger"><?php echo $error['password'] ?></p> 
                      <?php endif ?>
                </div>
              </div>
              <div>
                   <button  style="margin-left: 300px" type="submit" class="btn btn-primary">Đăng nhập</button>
              </div>
            </form>
        </div>
    </section>
    <?php require_once __DIR__. "/layouts/footer.php" ?>
