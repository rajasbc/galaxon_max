<?php
class ReturnItems extends Dbconnection {
  var $name;
  var $db;
  var $invitee_obj;
  var $msg = '';
  var $tablename = "`return_item`";
  var $tablename2 = "`return_item_details`";
  // Create Db Connection for this class operations
  function __construct() {
    parent::__construct();
    $this->db = new Dbconnection();
  }
  public function add_return_item()
  {

    print_r($_POST);die();
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
      $_SESSION['branch_id']=$result[0]['branch_id'];
      return ['status'=>'success'];
    }
  }
}
?>