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

    public function get_Rendez()
    {
        // Create query
        $req = "SELECT * FROM rendezvous r ";
        // Prepare statement
        $stmt = $this->conn->prepare($req);
        // Execute query
        $stmt->execute();

        return $stmt;
    }
    public function insertRendez()
    {
        $req = "INSERT INTO rendezvous 
                SET Date_Rend =? , 
                ID_Journee = ? ,
                descreption = ? ,
                ID_USER = ?";
        $this->Date_Rend = htmlspecialchars(strip_tags($this->Date_Rend));
        $this->ID_Journee = htmlspecialchars(strip_tags($this->ID_Journee));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->ID_USER = htmlspecialchars(strip_tags($this->ID_USER));

        $stmt = $this->conn->prepare($req);
        if ($stmt->execute([$this->Date_Rend, $this->ID_Journee, $this->description, $this->ID_USER]))
            return true;

        // Print error if something goes wrong
        printf("Error insertRendez : %s .\n", $stmt->error);

        return false;
    }
    public function updateRendez()
    {
        $req = "UPDATE  rendezvous 
                SET Date_Rend = ?, ID_Journee = ?,  description = ? 
                WHERE ID_Rend = ?";
        $stmt = $this->conn->prepare($req);

        $this->Date_Rend = htmlspecialchars(strip_tags($this->Date_Rend));
        $this->ID_Journee = htmlspecialchars(strip_tags($this->ID_Journee));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->ID_Rend = htmlspecialchars(strip_tags($this->ID_Rend));

        if ($stmt->execute([$this->Date_Rend, $this->ID_Journee, $this->description, $this->ID_Rend]))
            return true;

        // Print error if something goes wrong
        printf("Error Update Rendez vous : %s.\n", $stmt->error);

        return false;
    }
}
