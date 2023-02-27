<?php
class Employee extends Dbconnection {
	var $name;
	var $db;
	var $invitee_obj;
	var $msg = '';
	var $tablename = "`employee`";
	// Create Db Connection for this class operations
	function __construct() {
		parent::__construct();
		$this->db = new Dbconnection();
	}
	public function add_employee()
	{
		$employee=array();
		$sql_max = "select max(id) from ".$this->tablename." where branch_id = ".$_SESSION['branch_id'];
		$max_cust_id = $this->db->GetResultsArray($sql_max);

		$employee["title"]=$this->db->getpost('title');
		$employee["employee_id"]="MAX000".($max_cust_id[0]['max(id)']+1);
		$employee["first_name"]=$this->db->getpost('first_name');
		$employee["last_name"]=$this->db->getpost('last_name');
		$employee["dob"]=$this->db->getpost('dob');
		$employee["age"]=$this->db->getpost('age');
		$employee["gender"]=$this->db->getpost('gender');
		$employee["mobile_no"]=$this->db->getpost('mobile_no');
		$employee["email"]=$this->db->getpost('email');
		$employee["address_line1"]=$this->db->getpost('address_line1');
		$employee["address_line2"]=$this->db->getpost('address_line2');
		$employee["street"]=$this->db->getpost('street');
		$employee["city"]=$this->db->getpost('city');
		$employee["state"]=$this->db->getpost('state');
		$employee["country"]=$this->db->getpost('country');
		$employee["pincode"]=$this->db->getpost('pincode');
		$employee["id_type"]=$this->db->getpost('id_type');
		$employee["id_no"]=$this->db->getpost('id_no');
		$employee["blood_group"]=$this->db->getpost('blood_group');
		$employee["emergency_contact"]=$this->db->getpost('emergency_contact');
		$employee["vaccinate"]=$this->db->getpost('vaccinate');
		$employee["bank_name"]=$this->db->getpost('bank_name');
		$employee["branch_name"]=$this->db->getpost('branch_name');
		$employee["branch_code"]=$this->db->getpost('branch_code');
		$employee["account_number"]=$this->db->getpost('account_number');
		$employee["ifsc_code"]=$this->db->getpost('ifsc_code');
		$employee["department_name"]=$this->db->getpost('department_name');
		$employee["designation"]=$this->db->getpost('designation');
		$employee["gross_wage"]=$this->db->getpost('gross_wage');
		$employee["basic_wage"]=$this->db->getpost('basic_wage');
		$employee["epf"]=$this->db->getpost('epf');
		$employee["ta_da"]=$this->db->getpost('ta_da');
		$employee["esi_health_insurance"]=$this->db->getpost('esi_health_insurance');
		$employee["conveyance_allowances"]=$this->db->getpost('conveyance_allowances');
		$employee["medical_allowances"]=$this->db->getpost('medical_allowances');
		$employee["addition_emp_tax"]=$this->db->getpost('addition_emp_tax');
		$employee["date_of_joining"]=$this->db->getpost('date_of_joining');
		$employee["uid"]=$_SESSION['uid'];

		$employee["uan"]=$this->db->getpost('uan');
        $employee["pf_no"]=$this->db->getpost('pf_no');
        $employee["esi_no"]=$this->db->getpost('esi_no');
        $employee["hra"]=$this->db->getpost('hra');
        $employee["other_allowances"]=$this->db->getpost('other_allowances');
        $employee["loan"]=$this->db->getpost('loan');


		$employee["branch_id"]=$_SESSION['branch_id'];
		$employee["created_at"]= date('Y-m-d H:i:s');
		$employee_insert = $this->db->mysql_insert($this->tablename, $employee);

		return ['status'=>'success'];
	}
public function update_employee()
	{
		$employee=array();
		

		$employee["title"]=$this->db->getpost('title');
		$employee["first_name"]=$this->db->getpost('first_name');
		$employee["last_name"]=$this->db->getpost('last_name');
		$employee["dob"]=$this->db->getpost('dob');
		$employee["age"]=$this->db->getpost('age');
		$employee["gender"]=$this->db->getpost('gender');
		$employee["mobile_no"]=$this->db->getpost('mobile_no');
		$employee["email"]=$this->db->getpost('email');
		$employee["address_line1"]=$this->db->getpost('address_line1');
		$employee["address_line2"]=$this->db->getpost('address_line2');
		$employee["street"]=$this->db->getpost('street');
		$employee["city"]=$this->db->getpost('city');
		$employee["state"]=$this->db->getpost('state');
		$employee["country"]=$this->db->getpost('country');
		$employee["pincode"]=$this->db->getpost('pincode');
		$employee["id_type"]=$this->db->getpost('id_type');
		$employee["id_no"]=$this->db->getpost('id_no');
		$employee["blood_group"]=$this->db->getpost('blood_group');
		$employee["emergency_contact"]=$this->db->getpost('emergency_contact');
		$employee["vaccinate"]=$this->db->getpost('vaccinate');
		$employee["bank_name"]=$this->db->getpost('bank_name');
		$employee["branch_name"]=$this->db->getpost('branch_name');
		$employee["branch_code"]=$this->db->getpost('branch_code');
		$employee["account_number"]=$this->db->getpost('account_number');
		$employee["ifsc_code"]=$this->db->getpost('ifsc_code');
		$employee["department_name"]=$this->db->getpost('department_name');
		$employee["designation"]=$this->db->getpost('designation');
		$employee["gross_wage"]=$this->db->getpost('gross_wage');
		$employee["basic_wage"]=$this->db->getpost('basic_wage');
		$employee["epf"]=$this->db->getpost('epf');
		$employee["ta_da"]=$this->db->getpost('ta_da');
		$employee["esi_health_insurance"]=$this->db->getpost('esi_health_insurance');
		$employee["conveyance_allowances"]=$this->db->getpost('conveyance_allowances');
		$employee["medical_allowances"]=$this->db->getpost('medical_allowances');
		$employee["addition_emp_tax"]=$this->db->getpost('addition_emp_tax');
		$employee["date_of_joining"]=$this->db->getpost('date_of_joining');
		$employee["uid"]=$_SESSION['uid'];

        $employee["uan"]=$this->db->getpost('uan');
        $employee["pf_no"]=$this->db->getpost('pf_no');
        $employee["esi_no"]=$this->db->getpost('esi_no');
        $employee["hra"]=$this->db->getpost('hra');
        $employee["other_allowances"]=$this->db->getpost('other_allowances');
        $employee["loan"]=$this->db->getpost('loan');


		$employee["branch_id"]=$_SESSION['branch_id'];
		$employee["created_at"]= date('Y-m-d H:i:s');
		$employee_insert = $this->db->mysql_update($this->tablename, $employee,'id='.$this->db->getpost('id'));

		return ['status'=>'success'];
	}
	public function get_employee()
	{
		$sql = "select * from employee where branch_id = ".$_SESSION['branch_id']." and is_delete='no'";
		$result = $this->db->GetResultsArray($sql);
		return $result;
	}
	public function get_employee_details($id)
	{
		$sql = "select * from employee where branch_id = ".$_SESSION['branch_id']." and id=".$id;
		$result = $this->db->GetResultsArray($sql);
		return $result;
	}
	public function get_employee_salary($id){

       $sql = 'select * from '.$this->tablename.'where branch_id='.$_SESSION['branch_id'].' and id='.$id.'';
       $result = $this->db->getAsIsArray($sql);
		return $result;

	}

	public function get_customerdata(){

    $sql = 'select * from '.$this->tablename.' where branch_id='.$_SESSION['branch_id'].' and is_delete="no"';
    $result = $this->db->GetResultsArray($sql);
    // print_r( $result);die();
    return $result;


	}
	public function del_employee($id){

		$del_employ = array();
		$del_employ['is_delete']="yes";
     
     $result = $this->db->mysql_update('employee',$del_employ,'id='.$id);

     if($result){
       return 'success';
     }
	}
	
}
?>