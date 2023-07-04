<table>
	<tr>
		<th>ID</th>
		<th>Bezeichnung</th>
	</tr>
<?php

	$sql = "SELECT * FROM ZUTAT";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {

	    // output data of each row
	    while($row = $result->fetch_assoc()) {
			echo '	<tr>';
			echo '		<td><a href="/zutat/' . $row["ZUTATENNR"] . '">' . $row["ZUTATENNR"] . '</a></td>';
			echo '		<td>' . $row['BEZEICHNUNG'] . '</td>';
			echo '	</tr>';
	    }
	} else {
	    echo "0 results";
	}
?>
</table>