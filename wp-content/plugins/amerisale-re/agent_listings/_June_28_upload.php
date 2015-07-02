<?php
include_once("../../../../wp-config.php");
global $wpdb;

$path = plugins_url()."/".$plugin_dir."/";
@$ftmp = $_FILES['image']['tmp_name'];
@$oname = $_FILES['image']['name'];
@$fname = $_FILES['image']['name'];
@$fsize = $_FILES['image']['size'];
@$ftype = $_FILES['image']['type'];

$user_image_path = "../upload/";
$newimage = "";
$thumbimage = "";

$ext = strrchr($oname, '.');
if($ext){
	if(($ext != '.jpg' && $ext != '.JPG' && $ext != '.png' && $ext != '.PNG' && $ext != '.jpeg' && $ext != '.JPEG' && $ext != '.GIF' && $ext != '.gif'&& $ext != '.MP4') || $fsize > 200*1024*1024){
		//echo 'error';
	}else{
		if(isset($ftmp)){
				$newimage = $user_image_path.$oname;
				// var_dump($newimage);
				//$result = @move_uploaded_file($ftmp,$newimage);
				$result = @move_uploaded_file($ftmp,$newimage);
				 
				$img_src = $path."upload/".$oname;

			?>
			<!-- Copy & Paste "Javascript Upload Script" -->
			<script>
				var par = window.parent.document;
				//par.getElementById('upload_notes').style.display = 'block';
				par.getElementById('show_url').src = '<?php echo $img_src; ?>';
				par.getElementById('image_computer').value = '<?php echo $oname; ?>';		
			</script>
			<?php
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
