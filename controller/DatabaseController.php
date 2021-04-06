<?php
//include_once('../config/database_credentials.php');

// classe che gestisce la connessione al db
class DatabaseController
{
    protected $db_connection = null;
    public $errors = array();
    public $messages = array();

    public function __construct()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        // connessione al db
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->db_connection->connect_errno) {
            echo "Error connecting to the database";
            exit();
        }
        $this->db_connection->set_charset("utf8");

    }


}