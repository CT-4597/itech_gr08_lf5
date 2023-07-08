<?php

# Be sure to give it a unique name.
class ControllerTemplate {
    # Do you need to be loggin for this controller?
    public bool $logged_in = False;
    public string $logged_in_redirect = '/';
    # Do you need to be a admin?
    public bool $admin = False;
    public string $admin_redirect = '/';

    # The viewer name. without suffix.
    # views can be reused if build for
    public string $view = 'template';
    # the container the viewer is rendered in.
    public string $container = 'Content';

    # var holden the database class
    public $db;

    # Create your vars here
    public $result_ingredients;

    public function __construct(array &$arr, &$db) {
        array_push($arr, $this);
        $this->db = $db;
    }

    public function RunEarly() {

    }

    public function RunDefault() {
        global $controller_vars;

        # DB Request without params
        /*$query = "SELECT * FROM ZUTAT";
        $controller_vars['ingredients'] = $this->db->executeQuery($query, array());*/

        # DB Request with params
        /*$query = "SELECT * FROM ZUTAT WHERE EINHEIT=:unit";
        $params = array(':unit' => 'Stück');
        $controller_vars['ingredients'] = $this->db->executeQuery($query, $params);*/

        # DB Request with only a single row expected
        $query = "SELECT * FROM ZUTAT WHERE ZUTATENNR=:id";
        $params = array(':id' => 1001);
        $controller_vars['ingredients'][] = $this->db->executeSingleRowQuery($query, $params);
    }

    public function RunLate() {
        Logger::log("{$this->view} late.");
    }
}

# Needs to be the same as class [NAME]
new ControllerTemplate($controllers, $db);
?>
