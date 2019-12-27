<?php     
    require_once __DIR__. "/../../autoload/autoload.php";

  
 	 $id = intval(getInput('id'));
 	
    $editTrans = $db ->fetchID("transaction", $id)  ;
    if( empty($editTrans)) {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin("transaction");
    }

    if($editTrans['status'] == 1) {
       $_SESSION['error'] = "Đơn hàng đã được xử lí !!";
        redirectAdmin("transaction");
    }
    $status =1;
    $update = $db ->update("transaction", array("status" =>$status), array("id"=>$id));
     if($update > 0) {
            
           $_SESSION['success'] = "Cập nhật thành công!";

           $sql = "select product_id , qty from orders where transaction_id = $id";
           $order = $db ->fetchsql($sql);
           foreach ($order as $item) {
             $idProduct = intval($item['product_id']);
             $product = $db -> fetchID("product", $idProduct);
             $number = $product['number'] - $item['qty'];
             $up_productNumber = $db ->update("product", array("number"=>$number, "pay"=> $product['pay'] + $item['qty']), array("id"=>$idProduct));
           }
           redirectAdmin("transaction"); 
        }
        else {
           $_SESSION['error'] = "Cập nhật thất bại!";
           redirectAdmin("transaction");
        }
?>