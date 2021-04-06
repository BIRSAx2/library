<?php

require_once 'controller/DatabaseController.php';
require_once 'model/UserModel.php';
require_once 'model/BooksModel.php';

class AuthorController extends DatabaseController
{
  public $messages = array();
  private $userModel;
  private $authorModel;

  public function __construct()
  {
    parent::__construct();
    $this->userModel = new UserModel();
    $this->authorModel = new AuthorModel();
    $this->errors = array();
    $filter = isset($_POST['filter']) ? $_POST['filter'] : null;

    $authors = $this->authorModel->findAllAuthors();

    include("views/library/authors.view.php");
  }
}