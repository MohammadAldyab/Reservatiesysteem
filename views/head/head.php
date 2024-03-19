<?php
session_start();
// Controleer of de gebruiker is ingelogd
if (isset($_SESSION['email'])) {
    $loginLogoutText = "Logout";
    $loginLogoutLink = "/reservaties/views/loginsysteem/logout.php";
} else {
    $loginLogoutText = "Login";
    $loginLogoutLink = "/reservaties/views/loginsysteem/login.php";
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo (empty($_GET['id'])) ? ((strpos($_SERVER['REQUEST_URI'],'create')) ? "Agregando nuevo usuario" : "Index") : ((strpos($_SERVER['REQUEST_URI'],'show')) ? "Detalles del registro ".$_GET['id'] : "Actualizar registro ".$_GET['id'] ); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>

    <div class="container-fluid bg-dark p-2 mb-3">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/reservaties/views/reservaties/index.php">Mohammad Omar </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <?php if (isset($_SESSION['email'])) : ?> <!-- Als de gebruiker is ingelogd, toon de reservatiespagina -->

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="/reservaties/views/reservaties/index.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Reservaties
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/reservaties/views/reservaties/dashboard.php">Dashboard</a></li>
                    <li><a class="dropdown-item" href="<?php echo $reservationsLink; ?>">Show Reservaties</a></li> <!-- Toon de link naar de reservatiespagina -->
                    <li><a class="dropdown-item" href="/reservaties/views/reservaties/create.php">Create Reservaties</a></li>
                </ul>
                </li>
            </ul>
            </div>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['email']['rolen']) && $_SESSION['email']['rolen'] == 'admin') : ?> <!-- Controleer of de sessievariabele 'rolen' is ingesteld en of deze gelijk is aan "admin" -->
<div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
    <li class="nav-item dropdown">

            <a class="nav-link " href="/reservaties/views/dashboards/admin_dashboard.php" role="button">
                Admin Dashboard
            </a>
            </li>
    </ul>
</div>
<?php endif; ?>
                <!-- ss -->
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="<?php echo $loginLogoutLink; ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php echo $loginLogoutText; ?>
                </a>
                <ul class="dropdown-menu">
                    <?php if ($loginLogoutText === "Login") : ?>
                        <li><a class="dropdown-item" href="/reservaties/views/loginsysteem/login.php">Login page</a></li>
                        <li><a class="dropdown-item" href="/reservaties/views/loginsysteem/singup.php">Singup page</a></li>
                    <?php else : ?>
                        <li><a class="dropdown-item" href="/reservaties/views/loginsysteem/logout.php">Logout</a></li>
                    <?php endif; ?>
                </ul>
                </li>
            </ul>
            </div>
        </div>
    </nav>
    </div>
    <div class="container-fluid">
        <!-- Hier komt de rest van de inhoud van de pagina -->
    </div>
</body>
</html>
