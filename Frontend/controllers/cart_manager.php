<?php
# Needs to be the same as class [NAME]
new ControllerCartManager($controllers, $db, ["CartDisplay" => 'cart_display']);

# Be sure to give it a unique name.
class ControllerCartManager extends BaseController {

    public function RunDefault() {
        global $vars;
        global $auth;

        # Test if the user has a Cart, otherwise create one.
        $query = "SELECT * FROM BESTELLUNG WHERE STATUS=:orderstate AND KUNDENNR=:userid"
        $params = [":orderstate" => 'Warenkorb', ":userid" => $auth->UserID()]
        if(!$this->db->executeExists($query, $params)) {
            $query = "INSERT INTO BESTELLUNG (KUNDENNR, STATUS)
                        VALUES (:userid, :orderstate)";
            $params = [":orderstate" => 'Warenkorb', ":userid" => $auth->UserID()];
            $this->db->execute($query, $params);
        }
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
