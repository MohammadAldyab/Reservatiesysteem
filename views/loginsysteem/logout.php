<?php
// Start de sessie
session_start();

// Beëindig de sessie om uit te loggen
session_destroy();

// Redirect naar de inlogpagina
header("Location: login.php");
exit;
?>
