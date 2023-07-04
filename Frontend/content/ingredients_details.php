<?php
$sql = "SELECT * FROM ZUTAT WHERE ZUTATENNR = " . $_GET['id'];
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
?>
<h1 class="details_headline"><?php echo $row['BEZEICHNUNG']; ?></h1>
<div class="details_nutrition">
    <h2>Nährwerte</h2>
    <ul>
        <li>Kalorien: <?php echo $row['KALORIEN']; ?></li>
        <li>Kohlenhydrate: <?php echo $row['KOHLENHYDRATE']; ?></li>
        <li>Protein: <?php echo $row['PROTEIN']; ?></li>
    </ul>
</div>

<div class="details_info">
    <ul>
        <li>Verfügbar: <?php echo $row['BESTAND']; ?> <?php echo $row['EINHEIT']; ?></li>
        <li>Preis in netto: <?php echo $row['NETTOPREIS']; ?> €</li>
    </ul>
</div>

<form>
    <label for="amount">Menge</label>
    <input type="number" id="amount" name="amount" min="1" max="<?php echo $row['BESTAND']; ?>" value="1">
    <input type="submit" value="Zum Warenkorb hinzufügen">
</form>

<img src="<?php get_image("z", $row['ZUTATENNR']); ?>" alt="Bild der Zutat" class="details_pic">
<?php
} else {
    echo "<h1 class=\"details_headline\">Es wurde keine Zutat gewählt</h1>";
}

?>
