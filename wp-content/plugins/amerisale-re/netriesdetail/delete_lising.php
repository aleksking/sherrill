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
	$rets_area = $results[0]->rets_area;
	 if($rets_area != null || $rets_area != ''){//if mls 
		$WHERE_0fficelist = " officelist = '".$agent_offcode."' AND (rets_area = '".$rets_area."' OR rets_area = 'manual_".$agent_offcode."') "; 
	  }else{ //manual only
			$WHERE_0fficelist = " officelist = '".$agent_offcode."' AND  rets_area = 'manual_".$agent_offcode."' "; 
	  }
	$con = mysql_connect($db_ip,$db_user,$db_pass);
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db($db_name, $con);
	
	$sql = "UPDATE `ntreislist` SET  `delete_status` =  '1' WHERE  `ntreislist`.`MLS` =".$_REQUEST['mls']." AND ".$WHERE_0fficelist."  ";
	
	$res2 = mysql_query($sql); 

?>
<script>
	function go_back(){
		$('.list-wraps').html('Loading..........');
		location.reload();
	}
	function submitform(){
		var dont_overwrite = $('#dont_overwrite').prop('checked');
		if(dont_overwrite){
			$.ajax({
			  url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/netriesdetail/overwrite.php",
			  data: 'mls=<?php echo $_REQUEST['mls']; ?>',
			}).done(function(res) {
				// alert(res);
				// return false;
				location.reload();
			});
		}else{
			alert('Please Check the checkbox....');return false;
		}
		// alert(dont_overwrite);return false;
	}
</script>
<input type="button" value="Go Back" onclick="go_back();" /><br clear="all" /><br />
<form method="post" id="retrive" onsubmit="return submitform();">
	<input type="checkbox" name="dont_overwrite" id="dont_overwrite" value="0" /> Do not overwrite from MLS in future<br clear="all" /><br />
	<input type="submit" value="Submit" class="button-primary" />
</form>