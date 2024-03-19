<?php
session_start();
if(!isset($_SESSION['email'] ) || $_SESSION['email']['rolen'] !== 'medewerker'){ //security check zodat niemand die niet is ingelogd als medewerker niet op deze pagina kan komen 
    header("Location:  ../loginsysteem/login.php");
    exit();
}
require_once("../head/head.php");
echo "Jij bent ingeloegd als medewerker";
?>