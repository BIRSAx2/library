<?php
require_once 'DatabaseController.php';
require_once 'model/BooksModel.php';
require_once 'model/AuthorModel.php';

class RecoverPasswordController extends DatabaseController
{
  public $messages = array();
  private UserModel $userModel;

  public function __construct()
  {
    parent::__construct();

    $this->userModel = new UserModel();
    if (isset($_POST['recover_password'])) {
      $this->recover_password();
    }
    require("views/user_management/recover_password.view.php");

  }

  private function recover_password()
  {
    if (empty($_POST['email'])) {
      $this->errors[] = "Il campo email non può essere vuoto";
    }
    if (sizeof($this->errors) == 0) {
      $user_email = strtolower($_POST['email']);
      $foundUser = $this->userModel->findByUsername($user_email);
      if ($foundUser != null) {
        // send the email
        $new_password = $this->randomPassword();

        $this->userModel->updateUserPassword($user_email, $new_password);
        $message = "La tua nuova password è: $new_password";
        $message = wordwrap($message, 70, "\r\n");
        mail($user_email, 'Recupero password', $message);
        $this->messages[] = "È stata inviata una password temporanea alla mail inserita. <a class='text-indigo-400' href=index.php>Log in</a>";
      } else {
        $this->errors[] = "Nessun utente trovato con la mail inserita. Riprovare";
      }
    }
  }

  private function randomPassword()
  {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
      $n = rand(0, $alphaLength);
      $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
  }
}
