<?php


require_once 'DatabaseController.php';
require_once 'model/BooksModel.php';
require_once 'model/AuthorModel.php';

class AddBookController extends DatabaseController
{
  public $messages = array();
  private BooksModel $bookModel;
  private AuthorModel $authorModel;

  public function __construct()
  {
    parent::__construct();
    $this->bookModel = new BooksModel();
    $this->authorModel = new AuthorModel();
    if (isset($_POST['addBook'])) {
      $this->addNewBook();
    }
    $authors = $this->authorModel->findAllAuthors();
    require("views/admin/add_book.view.php");

  }

  private function addNewBook()
  {
    // validazione dei parametri
    if (empty($_POST['title'])) {
      $this->errors[] = "Il campo titolo non può essere vuoto";
    }
    if (empty($_POST['author'])) {
      $this->errors[] = "Il campo autore non può essere vuoto";
    }
    if (empty($_POST['genre'])) {
      $this->errors[] = "Il campo genere non può essere vuoto";
    }
    if (empty($_POST['description'])) {
      $this->errors[] = "Il campo description non può essere vuoto";
    }
    if (sizeof($this->errors) == 0) {
      $title = $_POST['title'];
      $author = $_POST['author'];
      $genre = $_POST['genre'];
      $description = $_POST['description'];
      $result = $this->bookModel->addBook($title, $author, $description, $genre);
      if ($result->errno != null) {
        $this->errors[] = "Impossibile aggiungere il libro. Riprovare";
      } else {
        $this->messages[] = "Libro aggiunto con successo";
      }
    }
  }


}