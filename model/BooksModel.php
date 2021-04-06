<?php
require_once 'controller/DatabaseController.php';
require_once 'AuthorModel.php';

class BooksModel extends DatabaseController
{
  private AuthorModel $authorModel;

  public function __construct()
  {
    parent::__construct();
    $this->authorModel = new AuthorModel();
  }


  public function findAllBooks()
  {
    $sql = "SELECT * FROM books, book_authors WHERE books.id = book_authors.book;";
    $stmt = $this->db_connection->prepare($sql);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  }

  public function addBook($title, $author, $description, $genre)
  {
    $sql = "INSERT INTO books (title,description,genre) values (?,?,?)";
    $stmt = $this->db_connection->prepare($sql);
    $stmt->bind_param("sss", $title, $description, $genre);
    $stmt->execute();

    $book_id = $this->findBookByTitle($title)->id;

    $sql = "INSERT INTO book_authors values (?,?)";
    $stmt = $this->db_connection->prepare($sql);
    $stmt->bind_param("ii", $book_id, $author);
    $stmt->execute();
    return $stmt;
  }

  public function findBookByTitle($book_title)
  {
    $sql = "SELECT * from books where title = ?";
    $stmt = $this->db_connection->prepare($sql);
    $stmt->bind_param("s", $book_title);
    $stmt->execute();
    return $stmt->get_result()->fetch_object();

  }

  public function findAllAvailableBooks()
  {
    $sql = "SELECT * FROM books, book_authors WHERE books.id = book_authors.book and is_available = 1;";
    $stmt = $this->db_connection->prepare($sql);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  }

  public function enrichWithAuthorsName($books_list)
  {
    for ($i = 0; $i < sizeof($books_list); $i++) {
      $books_list[$i]['author'] = $this->authorModel->findAllBookAuthors($books_list[$i]['id']);
    }
    return $books_list;
  }

  public function findAllBorrowedBooks()
  {
    $sql = "SELECT * FROM books, book_authors WHERE books.id = book_authors.book and is_available = 0;";
    $stmt = $this->db_connection->prepare($sql);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  }

  public function findBookById($book_id)
  {
    $sql = "SELECT * FROM books WHERE id = ?;";
    $stmt = $this->db_connection->prepare($sql);
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_object();
  }

  public function findBookByIdArr($book_id)
  {
    $sql = "SELECT * FROM books WHERE id = ?;";
    $stmt = $this->db_connection->prepare($sql);
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
  }

  public function setBookUnavailable($book_id)
  {
    $sql = "UPDATE books SET is_available=0 WHERE id = ?;";
    $stmt = $this->db_connection->prepare($sql);
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    return $stmt;
  }

  public function setBookAvailable($book_id)
  {
    $sql = "UPDATE books SET is_available=1 WHERE id = ?;";
    $stmt = $this->db_connection->prepare($sql);
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    return $stmt;
  }

  public function findAllBooksByAuthor($author_id)
  {
    $sql = "SELECT b.id as 'id', title, genre,description,is_available from books as b, book_authors as a where b.id = a.book and a.author = ?;";
    $stmt = $this->db_connection->prepare($sql);
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  }
}