<?php
include('../includes/config.php');

session_start();

$user_id = $_SESSION['userid'];
$query_dsgvo_download = "SELECT KUNDE.*, BESTELLUNG.*, SAMMLUNG.SAMMLUNGSBEZEICHNUNG FROM KUNDE
                            LEFT JOIN BESTELLUNG ON BESTELLUNG.KUNDENNR = KUNDE.KUNDENNR
                            LEFT JOIN BESTELLUNGSAMMLUNG ON BESTELLUNGSAMMLUNG.BESTELLNR = BESTELLUNG.BESTELLNR
                            LEFT JOIN SAMMLUNG ON SAMMLUNG.SAMMLUNGSNR = BESTELLUNGSAMMLUNG.SAMMLUNGSNR
                            WHERE KUNDE.KUNDENNR = $user_id";

$conn->query(query_dsgvo_download);
$result = sql_fetch($query_dsgvo_download);

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

// Dateidownload-Header setzen
# header("Content-Type: text/csv");
# header("Content-Disposition: attachment; filename=$output_filename");

// CSV-Daten an den Browser senden
echo $csv_data;
# exit;

 ?>
