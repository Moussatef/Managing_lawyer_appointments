<?php

class Rendez
{
    // DB stuff
    private $conn;
    public $Ref;
    public $ID_Rend;
    public $Date_Rend;
    public $ID_Journee;
    public $description;
    public $ID_USER;

    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }
}
