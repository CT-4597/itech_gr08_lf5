<?php

# Be sure to give it a unique name.
class ControllerIngredientsDetails {
    # Do you need to be loggin for this controller?
    public bool $logged_in = False;
    public string $logged_in_redirect = '/';
    # Do you need to be a admin?
    public bool $admin = False;
    public string $admin_redirect = '/';

    # The viewer name. without suffix.
    # views can be reused if build for
    public string $view = 'ingredients_details';
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

        # DB Request with only a single row expected
        # Take a look at controllers/header_user.php for a better example
        $query = "SELECT * FROM ZUTAT WHERE ZUTATENNR=:id";
        $params = array(':id' => $_GET['id']);
        $vars['ingredient'][] = $this->db->executeSingleRowQuery($query, $params);
    }

    public function RunLate() {

    }
}

# Needs to be the same as class [NAME]
new ControllerIngredientsDetails($controllers, $db);
?>
