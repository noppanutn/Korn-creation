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
		<div id="div_content" class="usergroup">
			<!--%%%%% Main block %%%%-->
<?php
if(isset($_SESSION['user']) && ($_SESSION['group']==1 || $_SESSION['group']==2)) /// Need change
{
?>
		<?php
				require_once('connect.php');
				if(isset($_POST['page'])) {
				$page = $_POST['page'];
				$groupcode = $_POST['groupcode'];
				$groupname = $_POST['groupname'];
				$remark = $_POST['remark'];
				$url = $_POST['url'];
				if($page=='addgroup') {
					$q="INSERT INTO usergroup(USERGROUP_CODE,USERGROUP_NAME,USERGROUP_REMARK,USERGROUP_URL) VALUES ('$groupcode','$groupname','$remark','$url');";

					$result=$mysqli->query($q);
					if(!$result){
						echo "INSERT failed. Error: ".$mysqli->error ;
						break;
					}
				}
			}
			?>
			<h2>User Group</h2>
			<table>
                <col width="10%">
                <col width="20%">
                <col width="30%">
                <col width="30%">
                <col width="5%">
                <col width="5%">

                <tr>
                    <th>Group Code</th>
                    <th>Group Name</th>
                    <th>Remark</th>
                    <th>URL</th>
                    <th>Edit</th>
                    <th>Del</th>
                </tr>
				<?php
				 	$q="select * from usergroup";
					$result=$mysqli->query($q);
					if(!$result){
						echo "Select failed. Error: ".$mysqli->error ;
						break;
					}
				 while($row=$result->fetch_array()){ ?>
                 <tr>
                    <td><?=$row['USERGROUP_CODE']?></td>
                    <td><?=$row['USERGROUP_NAME']?></td>
                    <td><?=$row['USERGROUP_REMARK']?></td>
                    <td><?=$row['USERGROUP_URL']?></td>
                    <td>
						<a href="edit_group.php?id=<?=$row['USERGROUP_ID']?>"><img src="images/Modify.png" width="24" height="24"></a>
					</td>
                    <td><a href='del_group.php?id=<?=$row['USERGROUP_ID']?>'> <img src="images/Delete.png" width="24" height="24"></a></td>
                </tr>
				<?php } ?>

			<?php $count=$result->num_rows;
					echo "<tr><td colspan=6 align=right>Total $count records</td></tr>";
					$result->free();
			?>
            </table>
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
