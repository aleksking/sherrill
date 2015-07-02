<?php global $wpdb; ?>
<link rel="stylesheet" href="<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/css/style.css">
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js'></script>

<div class="icon32" id="icon-options-general"><br/></div>
<h2>Amerisale RE</h2><br clear="all" />
<div class="wrap">
<h2>Account Details</h2>
<a class="menus" href="<?php echo $url ;?>admin.php?page=account">View</a>
<a class="menus" href="<?php echo $url ;?>/admin.php?page=account&name=add">Add</a>
<br clear="all" /><br />
	<?php
	
	if(isset($_REQUEST['agent_offcode'])){
		$agent_id = $_REQUEST['agent_id'];
		if(!empty($agent_id)){
		// echo "<pre>";print_r($_REQUEST);die;
			$username = $_REQUEST['agent_username'];
			$password = base64_encode($_REQUEST['agent_password']);
			$lgurl = $_REQUEST['agent_loginurl'];
			$ofcde = $_REQUEST['agent_offcode'];
			$sql1="update ".$wpdb->prefix."agentaccount set agent_username = '".$username."', agent_password = '".$password."', agent_loginurl = '".$lgurl."', agent_offcode = '".$ofcde."', db = '".$_REQUEST['db_name']."', db_user = '".$_REQUEST['db_user']."', password = '".$_REQUEST['db_password']."', host = '".$_REQUEST['db_host']."' where agent_id = ".$agent_id." ";
			$res2 =  $wpdb->query($sql1);
		}else{
			$username = $_REQUEST['agent_username'];
			$password = base64_encode($_REQUEST['agent_password']);
			$lgurl = $_REQUEST['agent_loginurl'];
			$ofcde = $_REQUEST['agent_offcode'];
			$sql1="insert into ".$wpdb->prefix."agentaccount (agent_username,agent_password,agent_loginurl,agent_offcode,db,db_user,password,host) values ('".$username."', '".$password."', '".$lgurl."', '".$ofcde."', '".$_REQUEST['db_name']."', '".$_REQUEST['db_user']."', '".$_REQUEST['db_password']."', '".$_REQUEST['db_host']."') ";
			$res2 =  $wpdb->query($sql1);
		}		
	}
	
	if(isset($_REQUEST['id'])){
		$sql = "SELECT * FROM ".$wpdb->prefix."agentaccount WHERE agent_id=".$_REQUEST['id']."  ";
		$results = $wpdb->get_results($sql);
		?>
		<form action="" method="post">
			<div class="postbox" id="linkadvanceddiv">
				<div class="inside" style="float: left; width: 98%; clear: both;">
					<legend>User Name: </legend>
					<input type="hidden" name="agent_id" value="<?php echo $results[0]->agent_id; ?>" /> 
					<input type="text" name="agent_username" value="<?php echo $results[0]->agent_username; ?>" /> 
					<legend>Password : </legend>
					<input type="password" name="agent_password" value="<?php echo base64_decode($results[0]->agent_password); ?>" />
					<legend>URL : </legend>
					<input type="text" name="agent_loginurl" value="<?php echo $results[0]->agent_loginurl; ?>" />
					
					<legend>Office Code : </legend>
					<input type="text" name="agent_offcode" value="<?php echo $results[0]->agent_offcode; ?>" />
					
					
					<legend>DB Name : </legend>
					<input type="text" name="db_name" value="<?php echo $results[0]->db; ?>" />
					<legend>DB User : </legend>
					<input type="text" name="db_user" value="<?php echo $results[0]->db_user; ?>" />
					<legend>DB Pasword : </legend>
					<input type="text" name="db_password" value="<?php echo $results[0]->password; ?>" />
					<legend>DB Host : </legend>
					<input type="text" name="db_host" value="<?php echo $results[0]->host; ?>" />
				</div>
				<div style="clear:both; height:1px;">&nbsp;</div>
			</div>
			<input type="submit" value="Edit" class="button bold" name="save">
		</form>
		<?php 
	}else if(isset($_REQUEST['name'])){
	?>
		<form action="" method="post">
			<div class="postbox" id="linkadvanceddiv">
				<div class="inside" style="float: left; width: 98%; clear: both;">
					<legend>User Name: </legend>
					<input type="hidden" name="agent_id" value="" /> 
					<input type="text" name="agent_username" value="" /> 
					<legend>Password : </legend>
					<input type="password" name="agent_password" value="" />
					<legend>Office Code : </legend>
					<input type="text" name="agent_loginurl" value="" />
					
					<legend>URL : </legend>
					<input type="text" name="agent_offcode" value="" />
					
					
					<legend>DB Name : </legend>
					<input type="text" name="db_name" value="" />
					<legend>DB User : </legend>
					<input type="text" name="db_user" value="" />
					<legend>DB Pasword : </legend>
					<input type="text" name="db_password" value="" />
					<legend>DB Host : </legend>
					<input type="text" name="db_host" value="" />
				</div>
				<div style="clear:both; height:1px;">&nbsp;</div>
			</div>
			<input type="submit" value="Edit" class="button bold" name="save">
		</form>
	<?php	
	}else{

?>
<?php 
	$sql = "SELECT * FROM ".$wpdb->prefix."agentaccount";
	//$query = $wpdb->prepare($sql);
	$res = $wpdb->get_results($sql);
?>
<table id="mytable">
	<tbody>
		<tr class="heading">
			<th class="cont_tab2">User Name</th>
			<!--<th class="cont_tab2">Password</th>-->
			<th class="cont_tab2">Login Url</th>
			<th class="cont_tab1">Office Code</th>
			<th class="cont_tab1">Db Name</th>
			<th class="cont_tab1">Db User</th>
			<th class="cont_tab1">Password</th>
			<th class="cont_tab1">Host Name</th>
			<th class="cont_tab1">Edit</th>
		</tr>
		<tr class="heading">
			<td class="cont_tab2"><?php echo $res[0]->agent_username ?></td>
			<!--<td class="cont_tab2"><?php echo $res[0]->agent_password ?></td>-->
			<td class="cont_tab3"><?php echo $res[0]->agent_loginurl ?></td>
			<td class="cont_tab2"><?php echo $res[0]->agent_offcode ?></td>
			<td class="cont_tab2"><?php echo $res[0]->db ?></td>
			<td class="cont_tab2"><?php echo $res[0]->db_user ?></td>
			<td class="cont_tab2"><?php echo $res[0]->password ?></td>
			<td class="cont_tab2"><?php echo $res[0]->host ?></td>
			<td class="cont_tab2"><a href="<?php echo $url ;?>/admin.php?page=account&id=<?php echo $res[0]->agent_id ?>">Edit</a></td>
			
		</tr>
	</tbody>
</table>
<br clear="all" />
<div>Cron Links.</div>
<table id="mytable">
	<tbody>
		<tr class="heading">
			<!--<th class="cont_tab2">Austin Cron Configuration</th>
			<th class="cont_tab2">Austin Initial Cron Url</th>
			<th class="cont_tab2">Austin Daily Cron Url</th>-->
			<th class="cont_tab1">Ntreis Rets Initial cron Url</th>
			<th class="cont_tab1">Ntreis Rets Daily cron Url</th>
			<th class="cont_tab1">Image cron Url</th>
		</tr>
		<tr class="heading">
			<!--<td class="cont_tab2"><a href="<?php echo get_bloginfo('url'); ?>/austin_maping_config.php" target="_blank">Austin Configuration</a></td>
			<td class="cont_tab2"><a href="<?php echo get_bloginfo('url'); ?>/property_crons.php?type=austin&mode=init" target="_blank">Initial Austin Cron </a></td>
			<td class="cont_tab2"><a href="<?php echo get_bloginfo('url'); ?>/property_crons.php?type=austin" target="_blank">Daily Austin Cron </a></td>-->
			<td class="cont_tab2"><a href="<?php echo get_bloginfo('url'); ?>/property_crons.php?type=init&mode=init" target="_blank">Initial Rets Cron</a></td>
			<td class="cont_tab2"><a href="<?php echo get_bloginfo('url'); ?>/property_crons.php" target="_blank">Daily Rets Cron</a></td>
			<td class="cont_tab2"><a href="<?php echo get_bloginfo('url'); ?>/property_crons.php?type=image" target="_blank">Image Cron</a></td>
		</tr>
	</tbody>
</table>
<?php } ?>
</div>