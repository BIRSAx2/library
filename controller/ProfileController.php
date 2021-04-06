<?php
require_once 'controller/DatabaseController.php';
require_once 'model/UserModel.php';

class ProfileController extends DatabaseController
{
    public $messages = array();
    private $user;

    public function __construct()
    {
        parent::__construct();
        $this->user = new UserModel();
        $this->errors = array();
        // nel caso in cui la richiesta sia quella di registrare lo user nel db
        if (isset($_POST["changePassword"])) {
            $this->change_password();
        }
        include("views/user_management/profile.view.php");
    }

    private function change_password()
    {
        // TODO complete this
        $this->user->validatePassword($_POST['user_password_new'], $_SESSION['first_name'], $_SESSION['last_name'], $_SESSION['user_id']);
        // se non ci sono errori
        if (sizeof($this->errors) == 0) {

            // sanificazione dei dati
            $user_name = $_SESSION['user_name'];
            $user_id = $_SESSION['user_id'];
            $user_password = $_POST['user_password_new'];

            // calcolo del hash della pwd
            $past_passwords = $this->user->getUserPastPasswords($user_id);
            $already_user_password = false;

            foreach ($past_passwords as $password) {
                if (password_verify($user_password, $password['password_hash'])) {
                    $already_user_password = true;
                }
            }
            if (!$already_user_password) {
                $user_password_hash = password_hash($user_password, PASSWORD_BCRYPT);

                $result = $this->user->updateUserPassword($user_id, $user_password_hash);

                if (!$result->error) {
                    $this->messages[] = "Password cambiata con successo <a class='text-indigo-400' href=index.php>Log in</a>";
                    $_SESSION[] = array();
                    session_destroy();
                    $this->user->saveUserPassword($user_name, $user_password_hash);
                } else {
                    $this->errors[] = "Impossibile cambiare la password. Riprova";
                }
            } else {
                $this->errors[] = "Utilizzare una password mai utilizzata in precedenza.";
            }
        } else {
            $this->errors[] = "Errore di connessione al database.";
        }
    }
}