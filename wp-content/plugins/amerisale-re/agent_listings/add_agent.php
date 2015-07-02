<?php
		include_once("../../../../wp-config.php");
		global $wpdb;
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
		  $.ajax({
				  url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/agent_listings/save_agent.php",
				  data: datas,
				}).done(function(res) {  
					alert('Added Successfully');
					
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
				<td><label><input type="text" name="fname" id="fname" value=""></label> </td>
			</tr>
		</table>
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Email Address:</th>
				<td><label><input class="textlnk2" type="text" name="eadres" id="eadres" value=""></label> </td>
			</tr>
		</table>
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Office Phone:</th>
				<td><label>(<input type="text" size="4" maxlength="3" name="AC1" />)</label>
				<label><input type="text" size="4" maxlength="3" name="Prefix1">-</label>
				<label><input type="text" size="5" maxlength="4" name="Number1"></label></td>
			</tr>
		</table>
		
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Metro #1:</th>
				<td>
					(<input type="text" size="4" maxlength="3" name="AC8">)
						&nbsp;<input type="text" size="4" maxlength="3" name="Prefix8">-
						&nbsp;<input type="text" size="5" maxlength="4" name="Number8">
				</td>
			</tr>
		</table>
		
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Metro #2:</th>
				<td>
					(<input type="text" size="4" maxlength="3" name="AC9">)
						&nbsp;<input type="text" size="4" maxlength="3" name="Prefix9">-
						&nbsp;<input type="text" size="5" maxlength="4" name="Number9">
				</td>
			</tr>
		</table>
		
		<table class="form-table">
			<tr>
            <th align="right" valign="top">FAX Phone:</th>
            <td>
                
                        (<input type="text" size="4" maxlength="3" name="AC2">)
                        &nbsp;<input type="text" size="4" maxlength="3" name="Prefix2">-
                        &nbsp;<input type="text" size="5" maxlength="4" name="Number2">
                
            </td>
        </tr>
		</table>
		<table class="form-table">
			<tr>
            <th align="right" valign="top">Toll Free Phone:</th>
            <td>
            
                        (<input type="text" size="4" maxlength="3" name="AC3">)
                        &nbsp;<input type="text" size="4" maxlength="3" name="Prefix3">-
                        &nbsp;<input type="text" size="5" maxlength="4" name="Number3">
                
            </td>
        </tr>
		<table class="form-table">
			<tr>
            <th align="right" valign="top">Pager Number:</th>
            <td>
            
                        (<input type="text" size="4" maxlength="3" name="AC4">)
                        &nbsp;<input type="text" size="4" maxlength="3" name="Prefix4">-
                        &nbsp;<input type="text" size="5" maxlength="4" name="Number4">
                
            </td>
        </tr>
		</table>
		<table class="form-table">
			<tr>
            <th align="right" valign="top">Mobile Phone:</th>
            <td>
                
                        (<input type="text" size="4" maxlength="3" name="AC5">)
                        &nbsp;<input type="text" size="4" maxlength="3" name="Prefix5">-
                        &nbsp;<input type="text" size="5" maxlength="4" name="Number5">
                
            </td>
        </tr>
		</table>
		<table class="form-table">
			<tr>
            <th align="right" valign="top">Voice Mail:</th>
            <td>
            
                        (<input type="text" size="4" maxlength="3" name="AC6">)
                        &nbsp;<input type="text" size="4" maxlength="3" name="Prefix6">-
                        &nbsp;<input type="text" size="5" maxlength="4" name="Number6">-
						&nbsp;<input type="text" size="5" maxlength="4" name="VoiceMailExtension">
                
            </td>
        </tr>
		</table>
		
		<table class="form-table">
			<tr>
            <th align="right" valign="top">Home Phone:</th>
            <td>
            
                        (<input type="text" size="4" maxlength="3" name="AC7">)
                        &nbsp;<input type="text" size="4" maxlength="3" name="Prefix7">-
                        &nbsp;<input type="text" size="5" maxlength="4" name="Number7">
                
            </td>
        </tr>
		</table>
		
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Agent License No:</th>
				<td><label><input type="text" name="a_license" id="a_license" value=""></label> </td>
			</tr>
		</table>
		
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Local MLS ID:</th>
				<td><label><input type="text" name="mlsid" id="mlsid" value=""></label> </td>
			</tr>
		</table>
		
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Web Link:</th>
				<td><label><input class="textlnk1" type="text" name="alk" id="alk" value="" ></label> </td>
			</tr>
		</table>
		
		
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Description:</th>
				<td><label><textarea rows="8" cols="100" name="adsc" id="adsc" value=""></textarea>
				</label> </td>
			</tr>
		</table>

		<table class="form-table">
			<tr valign="top">
				<th scope="row"></th>
				<td><!--<input class="textlnk_file" type="file" name="file" id="file" /> -->
					<iframe scrolling="no" height="57px" frameborder="0" vspace="0" hspace="0" src="<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/agent_listings/upload.php" name="frame" id="frame" class="image_iframe"></iframe>
				<img src="" id="show_url" class="image_f">
				<input type="hidden" value="" id="image_computer" name="image_computer">
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