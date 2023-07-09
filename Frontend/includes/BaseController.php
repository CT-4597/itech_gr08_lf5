<?php

class BaseController {
    protected bool $logged_in;
    protected string $logged_in_redirect;
    protected bool $admin;
    protected string $admin_redirect;
    protected string $view;
    protected string $container;
    protected $db;

    public function __construct(array &$arr, &$db, string $view = 'template', string $container = 'Content', bool $logged_in = false, string $logged_in_redirect = '/', bool $admin = false, string $admin_redirect = '/') {
        array_push($arr, $this);
        $this->db = $db;
        $this->logged_in = $logged_in;
        $this->logged_in_redirect = $logged_in_redirect;
        $this->admin = $admin;
        $this->admin_redirect = $admin_redirect;
        $this->view = $view;
        $this->container = $container;
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
}
?>
