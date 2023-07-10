<?php
# Needs to be the same as class [NAME]
new ControllerCartManager($controllers, $db, ["CartDisplay" => cart_display.php]);

# Be sure to give it a unique name.
class ControllerCartManager extends BaseController {
    public function RunDefault() {
        global $vars;
        global $auth;

        # boxes in cart
        $query_cart_ingredients = "SELECT ZUTAT.ZUTATENNR, ZUTAT.BEZEICHNUNG, ZUTAT.NETTOPREIS, ZUTAT.EINHEIT, BESTELLUNGZUTAT.MENGE, FORMAT((ZUTAT.NETTOPREIS * BESTELLUNGZUTAT.MENGE), 2) as GESAMTPREIS
                                    FROM BESTELLUNG
                                    JOIN KUNDE ON BESTELLUNG.KUNDENNR = KUNDE.KUNDENNR
                                    JOIN BESTELLUNGZUTAT ON BESTELLUNG.BESTELLNR = BESTELLUNGZUTAT.BESTELLNR
                                    JOIN ZUTAT ON BESTELLUNGZUTAT.ZUTATENNR = ZUTAT.ZUTATENNR
                                    WHERE BESTELLUNG.STATUS = :orderstate AND KUNDE.KUNDENNR = :userid";
        $params = [':orderstate' => 'Warenkorb', ':userid' => $auth->UserID()];

        # $vars['cart_ingeredients'] = $this->db->executeQuery($query_cart_ingredients, $params);

        $query_cart_boxes = "SELECT SAMMLUNG.SAMMLUNGSNR, SAMMLUNG.SAMMLUNGSBEZEICHNUNG, BESTELLUNGSAMMLUNG.MENGE,
                                FORMAT((SUM(ZUTAT.NETTOPREIS * SAMMLUNGZUTAT.ZUTATENMENGE) / 100 * (100 - SAMMLUNG.RABATT)), 2) AS EINZELPREIS,
                                FORMAT((SUM(ZUTAT.NETTOPREIS * SAMMLUNGZUTAT.ZUTATENMENGE) / 100 * (100 - SAMMLUNG.RABATT)) * BESTELLUNGSAMMLUNG.MENGE, 2) AS GESAMTPREIS
                                FROM BESTELLUNG
                                JOIN KUNDE ON BESTELLUNG.KUNDENNR = KUNDE.KUNDENNR
                                LEFT JOIN BESTELLUNGSAMMLUNG ON BESTELLUNG.BESTELLNR = BESTELLUNGSAMMLUNG.BESTELLNR
                                LEFT JOIN SAMMLUNG ON BESTELLUNGSAMMLUNG.SAMMLUNGSNR = SAMMLUNG.SAMMLUNGSNR
                                LEFT JOIN SAMMLUNGZUTAT ON SAMMLUNG.SAMMLUNGSNR = SAMMLUNGZUTAT.SAMMLUNGSNR
                                LEFT JOIN ZUTAT ON SAMMLUNGZUTAT.ZUTATENNR = ZUTAT.ZUTATENNR
                                WHERE BESTELLUNG.STATUS = :orderstate AND KUNDE.KUNDENNR = :userid GROUP BY SAMMLUNG.SAMMLUNGSNR, SAMMLUNG.SAMMLUNGSBEZEICHNUNG";
        $params = [':orderstate' => 'Warenkorb', ':userid' => $auth->UserID()];

        # $vars['cart_boxes'] = $this->db->executeQuery($query_cart_boxes, $params);

        $vars['cart_num_items'] = 10;
    }
}
?>
