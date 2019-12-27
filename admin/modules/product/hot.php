<?php     
    $open = "product";
    require_once __DIR__. "/../../autoload/autoload.php";

  
 	 $id = intval(getInput('id'));
 	
    $editProduct = $db ->fetchID("product", $id)  ;
    if( empty($editProduct)) {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin("product");
    }

    $hot = $editProduct['hot'] ==0 ? 1 : 0;
    $update = $db ->update("product", array("hot" =>$hot), array("id"=>$id));
     if($update > 0) {
          move_uploaded_file($file_tmp, $part.$file_name);
           $_SESSION['success'] = "Cập nhật thành công!";
           redirectAdmin("product"); 
        }
        else {
           $_SESSION['error'] = "Cập nhật thất bại!";
           redirectAdmin("product");
        }
?>