<div class="ingredients_flexbox">
<?php

	$sql = log_sql("SELECT * FROM ZUTAT");
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {

	    // output data of each row
	    while($row = $result->fetch_assoc()) {
            ?>
            <a href="/zutat/<?php echo $row["ZUTATENNR"] ?>" class="ingredients_flexitem">
                <img src="<?php get_image("z", $row['ZUTATENNR']); ?>" alt="Bild der Zutat">
                <p><?php echo $row['BEZEICHNUNG']; ?></p>
            </a>
            <?php
        }
	} else {
	    echo "0 results";
	}
?>
</div>