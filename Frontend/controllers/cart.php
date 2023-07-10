<?php
# Needs to be the same as class [NAME]
new ControllerCart($controllers, $db, ["Content" => "cart"]);
# Be sure to give it a unique name.
class ControllerCart extends BaseController {
    public function RunDefault() {
        global $vars;
        global $auth;

        # boxes in cart
        $query_cart_ingredients = "SELECT ZUTAT.ZUTATENNR, ZUTAT.BEZEICHNUNG, ZUTAT.NETTOPREIS, ZUTAT.EINHEIT, BESTELLUNGZUTAT.MENGE
                                    FROM BESTELLUNG
                                    JOIN KUNDE ON BESTELLUNG.KUNDENNR = KUNDE.KUNDENNR
                                    JOIN BESTELLUNGZUTAT ON BESTELLUNG.BESTELLNR = BESTELLUNGZUTAT.BESTELLNR
                                    JOIN ZUTAT ON BESTELLUNGZUTAT.ZUTATENNR = ZUTAT.ZUTATENNR
                                    WHERE BESTELLUNG.STATUS = :orderstate AND KUNDE.KUNDENNR = :userid";
        $params = [':orderstate' => 'Warenkorb', ':userid' => $auth->UserID()];

        $vars['cart_ingeredients'] = $this->db->executeQuery($query_cart_ingredients, $params);

        $query_cart_boxes = "SELECT SAMMLUNG.SAMMLUNGSNR, SAMMLUNG.SAMMLUNGSBEZEICHNUNG FROM KUNDE LEFT JOIN BESTELLUNG ON BESTELLUNG.KUNDENNR = KUNDE.KUNDENNR LEFT JOIN BESTELLUNGSAMMLUNG ON BESTELLUNGSAMMLUNG.BESTELLNR = BESTELLUNG.BESTELLNR LEFT JOIN SAMMLUNG ON SAMMLUNG.SAMMLUNGSNR = BESTELLUNGSAMMLUNG.SAMMLUNGSNR WHERE BESTELLUNG.STATUS=:orderstate AND KUNDE.KUNDENNR=:userid";
        $params = [':orderstate' => 'Warenkorb', ':userid' => $auth->UserID()];

        $vars['cart_boxes'] = $this->db->executeQuery($query_cart_boxes, $params);
    }
}
?>
