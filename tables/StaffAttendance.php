<?php
class StaffAttendance extends Dbconnection {
    var $name;
    var $db;
    var $invitee_obj;
    var $msg = '';
    var $tablename = "staff_attendance";
    // Create Db Connection for this class operations
    function __construct() {
        parent::__construct();
        $this->db = new Dbconnection();
    }
    function staff_attendance(){
        // print_r($_POST);die();
        $date=strtotime($_POST["date"]);
        $attendance=array();
        $i=0;
        foreach ($_POST["staffname"] as $key => $value) 
        {  
            $attendance['staff_id']=$_POST["staffid"][$i];
            $attendance['branch_id']=$_SESSION['branch_id'];
            $attendance['staff_name']=$_POST["staffname"][$i];
            $attendance['attendance']=$_POST["attendance"][$i];
            $attendance['attendance_date']=date('Y-m-d',$date);
            $attendance['time_in']=$_POST["time_in"][$i];
            $attendance['remarks']=$_POST["remarks"][$i];
            $attendance['created_at']=date('Y-m-d H:i:s');
            $attendance['updated_at']=date('Y-m-d H:i:s');
            $attendance['created_by']=$_SESSION['uid'];
            $attendance['updated_by']=$_SESSION['uid'];
            $sql = "select * from staff_attendance where staff_id=".$_POST['staffid'][$i]." and attendance_date='".date('Y-m-d',$date)."'";
            $res=$this->db->GetResultsArray($sql);
            if (count($res)==0) {
                if ($_POST['attendance'][$i]!='') {
                    $this->db->mysql_insert($this->tablename, $attendance);
                }
            }
            else{
                if ($_POST['attendance'][$i]!='') {
                    $this->db->mysql_update($this->tablename, $attendance,'id='.$res[0]['id']);
                }
            }       
            $i++;
        }
        return["status"=>"success"];
    }
    function count_attendance($id){ 
        
        $from=date("Y-m-d", strtotime("first day of this month"));
        $to=date("Y-m-d", strtotime("last day of this month"));
        $sql1 = "select attendance_date,attendance from " . $this->tablename . "  where branch_id=" . $_SESSION['branch_id']." and attendance_date>='".$from."' and attendance_date<='".$to."' and attendance='Present' and staff_id=".$id;
        $result1 = $this->db->GetResultsArray($sql1);
        $sql2 = "select attendance_date,attendance from " . $this->tablename . "  where branch_id=" . $_SESSION['branch_id']." and attendance_date>='".$from."' and attendance_date<='".$to."' and attendance='Absent' and staff_id=".$id;
        $result2 = $this->db->GetResultsArray($sql2);
        $sql3 = "select attendance_date,attendance from " . $this->tablename . "  where branch_id=" . $_SESSION['branch_id']." and attendance_date>='".$from."' and attendance_date<='".$to."' and attendance='Late' and staff_id=".$id;
        $result3 = $this->db->GetResultsArray($sql3);
        $sql4 = "select attendance_date,attendance from " . $this->tablename . "  where branch_id=" . $_SESSION['branch_id']." and attendance_date>='".$from."' and attendance_date<='".$to."' and attendance='Leave'  and staff_id=".$id;
        $result4 = $this->db->GetResultsArray($sql4);
        return ['Present'=>count($result1),'Absent'=>count($result2),'Late'=>count($result3),'Leave'=>count($result4)];
    }
    public function getattdetails_id($id)
    {
        $from=date("Y-m-d", strtotime("first day of this month"));
        $to=date("Y-m-d", strtotime("last day of this month"));
        $sql = "select attendance_date,attendance from " . $this->tablename . "  where branch_id=" . $_SESSION['branch_id']." and attendance_date>='".$from."' and attendance_date<='".$to."' and staff_id=".$id;
        $result = $this->db->GetResultsArray($sql);
        return $result;
    }
    public function getattdetails($id,$from,$to)
    {
        $sql = "select attendance_date,attendance from " . $this->tablename . "  where branch_id=" . $_SESSION['branch_id']." and attendance_date>='".$from."' and attendance_date<='".$to."' and staff_id=".$id;
        $result = $this->db->GetResultsArray($sql);

        return $result;
    }
    function month_wise_report(){
       $sql = "select id as staff_id,first_name as staff_name from employee where branch_id='".$_SESSION['branch_id']."' and is_delete='no'"; 
        $result = $this->db->GetResultsArray($sql);

        return $result;
        
    }
    function month_wise_report1($curpagename){
     
        $sql = "select id as staff_id,first_name as staff_name from employee  where branch_id=".$_SESSION['branch_id']." and is_delete='no'";
    
    $result = $this->db->GetResultsArray($sql);

    return $result;
}
  function month_wise_report2($curpagename){
     
        $sql = "select id as staff_id,first_name as staff_name from employee  where branch_id=".$_SESSION['branch_id']." and is_delete='no'";

    $result = $this->db->GetResultsArray($sql);
   
    return $result;
}
function count_details($id,$from,$to){ 
 $sql1 = "select attendance_date,attendance from " . $this->tablename . "  where branch_id=" . $_SESSION['branch_id']." and attendance_date>='".$from."' and attendance_date<='".$to."' and attendance='Present' and staff_id=".$id;
 $result1 = $this->db->GetResultsArray($sql1);
 $sql2 = "select attendance_date,attendance from " . $this->tablename . "  where branch_id=" . $_SESSION['branch_id']." and attendance_date>='".$from."' and attendance_date<='".$to."' and attendance='Absent' and staff_id=".$id;
 $result2 = $this->db->GetResultsArray($sql2);
 $sql3 = "select attendance_date,attendance from " . $this->tablename . "  where branch_id=" . $_SESSION['branch_id']." and attendance_date>='".$from."' and attendance_date<='".$to."' and attendance='Late' and staff_id=".$id;
 $result3 = $this->db->GetResultsArray($sql3);
 $sql4 = "select attendance_date,attendance from " . $this->tablename . "  where branch_id=" . $_SESSION['branch_id']." and attendance_date>='".$from."' and attendance_date<='".$to."' and attendance='Leave'  and staff_id=".$id;
 $result4 = $this->db->GetResultsArray($sql4);

 return ['Present'=>count($result1),'Absent'=>count($result2),'Late'=>count($result3),'Leave'=>count($result4)];
}
function time_in_report($id){
    $from = $this->db->getpost('from');
    $sql = "select * from " . $this->tablename . "  where branch_id=" . $_SESSION['branch_id']." and staff_id='".$id."' and attendance_date>='".$from."' and attendance_date<='".$from."'";
    $result = $this->db->GetResultsArray($sql);
    return $result;
}
function get_leave_taken($id,$date){

    $from = date('01-m-Y',strtotime($date));
    $to = date('Y-m-t',strtotime($date));
 $sql = "select * from ".$this->tablename." where branch_id=".$_SESSION['branch_id']." and attendance_date>='".$from."' and attendance_date<='".$to."' and staff_id='".$id."' and attendance='Absent'";   
 $result = $this->db->GetResultsArray($sql);
 return ['leave'=>count($result)];

}

}
?>