<?php
require_once 'DatabaseController.php';
require_once 'model/UserModel.php';
require_once 'model/RolesModel.php';


class RegistrationController extends DatabaseController
{
  public $messages = array();
  private $user;
  private $roles;

  public function __construct()
  {
    parent::__construct();
    $this->user = new UserModel();
    $this->roles = new RolesModel();
    $this->errors = array();
    if (isset($_POST["register"])) {
      $this->registerNewUser();
    }
    $roles = $this->roles->getAllRoles();
    include("views/user_management/register.view.php");

  }

  private function registerNewUser()
  {
    // TODO use validation inside USer
    // validazione dei dati
    if (empty($_POST['user_name'])) {
      $this->errors[] = "Il campo username non può essere vuoto";
    }
    if (empty($_POST['firstname'])) {
      $this->errors[] = "Il campo Nome non può essere vuoto";
    }
    if (empty($_POST['firstname'])) {
      $this->errors[] = "Il campo Cognome non può essere vuoto";
    }

    // validazione passowrd
    if (empty($_POST['user_password_new']) || empty($_POST['user_password_repeat'])) {
      $this->errors[] = "Il campo password non può essere vuoto";
    }
    if ($_POST['user_password_new'] !== $_POST['user_password_repeat']) {
      $this->errors[] = "Le due password devono combaciare";
    }
    array_push($this->errors, ...$this->user->validatePassword($_POST['user_password_new'], $_POST['firstname'], $_POST['lastname'], $_POST['user_name']));
    if (empty($_POST['user_role'])) {
      $this->errors[] = "Il campo ruolo non può essere vuoto";
    }

    if (strlen($_POST['user_name']) > 64 || strlen($_POST['user_name']) < 2) {
      $this->errors[] = "Il campo username deve essere lungo tra 2 e 64 caratteri";
    }
    // regex per verificare che lo user name non contenga caratteri speciali
    if (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])) {
      $this->errors[]
        = "Il campo username può contenere solo lettere e numeri e deve essere lungo tra 2 e 64 caratteri.";
    }
    if (empty($_POST['user_email'])) {
      $this->errors[] = "Il campo email non può essere vuoto.";
    }
    if (strlen($_POST['user_email']) > 320) {
      $this->errors[] = "Il campo email non può essere più lungo di 320 caratteri.";
    }
    // verifica che il formato della mail sia coretto
    if (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
      $this->errors[] = "Il campo email deve essere un email valida";
    }

    // se non ci sono errori
    if (sizeof($this->errors) == 0) {

      // sanificazione dei dati
      $user_name = strtolower($_POST['user_name']);
      $user_email = strtolower($_POST['user_email']);
      $first_name = strtolower($_POST['user_email']);
      $last_name = strtolower($_POST['user_email']);
      $role = strtolower($_POST['user_role']);
      $user_password = $_POST['user_password_new'];

      // calcolo del hash della pwd
      $password_hash = password_hash($user_password, PASSWORD_BCRYPT);

      $foundUser = $this->user->findByUsername($user_name, $user_email);

      // verifica che lo username o la password siano già presenti nel db
      if ($foundUser != null) {
        $this->errors[] = "Username / email già in uso";
      } else {
        // registra l'utente nel db

        $result = $this->user->saveUser($user_name, $first_name, $last_name, $password_hash, $user_email, $role);

        if (!$result->errno) {
          $this->messages[]
            = "Account creato con successo. <a class='text-indigo-400' href=index.php>Log in</a>";
        } else {
          $this->errors[] = "Registrazione fallita. Riprova";
        }
        $this->user->saveUserPassword($user_name, $password_hash);
      }
    }
  }


}