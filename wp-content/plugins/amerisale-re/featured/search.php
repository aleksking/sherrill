<?php 
	include_once("../../../../wp-config.php");
	global $wpdb;
	$mls = $_REQUEST['mls'];	
	$type = $_REQUEST['type'];	
	$sql = "SELECT * FROM ".$wpdb->prefix."agentaccount ";
	$results = $wpdb->get_results($sql);
	// echo "<pre>"; print_r($results);die;
	$db_ip = $results[0]->host;
	$db_user = $results[0]->db_user;
	$db_pass = $results[0]->password;
	$db_name = $results[0]->db;
	$codentrs = $results[0]->agent_offcode;
	$con = mysql_connect($db_ip,$db_user,$db_pass);
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db($db_name, $con);
	// $codentrs = "LYNC00FW";
	if(isset($_REQUEST['mls'])){
		$sql = "SELECT is_manual_edit,MLS, agent_name,street_num,street_name,street_type,city,state, directions, officelist,zipcode,county, officelist, featured_listings FROM ntreislist where officelist = '".$codentrs."' AND featured_listings ='0' AND mls =".$mls." AND agentlist !='' AND agent_name !=''";
	}else{
		$sql = "SELECT is_manual_edit,MLS, agent_name,street_num,street_name,street_type,city,state, directions, officelist,zipcode,county, officelist, featured_listings FROM ntreislist where officelist = '".$codentrs."' AND featured_listings ='0' AND agentlist !='' AND agent_name !='' ORDER by MLS $type ";
	}
	// echo $sql;
	// $results = $wpdb->get_results($sql);
	$res = mysql_query($sql); 
	$results = array();
	while($row = mysql_fetch_assoc($res)){
		$results[] = $row;
	}
		if(!empty($results)){

			?>
			<form method="post" id="retrive" onsubmit="return submitform();">
			<table id="mytable">

			<tbody>
				<tr class="heading">
					<th class="cont_tab2">MLS</th>
					<!--<th class="cont_tab2">Password</th>-->
					<th class="cont_tab2">Agent Name</th>
					<th class="cont_tab1">Address</th>
					<th class="cont_tab1">Feature Listings</th>
				</tr>
			<?php
			foreach($results as $result){
				if($result['is_manual_edit'] == 1){
					$address = $result['directions'].'<br />'.$result['city'].', TX'.$result['state'].' '.$result['zipcode'].'<br />'.$result['county'].' county';
				}else if($result['is_manual_edit'] == 0 || $result['is_manual_edit'] == 2){
					$address = $result['street_num'].' '.$result['street_name'].' '.$result['street_type'].' '.$result['city'].' '.$result['state'].' '.$result['zipcode'].' '.$result['county'];
				}else{
					$address = '';
				}
	?>
			<tr class="content">
				<td class="cont_tab2"><?php echo $result['MLS']; ?></td>
				<td class="cont_tab2"><?php echo $result['agent_name']; ?></td>
				<td class="cont_tab3"><a target="_blank" href="<?php echo get_bloginfo('url')."/viewproperty.php?mls=".$result['MLS']; ?>"><?php echo $address; ?></td>
				<td class="cont_tab3"><input type="checkbox" name="optval1[]" id="optval1" value=<?php echo $result['MLS']; ?> ></td>
			</tr>
		

			<?php }
			?>
				</tbody>
				
				
				</table>
				<p class="submit">
					<input type="submit" value="Add to Featured Listings" name="save" class="button-primary" />
				</p>
				
				</form>	
			<?php 
		}else{ ?>
			No Result
		<?php 
			
		}
	
?>