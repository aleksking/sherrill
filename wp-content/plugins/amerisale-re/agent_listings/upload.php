<?php
include_once("../../../../wp-config.php");
global $wpdb;

$path = plugins_url()."/".$plugin_dir."/";
@$ftmp = $_FILES['image']['tmp_name'];
@$oname = $_FILES['image']['name'];
@$fname = $_FILES['image']['name'];
@$fsize = $_FILES['image']['size'];
@$ftype = $_FILES['image']['type'];

$user_image_path = "../../../uploads/amerisale-re/";
$newimage = "";
$thumbimage = "";

$ext = strrchr($oname, '.');
if($ext){
	if(($ext != '.jpg' && $ext != '.JPG' && $ext != '.png' && $ext != '.PNG' && $ext != '.jpeg' && $ext != '.JPEG' && $ext != '.GIF' && $ext != '.gif'&& $ext != '.MP4') || $fsize > 200*1024*1024){
		//echo 'error';
	}else{
		if(isset($ftmp)){
				$newimage = time().$ext;
				$upload = $user_image_path.$newimage;
				// var_dump($newimage);
				//$result = @move_uploaded_file($ftmp,$newimage);
				$result = @move_uploaded_file($ftmp,$upload);
				 
				$img_src = get_bloginfo('url')."/wp-content/uploads/amerisale-re/".$newimage;
			if(isset($edit)){
			?>
			<!-- Copy & Paste "Javascript Upload Script" -->
			<script>
				var par = window.parent.document;
				par.getElementById('show_url_<?php echo $edit; ?>').src = '<?php echo $img_src; ?>';
				par.getElementById('image_computer_<?php echo $edit; ?>').value = '<?php echo $img_src; ?>';		
			</script>
			<?php
			}else{
				?>
			<!-- Copy & Paste "Javascript Upload Script" -->
			<script>
				var par = window.parent.document;
				par.getElementById('show_url').src = '<?php echo $img_src; ?>';
				par.getElementById('image_computer').value = '<?php echo $img_src; ?>';		
			</script>
			<?php
			}
		}
	}
}
?>
<!-- Copy & Paste "Form" -->
<script language="javascript">
function upload(id){

    var par = window.parent.document;
	document.getElementById('iform').submit();
	par.getElementById('show_url').src = '<?php echo $path."images/indicator.gif";?>';
}
</script>
<form id="iform" name="iform" action="" method="post" enctype="multipart/form-data">
<input id="file" type="file" name="image" onchange="upload('<?php echo $id; ?>')" />
</form>
