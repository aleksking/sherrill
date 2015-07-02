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
		if (!$con)
		  {
		  die('Could not connect: ' . mysql_error());
		  }
		  mysql_select_db($db_name, $con);
	 $sql = "select * from ntreislist where agentlist = '".$_REQUEST['data']."'";
	$agent = mysql_query($sql);	 
	$count = mysql_num_rows($agent);
	
	$agent_d = "select Name from agents where agent_license_no = '".$_REQUEST['data']."'";
	$agent_detail = mysql_query($agent_d);	  
	$agent_details = mysql_fetch_assoc($agent_detail);
	// echo "<pre>"; print_r($agent_details);
	while($row = mysql_fetch_assoc($agent)){
		$agent_ls[] = $row;
	}
	// echo "<pre>";print_r($agent_ls);
	$sql1 = "select Name,agent_id,agent_license_no from agents where agent_offcode = '".$agent_offcode."' and agent_license_no not in (".$agent_ls[0]['agentlist'].")";
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
	
	// $sql = "DELETE FROM agents WHERE agent_license_no = '".$_REQUEST['data']."'";
	// $res2 = mysql_query($sql); 
	
	//mysql_close($con);
	
	// Reset DB Conn
	mysql_select_db(DB_NAME);
?>
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js'></script>
    <script>
	$(function() {
	$("#transfer").val($("#transfer option:first").val());

	   $('#c_b input').click(updateTextArea);
	   updateTextArea();
	 });
	function updateTextArea() {
		 var allVals = [];
		 $('#c_b :checked').each(function() {
		   allVals.push($(this).val());
		 });
		 var leng = $(allVals).length;
		 // alert(leng);
		 $('#r_overall').val(leng)
		 $('#t').val(allVals)
	}

		function cancel(){
			location.reload();
		}
		function reassigning(){
		 	var transfer = $('#t').val();
			var transferring = $('#transfer').val();
			var r_over = $('#r_over').val();
			var r_overall = $('#r_overall').val();
			transferring = transferring.toString();			
			var fields = transferring.split("~");
			// var datas = 'agent='+'<?php echo $_REQUEST['data']; ?>'+'&transfer='+transfer;
			var datas = 'agent='+fields[0]+'&transfer='+transfer+'&agent_id=<?php echo $_REQUEST['data']; ?>'+'&r_over='+r_over;
			//alert(transfer);
			if(r_over == r_overall){
				var r=confirm("Are you sure want to delete Listings and agent?");
				$.ajax({
				  url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/agent_listings/reassiging.php",
				  data: datas,
				}).done(function(res) {  
					alert('Deleted Successfully');
					location.reload();
				});
			}else{
				$.ajax({
				  url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/agent_listings/reassiging.php",
				  data: datas,
				}).done(function(res) { 
					$('#r_over').val(res);
					$('.counting').html(res);
					alert('successfully Reassinged');
					$('#c_b :checked').each(function() {
						$('#'+$(this).val()).remove();
					 });
				});
			}
		}
		
		function delete_agent(){
			var datas = 'agent='+'<?php echo $_REQUEST['data']; ?>';
			$.ajax({
				  url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/agent_listings/deleting.php",
				  data: datas,
				}).done(function(res) {  
					alert('Deleted successfully');
					// $('.list-wrap').html(res);
					location.reload();
				});
		}
    </script>
<?php echo $agent_details['Name']; ?> has <strong><div class="counting"><?php echo $count; ?></div></strong> number listings
	
	<input type="hidden" id="r_over" value="<?php echo $count; ?>"/>
	<input type="hidden" id="r_overall" value=""/>
			<!--<select name="type" id="mls">
				<?php
						foreach($agent_ls as $lists){
							echo '<option value="'.$lists['MLS'].'" >MLS# '.$lists['MLS'].' '.$lists['city'].'</option>';
						}
				?></select>-->
<br clear="all" /><br />
<table id="mytable">
	<tbody>
	<tr class="heading">
		<th class="cont_tab2">MLS</th>
		<th class="cont_tab2">Agent Name</th>
		<th class="cont_tab1">Address</th>
		<th class="cont_tab1">Reassign Listings</th>
	</tr>
	<?php
	foreach($agent_ls as $result){
		if($result['is_manual_edit'] == 1){
			$address = $result['directions'].'<br />'.$result['city'].', TX '.$result['state'].' '.$result['zipcode'].'<br />'.$result['county'].' county';
		}else if($result['is_manual_edit'] == 0 || $result['is_manual_edit'] == 2){
			$address = $result['street_num'].' '.$result['street_name'].' '.$result['street_type'].' '.$result['city'].' '.$result['state'].' '.$result['zipcode'].' '.$result['county'];
		}else{
			$address = '';
		}
	?>
		<tr class="content" id="<?php echo $result['MLS']; ?>">
			<div >
				<td class="cont_tab2"><?php echo $result['MLS']; ?></td>
				<td class="cont_tab2"><?php echo $result['agent_name']; ?></td>
				<td class="cont_tab3"><a target="_blank" href="<?php echo get_bloginfo('url')."/viewproperty.php?mls=".$result['MLS']; ?>"><?php echo $address; ?></td>
				<td class="cont_tab3"><div id="c_b"><input type="checkbox" name="optval1[]" id="optval1" onclick="updateTextArea();" value=<?php echo $result['MLS']; ?> ></div></td>
			</div>
		</tr>
	<?php }
	?>
		</tbody>
</table>
Re-Assign this Agents listing to: <select name="type" id="transfer">
				<?php
						foreach($new_list as $lists){
							echo '<option selected="selected" value="'.$lists['agent_license_no'].'~'.$lists['name'].'" >ID# '.$lists['agent_license_no'].' - '.$lists['name'].'</option>';  
						}
				?></select><br clear="all" /><br />
<input type="hidden" id="t" value="" />
<button type="button" onclick="reassigning();">Re-Assign</button>  
<button type="button" onclick="delete_agent();">Delete</button>  
<button type="button" onclick="cancel();">cancel</button>  