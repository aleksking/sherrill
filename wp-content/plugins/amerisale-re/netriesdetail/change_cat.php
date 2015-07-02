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
	$con = mysql_connect($db_ip,$db_user,$db_pass);
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db($db_name, $con);
	
	
	$mls = $_REQUEST['mls'];
	$sql = "select * from ntreislist where MLS = '".$mls."'";
	// $agent = $wpdb->get_results($sql);
	$agent = mysql_query($sql); 
	$agent_ls = mysql_fetch_assoc($agent);
	
	// echo "<pre>";print_r($agent_ls);
	$listin = array('Residential'=>'Residential','Commercial'=>'Commercial','Multi-Family'=>'Multi-Family','Lots and Acreage'=>'Lots and Acreage');
	$proptype = $agent_ls['proptype'];
	$agentlist = $agent_ls['agentlist'];
	$MLS = $agent_ls['MLS'];
	$cities = $agent_ls['city']." ,".$agent_ls['state'];
	$address = $agent_ls['street_num']." ".$agent_ls['street_num']." ".$agent_ls['street_typ']." ".$agent_ls['county'];
	
	$sqls = "select Name from agents where agent_id = '".$agentlist."'";
	$agent = mysql_query($sqls);
	$Aname = mysql_fetch_assoc($agent);
	$Name = $Aname['Name'];
	
	mysql_close($con); 		
	
?>
    <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js'></script>
    <script>
			$(function() {
				$('.current').click(function() {
				  $('.list-wraps').html('Loading..........');
				   // $('#example-two').show();
				   location.reload();

				  // $('.list-wraps').load('<?php echo plugins_url(); ?>/netriesdetail/loading.php');
				});
			});
			function changes(){
				var types = $('#types').val();
				var datas = 'mls='+'<?php echo $mls; ?>'+'&type='+types;
				$.ajax({
					  url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/netriesdetail/change_cats.php",
					  data: datas
					}).done(function(res) {  
						alert(res);
						// $('.list-wrap').html(res);
					});
			}	
	</script>
	<div class="current"><input type="button" value="Go Back" /> </div><br clear="all" /><br />

<style>
.tables{
	background-color:#C9C9C9;
	width:400px;
	height:265px;
	border:1px solid #2D2D2D;font-family: helvetica;
}
.change{border-bottom: 1px solid #2D2D2D;
    font-size: 14px;
    padding: 5px;
    text-align: center;font-weight: bold}
.labels{border: 1px solid #2D2D2D;
    float: left;
    font-size: 14px;
    font-weight: bold;
    padding: 5px;
    text-align: right;
    width: 190px;height: 17px;}
.items span{color:#B4171E;font-weight: bold}
.items{float: left;
    padding: 5px;
    width: 186px;border:1px solid #2D2D2D;	background-color:#FEFEFE;height: 17px;}
</style>
	<?php 
	if(!empty($agent_ls)){
	?>
		
<div class="tables">
	<div class="change">Change Listing Category</div>
	<div class="labels">Agent:</div><div class="items"><span><?php echo $agentlist; ?></span> <strong><?php echo $Name; ?></strong></div>
	<div class="labels">Listing ID:</div><div class="items"><span><?php echo $MLS; ?></span></div>
	<div class="labels">Address:</div><div class="items"><?php echo $address; ?></div>
	<div class="labels">City State:</div><div class="items"><?php echo $cities; ?></div>
	<div class="labels">Current Category:</div><div class="items"><?php echo $proptype; ?></div>
	<div class="labels">Select New Category:</div><div class="items">
					<select name="type" id="types">
				<?php
						foreach($listin as $lists){
							echo '<option '.($proptype == $lists ? ' selected="selected " ' : '').' value="'.$lists.'" >'.$lists.'</option>';  
						}
				?></select></div>
				<br clear="all" /><br />
			<button type="button" onclick="changes();" style="margin: auto; display: block;">Change</button> 
</div>


<?php
	}else{
		echo "There is no records in this Agent.";
	}
 ?>
