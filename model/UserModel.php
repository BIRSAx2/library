<?php
require_once 'controller/DatabaseController.php';

class UserModel extends DatabaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function findByUsername($username, $email = null)
    {
        if ($email == null) $email = $username;
        $sql = "SELECT * FROM users WHERE user_name = ? OR email = ?;";
        $stmt = $this->db_connection->prepare($sql);
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_object();
    }

    public function saveUser($user_name, $first_name, $last_name, $password_hash, $email, $role)
    {
        $sql = "INSERT INTO users (user_name, first_name, last_name, password_hash, email,role) VALUES(?,?,?, ?, ?, ?);";
        $stmt = $this->db_connection->prepare($sql);
        $stmt->bind_param("ssssss", $user_name, $first_name, $last_name, $password_hash, $email, $role);
        $stmt->execute();
        return $stmt;
    }

    // TODO: move to model
    public function saveUserPassword($user_name, $password_hash)
    {
        $user_id = $this->findByUsername($user_name)->id;

        $sql = "INSERT INTO past_passwords (user, password_hash) values ('$user_id','$password_hash');";
        $result = $this->db_connection->query($sql);
        echo $this->db_connection->error;
        if (!$result) {
            die ("Error saving saving user password to the db");
        }
    }

    public function getUserPastPasswords($user_id)
    {
        $sql = "SELECT password_hash FROM past_passwords WHERE user=? ORDER BY date DESC LIMIT 10;";
        $stmt = $this->db_connection->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function updateUserPassword($user_id, $password_hash)
    {
        $sql = "UPDATE users SET password_hash=? WHERE id =? ;";
        $stmt = $this->db_connection->prepare($sql);
        $stmt->bind_param("si", $password_hash, $user_id);
        $stmt->execute();
        return $stmt;
    }

    public function validatePassword($password, $firstname, $lastname, $username)
    {
        $errors = array();
        if (strlen($password) < 8) {
            $errors[] = "La password deve essere di minimo 8 caratteri";
        }

        if (str_contains(strtolower($_POST['user_password_new']), strtolower($firstname))) {
            $errors[] = "La password non può contenere il nome dell'utente";
        }
        if (str_contains(strtolower($_POST['user_password_new']), strtolower($lastname))) {
            $errors[] = "La password non può contenere il cognome dell'utente";
        }
        if (str_contains(strtolower($_POST['user_password_new']), strtolower($username))) {
            $errors[] = "La password non può contenere lo user name dell'utente";
        }

        if (!preg_match("/^(?=.*[A-Z])(?=.*[\W])(?=.*[0-9])(?=.*[a-z]).{8,65}$/", $password)) {
            $errors[] = "La password deve essere di minimo 8 caratteri, massimo 64 e contenere almeno una lettera minuscola,una maiuscola, un numero e un carattere speciale";
        }
        if (!preg_match("/^((?![]\[{}~`|]).)*$/", $password)) {
            $errors[] = "La password non deve contenere i seguenti caratteri: []\[{}~`| ";
        }
        if (!preg_match("/^[a-zA-Z]+/", $password)) {
            $errors[] = "La password cominciare con un carattere alfabetico";
        }
        return $errors;
    }
}