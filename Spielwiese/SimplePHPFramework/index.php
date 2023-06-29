<?php
	include('includes/config.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Kraut & R&ubnsp;ben</title>
</head>
<body>
<table border="1" width="100%">
	<tr>
		<td colspan="3"><?php include('includes/header.php'); ?></td>
	</tr>
	<tr>
		<td><?php include('includes/left.php'); ?></td>
		<td>
			<?php
			if(isset($_GET['content'])) {
				include('includes/htmlspecialchars($_GET["name"]).php');
			} else {
				include('includes/htmlspecialchars($_GET["customer"]).php');
			}
			?>
		</td>
		<td><?php include('includes/right.php'); ?></td>
	</tr>
</table>
</body>
</html>