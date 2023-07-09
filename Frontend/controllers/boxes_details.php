<?php
# Needs to be the same as class [NAME]
new ControllerBoxesDetails($controllers, $db, ["Content" => "boxes_details"]);
# Be sure to give it a unique name.
class ControllerBoxesDetails extends BaseController {
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
        foreach($vars['box_content'] as $content) {
            if(is_null($vars['box']['maxAmount']) || ($vars['box']['maxAmount'] > $content['BESTAND'] / $content['ZUTATENMENGE'])) {
                $vars['box']['maxAmount'] = floor($content['BESTAND'] / $content['ZUTATENMENGE'])
            }
        }

    }
}
?>
