<?php 

    require_once __DIR__. "/../../autoload/autoload.php";

    $id = intval(getInput('id'));

    $editTrans = $db ->fetchID("transaction", $id)  ;
    if( empty($editTrans)) {
        $_SESSION['error'] = "Du lieu khong ton tai!";
        redirectAdmin("transaction");
    }
    $num = $db -> delete("transaction", $id);
    if($num> 0) {
        $_SESSION['success'] = "Xoa thanh cong";
        redirectAdmin("transaction");
    } 
    else {
        $_SESSION['error'] = "Xoa that bai";
        redirectAdmin("transaction");
    }

    

?>