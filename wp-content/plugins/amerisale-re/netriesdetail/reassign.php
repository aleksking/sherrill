<?php
	include_once("../../../../wp-config.php");
	global $wpdb;
	$mls = $_REQUEST['mls'];
	$agent = $_REQUEST['agent'];
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
	
	
	// $sql = "select * from ntreislist where agentlist = '".$_REQUEST['agent']."'";
	$sql = "select * from ntreislist where MLS = '".$_REQUEST['mls']."'";
	$agent = mysql_query($sql); 
	// $agent_ls = mysql_fetch_assoc($agent);
	$agent_ls = mysql_fetch_assoc($agent);
	/* while($row = mysql_fetch_assoc($agent)){
		$agent_ls[] = $row;
	} */
	// $c_o_agent = count($agent_ls);
	
	$sql1 = "select Name,agent_id,agent_license_no from agents where agent_offcode = '".$agent_offcode."' and agent_license_no not in (".$agent_ls['agentlist'].")";
	$sqls = mysql_query($sql1); 
	while($row = mysql_fetch_assoc($sqls)){
		$e_agent_l[] = $row;
	}
	// echo "<pre>"; print_r($e_agent_l);
	$new_list = array();
	foreach($e_agent_l as $key=>$agents){
		if($agent == $agents['agent_license_no']){
			$already = $agents['Name'];
		}else{
			$new_list[$key]['agent_license_no'] = $agents['agent_license_no'];
			$new_list[$key]['name'] = $agents['Name'];
		}
	}
	
	// echo "<pre>";print_r($agent_ls);
	/* foreach($agent_ls as $lists){
		echo "<pre>";print_r($lists->MLS);
			// echo '<option value="'.$lists.'" >MLS#'.$lists->MLS.'</option>';  
		} */
?>
    <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js'></script>
    <script>
		function cancel(){
			location.reload();
		}
		function reassigning(){
			var transfer = $('#transfer').val();
			var datas = 'agent='+'<?php echo $_REQUEST['agent']; ?>'+'&transfer='+transfer;
			// alert(datas);
			$.ajax({
				  url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/netriesdetail/reassiging.php",
				  data: datas
				}).done(function(res) {  
					alert('Tranferred successfully');
					// $('.list-wrap').html(res);
					location.reload();
				});
		}
    </script>
	Listing <strong><?php echo $_REQUEST['mls']; ?></strong> -  
	is presently assigned to Agent <strong><?php echo $_REQUEST['agent']; ?></strong> - <?php echo $agent_ls['agent_name']; ?>
	<br clear="all" /><br />
	You may reassign this listing to another agent by <br clear="all" />
selecting the new agent from the pull down menu and click the Re-Assign button<br clear="all" />
			<!--<select name="type" id="mls">
				<?php
						foreach($agent_ls as $lists){
							echo '<option value="'.$lists['MLS'].'" >MLS# '.$lists['MLS'].' '.$lists['city'].'</option>';
						}
				?></select>-->
<br clear="all" /><br />
Re-Assign this Agents listing to: <select name="type" id="transfer">
				<?php
						foreach($new_list as $lists){
							echo '<option value="'.$_REQUEST['mls'].'~'.$lists['agent_license_no'].'~'.$lists['name'].'" >ID# '.$lists['agent_license_no'].' - '.$lists['name'].'</option>';  
						}
				?></select><br clear="all" /><br />
<button type="button" onclick="reassigning();">Re-Assign</button>  
<button type="button" onclick="cancel();">cancel</button>  