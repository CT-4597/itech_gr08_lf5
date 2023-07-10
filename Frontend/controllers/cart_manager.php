<?php
# Needs to be the same as class [NAME]
new ControllerCartManager($controllers, $db, ["CartDisplay" => 'cart_display']);

# Be sure to give it a unique name.
class ControllerCartManager extends BaseController {

    public function RunEarly() {
        global $vars;
        global $auth;
        Logger::log("### Cart Manager Early ###");
        if(isset($_POST['AddToCartIngredient'])) {
            # id of cart
            $query = "SELECT BESTELLUNG.BESTELLNR FROM BESTELLUNG WHERE BESTELLUNG.STATUS = :orderstate AND KUNDE.KUNDENNR = :userid";
            $params = [':orderstate' => 'Warenkorb', ':userid' => $auth->UserID()];
            $row = $this->db->executeSingleRowQuery($query, $params);
            Logger::log("Cart ID: " . $row['BESTELLNR']);
        } else {
            Logger::log("Did nothing.");
        }

    }

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

        # num items in cart - boxes
        $query = "SELECT SUM(BESTELLUNGSAMMLUNG.MENGE) AS Anzahl_Zutaten FROM BESTELLUNG
                    JOIN KUNDE ON BESTELLUNG.KUNDENNR = KUNDE.KUNDENNR
                    JOIN BESTELLUNGSAMMLUNG ON BESTELLUNG.BESTELLNR = BESTELLUNGSAMMLUNG.BESTELLNR
                    WHERE BESTELLUNG.STATUS = :orderstate AND KUNDE.KUNDENNR = :userid";

        $params = [':orderstate' => 'Warenkorb', ':userid' => $auth->UserID()];

        $row = $this->db->executeSingleRowQuery($query, $params);

        $vars['cart_num_items'] += $row['Anzahl_Zutaten'];
    }
}
?>
