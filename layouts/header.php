<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="public/frontend/assets/sass/main.css">
    <link rel="stylesheet" href="public/frontend/assets/css/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="public/frontend/assets/css/dist/assets/owl.theme.default.min.css">
    <link href="<?php echo base_url() ?>public/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="public/frontend/assets/js/jquery.min.js"></script>
    <script src="public/frontend/assets/js/owl.carousel.min.js"></script>
    <script src="public/frontend/assets/js/main.js"></script>
    <title>Mixishop</title>
</head>
<body>
         <section class="header" style="background-color: rgb(255, 255, 130)">
                <div class="container">
                    <div class="header-search" style="background-color: rgb(255, 255, 130)">
                        <div>
                            <a href="index.php" style="color:black;font-weight:bold">Mixi Shop</a>
                        </div>
                        <form class="search-input form-group"  >
                            <input type="text" class="form-input input-search" placeholder="Bạn tìm gì...">
                            <button class="search-button">
                                <i class="search-icon"></i>
                            </button>
                        </form>
                    </div>
                    <nav class="nav">
                        <ul>
                            <?php foreach ($category as $item): ?>
                                <li class="nav-item">
                                <h3 class="nav-item-title" style="padding-top:10px">
                                    <i class="<?php echo $item['class'] ?>" style="font-size:20px"></i>
                                  <a style="color: black; font-weight: bold;" href="danh-muc-san-pham.php?id=<?php echo $item['id'] ?>">
                                    <?php echo $item['name'] ?></a>
                                </h3>
                                </li>

                            <?php endforeach?>
                             <li class="nav-item">
                                <i  style="margin-left: 25px" class="fa fa-shopping-cart"></i>
                                <h6> <a href="gio-hang.php" style="color: black;"> Giỏ hàng</a></h6>
                            </li>
                            <?php if (isset($_SESSION['name_user'])): ?>
                            <li class="nav-item" style="width: auto">
                                    <i style="margin-left: 50px" class="fa fa-user"></i>
                                   <div class="dropdown show">
                                        <a style="color: black;" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?php echo $_SESSION['name_user']; ?>
                                        </a>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="#">Thông tin</a>
                                        <a class="dropdown-item" href="dang-xuat.php">Đăng xuất</a>
                                     </div>
                                </div>
                            </li>
                            <?php else: ?>
                                <li class="nav-item">
                                    <i style="margin-left: 30px" class="fa fa-sign-in"></i>
                                    <h6>
                                       <a href="dang-nhap.php" style="color: black; "> Đăng nhập</a>
                                   </h6>
                               </li>
                              <li class="nav-item">
                                <i style="margin-left: 25px" class="fa fa-user-plus"></i>
                                <h6>
                                   <a href="dang-ki.php" style="color: black;"> Đăng ký</a>
                               </h6>
                            </li>
                            <?php endif?>

                        </ul>
                    </nav>
                    <div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </section>
