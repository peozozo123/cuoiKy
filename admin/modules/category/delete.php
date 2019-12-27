<?php 

    require_once __DIR__. "/../../autoload/autoload.php";

    $id = intval(getInput('id'));

    $editCategory = $db ->fetchID("category", $id)  ;
    if( empty($editCategory)) {
        $_SESSION['error'] = "Du lieu khong ton tai!";
        redirectAdmin("category");
    }


    $is_product = $db -> fetchOne("product", " category_id = $id " );
    if($is_product == NULL) {

        $num = $db -> delete("category", $id);
        if($num> 0) {
            $_SESSION['success'] = "Xoa thanh cong";
            redirectAdmin("category");
        } 
        else {
            $_SESSION['error'] = "Xoa that bai";
            redirectAdmin("category");
        }

    }
    else {
         $_SESSION['error'] = "Danh mục đã có sản phẩm ! Không thể xoá !";
        redirectAdmin("category");
    }

?>