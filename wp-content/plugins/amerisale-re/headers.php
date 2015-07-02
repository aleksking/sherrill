<?php global $wpdb; ?>
<div class="icon32" id="icon-options-general"><br/></div>
<h2>Amerisale RE</h2><br clear="all" />
<div class="wrap">
<h2>Manage Headers</h2>
<?php 
// echo $_SERVER['REQUEST_URI'];
// echo "<pre>"; print_r($_SERVER);
	
	if(isset($_REQUEST['content'])){
		// $_REQUEST['content'];$agent_offcode;
		$sql1="update ".$wpdb->prefix."agentaccount set address = '".$_REQUEST['content']."' where agent_offcode = '".$agent_offcode."' ";
		$res2 =  $wpdb->query($sql1);
		// var_dump($res2);die;
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		// wp_redirect($url);
		// header( 'Location: '.$url.'' ) ;
		?>
	   <script type="text/javascript">
	   <!--
		  window.location= <?php echo "'" . $url . "'"; ?>;
	   //-->
	   </script>
	<?php
	}
?>
	<div id="poststuff">
		<form action="" method="post">
			<?php 
			
				the_editor($address,'content');
			?>
			<input type="submit" value="Edit" class="button bold" name="save">
		</form>
	</div>	
</div>