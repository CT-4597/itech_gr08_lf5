<?php
# Needs to be the same as class [NAME]
new ControllerFilters($controllers, $db, ["Filters" => "filters"]);
# Be sure to give it a unique name.
class ControllerFilters extends BaseController {

    public function RunEarly() {
        global $vars;

        # Check if vars are assigned
        if (!isset($_SESSION['category']))
            $_SESSION['category'] = NULL;

        if (!isset($_SESSION['allergies']))
            $_SESSION['allergies'] = array();

        # Clear Filters
        if(isset($_POST["FiltersClear"])) {
            Logger::log('Clearing Filters.');
            $_SESSION['category'] = NULL;
            $_SESSION['allergies'] = array();
        }

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
        if($_SESSION['category'] == NULL AND count($_SESSION['allergies']) == 0)
                  $vars['filters_active'] = False;
    }

    public function RunDefault() {
        global $vars;

        $query = "SELECT ALLERGENNR, ALLERGENBEZEICHNUNG FROM ALLERGEN";
        $vars['allergies'] = $this->db->executeQuery($query, array());
        $query = "SELECT KATEGORIENR, KATEGORIEBEZEICHNUNG FROM ERNAEHRUNGSKATEGORIE";
        $vars['nutrition_categories'] = $this->db->executeQuery($query, array());

    }
}
?>
