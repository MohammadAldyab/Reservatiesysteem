<?php


require "../../models/UserModel.php";


class UserController extends UserModel
{
  
    public function login($email, $password)
    {
        $user = $this->authenticate($email, $password); 
        if ($user) {
            session_start();
            $_SESSION['email'] = $user;
           
            // Successful login, redirect the user to the appropriate dashboard based on their role
            if ($user['rolen'] === 'admin') {
                header("Location: ../dashboards/admin_dashboard.php");

                exit();
            } elseif ($user['rolen'] === 'klant') {
                header("Location: ../dashboards/klant_dashboard.php");
                exit();
            } elseif ($user['rolen'] === 'medewerker') {
                header("Location: ../dashboards/medewerker_dashboard.php");
                exit();
            } else {
                // Unknown role, redirect to a default dashboard or display an error message
                header("Location: ../login.php");
                exit();
            }
        } else {
            // Login failed, display an error message to the user or take another action
            return false;
        }
    }
    

    public function signup($email, $password)
    {
        return $this->register($email, $password );
    }
///////////Haal alle users een userController //////////////

    public function getUsers()
    {
        return $this->index();

    }

///////////maak een userController //////////////
    public function create($email, $password, $rolen)
    {
      
        return $this->add($email, $password, $rolen);
    }
///////////zoeken een user om bewerken userController //////////////

public function findorfail()
    {
        return $this->find($_GET["id"]);
    }
///////////bewerken een userController //////////////

    public function update()
    {
        return $this->edit($_POST["email"], $_POST["rolen"], $_GET["id"]);
    }

    ///////////verwijder een userController //////////////

    public function remove()
    {
        return $this->delete($_GET["id"]);
    }
    


}