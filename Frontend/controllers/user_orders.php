<?php
# Needs to be the same as class [NAME]
new ControllerUserOrders($controllers, $db, ["Content" => "user_orders"]);
# Be sure to give it a unique name.
class ControllerUserOrders extends BaseController {
    public function RunDefault() {
        global $vars;
        global $auth;
        $query = "SELECT BESTELLNR, BESTELLDATUM, RECHNUNGSBETRAG FROM BESTELLUNG WHERE KUNDENNR=:userid AND STATUS=:orderstate";
        $params = [":userid" => $auth->UserID(),
                    ":orderstate" => "Bestellt"];
        $vars['orders'] = $this->db->executeQuery($query, $params);
    }
}
?>
