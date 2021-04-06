<?php
require_once 'controller/DatabaseController.php';

class AuthorModel extends DatabaseController
{
  public function __construct()
  {
    parent::__construct();
  }

  public function findAuthorById($author_id)
  {
    $sql = "SELECT * FROM author WHERE id = ?;";
    $stmt = $this->db_connection->prepare($sql);
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_object();
  }

  public function findAllAuthors()
  {
    $sql = "SELECT * FROM authors;";
    $stmt = $this->db_connection->prepare($sql);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  }

  public function addAuthor($first_name, $middle_name, $last_name, $description)
  {
    $sql = "INSERT INTO authors (first_name, middle_name, last_name, description) values (?,?,?,?)";
    $stmt = $this->db_connection->prepare($sql);
    $stmt->bind_param("ssss", $first_name, $middle_name, $last_name, $description);
    $stmt->execute();
    return $stmt;
  }

  public function findAllBookAuthors($book_id)
  {
    $sql = "SELECT first_name, middle_name, last_name from book_authors as ba, authors as a WHERE a.id = ba.author and ba.book = ?;";
    $stmt = $this->db_connection->prepare($sql);
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  }
}
