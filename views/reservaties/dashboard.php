<?php
require_once("../head/head.php");
//c://MAMP/htdocs//reservaties/views/

require "../../controllers/ReservatiesController.php";

$reservaties = new ReservatiesController();
$reservaties = $reservaties->dashboardindex();

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Dashboard Template</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <!-- <link rel="stylesheet" href="../../css/index.css"> -->
    

    <!-- Bootstrap core CSS -->
  
    <!-- Custom styles for this template -->
  </head>
  <body>
    


<div class="container-fluid">
  <div class="row">
   

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <h4>Gereserveerde Vergaderkamers voor Vandaag: </h4>
            <tr>
              <th scope="col">BedrijfNaam</th>
              <th scope="col">KamerNaam</th>

              <th scope="col">Start</th>
              <th scope="col">Eind</th>
              <th scope="col">Edit</th>
              <th scope="col">Delet</th>

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
        <table class="table table-striped table-sm">
          <thead>
            <h4>Verloop Contracten </h4>
            <tr>
              <th scope="col">BedrijfNaam</th>
              <th scope="col">KamerNaam</th>



            </tr>
          </thead>
          <tbody>
  <?php if (is_array($reservaties)) : ?>
    <?php foreach ($reservaties as $row) : ?>
                <tr>
                  
                    <td><?= $row->bedrijfsnaam ?></td>
                    <td><?= $row->naam ?></td>
                   
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
    </main>
  </div>
</div>


<script  type="text/javascript" src="./dist/js/bootstrap.bundle.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  </body>
</html>
