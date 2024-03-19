<?php

require_once "../../cores/Database.php";


class UserModel extends Database
{
    protected function authenticate($email, $password)
    {
        $connection = $this->connect();
        $stmt = $connection->prepare("SELECT * FROM users WHERE email = ? AND status = 1");
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            // Controleer of het opgegeven wachtwoord overeenkomt met het opgeslagen wachtwoord
            if (md5($password) === $user['password']) {
                return $user; // Gebruiker gevonden en wachtwoord is correct
            }
        }
        return false; // Gebruiker niet gevonden of wachtwoord is incorrect
    }

    protected function register($email, $password)
    {
        try {
            $hashedPassword = md5($password); // Voorbeeld, gebruik een veilige hash-methode in productie
            $connection = $this->connect();
    
            // Controleer of de gebruikersnaam al bestaat
            $stmtCheck = $connection->prepare("SELECT COUNT(*) AS count FROM users WHERE email = ?");
            $stmtCheck->execute([$email]);
            $result = $stmtCheck->fetch(PDO::FETCH_ASSOC);
    
            if ($result['count'] > 0) {
                // Gebruikersnaam bestaat al, retourneer false voor mislukte registratie
                echo '<div style="background-color: #ffcccc;
            color: #cc0000;
            border: 1px solid #cc0000;
            padding: 10px;
            margin-bottom: 20px;">Gebruikersnaam bestaat al</div>';

                return false;
            }
    
            // Gebruikersnaam bestaat niet, voeg de nieuwe gebruiker toe
            $stmt = $connection->prepare("INSERT INTO users (email, password, rolen, status) VALUES (?, ?, 'klant', 1)");
            $stmt->execute([$email, $hashedPassword]);
    
            if ($stmt->rowCount() > 0) {
                return true; // Registratie succesvol
            } else {
                return false; // Registratie mislukt
            }
        } catch (PDOException $e) {
            // Behandel eventuele databasefouten
            return false;
        }
    }
    
   
   
    protected function index()
    {
        $connection = $this->connect();
        if($connection === false) {
            // Handle database connection error
            return false;
        }
    
        try {
            $stmt = $connection->prepare("SELECT * FROM users WHERE status = 1");
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                return $stmt->fetchAll(PDO::FETCH_OBJ);
            } else {
                // No records found
                return [];
            }
        } catch (PDOException $e) {
            // Handle database query error
            // Log or display the error message as needed
            return false;
        }
    }

    protected function add($email, $password, $rolen)
{
    try {
        // Controleer of de gebruikersnaam al bestaat
        $connection = $this->connect();
        $stmtCheck = $connection->prepare("SELECT COUNT(*) AS count FROM users WHERE email = ? AND status = 1 And rolen = ?");
        $stmtCheck->execute([$email, $rolen]);
        $result = $stmtCheck->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] > 0) {
            // Gebruikersnaam bestaat al, retourneer false voor mislukte toevoeging
            echo '<div style="background-color: #ffcccc;
            color: #cc0000;
            border: 1px solid #cc0000;
            padding: 10px;
            margin-bottom: 20px;">Gebruikersnaam bestaat al met deze rol</div>';


            return false;
        }

        // Voeg de nieuwe gebruiker toe
        $hashedPassword = md5($password); // Voorbeeld, gebruik een veilige hash-methode in productie
        $stmt = $connection->prepare("INSERT INTO users (email, password, rolen, status) VALUES (?, ?, ?, 1)");
        $stmt->execute([$email, $hashedPassword, $rolen]);

        // Controleer of de invoeging succesvol was
        if ($stmt->rowCount() > 0) {
            return true; // Toevoeging succesvol
        } else {
            return false; // Toevoeging mislukt
        }
    } catch (PDOException $e) {
        // Behandel eventuele databasefouten
        return false;
    }
}

    protected function find($id)
    {
        $connection = $this->connect();
$stmt = $connection->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
if ($stmt->rowCount() > 0) {
    return $stmt->fetch(PDO::FETCH_OBJ);
} else {
    return false;
}
    }
 
            ////////////////////  التعديل عن طريق الايدي/////////////////////////
    protected function edit($email,$rolen, $id)
    {
        $connection = $this->connect();
        $stmt = $connection->prepare("UPDATE users SET email = ?, rolen = ? WHERE id = ?");
        $stmt->execute([$email,$rolen,$id]);
        if ($stmt->rowCount() > 0) {
            return true; // Record updated successfully
        } else {
            return false; // No record with the given id found or no changes made
        }
    }
    
    protected function delete($id)
    {
        try {
            // Update status to 0 instead of directly deleting
            $connection = $this->connect();
            $stmt = $connection->prepare("UPDATE users SET status = 0 WHERE id = ?");
            $stmt->execute([$id]);
    
            // Check if the update was successful
            if ($stmt->rowCount() > 0) {
                return true; // Record updated successfully
            } else {
                return false; // No record with the given id found
            }
        } catch (PDOException $e) {
            // Handle any database errors
            // You might want to log the error or throw an exception
            return false;
        }
    }
}
