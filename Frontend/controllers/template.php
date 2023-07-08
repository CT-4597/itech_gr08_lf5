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

    public function early() {
        $query = "SELECT * FROM ZUTAT WHERE ZUTATENNR=:id";
        $params = array(':id' => 1001);
        $this->result_ingredients = $this->db->executeQuery($query, $params);
    }

    public function late() {
        Logger::log("{$this->view} late.");
    }
}

# Needs to be the same as class [NAME]
new ControllerTemplate($controllers, $db);
?>
