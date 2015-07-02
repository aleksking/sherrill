 <div class="icon32" id="icon-options-general"><br/></div>
<h2>Amerisale RE</h2><br clear="all" />


<style>	
.red{color:red;}
.blue{color:blue;}
.black{color:#000;}
.seperates{border: 1px solid #AAAAAA;float: left;width: 100%;}
.tot{float:left;width:350px;}
.sorting{float:left;margin: 12px 0 0;}
.red_c{background: none repeat scroll 0 0 #FF0000;margin: 0 6px 0 10px;width: 20px;}
.blue_c{background: none repeat scroll 0 0 #5252C4;margin: 0 6px 0 10px;width: 20px;}
.black_c{background: none repeat scroll 0 0 #000;margin: 0 6px 0 10px;width: 20px;}
.coloring{font-weight:bold;color:#000;}
.coloring span{float:left;}
 </style>
    <script>
        $(function() {
			$('#wp_netries_options').submit(function() {
				  // alert($(this).serialize());
				  var agent = $('#agent').val();
				  var city = $('#city').val();
				  var country = $('#country').val();
				  var property = $('#property').val();
				  if(agent == ''){
					alert('You Must Choose Agent');return false;
				  }
				  
				  if(city == ''){
					alert('You Must Choose City');return false;
				  }
				  if(country == ''){
					alert('You Must Choose Country');return false;
				  }
				  if(property == ''){
					alert('You Must Choose Property Type');return false;
				  }
				    $('.list-wrap').html('Progressing..........');
				    $('#example-two').hide();
				    $('#example-three').hide();
				 $.ajax({
				  url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/netriesdetail/form1.php",
				  data: $(this).serialize()
				}).done(function(res) {  
					// alert(res);
					$('.list-wrap').html(res);
				});
			  return false;
			});
        });
		function sel_list(){
			// alert('TEst');
			var ids = $('#Select1').val();
			// alert(ids);
			if(ids == null){
				alert('Please Select any one of the Listings!....');
				return false;
			}else{
			ids = ids.toString();
			var mySplitResult = ids.split("~");
			window.open('<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/agent_listings/view_all_listing.php?data='+mySplitResult[1]+'','mywindow', 'scrollbars=1 width=600, height=500'); 
			    //mywindow = window.open("http://www.javascript-coder.com", "mywindow", "location=1,status=1,scrollbars=1,  width=100,height=100");
			/* $.ajax({
				 // url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/netriesdetail/viewdetail.php",
				 url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/netriesdetail/agent_listings/view_all_listing.php",
				  data: 'data='+mySplitResult[0],
				}).done(function(res) { 
					if(res == 'There is no records in this Listings.'){
						alert('There is no records in this Listings.');
						return false;
					}else{
						$('.list-wraps').html(res);
					}
				}); */
			}
		}
		
		function edit_list(){
			// alert('TEst');
			var ids = $('#Select1').val();
			// alert(ids);
				ids = ids.toString();
			var mySplitResult = ids.split("~");
			if(ids == null){
				alert('Please Select any one of the Listing!....');
				return false;
			}else{
			$('.list-wraps').html('Progressing..........');
			
			$('#example-one').hide();
			$('#example-three').hide();
			
			$.ajax({
				  url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/netriesdetail/form.php",
				  data: 'agent='+mySplitResult[1]+'~'+mySplitResult[0],
				}).done(function(res) { 
					if(res == 'There is no records in this Listings.'){
						alert('There is no records in this Listings.');
						location.reload();
						return false;
					}else{
						$('.list-wraps').html(res);
					}
				});
			}
		}
		
		function change_cat(){
			var ids = $('#Select1').val();
			if(ids == null){
				alert('Please Select any one of the Listings!....');
				return false;
			}else{
			ids = ids.toString();
			var mySplitResult = ids.split("~");
			$('#example-one').hide();
			$('#example-three').hide();
			$.ajax({
				  url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/netriesdetail/change_cat.php",
				  data: 'mls='+mySplitResult[0],
				}).done(function(res) { 
					if(res == 'There is no records in this Listings.'){
						alert('There is no records in this Listings.');
						return false;
					}else{
						$('.list-wraps').html('Progressing..........');
						$('.list-wraps').html(res);
					}
				});
			}
		}
		
		function reassign(){
			var ids = $('#Select1').val();
			if(ids == null){
				alert('Please Select any one of the Listings!....');
				return false;
			}else{
			ids = ids.toString();
			var mySplitResult = ids.split("~");
			if(mySplitResult[2] != 0){
				$('#example-one').hide();
				$('#example-three').hide();
				$.ajax({
					  url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/netriesdetail/reassign.php",
					  data: 'mls='+mySplitResult[0]+'&agent='+mySplitResult[1],
					}).done(function(res) { 
						if(res == 'There is no records in this Listings.'){
							alert('There is no records in this Listings.');
							return false;
						}else{
							$('.list-wraps').html('Progressing..........');
							$('.list-wraps').html(res);
						}
					});
				}else{
					alert('Uable to reassign the expired Lists !....');
				}
			}
		}
		function all_list(){
			$('#example-one').hide();
			$('#example-three').hide();
			$('.list-wraps').html('Progressing..........');
			$.ajax({
				  url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/netriesdetail/list_all.php",
				  data: '',
				}).done(function(res) {
					$('.list-wraps').html(res);
				});
			}
		function searching(s){
			var val = $('#Smls').val();
			
			$('#addnetress').html('Loading..........');
			$.ajax({
				  url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/netriesdetail/searching.php",
				  data: {data : val,sort : s},
				}).done(function(res) {
					$('#back').show('fast');
					$('#addnetress').html(res);
				});
		}
    </script>
	

<?php
$con = mysql_connect($db_ip,$db_user,$db_pass);
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db($db_name, $con);
	
function generateSelect($name = '', $options = array()) {
	$html = '<select name="'.$name.'" id="'.$name.'">';
	foreach ($options as $option => $value) {
		$html .= '<option value='.$value.'>'.$option.'</option>';
	}
		$html .= '</select>';
		return $html;
	}
?>
<div class="wrap">	
<h2> Manage Listings </h2><br clear="all" />
	<div class="contes">
		<div id="example-one" >				
			<div class="list-wrap">
			<!--<h2> Add New Listings </h2><br clear="all" />-->
			<div style='font-weight:bold;color:#D31730;'>"Warning" All Listings expired for more than 45 days will be permanently deleted from the system unless they are Reactivated by Changing the Expiration Date</div><br clear='all' />
				<ul id="addnetres" >
					<form method="post" id="wp_netries_options">

						<?php	
						global $wpdb;						
							/* $sql = "select id,Name,agent_id,agent_license_no from  ".$wpdb->prefix."agents ";
							$tkeqry = $wpdb->get_results($sql);
							 */
							$sql = "SELECT id,Name,agent_id,agent_license_no FROM agents WHERE agent_offcode= '".$agent_offcode."' ";
							$agent = mysql_query($sql); 
							while($row = mysql_fetch_assoc($agent)){
								$tkeqry[] = $row;
							}
							
							$sel = array('---Select Any Agent---'=>'');
							foreach($tkeqry as $key=>$slec){
								$sel[$slec['agent_license_no'].' - '.$slec['Name']] = $slec['agent_license_no'];
							}
							 // echo "<pre>";print_r($sel);
							 ?>
							 <table class="form-table">
								<tr valign="top">
									
									<th scope="row">Select The Agent:</th>
									<td><label><?php echo $html = generateSelect('agent', $sel); ?></label> </td>
								</tr>
							</table>
							
							<?php 
							include("array.php") ;
							
							?>
							
							 <table class="form-table">
								<tr valign="top">
									<th scope="row">Select The City:</th>
									<td><label><?php echo $html = generateSelect('city', $city); ?></label> </td>
								</tr>
							</table>
														
							<table class="form-table">
								<tr valign="top">
								<th scope="row">Select The County:</th>
									
									<td><label><?php echo $html = generateSelect('country', $country); ?></label> </td>
								</tr>
							</table>
				
							<table class="form-table">
								<tr valign="top">
								<th scope="row">Select The Catagory:</th>								
									<td><label>
									<select name="type" id="property">
									  <option value="">---Select Any Type---</option>
									  <option value="Residential">Residential</option>
									  <option value="Commercial">Commercial</option>
									  <option value="Acreage">Acreage</option>
									  <option value="Multi-Family">Multi-Family</option>
									  <option value="Residential Leasing">Residential Leasing/Rental</option>
									  <option value="Commercial Leasing">Commercial Leasing/Rental</option>
									  <option value="Residential Lots">Residential Lots</option>
									  <option value="Commercial Lots">Commercial Lots</option>
									  <option value="Commercial">Commercial</option>
									  <option value="Farm/Ranch">Farm/Ranch</option>
									  <option value="WaterFront">WaterFront</option>
									  <option value="WaterView">WaterView</option>
									</select></label> </td>
								</tr>
							</table>
							
							<p class="submit">
								<input type="submit" value="+ Add Listing" name="save" class="button-primary" />
							</p>
					</form>
				</ul>
			</div>
		</div>
		<br clear="all" />
		<br /><br />
		<?php
	
		$sql = "SELECT A.agent_license_no,A.Name,A.agent_id,B.MLS,B.directions,B.city,B.county,B.agentlist,B.is_manual_edit,B.expired_date,B.liststatus,B.sold
				FROM agents AS A
				LEFT JOIN ntreislist AS B
				ON A.agent_license_no=B.agentlist WHERE B.agentlist != '' AND B.officelist = '".$agent_offcode."'";
							$sql = mysql_query($sql); 
							while($row = mysql_fetch_assoc($sql)){
								$tkeqrys[] = $row;
							}
							
		$today = getdate();
		$dates = $today['year']."-".$today['mon']."-".$today['mday'];
		$date = date('Y-m-d',strtotime($dates));
		/*  foreach($listing as $a_mls)
						{ 
						// echo "<pre>"; print_r($a_mls);die;
						
							if ( $date > $a_mls['expired_date']) {
								echo $a_mls['expired_date'];
								echo '<hr />';
							}
							}  */
		?>
		<div id="example-two">
			<div class="list-wraps">
			<div class="seperates"></div>
			<h2>Listings</h2><br clear="all" />
			<label>Search MLS # </label>
			<input id="Smls" type="text" size="30"/>
			<button type="button" onclick="searching(0);">Search</button>
			<button type="button" style="display:none;" id="back" onclick="searching('MLS');">Back</button>
			<br clear="all" /><span>Example 11743006,11621239,11721117 (Seperate Multiple Values with Commas)</span>
			<br clear="all" /><br />
			<br />		 
			<button type="button" onclick="sel_list();">View Listing!</button> 
			<!--<button type="button" onclick="sel_list();">View Listing!</button>-->
			<button type="button" onclick="edit_list();">Edit Listing!</button> 
			<button type="button" onclick="change_cat();">Change Category</button> 
			<button type="button" onclick="reassign();">Re-Assign</button> 
			<button type="button" onclick="all_list();">List All Listings</button>
				
		<br clear="all" /><br />
				<ul  >
				<div class='coloring'><span class="red_c">&nbsp;</span> <span>RED Expired</span> <span class="blue_c">&nbsp;</span> <span>Blue Imported</span> <span class="black_c">&nbsp;</span> <span>Black Manually Entered</span></div><br clear="all" />
				<h3 class="tot">Total Count Of MLS: <span style="color:#AA462A; font-size: 18px;"><?php echo count($tkeqrys); ?></span></h3>
			<div class="sorting">	<label>Sort Listings:</label>
			<a href="Javascript://" onclick="searching('id');" >ID</a>|
			<a href="Javascript://" onclick="searching('agent_id');" >Agent</a>|
			<a href="Javascript://" onclick="searching('MLS');" >MLS</a>
			</div>
			<br clear="all" />
				<div id="addnetress">
				<?php
						/* foreach($tkeqrys as $a_mls)
						{ 
							echo "<pre>";
							print_r($a_mls);
							echo "expired   " .$a_mls['expired_date'];
							if($a_mls['is_manual_edit'] == 1){
								if ($a_mls['liststatus'] == 'expired') {
									echo 'red';
								}else if ($a_mls['sold'] == 1) {
									echo 'red';
								}else{
									echo 'black';
								}
							}
							
							if($a_mls['is_manual_edit'] == 0){
									echo 'blue';
							}
						}	
						die; */
				?>
				<select name="drop1" id="Select1" size="4" multiple="multiple" style="width: 750px; height: 400px;">
					<?php 
					
						foreach($tkeqrys as $a_mls)
						{ 
							$addresss = $a_mls['directions'].', '.$a_mls['city'].', '.$a_mls['county'].' county';
							// print_r($a_mls);
							// echo "expired   " .$a_mls['expired_date'];
							if($a_mls['is_manual_edit'] == 1){
								//if ( $date > $a_mls['expired_date']) {
								if ($a_mls['liststatus'] == 'expired') {
									echo '<option class="red" value="'.$a_mls['MLS'].'~'.$a_mls['agent_license_no'].'~0">'.$a_mls['agent_license_no']." Agent ID:".$a_mls['agent_license_no']." - MLS #:".$a_mls['MLS']." - Agent Name #:".$a_mls['Name']." - Address #:".$addresss.'</option>';
								}else if ($a_mls['sold'] == 1) {
									echo '<option class="red" value="'.$a_mls['MLS'].'~'.$a_mls['agent_license_no'].'~0">'.$a_mls['agent_license_no']." Agent ID:".$a_mls['agent_license_no']." - MLS #:".$a_mls['MLS']." - Agent Name #:".$a_mls['Name']." - Address #:".$addresss.'</option>';
									//echo '<option class="red" value="'.$a_mls->MLS.'~'.$a_mls->agent_license_no.'~0">'.$a_mls->agent_license_no." Agent ID:".$a_mls->agent_license_no." - MLS #:".$a_mls->MLS." - Agent Name #:".$a_mls->Name.'</option>';
								}else{
									echo '<option class="black" value="'.$a_mls['MLS'].'~'.$a_mls['agent_license_no'].'~1">'.$a_mls['agent_license_no']." Agent ID:".$a_mls['agent_license_no']." - MLS #:".$a_mls['MLS']." - Agent Name #:".$a_mls['Name']." - Address #:".$addresss.'</option>';
									//echo '<option class="black" value="'.$a_mls->MLS.'~'.$a_mls->agent_license_no.'~1">'.$a_mls->agent_license_no." Agent ID:".$a_mls->agent_license_no." - MLS #:".$a_mls->MLS." - Agent Name #:".$a_mls->Name.'</option>';
								}
							}
							
							if($a_mls['is_manual_edit'] == 0){
									echo '<option class="blue" value="'.$a_mls['MLS'].'~'.$a_mls['agent_license_no'].'~1">'.$a_mls['agent_license_no']." Agent ID:".$a_mls['agent_license_no']." - MLS #:".$a_mls['MLS']." - Agent Name #:".$a_mls['Name'].'</option>';
									//echo '<option class="blue" value="'.$a_mls->MLS.'~'.$a_mls->agent_license_no.'~1">'.$a_mls->agent_license_no." Agent ID:".$a_mls->agent_license_no." - MLS #:".$a_mls->MLS." - Agent Name #:".$a_mls->Name.'</option>';
							}
						}
					?>
				</select>
				</div>					
				</ul>
			</div>	
		</div>	<br clear="all" />
		<br />
		
	</div>
</div>