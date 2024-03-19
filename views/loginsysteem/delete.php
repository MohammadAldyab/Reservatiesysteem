<?php

require "../../controllers/UserController.php";

$users = new UserController();
$find = $users->findorfail();



if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $remove = $users->remove();
    if($remove){
        header("Location: ../dashboards/admin_dashboard.php");
    }
    else{
        echo '
        <div class="w3-container">
        <div class="w3-panel w3-red w3-display-container">
          <span onclick="this.parentElement.style.display=none"
          class="w3-button w3-large w3-display-topright">&times;</span>
          <h3>LetOP!</h3>
          <p>Jij bent ingeloegd als admin.</p>
        </div>
        </div>';
    }
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

</head>
<body>
</body> 
</html>