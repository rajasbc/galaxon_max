<?php
class Dbconnection {
	//Database variables to make a connection t
	// public $Database_name = "main_labs";
	// public $Host_name = "localhost";
	// public $Database_user = "root";
	// public $Database_pass = "";

	public $Database_name;
	public $Host_name;
	public $Database_user;
	public $Database_pass;

	var $conn;
	var $records_per_page = 10;
	var $dbprefix = "";

	//This is a constructor to creat database connection
	function __construct() {

		 $this->Database_name = 'galaxon_max';
	     $this->Host_name = 'localhost';
	     $this->Database_user = 'labs_admin';
	     $this->Database_pass = 'Zz?B^%cGPWuM';

		$this->conn = new mysqli($this->Host_name, $this->Database_user, $this->Database_pass, $this->Database_name);
		if ($this->conn->connect_error) {
			die("Connection failed: " . $this->conn->connect_error);
		}
		$this->conn ->set_charset("utf8");
	}

	// Function for execute the query in Database
	function ExecuteQuery($sql) {
		//echo $sql;
		return $this->conn->query($sql) or die("Query Error" . $sql . $this->conn->connect_error);
	}

	function getpost($field) {
		return trim(mysqli_real_escape_string($this->conn, $_REQUEST[$field]));
	}

	function realEscapeString($fieldVar) {
		return trim($this->conn->real_escape_string($fieldVar));
	}

	// Function for fetch records from database
	function GetResultsArray($sql) {
		//echo $sql."error";
		$result = $this->conn->query($sql) or die("Query Error" . $sql . $this->conn->connect_error);
		$resultarray = array();
		while ($row = $result->fetch_assoc()) {
			$resultarray[] = $row;
		}
		return $resultarray;
	}

	function getAsIsArray($sql) {
		$result = $this->conn->query($sql) or die("Query Error" . $sql . $this->conn->connect_error);
		return $result->fetch_assoc();
	}

	function GetResultsAsValuePairArray($sql) {
		//echo $sql;
		//select category_id as key, category_name as value from
		$result = $this->conn->query($sql) or die("Query Error" . $sql . $this->conn->connect_error);
		$resultarray = array();
		while ($row = $result->fetch_assoc()) {
			$resultarray[$row['key']] = $row['value'];
		}
		return $resultarray;
	}

	// Function for find number of records from database
	function GetNumRows($sql) {
		$result = $this->conn->query($sql) or die("Query Error" . $sql . $this->conn->connect_error);
		return $result->num_rows;
	}

	// Function to upload files into server
	function FileUplaod($tmpName, $fileName) {
		return move_uploaded_file($tmpName, $fileName);
	}

	/*
			* insert's into fields array( "field" => specific
			* value $value ); in the form of an array
		*/
	function mysql_insert($table, $array) {
		$campos = '';
		$valores = '';
		$table = trim($table);
		if ($table == '') {
			die("Erro table not defined");
		}

		foreach ($array as $key => $value) {
			$campos .= $key . ",";
			if (!is_int($value)) {
				$value = '"' . $value . '"';
			}
			$valores .= $value . ",";
		}
		$campos = substr($campos, 0, -1);
		$valores = substr($valores, 0, -1);
		if (strpos($table, '`') !== false) {
			$sql = "INSERT INTO $table ($campos) VALUES ($valores)";
		} else {
			$sql = "INSERT INTO `$table` ($campos) VALUES ($valores)";
		}
		$this->ExecuteQuery($sql);
		return mysqli_insert_id($this->conn);

	}

	/*
			* update's into fields array( "field" => specific
			* value $value ); in the form of an array
		*/
	function mysql_update($table, $array, $condition) {
		$table = trim($table);
		if ($table == '' || $condition == '') {
			$this->error("Error table or condition not defenide,mysql_update()");
		}
		if (strpos($condition, '=') !== false) {

		} else {
			$this->error("Error condition not defenide,mysql_update()");
		}

		foreach ($array as $key => $value) {
			if (!is_int($value)) {
				$value = "'" . $value . "'";
			}
			$campos .= $key . "=" . $value . ",";
		}
		$campos = substr($campos, 0, -1);
		if (strpos($table, '`') !== false) {
			$sql = "UPDATE $table SET $campos WHERE $condition ";
		} else {
			$sql = "UPDATE `$table` SET $campos WHERE $condition ";
		}

		return $this->ExecuteQuery($sql);
	}

	function mysql_delete($table, $condition) {
		$sql = "delete from $table WHERE $condition ";
		return $this->ExecuteQuery($sql);
	}

	/*
			* This is a function for creating pagination for all tables
		*/
	function pagination($table) {
		$sql = "select * from " . $table;
		$result = $this->GetNumRows($sql);
		$html = Dbconnection::linkstr($result, $this->db->records_per_page, ceil($result / $this->db->records_per_page));

		return $html;
	}

	function linkstr($reccount, $rowperpage, $totalpages) {

		$showlinks = 4; //how many links to show 1|2|3|4
		$frompage = $_POST['page'];
		$topage = $_POST['page'] + $showlinks;
		if ($topage > $totalpages) {
			$topage = $totalpages;
		}

		if ($totalpages > $showlinks) {
			if (($topage - $frompage) < $showlinks) {
				$frompage = $topage - $showlinks;
			}

		} else {
			$frompage = 1;
			$topage = $totalpages;
		}

		$prevpageno = $frompage - 1;
		$nextpageno = $topage + 1;
		if ($nextpageno > $totalpages) {
			$nextpageno = $totalpages;
		}

		$linkstr = "";
		$imgno = "";
		$prevchar = ""; //chr(171);
		$nextchar = ""; //chr(187);

		if ($totalpages > 1) {

			if ($frompage > 1) {
				$linkstr .= "\n<a class='text12' href='javascript:link_click(1);' title='First'><img src='../images/first{$imgno}.gif' border=0 >{$prevchar}{$prevchar}</a> | ";
			}

			if ($frompage > 2) {
				$linkstr .= "\n<a  class='text12' href='javascript:link_click({$prevpageno});' title='Previous'><img src='../images/previous{$imgno}.gif' border=0 >{$prevchar}</a> | ";
			}

			//for loop
			for ($i = $frompage; $i <= $topage; $i++) {
				if ($_POST['page'] != $i) {
					$linkstr .= "\n<a  class='text12' href='javascript:link_click({$i});'><u><strong>";
				}

				$linkstr .= $i;
				if ($_POST['page'] != $i) {
					$linkstr .= "</strong></u></a>";
				}

				if ($i < $topage) {
					$linkstr .= " | ";
				}

			}
			//end for
			if ($topage < $totalpages - 1) {
				$linkstr .= "\n | <a  class='text12' valign='bottom' href='javascript:link_click({$nextpageno});' title='Next'><img src='../images/next{$imgno}.gif' border=0>{$nextchar}</a>";
			}

			if ($topage < $totalpages) {
				$linkstr .= "\n | <a  class='text12' href='javascript:link_click({$totalpages});' title='Last'><img src='../images/last{$imgno}.gif' border=0>{$nextchar}{$nextchar}</a>";
			}

		}

		return $linkstr;
	}

}

?>