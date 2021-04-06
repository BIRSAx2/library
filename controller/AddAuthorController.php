<?php


require_once 'DatabaseController.php';
require_once 'model/AuthorModel.php';

class AddAuthorController extends DatabaseController
{
  public $messages = array();
  private AuthorModel $authorModel;

  public function __construct()
  {
    parent::__construct();
    $this->authorModel = new AuthorModel();
    if (isset($_POST['addAuthor'])) {
      $this->addNewAuthor();
    }
    $authors = $this->authorModel->findAllAuthors();
    require("views/admin/add_author.view.php");

  }

  private function addNewAuthor()
  {
    // validazione dei parametri
    if (empty($_POST['first_name'])) {
      $this->errors[] = "Il campo Nome non può essere vuoto";
    }

    if (empty($_POST['last_name'])) {
      $this->errors[] = "Il campo Cognome non può essere vuoto";
    }

    if (sizeof($this->errors) == 0) {
      $first_name = $_POST['first_name'];
      $last_name = $_POST['last_name'];
      $middle_name = $_POST['middle_name'];
      $description = $_POST['description'];
      $result = $this->authorModel->addAuthor($first_name, $middle_name, $last_name, $description);
      if ($result->errno != null) {
        $this->errors[] = "Impossibile aggiungere l'autore. Riprovare";
      } else {
        $this->messages[] = "Autore aggiunto con successo";
      }
    }
  }


}