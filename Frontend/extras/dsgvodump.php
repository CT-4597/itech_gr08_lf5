<?php
  include('../includes/config.php');
  include('../includes/logger.php');
  include('../includes/database.php');
  include('../includes/auth.php');

  $db = new DatabaseConnection($CONFIG['dbhost'], $CONFIG['dbuser'], $CONFIG['dbpassword'], $CONFIG['dbname']);

  # Authentification
  session_start();
  $auth = new authentification($db);

  if(!$auth->LoggedIn())
    exit();

  $params = [":userid" => $auth->UserID()];
  $query_user = "SELECT * FROM KUNDE WHERE KUNDENNR=:userid";
  $query_orders_ingredients = "SELECT * FROM BESTELLUNG JOIN BESTELLUNGZUTAT WHERE BESTELLUNG.KUNDENNR = :userid";
  $query_orders_boxes = "SELECT * FROM BESTELLUNG JOIN BESTELLUNGSAMMLUNG WHERE BESTELLUNG.KUNDENNR = :userid";
  $query_orders = "SELECT KUNDE.*, BESTELLUNG.*, SAMMLUNG.SAMMLUNGSBEZEICHNUNG FROM KUNDE LEFT JOIN BESTELLUNG ON BESTELLUNG.KUNDENNR = KUNDE.KUNDENNR LEFT JOIN BESTELLUNGSAMMLUNG ON BESTELLUNGSAMMLUNG.BESTELLNR = BESTELLUNG.BESTELLNR LEFT JOIN SAMMLUNG ON SAMMLUNG.SAMMLUNGSNR = BESTELLUNGSAMMLUNG.SAMMLUNGSNR WHERE KUNDE.KUNDENNR = :userid";

  function resultToCSV($result) {
      $fields = array_keys($result[0]);
      $csv_data = implode(",", $fields) . "\n";
      foreach ($result as $row) {
          $csv_data .= implode(",", $row) . "\n";
      }
      return $csv_data;
  }

  $csv_data = resultToCSV($db->executeQuery($query_user, $params));
  $csv_data .= resultToCSV($db->executeQuery($query_orders_ingredients, $params));
  $csv_data .= resultToCSV($db->executeQuery($query_orders_boxes, $params));
  $csv_data .= resultToCSV($db->executeQuery($query_orders, $params));

  $output_filename = "dsgvodump_" . (string)$auth->UserID() . ".csv";
  header("Content-Type: text/csv");
  header("Content-Disposition: attachment; filename=$output_filename");
  echo $csv_data;
  exit;
 ?>
