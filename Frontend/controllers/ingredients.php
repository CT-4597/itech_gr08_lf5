<?php

# Be sure to give it a unique name.
class ControllerIngredients {
    # Do you need to be loggin for this controller?
    public bool $logged_in = False;
    public string $logged_in_redirect = '/';
    # Do you need to be a admin?
    public bool $admin = False;
    public string $admin_redirect = '/';

    # The viewer name. without suffix.
    # views can be reused if build for
    public string $view = 'ingredients';
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
        $query = "SELECT DISTINCT ZUTAT.ZUTATENNR, ZUTAT.BEZEICHNUNG FROM ZUTAT
            LEFT JOIN ZUTATALLERGEN ON ZUTATALLERGEN.ZUTATENNR = ZUTAT.ZUTATENNR
            LEFT JOIN ALLERGEN ON ALLERGEN.ALLERGENNR = ZUTATALLERGEN.ALLERGENNR
            LEFT JOIN ZUTATKATEGORIE ON ZUTATKATEGORIE.ZUTATENNR = ZUTAT.ZUTATENNR
            LEFT JOIN ERNAEHRUNGSKATEGORIE ON ERNAEHRUNGSKATEGORIE.KATEGORIENR = ZUTATKATEGORIE.KATEGORIENR
            WHERE ((ZUTATALLERGEN.ALLERGENNR != 0)" . ")"; # Pulsar highlighting is shit with it.... so i need to add a ) and remove it in the next line
        $query = substr($query, 0, -1); # Still the workaround for the hightlighting

        $params = array();
        $placeholders = array();

        foreach ($_SESSION['allergies'] as $id) {
            $placeholders[] = 'ZUTATALLERGEN.ALLERGENNR != :allergen_' . $id;
            $params[':allergen_' . $id] = $id;
        }
        if(count($_SESSION['allergies']) > 0)
            $query .= ' AND (' . implode(' AND ', $placeholders) . ')';

        $query .= ' OR ZUTATALLERGEN.ALLERGENNR IS NULL)';

        if ($_SESSION['category'] != NULL && $_SESSION['category'] != "0") {
            $query .= ' AND ERNAEHRUNGSKATEGORIE.KATEGORIENR = :category';
            $params[':category'] = $_SESSION['category'];
        }
        # Logger::log($query);
        # Logger::log($params);
        # DB Request with params
        # $query = "SELECT * FROM ZUTAT WHERE EINHEIT=:unit";
        # $params = array(':unit' => 'Stück');
        $vars['ingredients'] = $this->db->executeQuery($query, $params);
    }

    public function RunLate() {

    }
}

# Needs to be the same as class [NAME]
new ControllerIngredients($controllers, $db);
?>
