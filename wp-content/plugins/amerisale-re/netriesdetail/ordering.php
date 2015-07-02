<?php 
	require("db.php");
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ordering The Images</title>
<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.7.1.custom.min.js"></script>



<style>
body {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 16px;
	margin-top: 10px;
}

ul {
	margin: 0;
}

#contentWrap {
	width: 700px;
	margin: 0 auto;
	height: auto;
	overflow: hidden;
}

#contentTop {
	width: 600px;
	padding: 10px;
	margin-left: 30px;
}

#contentLeft {
	float: left;
	width: 400px;
}

#contentLeft li {
	list-style: none;
	margin: 0 0 4px 0;
	padding: 10px;
	background-color:#00CCCC;
	border: #CCCCCC solid 1px;
	color:#fff;
}


	

#contentRight {
	float: right;
	width: 260px;
	padding:10px;
	background-color:#336600;
	color:#FFFFFF;
}

</style>


<script type="text/javascript">
$(document).ready(function(){ 
						   
	$(function() {
		$("#contentLeft ul").sortable({ opacity: 0.6, cursor: 'move', update: function() {
			$("#contentRight").html('Loading..........');
			var order = $(this).sortable("serialize") + '&action=updateRecordsListings&mlsid=<?php echo $_REQUEST['mlsid']?>'; 
			$.post("updateDB.php", order, function(theResponse){
				$("#contentRight").html('Updated Successfully..........');
				$("#contentLeft ul").html(theResponse);
			}); 															 
		}								  
		});
	});

});	
</script>

</head>
<body>

	<div id="contentWrap">

		<div id="contentTop">
		
		  <p>Drag'n drop the items below. Their new positions are updated<img src="../images/arrow-down.png" alt="Arrow Down" width="32" height="32" /></p>
	  </div>
	
		<div id="contentLeft">
			<ul>
				<?php
				// $query  = "SELECT * FROM records ORDER BY recordListingID ASC";
				$query = "select * from ntreisimages where mlsnum = '".$_REQUEST['mlsid']."' ORDER BY recordListingID ASC";
				$result = mysql_query($query);
				
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
				// echo "<pre>"; print_r($row);
				?>
					<li id="recordsArray_<?php echo $row['id']; ?>"><?php echo  $row['recordListingID'] ."<img width='100px;' src='" . $row['imagename']."' alt='Image'/>"; ?></li>
				<?php } ?>
			</ul>
		</div>
		
		<div id="contentRight">
		  
		</div>
	
	</div>

</body>
</html>
