<?
  $query = "SELECT * FROM SAMMLUNG
			LEFT JOIN (SELECT SAMMLUNGZUTAT.SAMMLUNGSNR AS SAMMLUNGMITALLERGENNR FROM SAMMLUNGZUTAT JOIN ZUTATALLERGEN ON SAMMLUNGZUTAT.ZUTATENNR = ZUTATALLERGEN.ZUTATENNR WHERE ZUTATALLERGEN.ALLERGENNR = 1) sub
            ON SAMMLUNG.SAMMLUNGSNR = sub.SAMMLUNGMITALLERGENNR
            WHERE SAMMLUNGMITALLERGENNR IS NULL";

  if($_GET['type'] == 'discount'){

  }
  if($_GET['type'] == 'bio'){

  }
  if($_GET['type'] == 'recipe'){

  }

  # execute sql statement
  $result = sql_fetch($query);

  while($row = $result->fetch_assoc()) {
    echo "dataset";
  }
?>
