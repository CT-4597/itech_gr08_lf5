<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Kraut & Rüben</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>

    <div class="header">
        <img src="/images/Logo.png" class="logo">
        <h1>KuR-Verwaltung</h1>
        <img src="/images/user_icon.png" class="user_icon">
    </div>
    <div class="navigation">
        <a href="/index.php" class="navitem">Zutaten</a>
        <a href="/index.php" class="navitem">Rabatt-Boxen</a>
        <a href="/index.php" class="navitem">Bio-Boxen</a>
        <a href="/index.php" class="navitem">Rezept-Boxen</a>
    </div>

    <div class="content">
<?php
include './includes/config.php';
$sql = "SELECT * FROM ALLERGEN";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Bezeichnung</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["ALLERGENNR"]. "</td><td>" . $row["ALLERGENBEZEICHNUNG"]. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
    </div>

</body>
</html>