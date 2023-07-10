<?php
# Needs to be the same as class [NAME]
new ControllerUserOrderDetails($controllers, $db, ["Content" => "user_order_details"]);
# Be sure to give it a unique name.
class ControllerUserOrderDetails extends BaseController {
    public function RunDefault() {
        global $vars;
        global $auth;
        $query = "SELECT BESTELLNR, BESTELLDATUM, RECHNUNGSBETRAG FROM BESTELLUNG WHERE BESTELLNR=:orderid";
        $params = [":orderid" => $_GET['id']];
        $vars['orderdetails'] = $this->db->executeQuery($query, $params);
    }
}
?>
