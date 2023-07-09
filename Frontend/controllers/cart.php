<?php
# Needs to be the same as class [NAME]
new ControllerCart($controllers, $db, ["Content" => "cart"]);
# Be sure to give it a unique name.
class ControllerCart extends BaseController {
    public function RunDefault() {
        global $vars;

        $query = "SELECT count(*) FROM BESTELLUNG WHERE STATUS=:status AND KUNDENNR=:userid";
        
    }
}
?>
