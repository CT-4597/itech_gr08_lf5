<?php
# Needs to be the same as class [NAME]
new ControllerUserOrderDetails($controllers, $db, ["Content" => "user_order_details"]);
# Be sure to give it a unique name.
class ControllerUserOrderDetails extends BaseController {
    public function RunDefault() {
        global $vars;
        global $auth;

        # Order Details
        $query = "SELECT BESTELLNR, BESTELLDATUM, RECHNUNGSBETRAG FROM BESTELLUNG WHERE BESTELLNR=:orderid";
        $params = [":orderid" => $_GET['id']];
        $vars['orderdetails'] = $this->db->executeSingleRowQuery($query, $params);

        # Order Ingredients
        $query_cart_ingredients = "SELECT ZUTAT.ZUTATENNR, ZUTAT.BEZEICHNUNG, ZUTAT.NETTOPREIS, ZUTAT.EINHEIT, BESTELLUNGZUTAT.MENGE, FORMAT((ZUTAT.NETTOPREIS * BESTELLUNGZUTAT.MENGE), 2) as GESAMTPREIS
                                    FROM BESTELLUNG
                                    JOIN KUNDE ON BESTELLUNG.KUNDENNR = KUNDE.KUNDENNR
                                    JOIN BESTELLUNGZUTAT ON BESTELLUNG.BESTELLNR = BESTELLUNGZUTAT.BESTELLNR
                                    JOIN ZUTAT ON BESTELLUNGZUTAT.ZUTATENNR = ZUTAT.ZUTATENNR
                                    WHERE BESTELLNR=:orderid";
        $params = [":orderid" => $_GET['id']];

        $vars['order_ingredients'] = $this->db->executeQuery($query_cart_ingredients, $params);

        # Order Boxes
        $query_cart_boxes = "SELECT SAMMLUNG.SAMMLUNGSNR, SAMMLUNG.SAMMLUNGSBEZEICHNUNG, BESTELLUNGSAMMLUNG.MENGE,
                                FORMAT((SUM(ZUTAT.NETTOPREIS * SAMMLUNGZUTAT.ZUTATENMENGE) / 100 * (100 - SAMMLUNG.RABATT)), 2) AS EINZELPREIS,
                                FORMAT((SUM(ZUTAT.NETTOPREIS * SAMMLUNGZUTAT.ZUTATENMENGE) / 100 * (100 - SAMMLUNG.RABATT)) * BESTELLUNGSAMMLUNG.MENGE, 2) AS GESAMTPREIS
                                FROM BESTELLUNG
                                JOIN KUNDE ON BESTELLUNG.KUNDENNR = KUNDE.KUNDENNR
                                LEFT JOIN BESTELLUNGSAMMLUNG ON BESTELLUNG.BESTELLNR = BESTELLUNGSAMMLUNG.BESTELLNR
                                LEFT JOIN SAMMLUNG ON BESTELLUNGSAMMLUNG.SAMMLUNGSNR = SAMMLUNG.SAMMLUNGSNR
                                LEFT JOIN SAMMLUNGZUTAT ON SAMMLUNG.SAMMLUNGSNR = SAMMLUNGZUTAT.SAMMLUNGSNR
                                LEFT JOIN ZUTAT ON SAMMLUNGZUTAT.ZUTATENNR = ZUTAT.ZUTATENNR
                                WHERE BESTELLNR=:orderid GROUP BY SAMMLUNG.SAMMLUNGSNR, SAMMLUNG.SAMMLUNGSBEZEICHNUNG";
        $params = [":orderid" => $_GET['id']];

        $vars['order_boxes'] = $this->db->executeQuery($query_cart_boxes, $params);
    }
}
?>
