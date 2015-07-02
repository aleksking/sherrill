<?php if(isset($_POST['username'])){echo "<pre>";print_r($_REQUEST);} ?>
<div class="icon32" id="icon-options-general"><br/></div>
<h2> Amerisale RE </h2><br clear="all" />
<?php global $url; //echo "LL".$url; ?>
<div class="account">To Mange the Account: </div>
<a class="tabs" href="<?php echo $url ;?>admin.php?page=account" ><input type="button" class="button-primary" value="Manage Settings"/></a>
<br clear="all" /><br />
<div class="account">To Mange the Agents:  </div>
<a class="tabs" href="<?php echo $url ;?>admin.php?page=agent" ><input type="button" class="button-primary" value="Manage Agents"/></a>
<br clear="all" /><br />
<div class="account">To Mange the Listings:  </div>
<a class="tabs" href="<?php echo $url ;?>admin.php?page=netriesdetails" ><input type="button" class="button-primary" value="Manage Listings"/></a>
<br clear="all" /><br />
<div class="account">To Mange the Featured Listings: </div>
<a class="tabs" href="<?php echo $url ;?>admin.php?page=featured" ><input type="button" class="button-primary" value="Manage Featured Listings"/></a>
<br clear="all" /><br />
<div class="account">To Mange the Home Page Header: </div>
<a class="tabs" href="<?php echo $url ;?>admin.php?page=headers" ><input type="button" class="button-primary" value="Manage Page Header"/></a>