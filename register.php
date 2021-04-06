<?php
require_once("config/database_credentials.php");
require_once("controller/RegistrationController.php");

// L'oggetto RegistrationController gestisce il processo di registrazione dello user
$registration = new RegistrationController();
