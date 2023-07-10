<?php
# Needs to be the same as class [NAME]
new ControllerIngredientsDetails($controllers, $db, ["Content" => "ingredients_details"]);
# Be sure to give it a unique name.
class ControllerIngredientsDetails extends BaseController {

    public function RunEarly() {
        global $vars;
        global $auth;
        if(isset($_POST['AddToCartIngredient'])) {
            # id of cart
            $query = "SELECT BESTELLUNG.BESTELLNR FROM BESTELLUNG WHERE BESTELLUNG.STATUS = :orderstate AND BESTELLUNG.KUNDENNR = :userid";
            $params = [':orderstate' => 'Warenkorb', ':userid' => $auth->UserID()];
            $orderid = $this->db->executeSingleRowQuery($query, $params)['BESTELLNR'];
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

    public function RunDefault() {
        global $vars;

        # DB Request with only a single row expected
        # Take a look at controllers/header_user.php for a better example
        $query = "SELECT * FROM ZUTAT WHERE ZUTATENNR=:id";
        $params = array(':id' => $_GET['id']);
        $vars['ingredient'] = $this->db->executeSingleRowQuery($query, $params);
    }
}
?>
