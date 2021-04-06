<?php


require_once 'controller/DatabaseController.php';
require_once 'model/UserModel.php';
require_once 'model/LoansModel.php';
require_once 'model/BooksModel.php';

class LoansController extends DatabaseController
{
    public $messages = array();
    private $userModel;
    private $loansModel;
    private $booksModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
        $this->loansModel = new LoansModel();
        $this->booksModel = new BooksModel();
        $this->errors = array();
        if (isset($_POST['loanABook'])) {
            $this->handleLoansRequest();
        }
        if (isset($_GET['loan_id'])) {
            $this->endLoan();
        }
        $books = $this->booksModel->findAllAvailableBooks();
        $loans = $this->getUserLoans();
        include("views/library/loans.view.php");
    }

    private function handleLoansRequest()
    {
        if (empty($_POST['book_id'])) {
            $this->errors[] = "Il campo libro non può essere vuoto";
        }
        if (!empty($_POST['book_id']) and $this->booksModel->findBookById($_POST['book_id']) == null) {
            $this->errors[] = "Libro inesistente";
        }
        if (empty($_POST['date'])) {
            $this->errors[] = "Il campo data non può essere vuoto";
        }
        if (!empty($_POST['date']) and new DateTime($_POST['date']) < new DateTime('today')) {
            $this->errors[] = "La data non può essere una data passata";
        }
        if (sizeof($this->errors) == 0) {

            $book_id = $_POST['book_id'];
            $date = new DateTime($_POST['date']);
            $user_name = $_SESSION['user_name'];
            $result = $this->loansModel->addLoan($user_name, $book_id, $date);
            if ($result->errno == null) {
                $this->messages[] = "Prestito registrato con successo";
                $this->booksModel->setBookUnavailable($book_id);
            } else {
                $this->errors[] = "Errore! Impossibile completare la richiesta";
            }
        }
    }

    private function endLoan()
    {
        if (empty($_GET['book_id'])) {
            $this->errors[] = "È richiesto il campo book_id";
        }
        if (!empty($_GET['book_id']) and $this->booksModel->findBookById($_GET['book_id']) == null) {
            $this->errors[] = "Libro inesistente";
        }
        if (empty($_GET['loan_id'])) {
            $this->errors[] = "È richiesto il campo loan_id";
        }
        if (!empty($_GET['loan_id']) and $this->loansModel->findLoanById($_GET['loan_id']) == null) {
            $this->errors[] = "Prestito inesistente inesistente";
        }
        if (!empty($_GET['loan_id']) and $this->loansModel->findLoanById($_GET['loan_id'])->return_date != null) {
            $this->errors[] = "Prestito concluso";
        }
        if (sizeof($this->errors) == 0) {
            $result = $this->loansModel->addLoanReturnDate($_GET['loan_id'], $_GET['book_id']);
            if ($result->errno == null) {
                $this->messages[] = "Libro resituito con successo";
            } else {
                $this->errors[] = "Impossibile resituire il libro";
            }
        }

    }

    private function getUserLoans()
    {
        $loansList = $this->loansModel->findAllActiveLoansByUser($_SESSION['user_name']);

        $loans = array();
        foreach ($loansList as $loan) {
            $book = $this->booksModel->findBookByIdArr($loan['book']);
            $book['loan_date'] = $loan['loan_date'];
            $book['loan_id'] = $loan['id'];
            $loans[] = $book;
        }

        return $loans;
    }
}