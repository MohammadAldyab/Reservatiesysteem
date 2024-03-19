<?php
require_once("../head/head.php");
// Include your UserController.php at the top
require "../../controllers/UserController.php";

// Initialize the UserController
$userController = new UserController();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the input values
    $email = $_POST["email"];
    $password = $_POST["password"];
    // Perform signup
    if ($userController->signup($email, $password)) {
        // Redirect to the login page or any other page
        header("Location: login.php");
        exit();
    } else {
        $error = "Signup failed. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="../../static/css/login-singup.css" rel="stylesheet" id="bootstrap-css">
</head>
<body>
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="https://th.bing.com/th/id/OIP.L_pLAvu8Tilt4AD4S9mBkgHaCC?rs=1&pid=ImgDetMain" id="icon" alt="User Icon" />
    </div>
    <?php if (isset($error)) : ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <input type="text" id="email" class="fadeIn second"  name="email" placeholder="Maak Nieuw email" required><br>

        <input type="password" id="password" class="fadeIn third" name="password" placeholder="Maak Nieuw password" required><br>

        <!-- You might want to add password confirmation field here -->

        <input type="submit" class="fadeIn fourth" value="Signup">
    </form>
    <div id="formFooter">
    <p>Already have an account? <a class="underlineHover"  href="login.php">Login here</a></p>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</div>

  </div>
</div>
</body>
</html>
