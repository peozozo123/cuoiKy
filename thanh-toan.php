    <?php 
        require_once __DIR__. "/autoload/autoload.php";
       
        $user = $db ->fetchID("users", intval($_SESSION['name_id']));
        $error= [];
         if($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = [
                'amount' => $_SESSION['total'],
                'users_id' => $_SESSION['name_id'],
                'note' => postInput("note")
            ];

            $idtrans = $db-> insert("transaction", $data);
            if($idtrans > 0) {
                foreach ($_SESSION['cart'] as $key => $value) {
                    $data2 = [
                        'transaction_id' => $idtrans,
                        'product_id'     => $key,
                        'qty'            => $value['qty'],
                        'price'          => $value['price']
                    ];
                    $id_insert = $db ->insert("orders", $data2);
                }
               
               
                $_SESSION['success'] = "Xác nhận thành công ! Cảm ơn bạn đã tin tưởng mua hàng tại shop chúng tôi ! Chúng tôi sẽ sớm liên hệ với bạn! Xin cảm ơn!";
                header("location: thong-bao.php");
            }

        }

     ?>

   <?php   require_once __DIR__. "/layouts/header.php"; ?>
     
  <section>
        <div class="container clearfix">
            <div class="text-center" style="padding-top: 100px;">
                <h3>THANH TOÁN ĐƠN HÀNG</h3>
                <hr>
            </div>
            <form style="padding-left: 200px;" action="" method="POST">
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Họ và tên</label>
                <div class="col-sm-6">
                  <input type="text"  readonly="" class="form-control" id="staticEmail" name="name" value="<?php echo $user['name'] ?>" placeholder="Nhập họ và tên">
                      
                </div>
              </div>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-6">
                  <input type="email"  readonly="" class="form-control" id="staticEmail"  name="email" value="<?php echo $user['email'] ?>" placeholder="Nhập email">
                </div>
              </div>
               <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Số điện thoại</label>
                <div class="col-sm-6">
                  <input type="number" readonly="" class="form-control" id="inputPassword"  name="phone" value="<?php echo $user['phone'] ?>" 
                  placeholder="Nhập số điện thoại">
                </div>
              </div>
               <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Địa chỉ</label>
                <div class="col-sm-6">
                  <input type="text" readonly="" class="form-control" id="inputPassword" value="<?php echo $user['address'] ?>"  name="address" 
                  placeholder="Nhập địa chỉ">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Ghi chú</label>
                <div class="col-sm-6">
                  <textarea cols="2" class="form-control" name="note"></textarea>
                </div>
              </div>
              <div>
                   <button style="margin-left: 300px" type="submit" class="btn btn-primary">Xác nhận</button>
              </div>
            </form>
        </div>
    </section>
    <?php require_once __DIR__. "/layouts/footer.php"; ?>
