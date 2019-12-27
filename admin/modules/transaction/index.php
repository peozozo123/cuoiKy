

<?php     
    $open = "transaction";
    require_once __DIR__. "/../../autoload/autoload.php";

   
    $sql = "SELECT transaction.*, users.name as name_user, users.phone as phone FROM  transaction left join users on transaction.users_id= users.id  order by id desc";
     $transaction = $db -> fetchsql($sql);
?>
<?php require_once __DIR__. "/../../layouts/header.php" ?>
    <div id="content-wrapper">
      <div class="container-fluid">
          <h1 class="page-header">Danh sách đơn hàng </h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.html">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Đơn hàng</li>
        </ol>
        <div class="clearfix"></div>
        <?php require_once __DIR__. "/../../../partials/notification.php" ?>
        <div class="row">
         <div class="col-md-12">
            <div class="card mb-3">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Name</th>
                    <th>Số điện thoại</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                 <?php $stt = 1; foreach ($transaction as $item): ?>
                      <tr>
                        <td><?php echo $stt ?></td>
                        <td><?php echo $item['name_user'] ?></td>
                        <td><?php echo $item['phone'] ?></td>
                        <td><?php echo fomatPrice($item['amount']) ?>đ</td>
                         <td>
                          <a class="btn btn-xs <?php echo $item['status'] == 1 ? 'btn-primary' : 'btn-danger' ?>" href="status.php?id=<?php echo $item['id'] ?>">
                            <?php echo $item['status'] == 1 ? 'Đã xử lí' : 'Chưa xử lí' ?>
                         </a>

                        <td> 
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
