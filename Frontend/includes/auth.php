<?php
    $auth = new authentification();

    class authentification {
        protected bool $logged_in;
        protected bool $is_admin;

        public function __construct() {
            session_id();
            $this->logged_in = False;
            $this->is_admin = False;

            Logger::log("Session ID: " . session_id());
            # test if session id is in KUNDEN
        }

        public function login(string $username, string $password) {
            # test if user and pw returns a valid row
            # update session id
        }

        public function logged_in() {
            return $this->logged_in;
        }

        public function is_admin() {
            return $this->is_admin();
        }
    }
    # initialize vars
    # security by default
    if(!isset($AUTH))
        $AUTH = array();

    $AUTH['controller'] = True;         # Does the controller require you to be logged in
    $AUTH['admin'] = True;              # Does the controller require you to be a admin
    $AUTH['redirect'] = '/';            # The Page you get redirected to if you aren't logged in and/or admin

    $AUTH['logged_in'] = False
?>
