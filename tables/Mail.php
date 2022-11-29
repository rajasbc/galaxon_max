<?php

include_once '../../vendor/autoload.php';
include_once '../config.php';

use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\Exception;

class Mail extends Dbconnection {
    var $mail;
    var $db;
    var $tablename = "`shop_profile`";
    var $tablename1 = "`users`";

    // use PHPMailer\PHPMailer\PHPMailer;
    // use PHPMailer\PHPMailer\Exception;


    function __construct() {
        parent::__construct();
        $this->db = new Dbconnection();
    }

    public function sendEmail(){
        

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

        $branch = array();
        $branch1 = array();

        $branch['name'] = $this->db->getpost('name');
        $branch['shop_id'] = $_SESSION['shop_id'];
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
        $branch['branch'] = $_SESSION['shop_id'];
        $branch['username'] = $this->db->getpost('username');
        $pass1 = md5($this->db->getpost('password'));
        $branch['password'] = $pass1;

        $branch['created_at'] = date('Y-m-d h:i:s');




        $branch1['type'] = $this->db->getpost('type');
        $branch1['shop_id'] = $_SESSION['shop_id'];
        $branch1['email'] = $this->db->getpost('email');
        $branch1['mobile_no'] = $this->db->getpost('mobile_no');
        $branch1['username'] = $this->db->getpost('username');
        $pass = md5($this->db->getpost('password'));
        $branch1['login_password'] = $pass;





        $result = $this->db->mysql_insert($this->tablename,$branch);
        $result1 = $this->db->mysql_insert($this->tablename1,$branch1);
        


        $mail = new PHPMailer();

        $mail->From = "galaxon@gmail.com";
        $mail->FromName = "ADMIN";


        $mail->addAddress($this->db->getpost('email'), $this->db->getpost('username'));

        $mail->isHTML(true);

        $mail->Subject = "Registered as PO Tracking System - 2crsi";
        $mail->Body = "Hi, You are registered as 2crsi PO Tracking System, Your login details below., <br /><br /><table><tr><td>User Name : ".$this->db->getpost('username')."</td></tr><tr><td>Password : ".$this->db->getpost('password')."</td></tr></table><br />Thank You,";

        // echo $mail;

        try {
            $mail->send();
            return 'Success';
        } catch (Exception $e) {
            return 'Failed';
        }
        

    }

    public function sendorderEmail(){

        $mail = new PHPMailer();

        $mail->From = "adminpo@2crsi.com";
        $mail->FromName = "Admin";


        $obj = new Admin();
        $adres = $obj -> getadmin();

        $ures = $obj->getusername($_POST['salesperson']);    


        $mail->addAddress($adres['email'], $adres['username']);

        $mail->isHTML(true);

        $mail->Subject = "New PO - 2crsi";
        $mail->Body = "Hi Admin, a salesperson ".$ures['name']." has raised a new PO.<br />Thank You,";

        // echo $mail;

        try {
            $mail->send();
            return 'Success';
        } catch (Exception $e) {
            return 'Failed';
        }
        

    }


}