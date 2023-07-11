<?php
# Needs to be the same as class [NAME]
new ControllerBoxesDetails($controllers, $db, ["Content" => "boxes_details"]);
# Be sure to give it a unique name.
class ControllerBoxesDetails extends BaseController {

    public function RunEarly() {
        global $vars;
        global $auth;
        if(isset($_POST['AddToCartBoxes'])) {
            # id of cart
            $query = "SELECT BESTELLUNG.BESTELLNR FROM BESTELLUNG WHERE BESTELLUNG.STATUS = :orderstate AND BESTELLUNG.KUNDENNR = :userid";
            $params = [':orderstate' => 'Warenkorb', ':userid' => $auth->UserID()];
            $orderid = $this->db->executeSingleRowQuery($query, $params)['BESTELLNR'];

            # test if the ingredient is already in the cart
            $query = "SELECT * FROM BESTELLUNGSAMMLUNG WHERE BESTELLNR=:orderid AND SAMMLUNGSNR=:boxid";
            $params = [':orderid' => $orderid,
                        ':boxid' => $_POST['SAMMLUNGSNR']];
            if($this->db->executeExists($query, $params)){
                # read amount
                $query = "SELECT MENGE FROM BESTELLUNGSAMMLUNG WHERE BESTELLNR=:orderid AND SAMMLUNGSNR=:boxid";
                $params = [':orderid' => $orderid,
                            ':boxid' => $_POST['SAMMLUNGSNR']];
                $amount = $this->db->executeSingleRowQuery($query, $params)['MENGE'];
                # Update row
                $query = "UPDATE BESTELLUNGSAMMLUNG SET MENGE=:amount WHERE BESTELLNR=:orderid AND SAMMLUNGSNR=:boxid";
                $params = [':orderid' => $orderid,
                            ':boxid' => $_POST['SAMMLUNGSNR'],
                            ':amount' => $amount + $_POST['amount']];
                $this->db->execute($query, $params);
            } else {
                # insert new
                $query = "INSERT INTO BESTELLUNGSAMMLUNG (BESTELLNR, SAMMLUNGSNR, MENGE) VALUES (:orderid, :boxid, :amount)";
                $params = [':orderid' => $orderid,
                            ':boxid' => $_POST['SAMMLUNGSNR'],
                            ':amount' => $_POST['amount']];
                $this->db->execute($query, $params);
            }
        }
    }

    public function RunDefault() {
        global $vars;

        # DB Request with only a single row expected
        # Take a look at controllers/header_user.php for a better example

        # Get Box Details
        $query = "SELECT SAMMLUNG.SAMMLUNGSNR, SAMMLUNG.SAMMLUNGSBEZEICHNUNG,
                        sum(ZUTAT.NETTOPREIS * SAMMLUNGZUTAT.ZUTATENMENGE) AS 'Gesamtpreis',
                        sum(ZUTAT.NETTOPREIS * SAMMLUNGZUTAT.ZUTATENMENGE)-round(sum(ZUTAT.NETTOPREIS * SAMMLUNGZUTAT.ZUTATENMENGE)*(SAMMLUNG.RABATT/100),2)
                        AS 'RabattPreis' FROM SAMMLUNG LEFT JOIN SAMMLUNGZUTAT ON SAMMLUNGZUTAT.SAMMLUNGSNR = SAMMLUNG.SAMMLUNGSNR
                        LEFT JOIN ZUTAT ON ZUTAT.ZUTATENNR = SAMMLUNGZUTAT.ZUTATENNR WHERE SAMMLUNG.SAMMLUNGSNR=:id";

        $params = array(':id' => $_GET['id']);
        $vars['box'] = $this->db->executeSingleRowQuery($query, $params);

        # Get Box Ingredients
        $query = "SELECT SAMMLUNGZUTAT.ZUTATENNR, ZUTAT.BEZEICHNUNG, ZUTAT.BESTAND, SAMMLUNGZUTAT.ZUTATENMENGE FROM SAMMLUNGZUTAT
                                LEFT JOIN ZUTAT ON ZUTAT.ZUTATENNR = SAMMLUNGZUTAT.ZUTATENNR
                                WHERE SAMMLUNGZUTAT.SAMMLUNGSNR=:id";
        $params = array(':id' => $_GET['id']);
        $vars['box_content'] = $this->db->executeQuery($query, $params);

        # Get Max Possible Box amount depending on ingredients
        $vars['box']['maxAmount'] = NULL;
        foreach($vars['box_content'] as $content)
            if(is_null($vars['box']['maxAmount']) || ($vars['box']['maxAmount'] > $content['BESTAND'] / $content['ZUTATENMENGE']))
                $vars['box']['maxAmount'] = floor($content['BESTAND'] / $content['ZUTATENMENGE']);
    }
}
?>
