<?php
include '../tables/config.php';
// error_reporting(E_ALL);

 $obj = new Shops();

 $result =  $obj->get_branch_grp($_POST['group_id']);
 // print_r($result);die();


$output=array();
$main=array();

if (count($result)>0) {
	$i=0;
	$j=0;
	foreach ($result as $key => $value) {
		
		$i++;

        if($value['sale_price']=='yes' && $value['status']=='ENABLED'){

             
          $sale_btn = '<button style="margin-right:20px" type="button" id="test" for="'.$value['branch_code'].'"  class="btn btn-primary" data-id="'.$value['branch_id'].'" onclick="sale_model_yes(this);" value="enable">Price Disabled </button>';
             


        } elseif($value['sale_price']=='yes' && $value['status']=='DISABLED'){

           $sale_btn = '<button style="margin-right:20px" type="button" id="test" for="'.$value['branch_code'].'" disabled class="btn btn-primary" data-id="'.$value['branch_id'].'" onclick="sale_model_yes(this);" value="enable">Price Disabled </button>';
             
        }elseif($value['sale_price']=='no' && $value['status']=='ENABLED'){

            $sale_btn = '<button style="margin-right:20px" type="button" id="test" for="'.$value['branch_code'].'"  class="btn btn-primary" data-id="'.$value['branch_id'].'" onclick="sale_model_no(this);" value="disable"> Price Enabled</button>';


        }elseif($value['sale_price']=='no' && $value['status']=='DISABLED'){
            $sale_btn = '<button style="margin-right:20px" type="button" id="test" for="'.$value['branch_code'].'" disabled class="btn btn-primary" data-id="'.$value['branch_id'].'" onclick="sale_model_no(this);" value="disable"> Price Enabled</button>';


        }
        


		if($value['status']=='ENABLED'){
$output [$j] =[$i,$value['name'],$value['branch_code'],$value['mobile_no'],$value['email'],'<button style="margin-right:25px";
type="button"  class="btn btn-primary" data-id="'.$value['id'].'" data-form="'.$value['name'].'" onclick="edit_modal(this);">Edit</button><button  style="margin-right: 20px"; type="button"  class="btn btn-danger" data-id="'.$value['id'].'" onclick="delete_modal(this);">Disable</button><button style="margin-right:20px" type="button" for="'.$value['branch_code'].'"  class="btn btn-primary" data-id="'.$value['branch_id'].'" onclick="reset_model(this);">Reset</button>'.$sale_btn];
              }else{

               $output [$j] =[$i,$value['name'],$value['branch_code'],$value['mobile_no'],$value['email'],
               '<button style="margin-right: 20px"; type="button"  class="btn btn-primary" disabled data-id="'.$value['id'].'" data-form="'.$value['name'].'" onclick="edit_modal(this);">Edit</button> 
               <button style="margin-right: 20px"; type="button"   class="btn btn-danger" data-id="'.$value['id'].'" onclick="enable_btn(this);">Enable</button>
               <button style="margin-right: 20px"; type="button"  class="btn btn-primary" for="'.$value['branch_code'].'" disabled data-id="'.$value['branch_id'].'" onclick="reset_model(this);">Reset</button>'.$sale_btn];


              }





		$j++;
	}
	
}

$main = $output;
echo json_encode($main);

?>