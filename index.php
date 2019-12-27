    <?php
require_once __DIR__ . "/autoload/autoload.php";

$sqlActiveCate = "select name, id from category where active = 1 ";
$cateActive = $db->fetchsql($sqlActiveCate);

$data = [];
foreach ($cateActive as $item) {
    $cateId = intval($item['id']);
    $sql = "Select * from product where category_id = $cateId ";
    $productActive = $db->fetchsql($sql);
    $data[$item['name']] = $productActive;
}

$sql = "select * from product order by pay desc limit 15";
$productHot = $db->fetchsql($sql);

?>

   <?php require_once __DIR__ . "/layouts/header.php";?>

    <section class="shock-product">
        <div class="container">
            <div class="inner clearfix" >
                <div class="head">
                    <h2 class="head-title">Sản phẩm bán chạy</h2>
                </div>
                <div class="list-product">
                    <ul>
                        <?php foreach ($productHot as $item): ?>
                            <li>
                            <div class="item-product">
                                <a href="chi-tiet-san-pham.php?id=<?php echo $item['id'] ?>">
                                    <img src="<?php echo uploads() ?>product/<?php echo $item['thunbar'] ?>" class="product-img hover">
                                    <h3 class="product-title"><?php echo $item['name'] ?></h3>
                                    <span class="product-title" style="color: red;" >Đã bán <?php echo $item['pay']; ?> sản phẩm</span>
                                   <div class="product-price">
                                        <?php if ($item['sale'] > 0): ?>
                                            <strong> <?php echo formatPriceSale($item['price'], $item['sale']) ?>₫</strong>
                                            <span><?php echo fomatPrice($item['price']) ?>₫</span>
                                        <?php else: ?>
                                              <strong><?php echo fomatPrice($item['price']) ?>₫</strong>
                                        <?php endif?>

                                    </div>
                                    <?php if ($item['sale'] > 0): ?>
                                    <label for="" class="product-shock-price">Giảm giá <?php echo $item['sale'] ?>%</label>
                                <?php endif?>
                                </a>
                            </div>
                        </li>
                        <?php endforeach?>
                    </ul>
                </div>
            </div>

        </div>
    </section>
    <section>
        <div class="container">

                 <?php foreach ($data as $key => $value): ?>
                    <?php if ($value != null): ?>
                     <div class="owl-product1 owl-carousel owl-theme owl-loaded">
                          <div class="inner">
                            <div class="head">
                                <h2 class="head-title"><?php echo $key ?></h2>
                             </div>
                            </div>
                            <div class="owl-stage-outer">
                                <div class="owl-stage">
                                 <?php foreach ($value as $item): ?>
                                        <div class="owl-item">
                                        <div class="item-product">
                                            <a href="chi-tiet-san-pham.php?id=<?php echo $item['id'] ?>">
                                                <img src="<?php echo uploads() ?>product/<?php echo $item['thunbar'] ?>" class="product-img hover">
                                                <h3 class="product-title"><?php echo $item['name'] ?></h3>
                                                <div class="product-price">
                                                    <?php if ($item['sale'] > 0): ?>
                                                        <strong> <?php echo formatPriceSale($item['price'], $item['sale']) ?>₫</strong>
                                                        <span><?php echo fomatPrice($item['price']) ?>₫</span>
                                                    <?php else: ?>
                                                          <strong><?php echo fomatPrice($item['price']) ?>₫</strong>
                                                    <?php endif?>

                                                </div>
                                                <?php if ($item['sale'] > 0): ?>
                                                <label for="" class="product-shock-price">Giảm giá <?php echo $item['sale'] ?>%</label>
                                            <?php endif?>
                                            </a>
                                        </div>

                                    </div>
                                    <?php endforeach?>
                                </div>
                            </div>
                            <div class="owl-nav">
                                <div class="owl-prev owl-prev-product1">&#8249;</div>
                                <div class="owl-next owl-next-product1">&#8250;</div>
                            </div>
                    </div>
                  <?php endif?>
              <?php endforeach?>
        </div>
    </section>

    <?php require_once __DIR__ . "/layouts/footer.php";?>
