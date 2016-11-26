<?php
session_start();
//require_once('connect.php');
require_once('helper.php');
 ?>
<!DOCTYPE html>
<html>
<head>
<title>ITS331 Sample</title>
<link rel="stylesheet" href="default.css">
</head>

<body>
<div id="wrapper">
	<div id="div_header">
		ITS331 System
	</div>
	<div id="div_subhead">
		<?php welcome(); ?>
	</div>

	<div id="div_main">
		<div id="div_menu">
			<?php print_menus(); ?>
		</div>

		<div id="div_content" class="form">
			<!--%%%%% Main block %%%%-->
<?php
if(isset($_SESSION['user']) && ($_SESSION['group']==1 || $_SESSION['group']==2)) /// Need change
{
?>
			<!--Form -->
			<h2>Add User Group</h2>
			<form action="group.php" method="post">
				<label>Group Code</label>
				<input type="text" name="groupcode">

				<label>Group Name</label>
				<input type="text" name="groupname">

				<label>Remark</label>
				<textarea name="remark">Description</textarea><br>

				<label>URL</label>
				<input type="text" name="url">

				<div class="center">
					<input type="submit" name="submit" value="Submit">
					<input type="reset" value="Cancel">
				</div>
				<input type="hidden" name="page" value="addgroup">
			</form>
		</div> <!-- end div_content -->
<?php
}
else {
	echo "You do not have a permission to access";
}
?>
	</div> <!-- end div_main -->

	<div id="div_footer">

	</div>

</div>
</body>
</html>
