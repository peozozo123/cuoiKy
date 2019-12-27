    <?php 
        require_once __DIR__. "/autoload/autoload.php";

        $id = intval(getInput('id'));
        $editCategory = $db ->fetchID("category", $id)  ;
       
        $sql = "Select * from product where category_id = $id ";
        $product = $db -> fetchsql($sql);
     ?>

   <?php   require_once __DIR__. "/layouts/header.php"; ?>
    
  <section class="shock-product">
        <div class="container">
            <div class="inner clearfix" >
                <div class="head">
                    <h2 class="head-title"><?php echo $editCategory['name'] ?></h2>
                </div>
                <div class="list-product">
                    <ul>
                        <?php foreach ($product as $item): ?>
                            <li>
                            <div class="item-product">
                                <a href="chi-tiet-san-pham.php?id=<?php echo $item['id'] ?>">
                                    <img src="<?php echo uploads()?>product/<?php echo $item['thunbar'] ?>" class="product-img hover">
                                    <h3 class="product-title"><?php echo $item['name'] ?></h3>
                                    <div class="product-price">
                                       <strong> <?php echo formatPriceSale($item['price'], $item['sale'])?>₫</strong>
                                        <span><?php echo fomatPrice($item['price']) ?>₫</span>
                                    </div>
                                    <label for="" class="installment">Giảm giá <?php echo $item['sale'] ?>%</label>
                                </a>
                            </div>
                        </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
           
                <nav style="text-align: center;">
                  <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                  </ul>
               </nav>
          
        </div>
    </section>
    
    
    <?php require_once __DIR__. "/layouts/footer.php"; ?>
