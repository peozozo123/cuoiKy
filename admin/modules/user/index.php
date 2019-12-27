

<?php     
    $open = "user";
    require_once __DIR__. "/../../autoload/autoload.php";

   
    $sql = "SELECT users.* FROM users ORDER BY ID DESC";
     $user = $db -> fetchsql($sql);
?>
<?php require_once __DIR__. "/../../layouts/header.php" ?>
    <div id="content-wrapper">
      <div class="container-fluid">
          <h1 class="page-header">Danh sách thành viên</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.html">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Thành viên</li>
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
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                 <?php $stt = 1; foreach ($user as $item): ?>
                      <tr>
                        <td><?php echo $stt ?></td>
                        <td><?php echo $item['name'] ?></td>
                        <td><?php echo $item['email'] ?></td>
                        <td><?php echo $item['phone'] ?></td>
                        <td><?php echo $item['address'] ?></td>
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
