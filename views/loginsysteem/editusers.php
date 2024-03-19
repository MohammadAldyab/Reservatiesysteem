<?php

require "../../controllers/UserController.php";

$class = new UserController();
$find = $class->findorfail($id); // $id deze id van de gebruiker die je wilt bewerken
$message = "User not found";
if(!$find){
  echo '<script>alert("' . $_SESSION['message'] . '");</script>';
  header("Location: ../dashboards/admin_dashboard.php");
}
$errors = [];
if($_SERVER["REQUEST_METHOD"] == "POST"){
  // Assuming you perform some validation/sanitization of $_POST values before using them
  
  if(empty($_POST["email"])){
    $errors["email"] = "email is vereist";
  }else if (empty($_POST["rolen"])) {
    $errors["rolen"] = "rolen is vereist";
  }
  
  $update = $class->update(); 
    if($update){
        header("Location: ../dashboards/admin_dashboard.php");
    }
    else{
        echo "<div class='alert alert-danger' role='alert'>
        Error Er its Fout gevonden Of U heeft niks gewezigd     </div>";
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
    <title>Edit</title>
</head>
<body>
<form method="POST">
<div class="form-group">
<label for="exampleInputEmail1">email:</label>
  <div class="form-group" >
<input type="text" name="email" class="form-control" value="<?=$find->email ?>" id="exampleInputEmail1" aria-describedby="emailHelp" required>
   
  </div>
</br>
<!-- <label for="classes">Choose a password:</label><br> -->
<!-- <input type="text" name="password" class="form-control" value=" id="exampleInputEmail1" aria-describedby="emailHelp" required> -->

  </div>
</br>
<label for="classes">Choose a rolen:</label>
<option type="text" value="<?= $find->rolen?>" disabled selected>Huidige rol voor dit gebruiker <?= $find->rolen?></option>

            <select  type="text" name="rolen" id="rolen"  class="form-control" >
    <option value="admin">admin</option>
    <option value="klant">klant</option>
    <option value="medewerker">medewerker</option>
  </select>
        </br>     
        
  <button type="submit" class="button">save</button>
        </div>
</form>
<?php if(is_array($errors)) : ?>
        <?= implode("</br>", $errors) ?>
    <?php endif ?>
</body>
</html>