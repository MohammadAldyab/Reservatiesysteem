<?php
session_start();
if(!isset($_SESSION['email'] ) || $_SESSION['email']['rolen'] !== 'admin'){//security check zodat niemand die niet is ingelogd als admin niet op deze pagina kan komen 
  header("Location:  ../loginsysteem/login.php");
  exit();

}
require_once("../head/head.php");


echo '
<div class="w3-container">
<div class="w3-panel w3-red w3-display-container">
  <span onclick="this.parentElement.style.display=none"
  class="w3-button w3-large w3-display-topright">&times;</span>
  <h3>LetOP!</h3>
  <p>Jij bent ingeloegd als admin.</p>
</div>
</div>';
require "../../controllers/UserController.php";
$userController = new UserController();
$users = $userController->getUsers();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  
<script src="../../static/js/index.js"></script>
  <link rel="stylesheet" href="../../static/css/index.css">
  <title>Gebruikers page</title>  
</head>
<body>
  <div class="table-container">
  <label class="control-label col-sm-4" for="email"><b>Zoek een Gebruiker</b>:</label>
        <div class="col-sm-4">
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Zoeken.." title="Type in a name">
        </div>
<div class="table-responsive">
            <table class="table" id="contractTable">

  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">name</th>
      <th scope="col">rolen</th>
      <th scope="col">edit</th>
      <th scope="col">delete</th>
    </tr>
  </thead>
  <tbody>
  <?php if (is_array($users)) : ?>
    <?php foreach ($users as $row) : ?>
                <tr>
                  
                    <td><?= $row->id ?></td>
                    <td><?= $row->email ?></td>
                    <td><?= $row->rolen ?></td>
                    <td><a href="../loginsysteem/editusers.php?id=<?= $row->id ?>"><button type="button" class="btn btn-warning">Edit</button></a></td>
                    <td>
                        <form action="../loginsysteem/delete.php?id=<?= $row->id ?>" onsubmit="return confirm('Weet je zeker dat je wilt verwijderen?');" method="post">
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
<?php endif; ?>

  </tbody>
</table>
</div>
<div class="row justify-content-end mb-3">
            <div class="col-auto">
                <a href="../loginsysteem/create.php">
                    <button type="submit" class="btn btn-primary">Aanmaken</button>
                </a>
            </div>
        </div>
    </div>
    
</body>

</html>
