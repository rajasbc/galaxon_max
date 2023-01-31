<?php

class Shops extends Dbconnection {
	var $name;
	var $db;
	var $invitee_obj;
	var $msg = '';
	var $tablename = "`shop_profile`";
	var $tablename1 = "`users`";
	
	// var $tablename2 = "``"
	// Create Db Connection for this class operations
	function __construct() {
		parent::__construct();
		$this->db = new Dbconnection();
	}
	function update_Shops(){


		$shop = array();
		$uploadedFile = '';
		$uploadedFile1 = '';
		$filename = basename($_FILES["shop_logo"]["name"]);
		$filename1 = basename($_FILES["shop_image"]["name"]);
		$tmp_name1 = "NIG_".$_SESSION['shop_id']."-".$filename1;
        $path1 = '../uploads/';
        $targetpath1 = $path1.$tmp_name1;
         if(move_uploaded_file($_FILES["shop_image"]["tmp_name"],$targetpath1)){

           $uploadedFile1 = $tmp_name1;
            
         }

         if($uploadedFile1!=''){


          $shop['shop_image'] = $uploadedFile1;

         }


		$tmp_name = "NIG_" . $_SESSION['shop_id'] . "_" . $filename;
		$path = '../uploads/'; // upload directory

		$targetpath = $path . $tmp_name;

		if (move_uploaded_file($_FILES["shop_logo"]["tmp_name"], $targetpath)) {

			$uploadedFile = $tmp_name;


		}
		if ($uploadedFile != '') {
			$shop['shop_logo'] = $uploadedFile;
		}

		$shop['name'] = $this->db->getpost('shop_name');
		$shop['shop_id'] = $_SESSION['shop_id'];
		$shio['branch_id'] = $_SESSION['branch_id'];
		$shop['shop_registration_number'] = $this->db->getpost('registration_no');
		$shop['dl_no'] = $this->db->getpost('dl_no');
		$shop['shop_gst_no'] = $this->db->getpost('shop_gst_no');
		$shop['email'] = $this->db->getpost('shop_email');
		$shop['address1'] = $this->db->getpost('address1');
		$shop['address2'] = $this->db->getpost('address2');
		$shop['area'] = $this->db->getpost('area');
		$shop['city'] = $this->db->getpost('city');
		$shop['state'] = $this->db->getpost('state');
		$shop['state_code'] = $this->db->getpost('state_code');
		$shop['country'] = $this->db->getpost('country');
		$shop['pincode'] = $this->db->getpost('pincode');
		$shop['mobile_no'] = $this->db->getpost('mobile_no');
		$shop['alt_mobile_no'] = $this->db->getpost('alt_mobile_no');

		$shop['landline_no'] = $this->db->getpost('Landline_no');
		$shop['declaration'] = $this->db->getpost('declaration');
		
		$shop['created_at'] = date('Y-m-d h:i:s');
		
		$result = $this->db->mysql_update($this->tablename,$shop,"id=".$this->db->getpost('id')."");
		$sql = "select * from ".$this->tablename." where id = ".$this->db->getpost('id')." and shop_id = ".$_SESSION['shop_id']."";
		$result1 = $this->db->GetResultsArray($sql);
// print_r(count($result1));die();

		if (count($result1)>0) {
			return [
				"status" => "Success",
				"id" => $result1[0]['id'],
				"shop_name"=> $result1[0]['name'],
				"registration_no"=> $result1[0]['shop_registration_number'],
				"dl_no"=> $result1[0]['dl_no'],
				"shop_gst_no"=> $result1[0]['shop_gst_no'],
				"email"=> $result1[0]['email'],
				"address1"=> $result1[0]['address1'],
				"address2"=> $result1[0]['address2'],
				"area"=> $result1[0]['area'],
				"city"=> $result1[0]['city'],
				"state"=> $result1[0]['state'],
				"state_code"=> $result1[0]['state_code'],
				"country"=> $result1[0]['country'],
				"pincode"=> $result1[0]['pincode'],
				"mobile_no"=> $result1[0]['mobile_no'],
				"alt_mobile_no"=> $result1[0]['alt_mobile_no'],
				"landline_no"=> $result1[0]['landline_no'],
				"created_at"=> $result1[0]['created_at'],

			];
			
		}else{
			return ['status'=>'failed'];
		}




	}


	public function get_user(){


		$sql = "select * from users where branch_id = '".$_SESSION['branch_id']."' and is_active='1'";

		$result = $this->db->GetResultsArray($sql);

		return $result;

	}

	public function get_shop_details(){


		$sql = "select * from ".$this->tablename." where branch_id = '".$_SESSION['branch_id']."' and status='ENABLED' ";

		$result = $this->db->GetResultsArray($sql);

		return $result;

	}
	public function get_countries() {
		$sql = "select * from ".$this->tablename1."";
		$result = $this->db->GetResultsArray($sql);
		return $result;
	}
	public function insert_details(){


		$check_sql = "select * from ".$this->tablename." where name = '".$this->db->getpost('name')."' and status='ENABLED' and branch='1'";
        $check_res = $this->db->GetResultsArray($check_sql);

       
        if(count( $check_res)>0){

             return ['status'=>'alert'];

        }

        $sql = "select max(branch_code) as branch_code from ".$this->tablename." where branch = '1'";
        $result = $this->db->GetResultsArray($sql);


      if($result[0]['branch_code']!=''){
          $branch_code = $result[0]['branch_code'];
          $branch_code++;

      }else{
      $branch_code = 'GLXB0001';
  }

      $sel = "select max(branch_id) as branch_id from ".$this->tablename." where shop_id = '".$_SESSION['shop_id']."'";

        $res = $this->db->getAsIsArray($sel);

          $branch_id = $res['branch_id']+1;

          




		$branch = array();
		$branch1 = array();

		$branch['name'] = $this->db->getpost('name');
		$branch['shop_id'] = $_SESSION['shop_id'];
		$branch['branch_id'] = $branch_id;
		$branch['branch_code'] = $branch_code;
		$branch['shop_registration_number'] = $this->db->getpost('registration_no');
		$branch['shop_gst_no'] = $this->db->getpost('gst_no');
		$branch['email'] = $this->db->getpost('email');
		$branch['address1'] = $this->db->getpost('address');
		$branch['country'] = $this->db->getpost('country');
		$branch['state'] = $this->db->getpost('state');
		$branch['pincode'] = $this->db->getpost('pincode');
		$branch['mobile_no'] = $this->db->getpost('mobile_no');
		$branch['alt_mobile_no'] = $this->db->getpost('alt_mobile_no');
		$branch['landline_no'] = $this->db->getpost('Landline_no');
		$branch['group_id'] = $this->db->getpost('group_name');
		$branch['branch'] = $_SESSION['shop_id'];
		$branch['username'] = $this->db->getpost('username');
		$pass1 = md5($this->db->getpost('password'));
		$branch['password'] = $pass1;

		$branch['created_at'] = date('Y-m-d h:i:s');



        $branch1['branch_id'] = $branch_id;
		$branch1['type'] = $this->db->getpost('type');
		$branch1['shop_id'] = $_SESSION['shop_id'];
		$branch1['email'] = $this->db->getpost('email');
		$branch1['mobile_no'] = $this->db->getpost('mobile_no');
		$branch1['username'] = $this->db->getpost('username');
		$pass = md5($this->db->getpost('password'));
		$branch1['login_password'] = $pass;





		$result = $this->db->mysql_insert($this->tablename,$branch);
		$result1 = $this->db->mysql_insert($this->tablename1,$branch1);

        $obj = new Mail();
        $mail = $obj->sendEmail();


		if($result1){

			return ['status'=>'success'];

		}else{


			return ['status'=>'failed'];

		}

	}
	public function get_branch_data(){


		 $sql ="select * from ".$this->tablename." where branch='".$_SESSION['shop_id']."'";

	
		$result=$this->db->GetResultsArray($sql);
		return $result;


	}
	public function get_branch_dt($id)
	{

		$sql='select * from '.$this->tablename.' where id='.$id ;
		$result=$this->db->getAsIsArray($sql);

		return $result;
	}
	public function edit_branch()
	{
  $branch = array();




		$branch['name'] = $this->db->getpost('name');
		$branch['shop_id'] = $_SESSION['shop_id'];
		$branch['shop_registration_number'] = $this->db->getpost('registration_no');
		$branch['shop_gst_no'] = $this->db->getpost('gst_no');
		$branch['email'] = $this->db->getpost('email');
		$branch['address1'] = $this->db->getpost('address');
		$branch['country'] = $this->db->getpost('country');
		$branch['state'] = $this->db->getpost('state');
		$branch['pincode'] = $this->db->getpost('pincode');
		$branch['mobile_no'] = $this->db->getpost('mobile_no');
		$branch['alt_mobile_no'] = $this->db->getpost('alt_mobile_no');
		$branch['group_id'] = $this->db->getpost('group_name');
		$branch['landline_no'] = $this->db->getpost('Landline_no');
		$branch['branch'] = $_SESSION['shop_id'];

		$branch['created_at'] = date('Y-m-d h:i:s');


		$result = $this->db->mysql_update($this->tablename,$branch,'id='.$this->db->getpost('edit_branch_id'));
		if($result){
      return ['status'=>'success'];

		}else{
       return ['status'=>'failed'];

		}
 
		
	}
	public function delete_branch()
	{
		$branch=array();
		$branch['status']='DISABLED';
		$id = $this->db->mysql_update($this->tablename, $branch,'id='.$this->db->getpost('branch_id'));
		if ($id!=0) {
			return ['status'=>'success'];
		}else{
			return ['status'=>'failed'];
		}
	}
public function get_username($id){


$sql='select * from '.$this->tablename.' where branch_id='.$id.' and status="ENABLED"';
$res=$this->db->GetResultsArray($sql);


if(count($res)>0){
   return ['status'=>'success','username'=>$res[0]['username']];

}else{
   return ['status'=>'failed'];
}


	}



public function update_username($id){

   $update = array();
   $update1 = array();

   $update['username'] = $this->db->getpost('username');
   $pass = md5($this->db->getpost('password'));
   $update['password'] =  $pass;

   $update1['username'] = $this->db->getpost('username');
   $pass1 = md5($this->db->getpost('password'));
   $update1['login_password'] =  $pass1;





$result = $this->db->mysql_update($this->tablename,$update,'branch_id='.$id);
$result1 = $this->db->mysql_update($this->tablename1,$update1,'branch_id='.$id);
if($result1){
   return ['status'=>'success'];
}else{
   return ['status'=>'failed'];
}

}

public function branch_enable($id){

$branch=array();
$branch['status']='ENABLED';	

$result = $this->db->mysql_update($this->tablename,$branch,'id='.$id);
 if($result){
   return ['status'=>'success'];
  }else{

   return ['status'=>'failed'];

  } 

}

public function get_branch_details(){

$sql = 'select * from '.$this->tablename.'where branch_id='.$_SESSION['branch_id'].' and status="ENABLED"';

$result = $this->db->GetResultsArray($sql);

return $result;


}

public function get_branch_name($id){

$sql = 'select * from '.$this->tablename.' where branch_id='.$id.' and status="ENABLED"';

$result = $this->db->GetResultsArray($sql);
return $result;

}
public function get_branch_code($id){

$sql = 'select * from '.$this->tablename.' where branch_id='.$id.' and status="ENABLED"';

$result = $this->db->GetResultsArray($sql);
return $result;

}
public function shop_details(){
$sql = 'select * from '.$this->tablename.' where branch_id= '.$_SESSION['branch_id'].' and status="ENABLED"';

$result = $this->db->GetResultsArray($sql);

return $result;

}
public function show_branch(){
$sql = 'select * from '.$this->tablename.' where branch_id!='.$_SESSION['branch_id'].' and status="ENABLED"';

$result = $this->db->GetResultsArray($sql);


return $result;

}

public function get_shop_name($b_id){

$sql = 'select * from '.$this->tablename.' where branch_id='.$b_id.' and status="ENABLED"';

$result = $this->db->GetResultsArray($sql);


return $result;

}
public function get_Autocomplete_branch(){
$sql = "select * from ".$this->tablename." where(name like '%".$this->db->getpost('term')."%' or branch_code like '%".$this->db->getpost('term')."%') and status='ENABLED'";

$result = $this->db->GetResultsArray($sql);
return $result;

}
public function get_branch_inf($id){
$sql = 'select * from '.$this->tablename.'where branch_id='.$id.' and status="ENABLED"';

$result = $this->db->getAsIsArray($sql);


return $result;



}
public function item_frm_branch($b_id){

 $sql= 'select * from '.$this->tablename.'where branch_id = '.$b_id.' and status="ENABLED" group by name';
$result = $this->db->getAsIsArray($sql);
return $result;

}
public function item_to_branch($b_id){

$sql= 'select * from '.$this->tablename.'where branch_id = '.$b_id.' and status="ENABLED" group by name';
$result = $this->db->getAsIsArray($sql);

return $result;


}
public function update_price($b_id){
	$price = array();
	$price['sale_price']='no';

$sale = $this->db->mysql_update($this->tablename,$price,'branch_id='.$b_id);

if($sale){

return ['status'=>'success'];

}else{

return ['status'=>'failed'];

}


}

public function update_price_disable($b_id){
	$price = array();
	$price['sale_price']='yes';

$sale = $this->db->mysql_update($this->tablename,$price,'branch_id='.$b_id);

if($sale){

return ['status'=>'success'];

}else{

return ['status'=>'failed'];

}


}
public function get_branch_sale(){

$sql = 'select * from '.$this->tablename.'where branch_id = '.$_SESSION['branch_id'].' and status="ENABLED"';
$result = $this->db->getAsIsArray($sql);

return $result;

}
public function get_branch_grp($g_id){

$sql = 'select * from '.$this->tablename.' where group_id='.$g_id.' and branch_id!=0';
$result = $this->db->GetResultsArray($sql);
return $result;

}



}
?>