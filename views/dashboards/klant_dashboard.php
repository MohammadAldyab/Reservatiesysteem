<?php
session_start();
if(!isset($_SESSION['email'] ) || $_SESSION['email']['rolen'] !== 'klant'){//security check zodat niemand die niet is ingelogd als klant niet op deze pagina kan komen 
    header("Location:  ../loginsysteem/login.php");
    exit();
}
require_once("../head/head.php");
echo "Jij bent ingeloegd Als klant";
?>