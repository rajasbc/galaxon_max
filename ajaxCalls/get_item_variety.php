<?php
include '../tables/config.php';

 $obj = new Varieties();

 $result =  $obj->get_varieties_data($_POST['item_id']);
$output='';

if (count($result)>0) {
	$i=0;
	foreach ($result as $key => $value) {
		$i++;
		$output .='<tr><td>'.$i.'</td><td>'.$value['name'].'</td><td>'.$value['mrp'].'</td><td>'.$value['sale_price'].'</td><td><button type="button" class="btn btn-info" data-id="'.$value['id'].'" onclick="edit_variety(this);">Edit</button></td><td><button type="button" class="btn btn-danger" data-id="'.$value['id'].'" onclick="delete_variety(this);">Delete</button></td></tr>';
	}
	
}

echo json_encode($output);
?>