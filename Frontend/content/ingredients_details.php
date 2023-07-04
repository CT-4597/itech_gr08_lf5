<?php
$sql = "SELECT * FROM ZUTAT WHERE ZUTATENNR = " . $_GET['id'];
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
?>
<h1><?php echo $row['BEZEICHNUNG']; ?></h1>
<div class="nutrition">
    <h2>Nährwerte</h2>
    <ul>
        <li>Kalorien: <?php echo $row['KALORIEN']; ?></li>
        <li>Kohlenhydrate: <?php echo $row['KOHLENHYDRATE']; ?></li>
        <li>Protein: <?php echo $row['PROTEIN']; ?></li>
    </ul>
</div>

<div class="order">
    <ul>
        <li>Verfügbar: <?php echo $row['BESTAND']; ?> <?php echo $row['EINHEIT']; ?></li>
        <li>Preis in netto: <?php echo $row['NETTOPREIS']; ?> €</li>
    </ul>
</div>

<img src="/images/z_<?php echo $row['ZUTATENNR']; ?>.png" alt="Bild der Zutat">
<?php
}

?>