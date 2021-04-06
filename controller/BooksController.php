<?php

require_once 'controller/DatabaseController.php';
require_once 'model/UserModel.php';
require_once 'model/BooksModel.php';

class BooksController extends DatabaseController
{
  public $messages = array();
  private UserModel $userModel;
  private BooksModel $booksModel;
  private AuthorModel $authorModel;

  public function __construct()
  {
    parent::__construct();
    $this->userModel = new UserModel();
    $this->booksModel = new BooksModel();
    $this->authorModel = new AuthorModel();
    $this->errors = array();
    $filter = isset($_POST['filter']) ? $_POST['filter'] : null;
    $author = (isset($_POST['filterByAuthor']) and $_POST['filterByAuthor'] != 'noFilter') ? $_POST['filterByAuthor'] : null;

    if ($filter == 'onlyAvailable') {
      $books = $this->booksModel->findAllAvailableBooks();
    } elseif ($filter == 'onlyBorrowed') {
      $books = $this->booksModel->findAllBorrowedBooks();
    } else {
      $books = $this->booksModel->findAllBooks();
    }


    if ($author != null) {
      $books = array_values(array_filter($books, function ($book) use ($author) {
        return $book['author'] == $author;
      }));
    }
    $books = $this->booksModel->enrichWithAuthorsName($books);
//    print_r($books);
    $authors = $this->authorModel->findAllAuthors();

    include("views/library/books.view.php");
  }
}