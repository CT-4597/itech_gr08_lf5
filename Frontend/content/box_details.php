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

$sql_content = log_sql("SELECT SAMMLUNGZUTAT.ZUTATENNR, ZUTAT.BEZEICHNUNG, ZUTAT.BESTAND, SAMMLUNGZUTAT.ZUTATENMENGE FROM SAMMLUNGZUTAT
                        LEFT JOIN ZUTAT ON ZUTAT.ZUTATENNR = SAMMLUNGZUTAT.ZUTATENNR
                        WHERE SAMMLUNGZUTAT.SAMMLUNGSNR = " . $_GET['id']);
$result_content = $conn->query($sql_content);

if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
    $maxAmount = 1;
?>
<h1 class="details_headline"><?php echo $row['SAMMLUNGSBEZEICHNUNG']; ?></h1>
<div class="details_container">

    <div class="details_boxcontent">
        <table>
            <tr>
                <th>Zutat</th>
                <th>Menge</th>
            </tr>
            <?php
            while ($row_content = $result_content->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row_content['BEZEICHNUNG'] . '</td>';
                echo '<td>' . $row_content['ZUTATENMENGE'] . '</td>';
                echo '</tr>';

                if ($maxAmount < ($row_content['BESTAND'] / $row_content['ZUTATENMENGE'])) {
                    $maxAmount =floor($row_content['BESTAND'] / $row_content['ZUTATENMENGE']);
                }
            }
            ?>
        </table>
    </div>

    <img src="<?php get_image("s", $row['SAMMLUNGSNR']); ?>" alt="Bild der Zutat" class="details_pic">

    <div class="details_info">
        <ul>
            <li>Verfügbar: <?php echo $maxAmount; ?></li>
            <li>Einzelpreis der Zutaten: <?php echo $row['Gesamtpreis']; ?> €</li>
            <li>Preis in netto: <?php echo $row['RabattPreis']; ?> €</li>
        </ul>
    </div>

    <div class="details_order">
        <form action="/box/<?php echo $row['SAMMLUNGSNR']; ?>" method="post">
    	    <input type="hidden" name="SAMMLUNGSNR" value="<?php echo $row['SAMMLUNGSNR']; ?>">
            <label for="amount">Menge</label>
            <input type="number" id="amount" name="amount" min="1" max="<?php echo $maxAmount; ?>" value="1">
            <input type="submit" name="AddToCard" value="Zum Warenkorb hinzufügen">
        </form>
    </div>

</div>
<?php
} else {
    echo "<h1 class=\"details_headline\">Es wurde keine Zutat gewählt</h1>";
}

?>
