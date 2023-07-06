<?php

# Add to card
if (isset($_POST['AddToCard'])) {

		if(isset($_SESSION['shopping_card_boxes'][$_POST['SAMMLUNGSNR']])) {
			$_SESSION['shopping_card_boxes'][$_POST['SAMMLUNGSNR']] += (int)$_POST['amount'];
		} else {
			$_SESSION['shopping_card_boxes'][$_POST['SAMMLUNGSNR']] = (int)$_POST['amount'];
		}
}

$sql = log_sql("SELECT SAMMLUNG.SAMMLUNGSNR, SAMMLUNG.SAMMLUNGSBEZEICHNUNG,
                sum(ZUTAT.NETTOPREIS * SAMMLUNGZUTAT.ZUTATENMENGE) AS 'Gesamtpreis', 
                sum(ZUTAT.NETTOPREIS * SAMMLUNGZUTAT.ZUTATENMENGE)-round(sum(ZUTAT.NETTOPREIS * SAMMLUNGZUTAT.ZUTATENMENGE)*(SAMMLUNG.RABATT/100),2)
                AS 'RabattPreis' FROM SAMMLUNG LEFT JOIN SAMMLUNGZUTAT ON SAMMLUNGZUTAT.SAMMLUNGSNR = SAMMLUNG.SAMMLUNGSNR 
                LEFT JOIN ZUTAT ON ZUTAT.ZUTATENNR = SAMMLUNGZUTAT.ZUTATENNR WHERE SAMMLUNG.SAMMLUNGSNR = " . $_GET['id']);
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
?>
<h1 class="details_headline"><?php echo $row['SAMMLUNGSBEZEICHNUNG']; ?></h1>
<div class="details_container">

    <img src="<?php get_image("s", $row['SAMMLUNGSNR']); ?>" alt="Bild der Zutat" class="details_pic">

    <div class="details_info">
        <ul>
            <li>Verfügbar: <?php echo 'TO DO Stück'; ?></li>
            <li>Preis in netto: <?php echo $row['RabattPreis']; ?> €</li>
        </ul>
    </div>

    <div class="details_order">
        <form action="/box/<?php echo $row['SAMMLUNGSNR']; ?>" method="post">
    	    <input type="hidden" name="SAMMLUNGSNR" value="<?php echo $row['SAMMLUNGSNR']; ?>">
            <label for="amount">Menge</label>
            <input type="number" id="amount" name="amount" min="1" max="10" value="1">
            <input type="submit" name="AddToCard" value="Zum Warenkorb hinzufügen">
        </form>
    </div>

</div>
<?php
} else {
    echo "<h1 class=\"details_headline\">Es wurde keine Zutat gewählt</h1>";
}

?>
