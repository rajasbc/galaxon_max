<?php
include '../tables/config.php';
// print_r($_POST);die();
$obj=new StaffAttendance();

// $result = $obj->month_wise_report();
$curPageName =  $_SERVER['HTTP_HOST']; 

$result=$obj->month_wise_report2($curPageName);
$output='';
$output.="<thead class='text-center'>
        <tr><th class='check'>S.No</th><th class='check'>Staff Name</th>";
            
            if (date('m',strtotime($_POST['from']))=='01') {
                $c=31;
                $month='Jan';
            }
            if (date('m',strtotime($_POST['from']))=='02') {
                $c=28;
                $month='Feb';
            }
            if (date('m',strtotime($_POST['from']))=='03') {
                $c=31;
                $month='Mar';
            }
            if (date('m',strtotime($_POST['from']))=='04') {
                $c=30;
                $month='Apr';
            }
            if (date('m',strtotime($_POST['from']))=='05') {
                $c=31;
                $month='May';
            }
            if (date('m',strtotime($_POST['from']))=='06') {
                $c=30;
                $month='Jun';
            }
            if (date('m',strtotime($_POST['from']))=='07') {
                $c=31;
                $month='Jul';
            }
            if (date('m',strtotime($_POST['from']))=='08') {
                $c=31;
                $month='Aug';
            }
            if (date('m',strtotime($_POST['from']))=='09') {
                $c=30;
                $month='Sep';
            }
            if (date('m',strtotime($_POST['from']))=='10') {
                $c=31;
                $month='Oct';
            }
            if (date('m',strtotime($_POST['from']))=='11') {
                $c=30;
                $month='Nov';
            }
            if (date('m',strtotime($_POST['from']))=='12') {
                $c=31;
                $month='Dec';
            }
            for ($x = 1; $x <= $c; $x++) {
                $output.= "<th class='check'>".$month." ".$x."</th>";
            }        
  $output.="<th class='check'>Pre</th>
        <th class='check'>Abs</th>
        <th class='check'>Late</th>
        <th class='check'>Leave</th>
        </tr></thead>";
        $i=0;
        foreach ($result as $row) {
            // print_r($row);die();
        $i=$i+1;
        $output.="<tbody><tr height='50px'><td id='row".$row['id']."'>".$i."</td>
        <td>".$row['staff_name']."</td>";
        $att_details=$obj->getattdetails($row['staff_id'],$_POST['from'],$_POST['todate']);
        // print_r($att_details);die();
        $count=$obj->count_details($row['staff_id'],$_POST['from'],$_POST['todate']);
        $html='';
        for ($x = 1; $x <= $c; $x++) {
        $flagCame = 1;
        $present=1;
        foreach ($att_details as $key => $val) {
        $date=strtotime($val['attendance_date']);
        if((int)date('d',$date)==(int)$x){

        if($val['attendance']=='Present'){
            $present = "P";
        }
        if($val['attendance']=='Absent'){
            $present = "A";
        }
        if($val['attendance']=='Leave'){
            $present = "Leave";
        }
        if($val['attendance']=='Late'){
            $present = "Late";
        }
        
        $flagCame = 2;
    }
}
    if ($flagCame==2) {
        $html .= "<td>".$present."</td>";
    }else{
        $html .= "<td></td>";
    }
  
}
    $output.= $html;
    $output.='<td class="check text-center">'.$count['Present'].'</td>
        <td class="check text-center">'.$count['Absent'].'</td>
        <td class="check text-center">'.$count['Late'].'</td>
        <td class="check text-center">'.$count['Leave'].'</td>';
    $output.= '</tr></tbody>';
    }
if ($output != '') {
    $out = ["value" => $output];
}

echo json_encode($out);
?>

