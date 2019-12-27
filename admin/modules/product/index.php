

<?php     
    $open = "product";
    require_once __DIR__. "/../../autoload/autoload.php";

   
    $sql = "SELECT product.*, category.name as namecate FROM product LEFT JOIN category on category.id = product.category_id";
     $product = $db -> fetchsql($sql);
?>
<?php require_once __DIR__. "/../../layouts/header.php" ?>
    <div id="content-wrapper">
      <div class="container-fluid">
          <h1 class="page-header">Danh sách sản phẩm</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.html">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Sản phẩm</li>
        </ol>
        <div class="clearfix"></div>
        <?php require_once __DIR__. "/../../../partials/notification.php" ?>
        <div class="row">
         <div class="col-md-12">
            <div class="card mb-3">
          <div class="card-header">
            <a href="add.php">
                <button class="btn btn-primary float-right">Thêm mới</button>
            </a>
         </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Slug</th>
                    <th>Thunbar</th>
                    <th>Info</th>
                    <th>Sản phẩm nỗi bật</th>
                    <th>Created</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                 <?php $stt = 1; foreach ($product as $item): ?>
                      <tr>
                        <td><?php echo $stt ?></td>
                        <td><?php echo $item['name'] ?></td>
                        <td><?php echo $item['namecate'] ?></td>
                        <td><?php echo $item['slug'] ?></td>
                         <td> 
                            <img src="<?php echo uploads() ?>product/<?php echo $item['thunbar'] ?>" height="80px" width="80px" style="border-radius: 100%">
                        </td>
                        <td>
                          <ul>
                            <li>Giá : <?php echo $item['price'] ?> VND</li>
                            <li>Số lượng: <?php echo $item['number']; ?></li>
                          </ul>
                        </td>
                        <td>
                          <a class="btn btn-xs <?php echo $item['hot'] == 1 ? 'btn-primary' : 'btn-danger' ?>" href="hot.php?id=<?php echo $item['id'] ?>">
                            <?php echo $item['hot'] == 1 ? 'True' : 'False' ?>
                              
                         </a>
                        </td>
                        <td><?php echo $item['created_at'] ?></td>
                        <td>
                          <a class="btn btn-xs btn-primary" href="edit.php?id=<?php echo $item['id'] ?>"><i class="fa fa-edit"></i>Sửa</a>
                          <a class="btn btn-xs btn-danger" href="delete.php?id=<?php echo $item['id'] ?>"><i class="fa fa-times"></i></a>
                        </td>
                      </tr>

                 <?php $stt++ ;  endforeach  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        </div>
       </div>
        </div>
     <?php require_once __DIR__. "/../../layouts/footer.php" ?>
    </div>
