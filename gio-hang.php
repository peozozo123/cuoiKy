    <?php 
         require_once __DIR__. "/autoload/autoload.php";
         $product2;
         foreach ($_SESSION['cart'] as $key => $value) {     
              $sqlNew = "select number,id from product where id =$key ";
              $product1 = $db -> fetchsql($sqlNew);
              $product2[$product1[0]['id']] = $product1;
          }
         $sum = 0;
         if(!isset($_SESSION['cart']) | count($_SESSION['cart']) == 0) {
          echo " <script> alert(' Giỏ hàng trống !'); location.href = 'index.php' </script> ";
         }
         
     ?>
   <?php   require_once __DIR__. "/layouts/header.php"; ?>
     <section class="shock-product">
        <div class="container">
           <div class="text-center" style="padding-top: 70px; padding-bottom: 20px">
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
            <h3>GIỎ HÀNG CỦA BẠN</h3>
           </div>
          <table class="table">
              <thead>
                <tr>
                  <th>STT</th>
                  <th>Tên sản phẩm</th>
                  <th>Hình ảnh</th>
                  <th>Số lượng</th>
                  <th>Giá</th>
                  <th>Tổng tiền</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php $stt=1; foreach ($_SESSION['cart'] as $key =>$value ): ?>
                        <tr>
                     
                          <th><?php echo $stt ?></th>
                          <td><?php echo $value['name']; ?></td>
                          <td>
                              <img src="<?php echo uploads() ?>product/<?php echo $value['thunbar']; ?>" width="80px" height="80px">
                          </td>
                          <td>
                              <input min = 0 style="width: 50px" type="number" name="qty" class="qty" 
                              value="<?php echo $value['qty'] ?>">
                              <?php foreach ($product2 as $item): ?>
                                <?php if ($item[0]['id'] == $key ): ?>
                                <?php if ( $item[0]['number'] < $value['qty']): ?>
                                  <p style="color: red">Số lượng trong kho không đủ !!</p>
                                   <p style="color: red">Số lượng : <?php echo $item[0]['number']; ?></p>
                              <?php endif ?>
                              <?php endif ?>
                               
                             <?php endforeach ?>
                     
                          </td>
                          <td><?php echo fomatPrice($value['price']) ?>đ</td>
                           <td><?php echo fomatPrice($value['qty'] * $value['price']) ?>đ</td>
                          <td>
                              <a href="xoa-gio-hang.php?key=<?php echo $key ?>" class="btn btn-xs btn-danger"><i class="fa fa-times"></i>Xoá</a>
                              <a href="" class="btn btn-xs btn-primary updatecart" data-key =<?php echo $key; ?> ><i class="fa fa-refresh"></i>Cập nhật</a>
                          </td>
                      </tr> 
                        
                      <?php $sum += $value['price']* $value['qty']; $_SESSION['tongtien'] = $sum ; ?> 
                 <?php $stt++; endforeach ?>
              </tbody>
          </table>
          <hr>
          <div style="margin-left: 800px" class="col-md-4">
              <ul class="list-group">
                <li class="list-group-item">
                    <h4>Thông tin đơn hàng</h4>
                </li>
                <li class="list-group-item">
                    <span class="padge">
                         Số tiền: 
                        <?php echo fomatPrice($_SESSION['tongtien']) ?>đ
                    </span>
                </li>  
                <li class="list-group-item">
                    <span class="padge">
                         VAT:  
                        <?php echo VAT($_SESSION['tongtien']) ; ?> %
                    </span>
                </li>  

                 <li class="list-group-item">
                    <span class="padge">
                         Tổng tiền thanh toán:  
                        <?php 
                        echo fomatPrice($_SESSION['total'] = ($_SESSION['tongtien'] * (VAT($_SESSION['tongtien'])+100)/100 ) );
                         ?> đ
                    </span>
                </li>
                <li class="list-group-item">
                    <a href="index.php" class="btn btn-primary">Tiếp tục mua hàng</a>
                    <?php $t=1 ?>
                    <?php  foreach ($_SESSION['cart'] as $key =>$value ): ?>
                    
                    <?php foreach ($product2 as $item): ?>
                     <?php if ( $item[0]['number'] < $value['qty'] && $item[0]['id'] == $key ): ?>
                         <?php $t=0 ?>
                    <?php endif ?>
                   <?php endforeach ?>
                     <?php endforeach; ?>
                    <a href="thanh-toan.php" class="btn btn-primary <?php echo ($t == 0) ? 'disabled' : '' ?>">Thanh toán</a>
                </li>                                 
              </ul>
          </div>
        </div>
    </section>
    <?php require_once __DIR__. "/layouts/footer.php"; ?>
