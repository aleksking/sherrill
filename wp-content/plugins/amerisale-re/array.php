<?php 
	include_once("../../../wp-config.php");
	global $wpdb;
		$sql = "SELECT * FROM ".$wpdb->prefix."agentaccount ";
		$results = $wpdb->get_results($sql);
		// echo "<pre>"; print_r($results);
		$db_ip = $results[0]->host;
		$db_user = $results[0]->db_user;
		$db_pass = $results[0]->password;
		$db_name = $results[0]->db;
		$agent_offcode = $results[0]->agent_offcode;
		// if($db_user != ''){
		$con = mysql_connect($db_ip,$db_user,$db_pass);
		if (!$con)
		  {
		  die('Could not connect: ' . mysql_error());
		  }
		  mysql_select_db($db_name, $con);
		// }
if(isset($_GET['part']) and $_GET['part'] != '')
{
	$val = $_GET['part'];
	if($_REQUEST['key'] == 'cntry'){
		$cntysql = "SELECT * FROM county where county_name like '".$val."%' ";
		$cntylist = mysql_query($cntysql); 
		// $cntynames = array();
		while($cntyrow = mysql_fetch_assoc($cntylist)){
			// print_r($citrow);
			$names[] = $cntyrow['county_name'];
			
		}
	}else if($_REQUEST['key'] == 'city'){
		$cntysql = "SELECT * FROM city where city_name like '".$val."%' ";
		$cntylist = mysql_query($cntysql); 
		// $cntynames = array();
		while($cntyrow = mysql_fetch_assoc($cntylist)){
			// print_r($citrow);
			$names[] = $cntyrow['city_name'];
			
		}
	}else{
	}
	// echo "<pre>";
	// print_r($cntynames); die;

	$results = array();

	// search colors
	foreach($names as $cnty)
	{
		// print_r($cnty);
		// if it starts with 'part' add to results
		// if( strpos($cnty, $_GET['part']) === 0 ){
			$results[] = $cnty;
		// }
	}
	// print_r($results);

	// return the array as json with PHP 5.2
	echo json_encode($results);
}
	// die;

/* $city = Array
('---Select Any City---' => '','Dime Box' => 'Dime Box','Lexington' => 'Lexington','Thorndale' => 'Thorndale'); */

// $country = Array('---Select Any County---' => '','Lee' => 'Lee','Milam' => 'Milam');
// echo json_encode($country);
?>