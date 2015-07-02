<?php 
require("db.php");

$action 				= mysql_real_escape_string($_POST['action']); 
$updateRecordsArray 	= $_POST['recordsArray'];
	
if ($action == "updateRecordsListings"){
	
	$listingCounter = 1;
	foreach ($updateRecordsArray as $recordIDValue) {		
		$query = "UPDATE ntreisimages SET recordListingID = " . $listingCounter . " WHERE id = " . $recordIDValue;
		mysql_query($query) or die('Error, insert query failed');
		$listingCounter = $listingCounter + 1;	
	}
	
	/* echo '<pre>';
	print_r($updateRecordsArray);
	echo '</pre>'; */
	// echo 'If you close this popup and refresh the page, you will see that records will stay just as you modified.';
	// $query  = "SELECT * FROM records ORDER BY recordListingID ASC";
		$query = "select * from ntreisimages where mlsnum = '".$_REQUEST['mlsid']."' ORDER BY recordListingID ASC";
		$result = mysql_query($query);
		 /* echo '<pre>';
	print_r($result);
	echo '</pre>'; */ 
		while($row = mysql_fetch_array($result))
		{
		// echo "<pre>"; print_r($row);
		?>
			<li id="recordsArray_<?php echo $row['id']; ?>"><?php echo  $row['recordListingID'] ."<img width='100px;' src='" . $row['imagename']."' alt='Image'/>"; ?></li>
		<?php 
		}
}

		
