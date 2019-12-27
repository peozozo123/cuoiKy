<?php 
    require_once __DIR__. "/../../autoload/autoload.php";

    $id = intval(getInput('id'));

    $editUser = $db ->fetchID("users", $id)  ;
    if( empty($editUser)) {
        $_SESSION['error'] = "Du lieu khong ton tai!";
        redirectAdmin("user");
    }



    $num = $db -> delete("users", $id);
    if($num> 0) {
        $_SESSION['success'] = "Xoa thanh cong";
        redirectAdmin("user");
    } 
    else {
        $_SESSION['error'] = "Xoa that bai";
        redirectAdmin("user");
    }

?>