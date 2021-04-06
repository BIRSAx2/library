<?php
require_once("config/database_credentials.php");
require_once 'controller/DatabaseController.php';
require_once("controller/LoginController.php");

if (LoginController::is_user_logged_in() == true) {
    header("Location: books.php");
}
$login = new LoginController();
