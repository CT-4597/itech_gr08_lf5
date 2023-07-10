<?php
# Needs to be the same as class [NAME]
new ControllerCartOrder($controllers, $db, ["Content" => "cart_order"]);
# Be sure to give it a unique name.
class ControllerCartOrder extends BaseController {
    public function RunEarly() {
        global $vars;
        global $auth;

        $query = "UPDATE BESTELLUNG SET BESTELLDATUM=:orderdate, RECHNUNGSBETRAG=:total_price, STATUS=:neworderstate WHERE STATUS:orderstate AND KUNDENNR=:userid";
        $params = [":orderdate" => 'now()',
                    ":total_price" => 0,
                    ":neworderstate" => 'Bestellt',
                    ":orderstate" => 'Warenkorb',
                    ":userid" => $auth->UserID()];
        $this->db->execute($query, $params);
    }
}


?>
