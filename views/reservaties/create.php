<?php
require_once("../head/head.php");
require "../../controllers/ReservatiesController.php";


$reservatiesController = new ReservatiesController;
$errors = [];
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you perform some validation/sanitization of $_POST values before using them
    if(empty($_POST["bedrijfsnaam"])){
        $errors["bedrijfsnaam"] = "Bedrijfsnaam is vereist";
    }else if (empty($_POST["kamer"])) {
        $errors["kamer"] = "Kamer is vereist";
    } else if (empty($_POST["start"])) {
        $errors["start"] = "Start is vereist";
    } else if (empty($_POST["eind"])) {
        $errors["eind"] = "Eind is vereist";
    }
    

    // Call the create method to add a reservation
    $reservatieCreated = $reservatiesController->create($_POST["bedrijfsnaam"], $_POST["kamer"], $_POST["start"], $_POST["eind"]);

    // Check if the reservation was created successfully
    if ($reservatieCreated) {
        // Redirect to the index page after successful creation
        header("Location: index.php");
    } else {
        // Handle error, you might want to display an error message or log the error
        echo "<div class='alert alert-danger' role='alert'>
        Error kamer is al reserveerd kies andere datums      </div>";
    }
}
$kamers = new ReservatiesController();
$kamers = $kamers->getkamers();
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
            <label for="bedrijfsnaam">Bedrijfsnaam:</label>
            <input type="text" name="bedrijfsnaam" class="form-control"  required>
        </div>
        <label for="classes">Choose a kamer:</label><br>
        <select  type="text" name="kamer" id="classes"  class="form-control" >
    <!-- Get kamers naam to creat page -->
        <option type="text" value="" disabled selected>Kies een kamer</option>
        <?php 
        
        foreach  ($kamers as $row) : ?> 
            
                <option value="<?=$row->id?>"><?= $row->naam ?></option>
                <?php endforeach ?>
        </select>
<div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker" inline="true">
<label for="example">Start date...</label>

  <input type="date" type="hidden"  id="start" name="start" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>"  id="example" class="form-control"/>
  <i class="fas fa-calendar input-prefix"></i>
</div>
<div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker" inline="true">
<label for="example">Eind date...</label>

<input type="date" id="eind" name="eind" value="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" class="form-control" />
<i class="fas fa-calendar input-prefix"></i>
</div>   
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
