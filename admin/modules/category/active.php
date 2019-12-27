<?php     
    $open = "product";
    require_once __DIR__. "/../../autoload/autoload.php";

  
 	 $id = intval(getInput('id'));
 	
    $editCategory = $db ->fetchID("category", $id)  ;
    if( empty($editCategory)) {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin("category");
    }

    $active = $editCategory['active'] ==0 ? 1 : 0;
    $update = $db ->update("category", array("active" =>$active), array("id"=>$id));
     if($update > 0) {
          move_uploaded_file($file_tmp, $part.$file_name);
           $_SESSION['success'] = "Cập nhật thành công!";
           redirectAdmin("category"); 
        }
        else {
           $_SESSION['error'] = "Cập nhật thất bại!";
           redirectAdmin("category");
        }
?>