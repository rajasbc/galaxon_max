<?php 
include '../tables/config.php';


$obj = new Expenses();

$result = $obj->get_expenses_file($_POST['expenses_id']);



if (count($result)>0) {
	$i=0;
	
	$output='';


	foreach ($result as $key => $value) {
    
		$i++;
		

              $output .='<tr>
              <td>'.$i.'</td>
              <td>'.$value['file'].'</td>
           <td><button  type="button" class="btn btn-primary" data-id="'.$value['id'].'"><a href="../uploads/files/'.$value['file'].'" target="_blank" class="text-white">view</a></button></td>
         <td><button type="button" class="btn btn-danger" data-id="'.$value['id'].'" onclick="delete_file(this);">Delete</button></td></tr>';
      
              }

	}

echo json_encode($output);

?>