<?php
	//global $plugin_dir;
?>
<link rel="stylesheet" href="<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/css/amerisale-re.css">
<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'></script>

<?php 
	global $wpdb;
		$sql = "SELECT * FROM ".$wpdb->prefix."agentaccount ";
		$results = $wpdb->get_results($sql);
		// echo "<pre>"; print_r($results);
		$db_ip = $results[0]->host;
		$db_user = $results[0]->db_user;
		$db_pass = $results[0]->password;
		$db_name = $results[0]->db;
		$agent_loginurl = $results[0]->agent_loginurl;
		$agent_offcode = $results[0]->agent_offcode;
		$rets_area = $results[0]->rets_area;
		if($db_user != ''){
		$con = mysql_connect($db_ip,$db_user,$db_pass);
		if (!$con)
		  {
		  die('Could not connect: ' . mysql_error());
		  }
		  mysql_select_db($db_name, $con);
		}
		$sql = "SELECT MLS FROM ntreislist where officelist = '".$results[0]->agent_offcode."' and (expired_date < current_date and expired_date != '0000-00-00')  and liststatus != 'expired'";
		$expired_data = mysql_query($sql);
		$expired = array();
		while($row = mysql_fetch_assoc($expired_data)){
			$expired[] = $row;
			
		}
		// echo "<pre>"; print_r($expired);die;
		// var_dump($result);

		
		
		// $sql = "SELECT MLS FROM ".$wpdb->prefix."ntreislist where officelist = '".$results[0]->agent_offcode."' and expired_date < current_date and liststatus != 'expired'";
		// $expired = $wpdb->get_results($sql);
		$mls = array();
		foreach($expired as $exp){
			$mls[] = $exp['MLS'];
		}
		$mls = implode(",",$mls);
		if(!empty($mls)){
			/* 	$update_ep = "UPDATE ".$wpdb->prefix."ntreislist SET liststatus ='expired' WHERE MLS IN($mls)";
			$update_ep =  $wpdb->query($update_ep); */
			$update_ep = "UPDATE ntreislist SET liststatus ='expired' WHERE MLS IN($mls)";
			$update_ep = mysql_query($update_ep);
		}	
		
		$today = getdate();
		//print_r($today);
		$today = $today['year']."-".$today['mon']."-".$today['mday'];
		
		$date = $today;
		$newdate = strtotime ( '-45 day' , strtotime ( $date ) ) ;
		$newdate = date ( 'Y-m-j' , $newdate );
		 
		$newdate;
		
		
		/* 	$del = "SELECT MLS FROM ".$wpdb->prefix."ntreislist where officelist = '".$results[0]->agent_offcode."' and expired_date < current_date - 45 and liststatus = 'expired'";
			$delete = $wpdb->get_results($del); */
		$del = "SELECT MLS FROM ntreislist where officelist = '".$results[0]->agent_offcode."' and (expired_date < '".$newdate."' and expired_date != '0000-00-00') and liststatus = 'expired'";
			
			$delete_data = mysql_query($del);
			$delete = array();
			while($row = mysql_fetch_assoc($delete_data)){
				$delete[] = $row;
				
			}
			// echo "<pre>"; print_r($delete);die;
			if(!empty($delete)){
				foreach($delete as $dele){
					
					$deletilng = "DELETE FROM ntreislist WHERE MLS = ".$dele['MLS']."";
					$delete_data = mysql_query($deletilng);

					// $img = "SELECT imagename FROM ".$wpdb->prefix."ntreisimages WHERE mlsnum = $dele->MLS";
					// $images = $wpdb->get_results($img);
					// foreach($images as $img){
						// var_dump(file_exists($img->imagename));
					// }
					$deleteimg = "DELETE FROM ntreisimages` WHERE mlsnum = $dele->MLS";
					$delete_data = mysql_query($deleteimg);
				}
			}
		
			//mysql_close($commcon);
			
			// Reset DB Conn
			mysql_select_db(DB_NAME);
?>