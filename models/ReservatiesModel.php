<?php

require_once "../../cores/Database.php";

class ReservatiesModel extends Database
{
    /////////////////////جلب معلومات الحجز /////////////////
    protected function get()
    {
        $connection = $this->connect();
        $stmt = $connection->prepare("SELECT reservaties.id, reservaties.bedrijfsnaam, kamers.naam, reservaties.start, reservaties.eind
        FROM reservaties INNER JOIN kamers
        ON reservaties.kamer = kamers.id WHERE status =1");

        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } else {
            return false;
        }
    }
    //////////////////voor dashboard index//////////////
    protected function getdashboardindex()
    {
        $connection = $this->connect();
        $stmt = $connection->prepare("SELECT reservaties.id, reservaties.bedrijfsnaam, kamers.naam, reservaties.start, reservaties.eind
        FROM reservaties INNER JOIN kamers
        ON reservaties.kamer = kamers.id WHERE status = 1 AND DATE(reservaties.start) = CURDATE()");


        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } else {
            return false;
        }
    }
    //////////////////////جلب معلومه الغرف لطباعتها او اضافتها ///////////////
    protected function getone()
    {
        $connection = $this->connect();
        $stmt = $connection->prepare("SELECT * From kamers");

        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } else {
            return false;
        }
    }
//////////////////////////اضافه الحجز///////////////////
    protected function add($bedrijfsnaam, $kamer, $start, $eind)
    {
        
            // Convert date strings to the correct format
            $start = date('Y-m-d', strtotime($start));
            $eind = date('Y-m-d', strtotime($eind));
          
            // add reservation
            $connection = $this->connect();
            $stmt = $connection->prepare("INSERT INTO reservaties (bedrijfsnaam, kamer, start, eind) VALUES (?, ?, ?, ?)");
            $stmt->execute([$bedrijfsnaam, $kamer, $start, $eind]);
    
            // Check if the insertion was successful
            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
         
        
    }
     //////////////////////////////////التحقق من التاريخ الحجز للغرف////////////////////////////

    protected function isKamerReserved($kamer, $start, $eind)
    {
        $connection = $this->connect();
        $stmt = $connection->prepare("SELECT COUNT(*) FROM reservaties WHERE kamer = ? AND ((start <= ? AND eind >= ?) OR (start <= ? AND eind >= ?)) AND status = 1");
        $stmt->execute([$kamer, $start, $start, $eind, $eind]);

    
        $result = $stmt->fetchColumn();
        
    
        return ($result > 0);
    }
    

            //////////////////// البحث عن ايدي للتعديل//////////////////////////

    protected function find($id)
    {
        $connection = $this->connect();
$stmt = $connection->prepare("SELECT * FROM reservaties WHERE id = ? ");
$stmt->execute([$id]);
if ($stmt->rowCount() > 0) {
    return $stmt->fetch(PDO::FETCH_OBJ);
} else {
    return false;
}
    }
 
            ////////////////////  التعديل عن طريق الايدي/////////////////////////
    protected function edit($bedrijfsnaam, $kamer,$start,$eind, $id)
    {
         // Convert date strings to the correct format
         $start = date('Y-m-d', strtotime($start));
         $eind = date('Y-m-d', strtotime($eind));
         if ($this->isKamerReserved($kamer, $start, $eind)) {
             // Room is already reserved, return false or handle accordingly
             return false;
         }
        // edit reservation
        $connection = $this->connect();
        $stmt = $connection->prepare("UPDATE reservaties SET bedrijfsnaam = ?, kamer = ?, start = ?, eind = ? WHERE id = ?");
        $stmt->execute([$bedrijfsnaam, $kamer,$start,$eind, $id]);
        
        if ($stmt->rowCount() > 0) {
            return true; // Record updated successfully
        } else {
            return false; // No record with the given id found or no changes made
        }
    }
    
            ////////////////////  الحدف عن طريق الايدي/////////////////////////
    protected function delete($id)
    {
        try {
            // Update status to 0 instead of directly deleting
            $connection = $this->connect();
            $stmt = $connection->prepare("UPDATE reservaties SET status = 0 WHERE id = ?");
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