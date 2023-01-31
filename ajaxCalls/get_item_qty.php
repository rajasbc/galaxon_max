<?php
include '../tables/config.php';
// error_reporting(E_ALL);

// print_r($_POST);die();
$obj = new Items();
if($_POST['type']!= 0){
      if($_POST['item_id']!=0 && $_POST['varieties_id']!=0 ){

        $tot_qty = $obj->total_var_qty($_POST['varieties_id']);
// print_r($tot_qty);die();

       }else{


         $tot_qty = $obj->total_item_qty($_POST['item_id']);

          }
}else{

if($_POST['item_id']!=0 && $_POST['varieties_id']!='' ){

        $tot_qty = $obj->total_var_qty($_POST['varieties_id']);


       }else{


         $tot_qty = $obj->total_item_qty($_POST['item_id']);

          }



}

echo json_encode($tot_qty);

?>