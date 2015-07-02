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
	
	
	$id = $_REQUEST['id'];
	$photoname = $_REQUEST['photoname'];
	$caption = $_REQUEST['caption'];
	$updt_sql = "update ntreisimages set imagename = '".$photoname."',caption_text = '".$caption."' where id = ".$id ;
	// $res2 =  $wpdb->query($updt_sql);
	$agent = mysql_query($scn_sql); 
	
		$img = "select * from ntreisimages where id = '".$id."'";
			$list = mysql_query($img); 
			while($row = mysql_fetch_assoc($list)){
				$images[] = $row;
			}
		
			if(!empty($images)){
				foreach($images as $img){
					if(empty($img['caption_text'])){
						$caption_text = '&nbsp;';
					}else{
						$caption_text = $img->caption_text;
					}
					echo '<div id="'.$img['id'].'">';
						echo '<img src="'.$img['imagename'].'" id="show_url_'.$img['id'].'" alt="No Image" width="300px;"/>';
						echo "<br clear='all' /><br />";
						echo "<div class='caption'>Captions Text:-".$caption_text."</div>";
						echo "<br clear='all' /><br />";
							echo '<div class="edit_images" id="edit_images_'.$img['id'].'">';
								echo '<iframe scrolling="no" height="57px" frameborder="0" vspace="0" hspace="0" src="'.plugins_url().'/'.$plugin_dir.'/netriesdetail/upload.php?edit='.$img['id'].'" name="frame" id="frame" class="image_iframe"></iframe>';
								echo '<br clear="all" />';
								echo '<label>Captions Text:</label><input type="text" value="" id="caption_'.$img['id'].'" value="'.$caption_text.'" name="caption">';
								echo '<input type="hidden" value="'.$img['imagename'].'" id="image_computer_'.$img['id'].'" name="image_computer" />';
								echo '<br clear="all" />';
								echo '<button onclick="update_photo('.$img['id'].')" >Update</button>';
								echo '<br clear="all" /><br />';
							echo '</div>';
						echo '<button onclick="Edit_photos('.$img['id'].')" >Edit Photo</button>';
						echo '<button onclick="deleteimg('.$img['id'].')" >Remove Photo</button>';
						echo "<br clear='all' /><br />";
					echo '</div>';
				}
			}
		mysql_close($con); 
?>