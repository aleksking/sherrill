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
	$con = mysql_connect($db_ip,$db_user,$db_pass);
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db($db_name, $con);
	
	
	$sql = "select * from ntreislist where agentlist = '".$agent."'";
	$agent = mysql_query($sql); 
	// $agent_ls = mysql_fetch_assoc($agent);
	while($row = mysql_fetch_assoc($agent)){
		$agent_ls[] = $row;
	}
	$c_o_agent = count($agent_ls);
	
	$sql1 = "select Name,agent_id from agents ";
	$sqls = mysql_query($sql1); 
	while($row = mysql_fetch_assoc($sqls)){
		$e_agent_l[] = $row;
	}
	// echo "<pre>"; print_r($agent_ls);
	$new_list = array();
	foreach($e_agent_l as $key=>$agents){
		if($agent == $agents['agentlist']){
			$already = $agents['Name'];
		}else{
			$new_list[$key]['agentlist'] = $agents['agentlist'];
			$new_list[$key]['name'] = $agents['Name'];
		}
	}
	// echo "<pre>";print_r($e_agent_l);
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
			var datas = 'agent='+'<?php echo $agent; ?>'+'&transfer='+transfer;
			$.ajax({
				  url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/netriesdetail/reassiging.php",
				  data: datas,
				}).done(function(res) {  
					alert('Tranferred successfully');
					// $('.list-wrap').html(res);
					location.reload();
				});
		}
    </script>
Agent: <?php echo $agent; ?>- <?php echo $already; ?> has <?php echo $c_o_agent; ?>
			<select name="type" id="mls">
				<?php
						foreach($agent_ls as $lists){
							echo '<option value="'.$lists['MLS'].'" >MLS# '.$lists['MLS'].' '.$lists['city'].'</option>';
						}
				?></select>
<br clear="all" /><br />
ReAssign this agent's listings to (select): <select name="type" id="transfer">
				<?php
						foreach($new_list as $lists){
							echo '<option value="'.$lists['agentlist'].'" >ID# '.$lists['name'].'</option>';  
						}
				?></select><br clear="all" /><br />
<button type="button" onclick="reassigning();">Re-Assign</button>  
<button type="button" onclick="cancel();">cancel</button>  