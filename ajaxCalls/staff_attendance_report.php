<?php
include '../tables/config.php';
$obj=new StaffAttendance();
$result1 = $obj->month_wise_report();
$i=0;
$output='';
$i = 0;
foreach ($result1 as $row1) {
        if ($row1['staff_name'] == '') {
    $staffname = 'No Name';
    } else {
    $staffname = $row1['staff_name'];
    }
        $i++;
    $output.= "<tr height='50px' id='row".$row1['staff_id']."'>
    <td class='text-center' width='100px'>" . $i . "</td>
    <td width='250px'>" . $staffname . " <input type='hidden' name='staffname[]' value='".$staffname."'><input type='hidden' name='staffid[]' value='".$row1['staff_id']."'></td>";
    $result =  $obj->time_in_report($row1['staff_id']);
if (count($result)>0) {
foreach ($result as $row) {
    
    if ($row['attendance']=='Present') {
    	$chepresent='checked="checked"';
    	// $disabled='';
    }else{
    	$chepresent=' ';
    	// $disabled='disabled';
    }
    if ($row['attendance']=='Absent') {
    	$chabsent='checked="checked"';
    }else{
    	$chabsent=' ';
    	// $disabled='disabled:"disbled"';
    }
    if ($row['attendance']=='Late') {
    	$chelate='checked="checked"';
    	// $disabled='';
    }else{
    	$chelate=' ';
    	// $disabled='disabled';
    }
    if ($row['attendance']=='Leave') {
    	$cheleave='checked="checked"';
    	// $disabled='';
    }else{
    	$cheleave=' ';
    	// $disabled='disabled';
    }
  $output.="<input type='hidden' name='attendance[]' id='att".$row1['staff_id']."' value='".$row['attendance']."'><td class='text-center' width='100px' id='present1".$row['id']."'><div class='form-check'><input class='form-check-input' type='radio' ".$chepresent."  name='present".$i."' id='".$row['id']."' onclick='insertdata(1,".$row1['staff_id'].");'></div></td>";  
  $output.="<td class='text-center' width='100px' id='absent1".$row['id']."'><div class='form-check'><input class='form-check-input' ".$chabsent."  type='radio' name='present".$i."' id='".$row['id']."' onclick='insertdata(2,".$row1['staff_id'].");' ></div></td>";
 $output.="<td class='text-center' width='100px' id='late1".$row['id']."'><div class='form-check'><input class='form-check-input' ".$chelate." type='radio' name='present".$i."' id='".$row['id']."' onclick='insertdata(3,".$row1['staff_id'].");' ></div></td>";
 $output.="<td class='text-center' width='100px' id='leave1".$row['id']."'><div class='form-check'><input class='form-check-input' type='radio' ".$cheleave." name='present".$i."' id='".$row['id']."' onclick='insertdata(4,".$row1['staff_id'].");'></div></td>";
$output.="<td><input type='time' width='50px' class='form-control' name='time_in[]' id='time".$row['id']."' value='".$row['time_in']."' s></td>";
$output.= "<td><input type='text' width='50px' class='form-control' name='remarks[]' id='remarks".$row['id']."' value='".$row['remarks']."' ></td>";
}
}else{
  $output.="<input type='hidden' name='attendance[]' id='att".$row1['staff_id']."' ><td class='text-center' width='100px' id='present1".$row1['staff_id']."'><div class='form-check'><input class='form-check-input' type='radio'  name='present".$i."' id='".$row1['staff_id']."' onclick='insertdata(1,".$row1['staff_id'].");'></div></td>";
  $output.="<td class='text-center' width='100px' id='absent1".$row1['staff_id']."'><div class='form-check'><input class='form-check-input'  type='radio' name='present".$i."' id='".$row1['staff_id']."'' onclick='insertdata(2,".$row1['staff_id'].");' ></div></td>";
 $output.="<td class='text-center' width='100px' id='late1".$row1['staff_id']."'><div class='form-check'><input class='form-check-input' type='radio' name='present".$i."' id='".$row1['staff_id']."'' onclick='insertdata(3,".$row1['staff_id'].");' ></div></td>";
 $output.="<td class='text-center' width='100px' id='leave1".$row1['staff_id']."'><div class='form-check'><input class='form-check-input' type='radio'  name='present".$i."' id='".$row1['staff_id']."' onclick='insertdata(4,".$row1['staff_id'].");'></div></td>";
$output.="<td><input type='time' width='50px' class='form-control' name='time_in[]' id='time".$row['id']."'></td>";
$output.= "<td><input type='text' class='form-control' name='remarks[]' id='remarks".$row['id']."'></td>";
}
$output.='</tr>';
}
$out = ["value" => $output];

	
echo json_encode($out);
?>