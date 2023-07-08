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
        global $vars;

        # Apply Filters
        if(isset($_POST['FiltersApply'])) {
            Logger::log('Apply Filters');
          if($_POST['category'] == 'NULL')
            $_SESSION['category'] = NULL;
          else
            $_SESSION['category'] = $_POST['category'];
          # if no allergies are selected, the var isn set
          if(isset($_POST['allergies']))
            $_SESSION['allergies'] = $_POST['allergies'];
          else
            $_SESSION['allergies'] = array();
        }

        # Check if Filtering is active
        $vars['filters_active'] = True;

    }

    public function RunDefault() {
        global $vars;

        $query = "SELECT ALLERGENNR, ALLERGENBEZEICHNUNG FROM ALLERGEN";
        $vars['allergies'] = $this->db->executeQuery($query, array());
        $query = "SELECT KATEGORIENR, KATEGORIEBEZEICHNUNG FROM ERNAEHRUNGSKATEGORIE";
        $vars['nutrition_categories'] = $this->db->executeQuery($query, array());

    }

    public function RunLate() {
        # Logger::log("Filter Allergies:" . implode(" ", $_SESSION['allergies']));
        Logger::log("Filter Category: {$_SESSION['category']}");
    }
}

# Needs to be the same as class [NAME]
new ControllerFilters($controllers, $db);
?>
