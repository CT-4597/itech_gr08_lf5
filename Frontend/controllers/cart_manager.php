<?php
# Needs to be the same as class [NAME]
new ControllerCartManager($controllers, $db, ["CartDisplay" => 'cart_display']);

# Be sure to give it a unique name.
class ControllerCartManager extends BaseController {
    public function RunDefault() {
        global $vars;
        global $auth;

        # num items in cart - ingredients
        $query = "SELECT SUM(BESTELLUNGZUTAT.MENGE) AS Anzahl_Zutaten FROM BESTELLUNG
                    JOIN KUNDE ON BESTELLUNG.KUNDENNR = KUNDE.KUNDENNR
                    JOIN BESTELLUNGZUTAT ON BESTELLUNG.BESTELLNR = BESTELLUNGZUTAT.BESTELLNR
                    WHERE BESTELLUNG.STATUS = :orderstate AND KUNDE.KUNDENNR = :userid";

        $params = [':orderstate' => 'Warenkorb', ':userid' => $auth->UserID()];

        $row = $this->db->executeSingleRowQuery($query, $params);

        $vars['cart_num_items'] = $row['Anzahl_Zutaten'];
    }
}
?>
