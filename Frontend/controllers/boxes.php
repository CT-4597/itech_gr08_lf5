<?php

# Be sure to give it a unique name.
class ControllerBoxes {
    # Do you need to be loggin for this controller?
    public bool $logged_in = False;
    public string $logged_in_redirect = '/';
    # Do you need to be a admin?
    public bool $admin = False;
    public string $admin_redirect = '/';

    # The viewer name. without suffix.
    # views can be reused if build for
    public string $view = 'boxes';
    # the container the viewer is rendered in.
    public string $container = 'Content';

    # var holden the database class
    public $db;

    public function __construct(array &$arr, &$db) {
        array_push($arr, $this);
        $this->db = $db;
    }

    public function RunEarly() {

    }

    public function RunDefault() {
        global $vars;

        # adding allergies to clause
        $params = array();
        $placeholders = array();

        foreach ($_SESSION['allergies'] as $id) {
            $placeholders[] = 'ZUTATALLERGEN.ALLERGENNR != :allergen_' . $id;
            $params[':allergen_' . $id] = $id;
        }
        if(count($_SESSION['allergies']) > 0)
            $query_allergies .= implode(' OR ', $placeholders);

        # Adding category clause placeholder to query
        if ($_SESSION['category'] != NULL && $_SESSION['category'] != "0") {
            $query_catergory .= ' AND ERNAEHRUNGSKATEGORIE.KATEGORIENR = :category';
            $params[':category'] = $_SESSION['category'];
        }

        # query with allergies and category
        $query = "SELECT * FROM SAMMLUNG
                    LEFT JOIN (SELECT SAMMLUNGZUTAT.SAMMLUNGSNR AS SAMMLUNGMITALLERGENNR FROM SAMMLUNGZUTAT JOIN ZUTATALLERGEN
                    ON SAMMLUNGZUTAT.ZUTATENNR = ZUTATALLERGEN.ZUTATENNR WHERE FALSE $query_catergory) sub
                    ON SAMMLUNG.SAMMLUNGSNR = sub.SAMMLUNGMITALLERGENNR
                    WHERE SAMMLUNGMITALLERGENNR IS NULL$query_catergory AND SAMMLUNGSTYPNR={$_GET['id']}";

        $vars['boxes'] = $this->db->executeQuery($query, $params);
    }

    public function RunLate() {

    }
}

# Needs to be the same as class [NAME]
new ControllerBoxes($controllers, $db);
?>
