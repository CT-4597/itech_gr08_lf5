<?php
  include('../includes/config.php');
  include('../includes/logger.php');
  include('../includes/database.php');
  include('../includes/auth.php');

  $db = new DatabaseConnection($CONFIG['dbhost'], $CONFIG['dbuser'], $CONFIG['dbpassword'], $CONFIG['dbname']);

  # Authentification
  session_start();
  $auth = new authentification($db);

  $params = [":userid" => $auth->UserID()];
  $query_user = "SELECT * FROM KUNDE WHERE KUNDENNR=:userid";
  $query_orders_ingredients = "SELECT * FROM BESTELLUNG JOIN BESTELLUNGZUTAT WHERE BESTELLUNG.KUNDENNR = :userid";
  $query_orders_boxes = "SELECT * FROM BESTELLUNG JOIN BESTELLUNGSAMMLUNG WHERE BESTELLUNG.KUNDENNR = :userid";
  $query_orders = "SELECT KUNDE.*, BESTELLUNG.*, SAMMLUNG.SAMMLUNGSBEZEICHNUNG FROM KUNDE LEFT JOIN BESTELLUNG ON BESTELLUNG.KUNDENNR = KUNDE.KUNDENNR LEFT JOIN BESTELLUNGSAMMLUNG ON BESTELLUNGSAMMLUNG.BESTELLNR = BESTELLUNG.BESTELLNR LEFT JOIN SAMMLUNG ON SAMMLUNG.SAMMLUNGSNR = BESTELLUNGSAMMLUNG.SAMMLUNGSNR WHERE KUNDE.KUNDENNR = :userid";

  function resultToCSV($rows) {
      return '';
  }

  $csv_data = resultToCSV($db->executeQuery($query_user, $params));
  $csv_data .= resultToCSV($db->executeQuery($query_orders_ingredients, $params));
  $csv_data .= resultToCSV($db->executeQuery($query_orders_boxes, $params));
  $csv_data .= resultToCSV($db->executeQuery($query_orders, $params));


  /*function getcsv($query) {
    global $conn;
    $result = $conn->query($query);

    // get attribute names
    $fields = $result->fetch_fields();
    $column_names = array();
    foreach ($fields as $field) {
        $column_names[] = $field->name;
    }

    // create csv
    $csv_data = implode(",", $column_names) . "\n";
    while ($row = $result->fetch_assoc()) {
        $csv_data .= implode(",", $row) . "\n";
    }
    return $csv_data;
  }
  $output_filename = "dsgvodump_" . (string)$_SESSION['userid'] . ".csv";

  $user_id = $_SESSION['userid'];

  $query_personal_data = "SELECT * FROM KUNDE WHERE KUNDENNR=$user_id";
  $query_orders_ingredients = "SELECT * FROM BESTELLUNG JOIN BESTELLUNGZUTAT WHERE BESTELLUNG.KUNDENNR = $user_id";
  $query_orders_boxes = "SELECT * FROM BESTELLUNG JOIN BESTELLUNGSAMMLUNG WHERE BESTELLUNG.KUNDENNR = $user_id";

  $query_dsgvo_download = "SELECT KUNDE.*, BESTELLUNG.*, SAMMLUNG.SAMMLUNGSBEZEICHNUNG FROM KUNDE LEFT JOIN BESTELLUNG ON BESTELLUNG.KUNDENNR = KUNDE.KUNDENNR LEFT JOIN BESTELLUNGSAMMLUNG ON BESTELLUNGSAMMLUNG.BESTELLNR = BESTELLUNG.BESTELLNR LEFT JOIN SAMMLUNG ON SAMMLUNG.SAMMLUNGSNR = BESTELLUNGSAMMLUNG.SAMMLUNGSNR WHERE KUNDE.KUNDENNR = $user_id";

  $csv_data = '';
  $csv_data .= getcsv($query_personal_data);
  $csv_data .= getcsv($query_orders_ingredients);
  $csv_data .= getcsv($query_orders_boxes);

  // Dateidownload-Header setzen
  header("Content-Type: text/csv");
  header("Content-Disposition: attachment; filename=$output_filename");

  // CSV-Daten an den Browser senden
  echo $csv_data;
  exit;*/

 ?>
