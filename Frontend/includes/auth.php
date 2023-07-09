<?php
    $auth = new authentification($db);

    class authentification {
        protected $db;
        protected bool $logged_in;
        protected bool $is_admin;

        public function __construct(&$db) {
            $this->db = $db;
            session_id();
            $this->logged_in = False;
            $this->is_admin = False;

            Logger::log("Session ID: " . session_id());
            $this->logged_in = $this->isLoggedIn();
            # test if session id is in KUNDEN
        }

        public function isLoggedIn() {
            $query = "SELECT * FROM KUNDE WHERE SESSIONID=:sessionid";
            $params = array(':sessionid' => session_id());
            if($this->db->executeExists($query, $params))
                return True;
            else
                return False;
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
