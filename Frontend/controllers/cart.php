<?php
# Needs to be the same as class [NAME]
new ControllerCart($controllers, $db, ["Content" => "cart"]);
# Be sure to give it a unique name.
class ControllerCart extends BaseController {
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

        $vars['cart_ingeredients'] = $this->db->executeQuery($query_cart_ingredients, $params);

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
        $query_cart_boxes = "SELECT SAMMLUNG.SAMMLUNGSNR, SAMMLUNG.SAMMLUNGSBEZEICHNUNG, BESTELLUNGSAMMLUNG.MENGE,
                                FORMAT((SUM(ZUTAT.NETTOPREIS * SAMMLUNGZUTAT.ZUTATENMENGE) / 100 * (100 - SAMMLUNG.RABATT)), 2) AS EINZELPREIS,
                                FORMAT((SUM(ZUTAT.NETTOPREIS * SAMMLUNGZUTAT.ZUTATENMENGE) / 100 * (100 - SAMMLUNG.RABATT)) * BESTELLUNGSAMMLUNG.MENGE, 2) AS GESAMTPREIS
                                FROM BESTELLUNG
                                JOIN KUNDE ON BESTELLUNG.KUNDENNR = KUNDE.KUNDENNR 
                                JOIN BESTELLUNGSAMMLUNG ON BESTELLUNG.BESTELLNR = BESTELLUNGSAMMLUNG.BESTELLNR
                                JOIN SAMMLUNG ON BESTELLUNGSAMMLUNG.SAMMLUNGSNR = SAMMLUNG.SAMMLUNGSNR
                                JOIN SAMMLUNGZUTAT ON SAMMLUNG.SAMMLUNGSNR = SAMMLUNGZUTAT.SAMMLUNGSNR
                                JOIN ZUTAT ON SAMMLUNGZUTAT.ZUTATENNR = ZUTAT.ZUTATENNR
                                WHERE BESTELLUNG.STATUS = :orderstate AND KUNDE.KUNDENNR = :userid
                                GROUP BY SAMMLUNG.SAMMLUNGSNR, SAMMLUNG.SAMMLUNGSBEZEICHNUNG";
        $params = [':orderstate' => 'Warenkorb', ':userid' => $auth->UserID()];

        $vars['cart_boxes'] = $this->db->executeQuery($query_cart_boxes, $params);
        Logger::log("Boxes in cart: " . (string)count($vars['cart_boxes']));

        # Get Order Total Price
        $vars['order_price_total'] = 0;
        foreach($vars['cart_ingeredients'] as $ingredient)
            $vars['order_price_total'] += $ingredient['GESAMTPREIS'];
        foreach($vars['cart_boxes'] as $box)
            $vars['order_price_total'] += $box['GESAMTPREIS'];

    }
}
?>
