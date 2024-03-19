
<?php
require_once("../head/head.php");

require "../../controllers/ReservatiesController.php";

$reservaties = new ReservatiesController();
$reservaties = $reservaties->index();


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
  <script src="../../static/js/index.js"></script>
  <link rel="stylesheet" href="../../static/css/index.css">
  <title>reservatiesIndex</title>  
</head>
<body>
  <div class="table-container">
  <label class="control-label col-sm-4" for="email"><b>Zoek een reservatie</b>:</label>
        <div class="col-sm-4">
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Zoeken.." title="Type in a name">
        </div>
<div class="table-responsive">
            <table class="table" id="contractTable">

  <thead>
    <tr>
      <th scope="col">bedrijfsnaam</th>
      <th scope="col">kamer</th>
      <th scope="col">start</th>
      <th scope="col">eind</th>
      <th scope="col">edit</th>
      <th scope="col">delete</th>
    </tr>
  </thead>
  <tbody>
  <?php if (is_array($reservaties)) : ?>
    <?php foreach ($reservaties as $row) : ?>
                <tr>
                  
                    <td><?= $row->bedrijfsnaam ?></td>
                    <td><?= $row->naam ?></td>
                    <td><?= $row->start ?></td>
                    <td><?= $row->eind ?></td>
                    <td><a href="edit.php?id=<?= $row->id ?>"><button type="button" class="btn btn-warning">Edit</button></a></td>
                    <td>
                        <form action="delete.php?id=<?= $row->id ?>" method="post">
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
                <a href="create.php">
                    <button type="submit" class="btn btn-primary">Aanmaken</button>
                </a>
            </div>
        </div>
    </div>
    
</body>

</html>