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
		if (!$con)
		  {
		  die('Could not connect: ' . mysql_error());
		  }
		  mysql_select_db($db_name, $con);
	
		$sql = "SELECT * FROM agents WHERE `agent_license_no` = '".$_REQUEST['data']."'";
		$agent = mysql_query($sql); 
		$agentsql = mysql_fetch_assoc($agent);
		mysql_close($con);
		
		$id = $agentsql['id'];
		$agent_license_no = $agentsql['agent_license_no'];
		$Name = $agentsql['Name'];
		$email_address = $agentsql['email_address'];
		$phone_number = $agentsql['phone_number'];
		$agent_id = $agentsql['agent_id'];
		$photo = $agentsql['photo'];
		$Agent_link = $agentsql['Agent_link'];
		$agent_desc = $agentsql['agent_desc'];
		$officephone = $agentsql['officephone'];
		$metro1 = $agentsql['metro1'];
		$metro2 = $agentsql['metro2'];
		$fax = $agentsql['fax'];
		$tollfree = $agentsql['tollfree'];
		$pager = $agentsql['pager'];
		$voicemail = $agentsql['voicemail'];
		$home_phone = $agentsql['home_phone'];
		
		/* $phone_number = explode('-',$phone_number);
		$voicemail = explode('-',$voicemail);
		$home_phone = explode('-',$home_phone);
		$pager = explode('-',$pager);
		$tollfree = explode('-',$tollfree);
		$officephone = explode('-',$officephone);
		$fax = explode('-',$fax);
		$metro1 = explode('-',$metro1);
		$metro2 = explode('-',$metro2); */
		
?>
<script type="text/javascript">
function reloadPage()
  {
  window.location.reload()
  }
  function view_list_ifo(){
		$('#addagent').html("Loading................");
		$('#addagent').load("<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/agent_listings/view_all_listing.php?data=<?php echo $agent_license_no; ?>");
	}
</script>
<button type="button" onclick="reloadPage();">Back to Home</button>
<br clear="all" /><br />

<table width="590" cellspacing="0" cellpadding="4" border="0">

	<tbody>
	<tr>
		<td colspan="4">
			<font size="1" face="Verdana, Arial, sans serif">
			<p><img width="200" hspace="6" align="right" src="<?php echo plugins_url().'/'.$plugin_dir.'/upload/'.$photo; ?>">
			<font size="3" face="Arial, sans serif"><b><?php echo $Name; ?><br></b></font>
			
			</p><p><font size="2" face="Arial, sans serif">Visit my Personal Homepage at:<br><a href="<?php echo $Agent_link; ?>" target="_blank"><?php echo $Agent_link; ?></a></font></p>
			
			<p><?php echo $agent_desc; ?></p>
			</font>
		</td>
	</tr>
	<tr>
		<td colspan="4">
			<hr noshade="">
		</td>
	</tr>

	<tr>
		<td valign="top"><font size="2" face="Verdana, Arial, sans serif"><b>My Company</b></font></td>
		<td valign="top"><font size="2" face="Verdana, Arial, sans serif"><b><a href="javascript://" onclick="javascript:view_list_ifo();" >My Listings</a></b></font></td>
		<td valign="top"><font size="2" face="Verdana, Arial, sans serif"><b>Our Home Page</b></font></td>
		<td valign="top"><font size="2" face="Verdana, Arial, sans serif"><b><a href="<?php echo $Agent_link; ?>" target="_blank">My Home Page</a></b></font></td>
	</tr>
	<tr>
		<td valign="bottom" bgcolor="#C0C0C0"><font size="2" face="Verdana, Arial, sans serif">Office</font></td>
		<td valign="bottom" bgcolor="#C0C0C0"><font size="2" face="Verdana, Arial, sans serif">&nbsp;</font></td>
		<td valign="bottom" bgcolor="#C0C0C0"><font size="2" face="Verdana, Arial, sans serif">Metro1</font></td>
		<td valign="bottom" bgcolor="#C0C0C0"><font size="2" face="Verdana, Arial, sans serif">&nbsp;</font></td>
	</tr>
	<tr>
		<td valign="top"><font size="2" face="Verdana, Arial, sans serif"><?php echo $officephone; ?></font></td>
		<td valign="top"><font size="2" face="Verdana, Arial, sans serif"></font></td>
		<td valign="top"><font size="2" face="Verdana, Arial, sans serif"><?php echo $metro1; ?></font></td>
		<td valign="top"><font size="2" face="Verdana, Arial, sans serif"></font></td>
	</tr>
	<tr>
		<td valign="bottom" bgcolor="#C0C0C0"><font size="2" face="Verdana, Arial, sans serif">Fax</font></td>
		<td valign="bottom" bgcolor="#C0C0C0"><font size="2" face="Verdana, Arial, sans serif">&nbsp;</font></td>
		<td valign="bottom" bgcolor="#C0C0C0" colspan="2"><font size="2" face="Verdana, Arial, sans serif">Email</font></td>
	</tr>
	<tr>
		<td valign="top"><font size="2" face="Verdana, Arial, sans serif"><?php echo $fax; ?></font></td>
		<td valign="top"><font size="2" face="Verdana, Arial, sans serif">&nbsp;</font></td>
		<!--<td valign="top" colspan="2"><font size="2" face="Verdana, Arial, sans serif"><a onclick="window.open('view_contact.asp?ID=16388&amp;Mode=Agent&amp;ItemName=RANDEL &quot;Rees&quot;+ATKINS','ViewContact','width=370,height=200,toolbar=no,location=no,scrollbars=no')" language="JavaScript" href="#EmailAgent" name="EmailAgent"><?php echo $email_address; ?></a></font></td>-->
		<td valign="top" colspan="2"><font size="2" face="Verdana, Arial, sans serif"><a href="mailto:<?php echo $email_address; ?>" name="EmailAgent"><?php echo $email_address; ?></a></font></td>
	</tr>
	<tr>
		<td valign="bottom" bgcolor="#C0C0C0"><font size="2" face="Verdana, Arial, sans serif">Mobile</font></td>
		<td valign="bottom" bgcolor="#C0C0C0"><font size="2" face="Verdana, Arial, sans serif">Pager</font></td>
		<td valign="bottom" bgcolor="#C0C0C0" colspan="2"><font size="2" face="Verdana, Arial, sans serif"></font></td>
	</tr>
	<tr>
		<td valign="top"><font size="2" face="Verdana, Arial, sans serif"><?php echo $phone_number; ?></font></td>
		<td valign="top"><font size="2" face="Verdana, Arial, sans serif"><?php echo $pager; ?></font></td>
		<td valign="top" colspan="2"><font size="2" face="Verdana, Arial, sans serif"></font></td>
	</tr>
</tbody></table>