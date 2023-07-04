<div class="ingredients_flexbox">
<?php

	$sql = log_sql("SELECT * FROM ZUTAT");
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