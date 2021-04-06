<?php
require_once 'controller/DatabaseController.php';
require_once 'BooksModel.php';
require_once 'UserModel.php';

class LoansModel extends DatabaseController
{

    private $booksModel;
    private $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->booksModel = new BooksModel();
        $this->userModel = new UserModel();
    }

    public function findAllLoans()
    {
        $sql = "SELECT * FROM loans;";
        $stmt = $this->db_connection->prepare($sql);
        $stmt->execute();
        return $stmt->get_result()->fetch_array(MYSQLI_ASSOC);
    }

    public function addLoan($user_name, $book_id, $loan_date = null)
    {
        if ($loan_date == null) $loan_date = new DateTime();

        $loan_date = date_timestamp_get($loan_date);
        $user_id = $this->userModel->findByUsername($user_name)->id;

        $sql = "INSERT INTO loans (user, book, loan_date) values (?,?,FROM_UNIXTIME(?));";
        $stmt = $this->db_connection->prepare($sql);
        $stmt->bind_param("iis", $user_id, $book_id, $loan_date);
        $stmt->execute();
        return $stmt;

    }

    public function addLoanReturnDate($loan_id, $book_id, $datetime = null)
    {
        $timestamp = $datetime == null ? date_timestamp_get(new DateTime()) : date_timestamp_get($datetime);
        // should make the book available
        $sql = "UPDATE loans SET return_date = FROM_UNIXTIME($timestamp) where id = ?";
        $stmt = $this->db_connection->prepare($sql);
        $stmt->bind_param("i", $loan_id);
        $stmt->execute();
        $this->booksModel->setBookAvailable($book_id);
        return $stmt;
    }

    public function findAllLoansByUser($user_name)
    {
        $user_id = $this->userModel->findByUsername($user_name)->id;

        $sql = "SELECT * FROM loans WHERE user = ? ;";
        $stmt = $this->db_connection->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function findAllActiveLoansByUser($user_name)
    {
        $user_id = $this->userModel->findByUsername($user_name)->id;

        $sql = "SELECT * FROM loans WHERE user = ?  and return_date is null;";
        $stmt = $this->db_connection->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function findLoanById($loan_id)
    {
        $sql = "SELECT * FROM loans WHERE id = ?;";
        $stmt = $this->db_connection->prepare($sql);
        $stmt->bind_param("i", $loan_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_object();
    }
}