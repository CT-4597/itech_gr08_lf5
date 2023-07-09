<?php
# Needs to be the same as class [NAME]
new ControllerBoxes($controllers, $db, ["Content" => "boxes"]);
# Be sure to give it a unique name.
class ControllerBoxes extends BaseController {
    public function RunDefault() {
        global $vars;

        # adding allergies to clause
        $params = array();
        $placeholders = array();

        foreach ($_SESSION['allergies'] as $id) {
            $placeholders[] = 'ZUTATALLERGEN.ALLERGENNR != :allergen_' . $id;
            $params[':allergen_' . $id] = $id;
        }
        $query_allergies = '';
        if(count($_SESSION['allergies']) > 0)
            $query_allergies = ' OR ' . implode(' OR ', $placeholders);

        # Adding category clause placeholder to query
        if ($_SESSION['category'] != NULL && $_SESSION['category'] != "0") {
            $query_catergory = ' AND ERNAEHRUNGSKATEGORIE.KATEGORIENR = :category';
            $params[':category'] = $_SESSION['category'];
        } else {
            $query_catergory = '';
        }

        # query with allergies and category
        $query = "SELECT * FROM SAMMLUNG
                    LEFT JOIN (SELECT SAMMLUNGZUTAT.SAMMLUNGSNR AS SAMMLUNGMITALLERGENNR FROM SAMMLUNGZUTAT JOIN ZUTATALLERGEN
                    ON SAMMLUNGZUTAT.ZUTATENNR = ZUTATALLERGEN.ZUTATENNR WHERE FALSE$query_allergies) sub
                    ON SAMMLUNG.SAMMLUNGSNR = sub.SAMMLUNGMITALLERGENNR
                    WHERE SAMMLUNGMITALLERGENNR IS NULL AND SAMMLUNGSTYPNR={$_GET['typeid']}";

        $vars['boxes'] = $this->db->executeQuery($query, $params);
    }
}
?>