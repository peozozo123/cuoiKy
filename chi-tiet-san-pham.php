    <?php 
        require_once __DIR__. "/autoload/autoload.php";

          $id = intval(getInput('id'));
          $product = $db ->fetchID("product", $id)  ;


          $sqlActiveCate = "select name, id from category where id =". $product['category_id'];
          $cateActive = $db -> fetchsql($sqlActiveCate);

          $cate_id = intval($product['category_id']);

          $sql = "select * from product where category_id = $cate_id order by id desc limit 5";
          $sanphamkemtheo = $db -> fetchsql($sql);
     ?>

   <?php   require_once __DIR__. "/layouts/header.php"; ?>
    <div class="container clearfix">
         <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a style="color: black" href="#">Trang chủ</a>
          </li>
         <?php foreach ($cateActive as $key => $value): ?> 
           <li class="breadcrumb-item active"><?php echo $value['name'] ?></li>
          <?php endforeach ?>
        </ol>
    </div>
     <section class="shock-product">
        <div class="container">
             <div class="col-md-12 col-md-offset-2">
                <div class="row" id="" style="background-color: white !important">
                    <div class="col-md-7">
                        <?php if ($product['sale']>0): ?>
                             <label for="" class="product-shock-price">Giảm giá <?php echo $product['sale'] ?>%</label>
                        <?php endif ?>
                        <img src="<?php echo uploads()?>product/<?php echo $product['thunbar'] ?>" class="product-img hover">

                        <hr>
                       <div class="text-center">
                             <a class="btn btn-primary" href="add-cart.php?id=<?php echo $id ?>"><i class="fa fa-cart-plus"></i>Mua ngay </a>
                       </div>
                    </div>
                    <div class="col-md-5" id="overview">
                        <div class="row">
                            <div class="col-xs-6 col-md-6">
                                <ul class="pb-product-details-ul">
                                    <li><h2><?php echo $product['name'] ?></h2></li>
                                    <li></li>
                                    <li>
                                         <i class="fa fa-usd" aria-hidden="true"></i>
                                        <?php if ($product['sale'] > 0): ?>
                                            <strong style="color: red"> <?php echo formatPriceSale($product['price'], $product['sale'])?>₫</strong>
                                            <strike><?php echo fomatPrice($product['price']) ?>₫</strike>
                                        <?php else: ?>
                                             <strong style="color: red"><?php echo fomatPrice($product['price']) ?>₫</strong>
                                        <?php endif ?>
                                    </li>
                                    <li><span class="fa fa-id-card-o">&nbsp; <?php echo $product['content']; ?></span></li>
                                    <li><span class="fa fa-bluetooth-b">&nbsp;Size: 40</span></li>
                                    <li><span class="fa fa-microchip">&nbsp;Màu: Vàng</span></li>
                                </ul>
                            </div>
                            
                        </div>
                    </div>
                </div>
             </div>
    <section class="shock-product">
         <div class="owl-product1 owl-carousel owl-theme owl-loaded">
              <div class="inner">
                <div class="head">
                     <h2 class="head-title">Sản phẩm tương tự</h2>
                 </div>
                </div>
                <div class="owl-stage-outer">
                    <div class="owl-stage">
                     <?php foreach ($sanphamkemtheo as $item): ?>
                            <div class="owl-item">
                            <div class="item-product">
                                <a href="chi-tiet-san-pham.php?id=<?php echo $item['id'] ?>">
                                    <img src="<?php echo uploads()?>product/<?php echo $item['thunbar'] ?>" class="product-img hover"> 
                                    <h3 class="product-title"><?php echo $item['name'] ?></h3>
                                    <div class="product-price">
                                        <?php if ($item['sale'] > 0): ?>
                                            <strong> <?php echo formatPriceSale($item['price'], $item['sale'])?>₫</strong>
                                            <span><?php echo fomatPrice($item['price']) ?>₫</span>
                                        <?php else: ?>
                                              <strong><?php echo fomatPrice($item['price']) ?>₫</strong>
                                        <?php endif ?>
                                        
                                    </div>
                                    <?php if ($item['sale'] > 0): ?>
                                    <label for="" class="product-shock-price">Giảm giá <?php echo $item['sale'] ?>%</label>
                                <?php endif ?>
                                </a>
                            </div>

                        </div>
                        <?php endforeach ?>
                    </div>  
                </div>
                <div class="owl-nav">
                    <div class="owl-prev owl-prev-product1">&#8249;</div>
                    <div class="owl-next owl-next-product1">&#8250;</div>
                </div>
       </div>
    </section>


         <link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light-glow/all.min.css" />
            <script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
            <script type="text/javascript">
            jQuery(function ($) {
                $(".tabs_div").shieldTabs();
            });
        </script>

        <style>
            .pb-product-details-ul {
                list-style-type: none;
                padding-left: 0;
                color: black;
            }

                .pb-product-details-ul > li {
                    padding-bottom: 5px;
                    font-size: 15px;
                }

            #gradient {
                /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#feffff+0,ddf1f9+31,a0d8ef+62 */
                background: #feffff; /* Old browsers */
                background: -moz-linear-gradient(left, #feffff 0%, #ddf1f9 31%, #a0d8ef 62%); /* FF3.6-15 */
                background: -webkit-linear-gradient(left, #feffff 0%,#ddf1f9 31%,#a0d8ef 62%); /* Chrome10-25,Safari5.1-6 */
                background: linear-gradient(to right, #feffff 0%,#ddf1f9 31%,#a0d8ef 62%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#feffff', endColorstr='#a0d8ef',GradientType=1 ); /* IE6-9 */
                border: 1px solid #f2f2f2;
                padding: 20px;
            }

            #hits {
                border-right: 1px solid white;
                border-left: 1px solid white;
                vertical-align: middle;
                padding-top: 15px;
                font-size: 17px;
                color: white;
            }

            #fan {
                vertical-align: middle;
                padding-top: 15px;
                font-size: 17px;
                color: white;
            }

            .pb-product-details-fa > span {
                padding-top: 20px;
            }
        </style>

        </div>
        </section>
        </div>
    </section>
    <?php require_once __DIR__. "/layouts/footer.php"; ?>
