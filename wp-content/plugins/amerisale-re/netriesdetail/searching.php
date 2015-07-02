<?php 
	include_once("../../../../wp-config.php");
	global $wpdb;
	$sql = "SELECT * FROM ".$wpdb->prefix."agentaccount ";
	$results = $wpdb->get_results($sql);
	// echo "<pre>"; print_r($results);die;
	$db_ip = $results[0]->host;
	$db_user = $results[0]->db_user;
	$db_pass = $results[0]->password;
	$db_name = $results[0]->db;
	$agent_offcode = $results[0]->agent_offcode;
	
	$con = mysql_connect($db_ip,$db_user,$db_pass);
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db($db_name, $con);
	
	$today = getdate();
	$dates = $today['year']."-".$today['mon']."-".$today['mday'];
	$date = date('Y-m-d',strtotime($dates));
	
	$data = $_REQUEST['data'];
	// $data = implode(',',$data);
	// var_dump($data);
	$sort = $_REQUEST['sort'];
	if($sort == 'id'){
		$list = 'ORDER by A.agent_license_no ASC';
	}else if($sort == 'agent_id'){
		$list = 'ORDER by A.id ASC';
	}else if($sort == 'MLS'){
		$list = 'ORDER by B.MLS ASC';
	}
	if($data == ''){
		$sql = "SELECT A.agent_license_no,A.Name,A.agent_id,B.MLS,B.directions,B.city,B.county,B.agentlist,B.is_manual_edit,B.expired_date,B.sold,B.proptype
				FROM agents AS A
				LEFT JOIN ntreislist AS B
				ON A.agent_license_no=B.agentlist WHERE B.agentlist != '' AND B.officelist = '".$agent_offcode."' AND B.delete_status = '0' $list";
				
		// $tkeqry = $wpdb->get_results($sql);
		$sql1 = mysql_query($sql); 
	while($row = mysql_fetch_assoc($sql1)){
		$tkeqrys[] =  $row;
	}
	// echo count($tkeqrys);
	?><select name="drop1" id="Select1" size="4" multiple="multiple" style=" height: 400px;">
		<?php 
			foreach($tkeqrys as $a_mls)
			{ 
				$addresss = $a_mls['directions'].', '.$a_mls['city'].', '.$a_mls['county'].' county';
				// print_r($a_mls);
				// echo "expired   " .$a_mls['expired_date'];
				if($a_mls['is_manual_edit'] == 1){
					//if ( $date > $a_mls['expired_date']) {
					if ($a_mls['liststatus'] == 'expired') {
						echo '<option class="red" value="'.$a_mls['MLS'].'~'.$a_mls['agent_license_no'].'~0">'.$a_mls['proptype']." - Agent ID:".$a_mls['agent_license_no']." - MLS #:".$a_mls['MLS']." - Agent Name #:".$a_mls['Name']." - Address #:".$addresss.'</option>';
					}else if ($a_mls['sold'] == 1) {
						echo '<option class="red" value="'.$a_mls['MLS'].'~'.$a_mls['agent_license_no'].'~0">'.$a_mls['proptype']." - Agent ID:".$a_mls['agent_license_no']." - MLS #:".$a_mls['MLS']." - Agent Name #:".$a_mls['Name']." - Address #:".$addresss.'</option>';
						//echo '<option class="red" value="'.$a_mls->MLS.'~'.$a_mls->agent_license_no.'~0">'.$a_mls->agent_license_no." Agent ID:".$a_mls->agent_license_no." - MLS #:".$a_mls->MLS." - Agent Name #:".$a_mls->Name.'</option>';
					}else{
						echo '<option class="black" value="'.$a_mls['MLS'].'~'.$a_mls['agent_license_no'].'~1">'.$a_mls['proptype']." - Agent ID:".$a_mls['agent_license_no']." - MLS #:".$a_mls['MLS']." - Agent Name #:".$a_mls['Name']." - Address #:".$addresss.'</option>';
						//echo '<option class="black" value="'.$a_mls->MLS.'~'.$a_mls->agent_license_no.'~1">'.$a_mls->agent_license_no." Agent ID:".$a_mls->agent_license_no." - MLS #:".$a_mls->MLS." - Agent Name #:".$a_mls->Name.'</option>';
					}
				}
				
				if($a_mls['is_manual_edit'] == 0 || $a_mls['is_manual_edit'] == 2){
						echo '<option class="blue" value="'.$a_mls['MLS'].'~'.$a_mls['agent_license_no'].'~1">'.$a_mls['proptype']." - Agent ID:".$a_mls['agent_license_no']." - MLS #:".$a_mls['MLS']." - Agent Name #:".$a_mls['Name']." - Address #:".$addresss.'</option>';
						//echo '<option class="blue" value="'.$a_mls->MLS.'~'.$a_mls->agent_license_no.'~1">'.$a_mls->agent_license_no." Agent ID:".$a_mls->agent_license_no." - MLS #:".$a_mls->MLS." - Agent Name #:".$a_mls->Name.'</option>';
				}
			}
		?>
	</select>
	<?php
	}else{
		$sql = "SELECT A.agent_license_no,A.Name,A.agent_id,B.MLS,B.directions,B.city,B.county,B.agentlist,B.is_manual_edit,B.expired_date,B.sold,B.proptype
				FROM agents AS A
				LEFT JOIN ntreislist AS B
				ON A.agent_license_no=B.agentlist WHERE B.agentlist != '' AND B.MLS IN( ".$data.") AND B.officelist = '".$agent_offcode."' AND B.delete_status = '0' AND B.rets_area NOT LIKE '%abor%' ";
		$sql1 = mysql_query($sql); 
		while($row = mysql_fetch_assoc($sql1)){
			$tkeqry[] =  $row;
		}
		if(!empty($tkeqry)){
	?><select name="drop1" id="Select1" size="4" multiple="multiple" style="height: 400px;">
		<?php 
	
			foreach($tkeqry as $a_mls)
			{ 
				$addresss = $a_mls['directions'].', '.$a_mls['city'].', '.$a_mls['county'].' county';
				// print_r($a_mls);
				// echo "expired   " .$a_mls['expired_date'];
				if($a_mls['is_manual_edit'] == 1){
					//if ( $date > $a_mls['expired_date']) {
					if ($a_mls['liststatus'] == 'expired') {
						echo '<option class="red" value="'.$a_mls['MLS'].'~'.$a_mls['agent_license_no'].'~0">'.$a_mls['proptype']." - Agent ID:".$a_mls['agent_license_no']." - MLS #:".$a_mls['MLS']." - Agent Name #:".$a_mls['Name']." - Address #:".$addresss.'</option>';
					}else if ($a_mls['sold'] == 1) {
						echo '<option class="red" value="'.$a_mls['MLS'].'~'.$a_mls['agent_license_no'].'~0">'.$a_mls['proptype']." - Agent ID:".$a_mls['agent_license_no']." - MLS #:".$a_mls['MLS']." - Agent Name #:".$a_mls['Name']." - Address #:".$addresss.'</option>';
						//echo '<option class="red" value="'.$a_mls->MLS.'~'.$a_mls->agent_license_no.'~0">'.$a_mls->agent_license_no." Agent ID:".$a_mls->agent_license_no." - MLS #:".$a_mls->MLS." - Agent Name #:".$a_mls->Name.'</option>';
					}else{
						echo '<option class="black" value="'.$a_mls['MLS'].'~'.$a_mls['agent_license_no'].'~1">'.$a_mls['proptype']." - Agent ID:".$a_mls['agent_license_no']." - MLS #:".$a_mls['MLS']." - Agent Name #:".$a_mls['Name']." - Address #:".$addresss.'</option>';
						//echo '<option class="black" value="'.$a_mls->MLS.'~'.$a_mls->agent_license_no.'~1">'.$a_mls->agent_license_no." Agent ID:".$a_mls->agent_license_no." - MLS #:".$a_mls->MLS." - Agent Name #:".$a_mls->Name.'</option>';
					}
				}
				
				if($a_mls['is_manual_edit'] == 0 || $a_mls['is_manual_edit'] == 2){
						echo '<option class="blue" value="'.$a_mls['MLS'].'~'.$a_mls['agent_license_no'].'~1">'.$a_mls['proptype']." - Agent ID:".$a_mls['agent_license_no']." - MLS #:".$a_mls['MLS']." - Agent Name #:".$a_mls['Name']." - Address #:".$addresss.'</option>';
						//echo '<option class="blue" value="'.$a_mls->MLS.'~'.$a_mls->agent_license_no.'~1">'.$a_mls->agent_license_no." Agent ID:".$a_mls->agent_license_no." - MLS #:".$a_mls->MLS." - Agent Name #:".$a_mls->Name.'</option>';
				}
			}
		?>
	</select>
	<?php
	}else{
		echo "No Result"; 
	}
	}
	mysql_close($con); 
?>