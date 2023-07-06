<?php
  $id = $_GET['id'];

  $query = "SELECT * FROM KUNDE WHERE KUNDENNR=$id";


  # execute sql statement
  $row = sql_fetch($query);

  $vorname = $row['VORNAME'];
  $nachname = $row['NACHNAME'];

  echo "$vorname</br>";
  echo "$nachname</br>";
?>
