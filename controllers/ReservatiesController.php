<?php

require "../../models/ReservatiesModel.php";

class ReservatiesController extends ReservatiesModel
{
    ///////////////////////طباعه جميع العناصر ////////////////////////////////////////
    public function index()
    {
        return $this->get();
    }
    /////////////////////// voor index طباعه جميع العناصر ////////////////////////////////////////


    public function dashboardindex()
    {
        return $this->getdashboardindex();
    }



    ///////////////////////طباعه الغرف/////////////////////////////
    public function getkamers()
    {
        return $this->getone();

    }




//////////////////////////////////اضافه الغرفه////////////////////////////
    public function create($bedrijfsnaam, $kamer, $start, $eind)
    {
        ///////////////////////فحص ادا كانت الغرفه محجوزه بالتاريخ المحدد///////////////////////
        if ($this->isKamerReserved($kamer, $start, $eind)) {
            // Room is already reserved, return false or handle accordingly
            return false;
        }

        ////////////////////////////////اضافه الغرفه///////////////////////////////
        return $this->add($bedrijfsnaam, $kamer, $start, $eind);
    }





//////////////////////////البحث عن ايدي معين ///////////////////////////////
    public function findorfail()
    {
        return $this->find($_GET["id"]);
    }
    



    //////////////////////////التعديل علئ الايدي المعين///////////////////////////////
    public function update()
    {
        return $this->edit($_POST["bedrijfsnaam"], $_POST["kamer"],$_POST["start"],$_POST["eind"],$_GET["id"]);
    }



    
    /////////////////////////////حدف العناصر من ايدي معين///////////////////////////////
    public function remove()
    {
        return $this->delete($_GET["id"]);
    }
}