<?php
require_once 'controller/DatabaseController.php';

class RolesModel extends DatabaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllRoles()
    {
        // ricava i ruoli dal db
        $roles = array();
        if (!$this->db_connection->connect_errno) {
            $sql = "SELECT name FROM roles";
            $result = $this->db_connection->query($sql)->fetch_all();
            foreach ($result as $row) {
                $roles[] = $row[0];
            }
        }

        return $roles;
    }
}