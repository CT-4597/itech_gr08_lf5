<?php
# Needs to be the same as class [NAME]
new ControllerCartManager($controllers, $db, ["CartDisplay" => 'cart_display']);

# Be sure to give it a unique name.
class ControllerCartManager extends BaseController {

    public function RunEarly() {
        global $vars;
        global $auth;
        if(isset($_POST['AddToCartIngredient']) || isset($_POST['AddToCartBoxes'])) {
            # id of cart
            $query = "SELECT BESTELLUNG.BESTELLNR FROM BESTELLUNG WHERE BESTELLUNG.STATUS = :orderstate AND BESTELLUNG.KUNDENNR = :userid";
            $params = [':orderstate' => 'Warenkorb', ':userid' => $auth->UserID()];
            $orderid = $this->db->executeSingleRowQuery($query, $params)['BESTELLNR'];
            if(isset($_POST['AddToCartIngredient'])) {
                # test if the ingredient is already in the cart
                $query = "SELECT * FROM BESTELLUNGZUTAT WHERE BESTELLNR=:orderid AND ZUTATENNR=:ingredientid";
                $params = [':orderid' => $orderid,
                            ':ingredientid' => $_POST['ZUTATENNR']];
                if($this->db->executeExists($query, $params)){
                    # read amount
                    $query = "SELECT MENGE FROM BESTELLUNGZUTAT WHERE BESTELLNR=:orderid AND ZUTATENNR=:ingredientid";
                    $params = [':orderid' => $orderid,
                                ':ingredientid' => $_POST['ZUTATENNR']];
                    $amount = $this->db->executeSingleRowQuery($query, $params)['MENGE'];
                    # Update row
                    $query = "UPDATE BESTELLUNGZUTAT SET MENGE=:amount WHERE BESTELLNR=:orderid AND ZUTATENNR=:ingredientid";
                    $params = [':orderid' => $orderid,
                                ':ingredientid' => $_POST['ZUTATENNR'],
                                ':amount' => $amount + $_POST['amount']];
                    $this->db->execute($query, $params);
                } else {
                    # insert new
                    $query = "INSERT INTO BESTELLUNGZUTAT (BESTELLNR, ZUTATENNR, MENGE) VALUES (:orderid, :ingredientid, :amount)";
                    $params = [':orderid' => $orderid,
                                ':ingredientid' => $_POST['ZUTATENNR'],
                                ':amount' => $_POST['amount']];
                    $this->db->execute($query, $params);
                }
            }
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
