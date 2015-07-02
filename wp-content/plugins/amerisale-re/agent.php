<div class="icon32" id="icon-options-general"><br/></div>
<h2>Amerisale RE</h2><br clear="all" />
<div class="wrap">
<div id="example-one">
<h2> Agents List </h2><br clear="all" />
<script>
		function add_agent(){ 
			$('#addagent').html("Loading................");
			$('#addagent').load("<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/agent_listings/add_agent.php");
		}
		
		function del_agent(){
			var ids = $('#Select1').val();
			// alert(ids);
			if(ids == null){
				alert('Please Select any one of the Agent!....');
				return false;
			}
			ids = ids.toString();			
			var fields = ids.split("-");
			var r=confirm("Are you sure you want to delete ("+fields[1]+")");
			if (r==true){
				$('#addagent').html("Loading................");
			  	$.ajax({
				 url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/agent_listings/delete_agent.php",
				  data: 'data='+fields[0],
				}).done(function(res) { 
					// alert('Delete successfully');
					// location.reload();
					$('#addagent').html(res);
					}
								
				);
				}
			}
		
		function view_ifo(){
			var ids = $('#Select1').val();
			// alert(ids);
			if(ids == null){
				alert('Please Select any one of the Agent!....');
				return false;
			}
			ids = ids.toString();			
			var fields = ids.split("-");
			$('#addagent').html("Loading................");
			$('#addagent').load("<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/agent_listings/edit_agent.php?data="+fields[0]);
			
		}
		
		function all_list(){
			$('#addagent').html("Loading................");
			$('#addagent').load("<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/agent_listings/view_all_agents.php");
		}
		
		function view_list_ifo(){
			var ids = $('#Select1').val();
			// alert(ids);
			if(ids == null){
				alert('Please Select any one of the Agent!....');
				return false;
			}
			ids = ids.toString();			
			var fields = ids.split("-");
			$('#addagent').html("Loading................");
			$('#addagent').load("<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/agent_listings/view_listing.php?data="+fields[0]);
		}
		
	</script>
<div class="list-wrap">
	<ul id="addagent">
		<?php
			// global $wpdb;
			// echo "agent_offcode".$agent_offcode;
			$con = mysql_connect($db_ip,$db_user,$db_pass);
		if (!$con)
		  {
		  die('Could not connect: ' . mysql_error());
		  }
		  mysql_select_db($db_name, $con);
		  $agent = "select id,Name,agent_license_no,agent_id from agents where agent_offcode = '".$agent_offcode."' ORDER BY Name ";
		$agent_data = mysql_query($agent);
		$agents = array();
		while($row = mysql_fetch_assoc($agent_data)){
			$agents[] = $row;
		}
		//mysql_close($commcon);
		
		// Reset DB Conn
		mysql_select_db(DB_NAME);
		
		// echo "<pre>";print_r($agents);die;
			// $sql = "select Name,agent_license_no,agent_id from ".$wpdb->prefix."agents ORDER BY Name ";
			// $results = $wpdb->get_results($sql);
			// echo "<pre>";print_r($results);
		?>
		<select name="drop1" id="Select1" size="4" multiple="multiple" style="width: 400px; height: 400px;">
		<?php 
			//
			
			foreach($agents as $agent)
			{
				// echo '<option value="'.$agent['agent_license_no'].'">"ID# :'.$agent['agent_id'].' - '.$agent['Name'].'"</option>';
				echo '<option value="'.$agent['agent_license_no'].'-'.$agent['Name'].'">"ID# :'.$agent['agent_license_no'].' - '.$agent['Name'].'"</option>';
			}
		?>
	</select><br clear="all" /><br />
	<button type="button" onclick="add_agent();">+Add Agent</button>
	<button type="button" onclick="view_ifo();">Edit Agent</button> 
	<button type="button" onclick="del_agent();">-Delete Agent</button> 
	<button type="button" onclick="view_list_ifo();">View Information</button>	
	<button type="button" onclick="all_list();">List All Agents</button> 
	</ul>
	
	
</div>	
</div>
</div>