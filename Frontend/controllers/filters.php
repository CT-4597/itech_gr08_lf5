<?php

# Be sure to give it a unique name.
class ControllerFilters {
    # Do you need to be loggin for this controller?
    public bool $logged_in = False;
    public string $logged_in_redirect = '/';
    # Do you need to be a admin?
    public bool $admin = False;
    public string $admin_redirect = '/';

    # The viewer name. without suffix.
    # views can be reused if build for
    public string $view = 'filters';
    # the container the viewer is rendered in.
    public string $container = 'Filters';

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

        if(isset($_POST["FiltersApply"])){
            Logger::log("Apply filters");
            Logger::log(var_dump($_POST['allergies']));
            Logger::log(var_dump($_POST['categories']));
        }

        if(isset($_POST["FiltersClear"]))
            Logger::log("Clear filters");
        $query = "SELECT ALLERGENNR, ALLERGENBEZEICHNUNG FROM ALLERGEN";
        $vars['allergies'] = $this->db->executeQuery($query, array());
        $query = "SELECT KATEGORIENR, KATEGORIEBEZEICHNUNG FROM ERNAEHRUNGSKATEGORIE";
        $vars['nutrition_categories'] = $this->db->executeQuery($query, array());

    }

    public function RunLate() {

    }
}

# Needs to be the same as class [NAME]
new ControllerFilters($controllers, $db);
?>
