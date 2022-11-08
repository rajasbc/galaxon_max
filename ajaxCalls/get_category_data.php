<?php
include '../tables/config.php';

 $obj = new Category();
if ($_POST['category_id']==0 && $_POST['category_id']=='') {
 $result =  $obj->get_category_data();
$output=array();
$main=array();

if (count($result)>0) {
	$i=0;
	$j=0;
	foreach ($result as $key => $value) {
		$i++;
		$output [$j] =[$i,$value['name'],'<button type="button" class="btn btn-primary" data-id="'.$value['id'].'" data-form="'.$value['name'].'" onclick="edit_modal(this);">Edit</button> <button type="button"  class="btn btn-success" data-id="'.$value['id'].'" onclick="add_sub_modal(this);">Add Sub Category</button> <button type="button"  class="btn btn-info" data-id="'.$value['id'].'" onclick="view_sub_modal(this);">Sub Category</button> <button type="button" class="btn btn-danger" data-id="'.$value['id'].'" onclick="delete_modal(this);">Delete</button>'];
		$j++;
	}
	
}

$main = $output;
echo json_encode($main);
}else if ($_POST['category_id']!=0 && $_POST['category_id']!='') {
	 $result =  $obj->get_sub_category_data($_POST['category_id']);
$output=" ";
$main=array();

if (count($result)>0) {
	$i=0;
	if ($_POST['type']=='option') {
		$output .='<option value="">Select Sub Category</option>';
		foreach ($result as $key => $value) {
		$i++;
		$output  .="<option value='".$value['id']."'>".$value['name']."</option>";
	}
	}else{

		foreach ($result as $key => $value) {
		$i++;
		$output  .="<tr>
		<td>".$i."</td>
		<td>".$value['name']."</td><td>"
		.'<button type="button" class="btn btn-danger" data-id="'.$value['id'].'" onclick="delete_sub_modal(this);">Delete</button>'."</td></tr>";
	}
	}
	
	
}

echo json_encode($output);
}
?>