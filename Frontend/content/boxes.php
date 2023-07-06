<?php
  $query = "SELECT * FROM SAMMLUNG
			LEFT JOIN (SELECT SAMMLUNGZUTAT.SAMMLUNGSNR AS SAMMLUNGMITALLERGENNR FROM SAMMLUNGZUTAT JOIN ZUTATALLERGEN ON SAMMLUNGZUTAT.ZUTATENNR = ZUTATALLERGEN.ZUTATENNR WHERE ZUTATALLERGEN.ALLERGENNR = 1) sub
            ON SAMMLUNG.SAMMLUNGSNR = sub.SAMMLUNGMITALLERGENNR
            WHERE SAMMLUNGMITALLERGENNR IS NULL AND SAMMLUNGSTYPNR=1";

  if($_GET['type'] == 'discount'){
    $query .= "2"
  }

  if($_GET['type'] == 'bio'){
    $query .= "3"
  }

  if($_GET['type'] == 'recipe'){
    $query .= "1"
  }

  # execute sql statement
  $result = sql_fetch($query, False);
  if(result){
    while($row = $result->fetch_assoc()) {

    }
  }
?>
