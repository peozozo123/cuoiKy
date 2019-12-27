
<?php 
    $open = "admin";
    require_once __DIR__. "/autoload/autoload.php";
    $category = $db->fetchAll("category");
?>
<?php require_once __DIR__. "/layouts/header.php" ?>
    <div id="content-wrapper">
      <div class="container-fluid">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.html">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Blank Page</li>
        </ol>
        <h1>Xin chào bạn đến với trang quản trị admin</h1>
        <hr>
        <p>This is a great starting point for new custom pages.</p>
     </div>
     <?php require_once __DIR__. "/layouts/footer.php" ?>
    </div>

