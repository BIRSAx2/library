<?php
require_once 'DatabaseController.php';
require_once 'model/UserModel.php';

class LoginController extends DatabaseController
{
    private $user;

    public function __construct()
    {
        parent::__construct();
        $this->user = new UserModel();
        if (isset($_GET["logout"])) {
            $this->logout();
        } elseif (isset($_POST["login"])) {
            $this->login();
        }
        include("views/user_management/login.view.php");
    }

    private function login()
    {
        // validazione dei parametri
        if (empty($_POST['user_name'])) {
            $this->errors[] = "Il campo username non può essere vuoto";
        }
        if (empty($_POST['user_password'])) {
            $this->errors[] = "Il campo password non può essere vuoto";
        }
        if (sizeof($this->errors) == 0) {
            $user_name = strtolower($this->db_connection->real_escape_string($_POST['user_name']));
            $foundUser = $this->user->findByUsername($user_name);
            if ($foundUser != null) {
                if (password_verify($_POST['user_password'], $foundUser->password_hash)) {
                    $_SESSION['user_name'] = $foundUser->user_name;
                    $_SESSION['first_name'] = $foundUser->first_name;
                    $_SESSION['last_name'] = $foundUser->last_name;
                    $_SESSION['user_id'] = $foundUser->id;
                    $_SESSION['user_email'] = $foundUser->email;
                    $_SESSION['user_role'] = $foundUser->role;
                    $_SESSION['user_login_status'] = true;
                    $this->log_session($user_name, session_id());

                    header("Location: books.php");
                    exit();
                } else {
                    $this->errors[] = "Password errata. Riprovare";
                }
            } else {
                $this->errors[] = "Username errato";
            }
        }
    }

    public
    function logout()
    {
        // svuota e distrugge la sessione
        $_SESSION = array();
        session_destroy();
        $this->messages[] = "Sei stato disconnesso con successo.";

    }


    public
    static function is_user_logged_in(): bool
    {
        return isset($_SESSION['user_login_status']) and $_SESSION['user_login_status'] == 1;
    }

// registra l'accesso nel db
    private
    function log_session($user_name, $session_id)
    {
        $sql = "SELECT id from users where user_name = '$user_name' or email='$user_name';";
        $result = $this->db_connection->query($sql);
        $user_id = $result->fetch_assoc()['id'];
        $current_time = time();
        $sql
            = "INSERT INTO user_sessions (user,session_id,last_access) values ($user_id,'$session_id', FROM_UNIXTIME($current_time));";
        $this->db_connection->query($sql);
    }

}