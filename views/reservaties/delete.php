<?php

require "../../controllers/ReservatiesController.php";

$reservaties = new ReservatiesController();
$find = $reservaties->findorfail();
if(!$find){
    header("Location: index.php");
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $remove = $reservaties->remove();
    if($remove){
        header("Location: index.php");
    }
    else{
        echo "error";
    }
}
?>