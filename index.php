<?php
     require_once("views/head/head.php");
?>
<?php
session_start(); // Start de sessie

// Controleer of de gebruiker niet is ingelogd (gebruiker-ID is niet ingesteld)
if (!isset($_SESSION['email'])) {
    // Stuur de gebruiker automatisch door naar de inlogpagina
    header("Location: /reservaties/views/loginsysteem/login.php");
    exit; // Stop de verdere uitvoering van de code
}

// Als de gebruiker ingelogd is, kun je de rest van je code hier plaatsen
// ...
?>
<?php
     require_once("views/head/footer.php");
?>