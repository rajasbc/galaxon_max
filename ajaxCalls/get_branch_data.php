<?php
include '../tables/config.php';


 $obj = new Shops();
if ($_POST['branch_id']==0 && $_POST['branch_id']=='') {
 $result =  $obj->get_branch_data();


$output=array();
$main=array();

if (count($result)>0) {
	$i=0;
	$j=0;
	foreach ($result as $key => $value) {
		
		$i++;
		if($value['status']=='ENABLED'){
$output [$j] =[$i,$value['name'],$value['branch_code'],$value['mobile_no'],$value['email'],'<button style="margin-right:25px";
type="button"  class="btn btn-primary" data-id="'.$value['id'].'" data-form="'.$value['name'].'" onclick="edit_modal(this);">Edit</button><button  style="margin-right: 20px"; type="button"  class="btn btn-danger" data-id="'.$value['id'].'" onclick="delete_modal(this);">Disable</button><button style="margin-right:20px" type="button" for="'.$value['branch_code'].'"  class="btn btn-primary" data-id="'.$value['branch_id'].'" onclick="reset_model(this);">Reset</button>'];
              }else{

               $output [$j] =[$i,$value['name'],$value['branch_code'],$value['mobile_no'],$value['email'],
               '<button style="margin-right: 20px"; type="button"  class="btn btn-primary" disabled data-id="'.$value['id'].'" data-form="'.$value['name'].'" onclick="edit_modal(this);">Edit</button> 
               <button style="margin-right: 20px"; type="button"   class="btn btn-danger" data-id="'.$value['id'].'" onclick="enable_btn(this);">Enable</button>
               <button style="margin-right: 20px"; type="button"  class="btn btn-primary" for="'.$value['branch_code'].'"disabled data-id="'.$value['branch_id'].'" onclick="reset_model(this);">Reset</button>'];


              }





		$j++;
	}
	
}

$main = $output;
echo json_encode($main);
}else{
	$result=$obj->get_branch_dt($_POST['branch_id']);
	echo json_encode($result);
}
?>