<?php
  $sql = 'SELECT * FROM SAMMLUNG
            LEFT JOIN (SELECT SAMMLUNGZUTAT.SAMMLUNGSNR AS SAMMLUNGMITALLERGENNR FROM SAMMLUNGZUTAT JOIN ZUTATALLERGEN
            ON SAMMLUNGZUTAT.ZUTATENNR = ZUTATALLERGEN.ZUTATENNR WHERE FALSE';
            
  foreach ($_SESSION['allergies'] as $id) {
    $sql = $sql . ' OR ZUTATALLERGEN.ALLERGENNR = ' . $id . ')';
  }

  $sql = $sql . ') sub ON SAMMLUNG.SAMMLUNGSNR = sub.SAMMLUNGMITALLERGENNR WHERE SAMMLUNGMITALLERGENNR IS NULL';

  if($_GET['type'] == 'discount'){
    $sql .= " AND SAMMLUNGSTYPNR = 2"
  }

  if($_GET['type'] == 'bio'){
    $sql .= " AND SAMMLUNGSTYPNR = 3"
  }

  if($_GET['type'] == 'recipe'){
    $sql .= " AND SAMMLUNGSTYPNR = 1"
  }

  # execute sql statement
  $sql = log_sql($sql);
	$result = $conn->query($sql);


	if ($result->num_rows > 0) {

	    // output data of each row
	    while($row = $result->fetch_assoc()) {
            ?>
            <a href="/zutat/<?php echo $row["SAMMLUNGSNR"] ?>" class="ingredients_flexitem">
                <div><img src="<?php get_image("s", $row['SAMMLUNGSNR']); ?>" alt="Bild der Box" class="ingredients_pic"></div>
                <div><?php echo $row['SAMMLUNGSBEZEICHNUNG']; ?></div>
            </a>
            <?php
        }
	} else {
	    echo "0 results";
	}
?>
