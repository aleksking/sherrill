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
		
			// echo "<pre>";print_r($agentsql);
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
		
		$phone_number = explode('-',$phone_number);
		$voicemail = explode('-',$voicemail);
		$home_phone = explode('-',$home_phone);
		$pager = explode('-',$pager);
		$tollfree = explode('-',$tollfree);
		$officephone = explode('-',$officephone);
		$fax = explode('-',$fax);
		$metro1 = explode('-',$metro1);
		$metro2 = explode('-',$metro2);
?>
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js'></script>
<script>
	function cancel(){
		$('#addagent').html('Loading..........');
		location.reload();
	}
	function validEmail(e) {
		var filter = /^\s*[\w\-\+_]+(\.[\w\-\+_]+)*\@[\w\-\+_]+\.[\w\-\+_]+(\.[\w\-\+_]+)*\s*$/;
		return String(e).search (filter) != -1;
	}

	$(document).ready(function() {				
		$('#wp_agents_options').submit(function() {
		  var fname = $('#fname').val();
		  var email = $('#eadres').val();
		  var mlsid = $('#mlsid').val();
		  var a_license = $('#a_license').val();
		  var ids = $('#ids').val();
		  if(fname == ''){
			alert('Please Enter the Name');return false;
		  }else if(!validEmail(email)){
			alert('Please Enter Valid Email');return false;
		  }else if(a_license == ''){
			alert('Please Enter the Agent License No');return false;
		  }else if(mlsid == ''){
			alert('Please Enter the Local MLS ID');return false;
		  }
		  var datas = $("#wp_agents_options").serialize();
		  // alert(datas);return false;
		  $.ajax({
				  url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/agent_listings/save_agent.php",
				  data: datas,
				}).done(function(res) { 
					if(ids){
						alert('Updated Successfully');
					}else{
						alert('Added Successfully');
					}
					location.reload();
					// $('.list-wrap').html(res);
				});
		  return false;
		});
	});
</script>
<form action="" enctype="multipart/form-data" method="post" id="wp_agents_options">
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Name:</th>
				<td><label><input type="text" name="fname" id="fname" value="<?php echo $Name; ?>"></label> </td>
				<input type="hidden" name="ids" id="ids" value="<?php echo $id; ?>">
			</tr>
		</table>
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Email Address:</th>
				<td><label><input class="textlnk2" type="text" name="eadres" id="eadres" value="<?php echo $email_address; ?>"></label> </td>
			</tr>
		</table>
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Office Phone:</th>
				<td><label>(<input type="text" size="4" maxlength="3" value="<?php echo trim($officephone[0]); ?>"  name="AC1" />)</label>
				<label><input type="text" size="4" maxlength="3" value="<?php echo trim($officephone[1]); ?>"  name="Prefix1">-</label>
				<label><input type="text" size="5" maxlength="4" value="<?php echo trim($officephone[2]); ?>"  name="Number1"></label></td>
			</tr>
		</table>
		
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Metro #1:</th>
				<td>
					(<input type="text" size="4" maxlength="3" value="<?php echo trim($metro1[0]); ?>" name="AC8">)
						&nbsp;<input type="text" size="4" maxlength="3" value="<?php echo trim($metro1[1]); ?>" name="Prefix8">-
						&nbsp;<input type="text" size="5" maxlength="4" value="<?php echo trim($metro1[2]); ?>" name="Number8">
				</td>
			</tr>
		</table>
		
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Metro #2:</th>
				<td>
					(<input type="text" size="4" maxlength="3" value="<?php echo trim($metro2[0]); ?>" name="AC9">)
						&nbsp;<input type="text" size="4" value="<?php echo trim($metro2[1]); ?>" maxlength="3" name="Prefix9">-
						&nbsp;<input type="text" size="5" value="<?php echo trim($metro2[2]); ?>" maxlength="4" name="Number9">
				</td>
			</tr>
		</table>
		
		<table class="form-table">
			<tr>
            <th align="right" valign="top">FAX Phone:</th>
            <td>
                
                        (<input type="text" size="4" maxlength="3"  value="<?php echo trim($fax[0]); ?>" name="AC2">)
                        &nbsp;<input type="text" size="4" maxlength="3" value="<?php echo trim($fax[1]); ?>" name="Prefix2">-
                        &nbsp;<input type="text" size="5" maxlength="4" value="<?php echo trim($fax[2]); ?>" name="Number2">
                
            </td>
        </tr>
		</table>
		<table class="form-table">
			<tr>
            <th align="right" valign="top">Toll Free Phone:</th>
            <td>
            
                        (<input type="text" size="4" maxlength="3" value="<?php echo trim($tollfree[0]); ?>" name="AC3">)
                        &nbsp;<input type="text" size="4" maxlength="3" value="<?php echo trim($tollfree[1]); ?>" name="Prefix3">-
                        &nbsp;<input type="text" size="5" maxlength="4" value="<?php echo trim($tollfree[2]); ?>" name="Number3">
                
            </td>
        </tr>
		<table class="form-table">
			<tr>
            <th align="right" valign="top">Pager Number:</th>
            <td>
            
                        (<input type="text" size="4" maxlength="3" value="<?php echo trim($pager[0]); ?>" name="AC4">)
                        &nbsp;<input type="text" size="4" maxlength="3" value="<?php echo trim($pager[1]); ?>"  name="Prefix4">-
                        &nbsp;<input type="text" size="5" maxlength="4" value="<?php echo trim($pager[2]); ?>" name="Number4">
                
            </td>
        </tr>
		</table>
		<table class="form-table">
			<tr>
            <th align="right" valign="top">Mobile Phone:</th>
            <td>
                
                        (<input type="text" size="4" maxlength="3" value="<?php echo trim($phone_number[0]); ?>" name="AC5">)
                        &nbsp;<input type="text" size="4" maxlength="3" value="<?php echo trim($phone_number[1]); ?>" name="Prefix5">-
                        &nbsp;<input type="text" size="5" maxlength="4" value="<?php echo trim($phone_number[2]); ?>" name="Number5">
                
            </td>
        </tr>
		</table>
		<table class="form-table">
			<tr>
            <th align="right" valign="top">Voice Mail:</th>
            <td>
            
                        (<input type="text" size="4" maxlength="3" value="<?php echo trim($voicemail[0]); ?>" name="AC6">)
                        &nbsp;<input type="text" size="4" maxlength="3" value="<?php echo trim($voicemail[1]); ?>" name="Prefix6">-
                        &nbsp;<input type="text" size="5" maxlength="4" value="<?php echo trim($voicemail[2]); ?>" name="Number6">-
						&nbsp;<input type="text" size="5" maxlength="4" value="<?php echo trim($voicemail[3]); ?>" name="VoiceMailExtension">
                
            </td>
        </tr>
		</table>
		
		<table class="form-table">
			<tr>
            <th align="right" valign="top">Home Phone:</th>
            <td>
            
                        (<input type="text" size="4" maxlength="3" value="<?php echo trim($home_phone[0]); ?>"  name="AC7">)
                        &nbsp;<input type="text" size="4" maxlength="3" value="<?php echo trim($home_phone[1]); ?>"  name="Prefix7">-
                        &nbsp;<input type="text" size="5" maxlength="4" value="<?php echo trim($home_phone[2]); ?>"  name="Number7">
                
            </td>
        </tr>
		</table>
		
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Agent License No:</th>
				<td><label><input type="text" name="a_license" id="a_license" value="<?php echo $agent_license_no; ?>"></label> </td>
			</tr>
		</table>
		
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Local MLS ID:</th>
				<td><label><input type="text" name="mlsid" id="mlsid" value="<?php echo $agent_id; ?>"></label> </td>
			</tr>
		</table>
		
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Web Link:</th>
				<td><label><input class="textlnk1" type="text" name="alk" id="alk" value="<?php echo $Agent_link; ?>" ></label> </td>
			</tr>
		</table>
		
		
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Description:</th>
				<td><label><textarea rows="8" cols="100" name="adsc" id="adsc"><?php echo $agent_desc; ?></textarea>
				</label> </td>
			</tr>
		</table>

		<table class="form-table">
			<tr valign="top">
				<th scope="row"></th>
				<td><!--<input class="textlnk_file" type="file" name="file" id="file" /> -->
					<iframe scrolling="no" height="57px" frameborder="0" vspace="0" hspace="0" src="<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/agent_listings/upload.php" name="frame" id="frame" class="image_iframe"></iframe>
				<?php 
					if($photo=='imgres.png')
						echo	"<img style='width:100px;' src=\"".plugins_url().'/'.$plugin_dir.'/upload/'.$photo."\" id='show_url' class='image_f'>";
					else
						echo	"<img style='width:100px;' src=\"".$photo."\" id='show_url' class='image_f'>";
				?>
				
				
				<input type="hidden" value="<?php echo $photo; ?>" id="image_computer" name="image_computer">
				</td>
			</tr>
		</table>
		
		<p class="submit">
			<input type="submit" value="Submit" name="save" class="button-primary" />
		</p>
		
		<p class="submit">
			<input type="button" value="Cancel" name="Cancel" onclick="cancel();" class="button-primary" />
		</p>
		
</form>