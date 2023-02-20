<?php
include '../tables/config.php';
// error_reporting(E_ALL);


$obj = new Items();
   if($_POST['type']!=0){
      if( $_POST['varieties_id']!=0 && $_POST['varieties_id']!=''){

        $tot_qty = $obj->total_var_qty($_POST['varieties_id']);

       }else{


         $tot_qty = $obj->total_item_qty($_POST['item_id']);
         

          }
      }else{

          if( $_POST['varieties_id']!=0 && $_POST['varieties_id']!=''){

        $tot_qty = $obj->total_var_qty($_POST['varieties_id']);

       }else{


         $tot_qty = $obj->total_item_qty($_POST['item_id']);
         

          }





          }


// if($_POST['item_id']!=0 && $_POST['varieties_id']!='' ){

//         $tot_qty = $obj->total_var_qty($_POST['varieties_id']);


//        }else{


//          $tot_qty = $obj->total_item_qty($_POST['item_id']);

//           }





echo json_encode($tot_qty);

?>