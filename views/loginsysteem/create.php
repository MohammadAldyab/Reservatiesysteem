<?php
require_once("../head/head.php");
require "../../controllers/UserController.php";


$UserController = new UserController;
$errors = [];
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you perform some validation/sanitization of $_POST values before using them
    if(empty($_POST["email"])){
        $errors["email"] = "email is vereist";
    }else if (empty($_POST["password"])) {
        $errors["rolen"] = "password is vereist";
    } else if (empty($_POST["rolen"])) {
        $errors["rolen"] = "rolen is vereist";
    } 
    
    // Call the create method to add a reservation
    $UseerCreated = $UserController->create($_POST["email"], $_POST["password"], $_POST["rolen"]);

    // Check if the reservation was created successfully
    if ($UseerCreated) {
        // Redirect to the index page after successful creation
        header("Location: ../dashboards/admin_dashboard.php");
    } else {
        // Handle error, you might want to display an error message or log the error
        echo "<div class='alert alert-danger' role='alert'>
        Error Er its Fout gevonden      </div>";
    }
}

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
      <link rel="stylesheet" href="../../static/css/creat.css" type="text/css">  

    <title>Document</title>
  
</head>

<body>
    <form method="POST">
        <div class="form-group">
            <label for="email">email:</label>
            <input type="text" name="email" class="form-control"  required>
        </div>
       
        <div class="form-group">
            <label for="password">password:</label>
            <input type="password" name="password" class="form-control" required>

  

            <label for="classes">Choose a rolen:</label>
            <select  type="text" name="rolen" id="rolen"  class="form-control" >
            <option type="text" value="" disabled selected>Kies een van rolen</option>

    <option value="admin">admin</option>
    <option value="klant">klant</option>
    <option value="medewerker">medewerker</option>
  </select>
        </br>     
<div class="form-group">
        
        <button type="submit" class="button">Save</button>
    </form>
    <!-- error uitprinten -->
    <?php if(is_array($errors)) : ?>
        <?= implode("</br>", $errors) ?>
    <?php endif ?>
    <!-- Eind error uitprinten -->
</body>

</html>
