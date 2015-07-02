<?php 
include_once("../../../../wp-config.php");
global $wpdb;
	function generateSelect($name = '', $options = array()) {
	$html = '<select name="'.$name.'">';
	foreach ($options as $option => $value) {
		$html .= '<option value='.$value.'>'.$option.'</option>';
		}
		$html .= '</select>';
		return $html;
	}
?>
    <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js'></script>
    <script>
        $(function() {
			$('#wp_netries_options').submit(function() {
				  // alert($(this).serialize());
				  $('.list-wrap').html('Progressing..........');
				 $.ajax({
				  url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/netriesdetail/form.php",
				  data: $(this).serialize()
				}).done(function(res) {  
					// alert(res);
					$('.list-wrap').html(res);
				});
			  return false;
			});
        });
		
    </script>
<ul id="addnetres" >

	<form method="post" id="wp_netries_options">
	<?php
		
		 $sql = "select id,Name,mls_id from  ".$wpdb->prefix."agents ";
		$tkeqry = $wpdb->get_results($sql);
	   //print_r($tkeqry);
		foreach($tkeqry as $key=>$slec){
			$sel[$slec->id.' - '.$slec->Name] = $slec->id."~".$slec->mls_id;
		}
		 // echo "<pre>";print_r($sel);
		 ?>
		 <table class="form-table">
			<tr valign="top">
				<th scope="row"><label>Select The Agent:</label></th>
				<td><label><?php echo $html = generateSelect('agent', $sel); ?></label> </td>
			</tr>
		</table>
		
		<?php 
		$sql = "select city from  ".$wpdb->prefix."ntreislist group by city ";
		$tkeqry = $wpdb->get_results($sql);
		foreach($tkeqry as $key=>$slec){
			$city[$slec->city] = $slec->city;
		}
		?>
		
		 <table class="form-table">
			<tr valign="top">
				<th scope="row"><label>Select The City:</label> </th>
				<td><label><?php echo $html = generateSelect('city', $city); ?></label> </td>
			</tr>
		</table>

		
		<?php
			$sql = "select county from  ".$wpdb->prefix."ntreislist group by county ";
			$tkeqry = $wpdb->get_results($sql);
			foreach($tkeqry as $key=>$slec){
				$country[$slec->county] = $slec->county;
			}
		?>
									
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><label>Select The Country:</label></th>
				<td><label><?php echo $html = generateSelect('country', $country); ?></label> </td>
			</tr>
		</table>

		<table class="form-table">
			<tr valign="top">
				<th scope="row"><label>Select The Catagory:</label></th>
				<td><label>
				<select name="type">
				  <option>Residential</option>
				  <option>Commercial</option>
				  <option>Multi-Family</option>
				  <option>Lots and Acreage</option>
				</select></label> </td>
			</tr>
		</table>
		
		<p class="submit">
			<input type="submit" value="+ Add Listing" name="save" class="button-primary" />
		</p>
	</form>
</ul>