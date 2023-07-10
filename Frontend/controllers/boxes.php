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

        # Building strings for allergies
        foreach ($_SESSION['allergies'] as $allergyid) {
            $placeholders[] = 'ZUTATALLERGEN.ALLERGENNR != :allergen_' . $allergyid;
            $params[':allergen_' . $allergyid] = $allergyid;
        }
        $query_allergies = '';
        $allergies = '';
        if(count($_SESSION['allergies']) > 0)
            $allergies = ' OR ' . implode(' OR ', $placeholders);

        # Adding category clause placeholder to query
        if ($_SESSION['category'] != NULL && $_SESSION['category'] != "0") {
            $catergory = ' AND ZUTATKATEGORIE.KATEGORIENR = :category';
            $params[':category'] = $_SESSION['category'];
        } else {
            $catergory = '';
        }


        # query with allergies and category

        $query = "SELECT * FROM (SELECT * FROM SAMMLUNG
                    LEFT JOIN (SELECT SAMMLUNGZUTAT.SAMMLUNGSNR AS SAMMLUNGMITALLERGENNR FROM SAMMLUNGZUTAT JOIN ZUTATALLERGEN
                    ON SAMMLUNGZUTAT.ZUTATENNR = ZUTATALLERGEN.ZUTATENNR WHERE FALSE{$allergies}) sub
                    ON SAMMLUNG.SAMMLUNGSNR = sub.SAMMLUNGMITALLERGENNR
                    WHERE SAMMLUNGMITALLERGENNR IS NULL AND SAMMLUNGSTYPNR={$_GET['id']}) subAll
                    WHERE NOT EXISTS
                    (SELECT subAll.SAMMLUNGSBEZEICHNUNG FROM SAMMLUNG AS SUB JOIN SAMMLUNGZUTAT ON subAll.SAMMLUNGSNR = SAMMLUNGZUTAT.SAMMLUNGSNR WHERE NOT EXISTS
                    (SELECT ZUTATKATEGORIE.ZUTATENNR FROM ZUTATKATEGORIE WHERE SAMMLUNGZUTAT.ZUTATENNR = ZUTATKATEGORIE.ZUTATENNR{$catergory})
                    AND SUB.SAMMLUNGSNR = subAll.SAMMLUNGSNR)";

        $vars['boxes'] = $this->db->executeQuery($query, $params);
    }
}
?>
