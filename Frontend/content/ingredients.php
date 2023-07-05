<div class="ingredients_flexbox">
<?php

	$sql = "SELECT ZUTAT.ZUTATENNR, ZUTAT.BEZEICHNUNG, ZUTAT.NETTOPREIS, ERNAEHRUNGSKATEGORIE.KATEGORIEBEZEICHNUNG AS 'Kategorie'  FROM ZUTAT
            LEFT JOIN ZUTATALLERGEN ON ZUTATALLERGEN.ZUTATENNR = ZUTAT.ZUTATENNR
            LEFT JOIN ALLERGEN ON ALLERGEN.ALLERGENNR = ZUTATALLERGEN.ALLERGENNR
            LEFT JOIN ZUTATKATEGORIE ON ZUTATKATEGORIE.ZUTATENNR = ZUTAT.ZUTATENNR
            LEFT JOIN ERNAEHRUNGSKATEGORIE ON ERNAEHRUNGSKATEGORIE.KATEGORIENR = ZUTATKATEGORIE.KATEGORIENR
            WHERE ((ZUTATALLERGEN.ALLERGENNR != 0)";

    foreach ($_SESSION['allergies'] as $id) {
        $sql = $sql . ' AND (ZUTATALLERGEN.ALLERGENNR != ' . $id . ')';
    }

    $sql = $sql . 'OR ZUTATALLERGEN.ALLERGENNR IS NULL)';
	$result = $conn->query($sql);


	if ($result->num_rows > 0) {

	    // output data of each row
	    while($row = $result->fetch_assoc()) {
            ?>
            <a href="/zutat/<?php echo $row["ZUTATENNR"] ?>" class="ingredients_flexitem">
                <div><img src="<?php get_image("z", $row['ZUTATENNR']); ?>" alt="Bild der Zutat" class="ingredients_pic"></div>
                <div><?php echo $row['BEZEICHNUNG']; ?></div>
            </a>
            <?php
        }
	} else {
	    echo "0 results";
	}
?>
</div>