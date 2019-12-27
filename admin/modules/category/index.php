

<?php 
    $open = "category";
    require_once __DIR__. "/../../autoload/autoload.php";

    $category = $db -> fetchAll("category");
?>
<?php require_once __DIR__. "/../../layouts/header.php" ?>
    <div id="content-wrapper">
      <div class="container-fluid">
          <h1 class="page-header">Danh sách danh mục</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.html">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Danh mục</li>
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
                    <th>Slug</th>
                    <th>Active</th>
                    <th>Created</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                 <?php $stt = 1; foreach ($category as $item): ?>
                      <tr>
                        <td><?php echo $stt ?></td>
                        <td><?php echo $item['name'] ?></td>
                        <td><?php echo $item['slug'] ?></td>
                         <td>
                          <a class="btn btn-xs <?php echo $item['active'] == 1 ? 'btn-primary' : 'btn-danger' ?>" href="active.php?id=<?php echo $item['id'] ?>">
                            <?php echo $item['active'] == 1 ? 'True' : 'False' ?>
                         </a>
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
