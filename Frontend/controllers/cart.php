<?php
# Needs to be the same as class [NAME]
new ControllerCart($controllers, $db, ["Content" => "cart"]);
# Be sure to give it a unique name.
class ControllerCart extends BaseController {
    public function RunDefault() {
        global $vars;
        global $auth;

        $query = "SELECT count(*) FROM BESTELLUNG WHERE STATUS=:status AND KUNDENNR=:userid";
        $params = [':status' => 'Warenkorb', ':userid' => $auth->userid];

        $vars['cart'] = $db->executeQuery($query, $params);

        # boxes in cart
        $query_cart_ingredients = "SELECT ZUTAT.ZUTATENNR, ZUTAT.BEZEICHNUNG FROM KUNDE LEFT JOIN BESTELLUNG ON BESTELLUNG.KUNDENNR = KUNDE.KUNDENNR LEFT JOIN BESTELLUNGZUTAT ON BESTELLUNGZUTAT.BESTELLNR = BESTELLUNG.BESTELLNR LEFT JOIN ZUTAT ON ZUTAT.ZUTATENNR = BESTELLUNGZUTAT.ZUTATENNR WHERE BESTELLUNG.STATUS=:orderstate AND KUNDE.KUNDENNR=:userid";
        $params = [':orderstate' => 'Warenkorb', ':userid' => $auth->UserID()];

        $vars['cart_ingeredients'] = $this->db->executeQuery($query_cart_ingredients, $params);

        $query_cart_boxes = "SELECT SAMMLUNG.SAMMLUNGSNR, SAMMLUNG.SAMMLUNGSBEZEICHNUNG FROM KUNDE LEFT JOIN BESTELLUNG ON BESTELLUNG.KUNDENNR = KUNDE.KUNDENNR LEFT JOIN BESTELLUNGSAMMLUNG ON BESTELLUNGSAMMLUNG.BESTELLNR = BESTELLUNG.BESTELLNR LEFT JOIN SAMMLUNG ON SAMMLUNG.SAMMLUNGSNR = BESTELLUNGSAMMLUNG.SAMMLUNGSNR WHERE BESTELLUNG.STATUS=:orderstate AND KUNDE.KUNDENNR=:userid";
        $params = [':orderstate' => 'Warenkorb', ':userid' => $auth->UserID()];

        $vars['cart_boxes'] = $this->db->executeQuery($query_cart_boxes, $params);
    }
}
?>
