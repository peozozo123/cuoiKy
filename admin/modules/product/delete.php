<?php 
    require_once __DIR__. "/../../autoload/autoload.php";

    $id = intval(getInput('id'));

    $editProduct = $db ->fetchID("product", $id)  ;
    if( empty($editProduct)) {
        $_SESSION['error'] = "Du lieu khong ton tai!";
        redirectAdmin("product");
    }



    $num = $db -> delete("product", $id);
    if($num> 0) {
        $_SESSION['success'] = "Xoa thanh cong";
        redirectAdmin("product");
    } 
    else {
        $_SESSION['error'] = "Xoa that bai";
        redirectAdmin("product");
    }

?>