<?php

if (session_status() != PHP_SESSION_ACTIVE) {
  session_start();
}
require_once("config/database_credentials.php");
require_once("controller/LoginController.php");
require_once("controller/AddAuthorController.php");

if (!LoginController::is_user_logged_in() or (isset($_SESSION['user_role']) and $_SESSION['user_role'] != 'admin')) {
  header("Location: books.php");
  exit();
}
$addAuthor = new AddAuthorController();