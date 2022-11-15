<?php
class Users extends Dbconnection {
	var $name;
	var $db;
	var $invitee_obj;
	var $msg = '';
	var $tablename = "`users`";
	// Create Db Connection for this class operations
	function __construct() {
		parent::__construct();
		$this->db = new Dbconnection();
	}
	public function loginCheck()
	{
		$sql='select * from '.$this->tablename.' where (username="'.$this->db->getpost('username').'" or mobile_no="'.$this->db->getpost('username').'" or email="'.$this->db->getpost('username').'") and login_password="'.md5($this->db->getpost('password')).'" and is_active="1"';
		$result=$this->db->GetResultsArray($sql);
		if (count($result)==0) {
			return ['status'=>'failed'];
		}else{
			$_SESSION['shop_id']=$result[0]['shop_id'];
			$_SESSION['uid']=$result[0]['id'];
			$_SESSION['username']=$result[0]['username'];
			$_SESSION['email']=$result[0]['email'];
			$_SESSION['mobile_no']=$result[0]['mobile_no'];
			$_SESSION['type']=$result[0]['type'];
			return ['status'=>'success'];
		}
	}

function update_Shops(){


		$shop = array();
		$uploadedFile = '';
		$sign_uploaded = '';

		$filename = basename($_FILES["shop_logo"]["name"]);

		$tmp_name = "NIG_" . $_SESSION['shop_id'] . "_" . $filename;
		$path = '../uploads/shop/'; // upload directory

		$targetpath = $path . $tmp_name;

		if (move_uploaded_file($_FILES["shop_logo"]["tmp_name"], $targetpath)) {

			$uploadedFile = $tmp_name;


		}
		if ($uploadedFile != '') {
			$shop['shop_logo'] = $uploadedFile;
		}


        $filename = basename($_FILES["sign_logo"]["name"]);

		$tmp_name = "NIG_" . $_SESSION['shop_id'] . "_" . $filename;
		$path = '../uploads/shop/'; // upload directory

		$targetpath = $path . $tmp_name;

		if (move_uploaded_file($_FILES["sign_logo"]["tmp_name"], $targetpath)) {

			$sign_uploaded  = $tmp_name;


		}
		if ($sign_uploaded!= '') {
			$shop['sign_logo'] = $sign_uploaded ;
		}







		$shop['name'] = $this->db->getpost('shop_name');
		$shop['shop_id'] = $_SESSION['shop_id'];
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


   $sql = "select * from users where shop_id = '".$_SESSION['shop_id']."' and username = '".$_SESSION['username']."'";

  $result = $this->db->GetResultsArray($sql);
  
   return $result;

}
public function get_shop_details(){


   $sql = "select * from ".$this->tablename." where shop_id = '".$_SESSION['shop_id']."' and email = '".$_SESSION['email']."'";

  $result = $this->db->GetResultsArray($sql);
  
   return $result;

}




}
?>