<?php
  $query = "SELECT * FROM KUNDE";

  if($_GET['type'] == 'discount'){

  }
  if($_GET['type'] == 'bio'){

  }
  if($_GET['type'] == 'recipe'){

  }

  # execute sql statement
  $result = sql_fetch($query, False);

  while($row = $result->fetch_assoc()) {
    echo "dataset";
  }
?>
