    <?php 
        require_once __DIR__. "/autoload/autoload.php";
         unset($_SESSION['cart']);
        unset($_SESSION['total']);

     ?>

   <?php   require_once __DIR__. "/layouts/header.php"; ?>
     
  <section>
        <div class="container clearfix">
            <div class="text-center" style="padding-top: 100px;">
                <h3>Thông báo thanh toán!</h3>
                <hr>
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success">
                        <h2><?php echo $_SESSION['success'] ; unset($_SESSION['success']) ?></h2>
                    </div>
                <?php endif ?>
                <a href="index.php" class="btn btn-danger">Trở về trang chủ</a>
            </div>
        </div>
    </section>
    <?php require_once __DIR__. "/layouts/footer.php"; ?>
