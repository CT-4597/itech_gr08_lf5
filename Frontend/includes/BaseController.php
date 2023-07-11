<?php

class BaseController {
    protected bool $logged_in;
    protected string $logged_in_redirect;
    protected bool $admin;
    protected string $admin_redirect;
    protected array $views;
    protected string $view;
    protected string $container;
    protected $db;

    public function __construct(array &$arr, &$db, array $views = [], bool $logged_in = false, string $logged_in_redirect = '/', bool $admin = false, string $admin_redirect = '/') {
        array_push($arr, $this);
        $this->db = $db;
        $this->logged_in = $logged_in;
        $this->logged_in_redirect = $logged_in_redirect;
        $this->admin = $admin;
        $this->admin_redirect = $admin_redirect;
        $this->views = $views;
        # $this->view = $view;
        # $this->container = $container;
    }

    public function runEarly() {
        // Standardimplementierung oder leer lassen
    }

    public function runDefault() {
        global $vars;
        // Standardimplementierung oder leer lassen
    }

    public function runLate() {
        // Standardimplementierung oder leer lassen
    }

    public function Container() {
        return $this->container;
    }

    public function View() {
        return $this->view;
    }

    public function HasView($container) {
        if(array_key_exists($container, $this->views))
            return True;
        else
            return False;
    }

    public function GetView($container) {
        if(array_key_exists($container, $this->views))
            return $this->views[$container];
        else
            return NULL;
    }
}
?>
