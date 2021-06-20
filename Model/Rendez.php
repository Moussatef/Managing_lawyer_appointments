<?php

class Rendez
{
    // DB stuff
    private $conn;
    public $Ref;
    public $ID_Rend;
    public $Date_Rend;
    public $description;
    public $ID_USER;
    public $ID_Journee;
    public $Time_IN;
    public $Time_TO;

    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function get_Rendez()
    {
        // Create query
        $req = "SELECT * FROM rendezvous r INNER JOIN journee j ON j.ID_Journee = r.ID_Journee";
        // Prepare statement
        $stmt = $this->conn->prepare($req);
        // Execute query
        $stmt->execute();

        return $stmt;
    }
    public function get_Rendez_User()
    {
        // Create query
        $req = "SELECT * FROM rendezvous r INNER JOIN journee j ON j.ID_Journee = r.ID_Journee INNER JOIN user u ON u.ID_USER = r.ID_USER where r.ID_USER =?";
        // Prepare statement
        $stmt = $this->conn->prepare($req);

        $this->ID_USER = htmlspecialchars(strip_tags($this->ID_USER));
        // Execute query
        $stmt->execute([$this->ID_USER]);
        // Set properties
        return $stmt;
    }
    public function insertRendez()
    {
        $req = "INSERT INTO rendezvous 
                SET Date_Rend =? , 
                ID_Journee = ? ,
                description = ? ,
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
    public function deleteRendez()
    {
        $req = "DELETE FROM rendezvous WHERE ID_Rend = ?";
        $stmt = $this->conn->prepare($req);
        if ($stmt->execute($this->ID_Rend))
            return true;

        // Print error if something goes wrong
        printf("Error Delete Rendez vous: %s.\n", $stmt->error);

        return false;
    }
    public function getDateRendezDispo()
    {
        $req = "SELECT * 
            from journee
             WHERE ID_Journee not in
                                (SELECT ID_Journee FROM rendezvous WHERE Date_Rend = ?)";
        $stmt = $this->conn->prepare($req);
        $this->Date_Rend = htmlspecialchars(strip_tags($this->Date_Rend));
        $date1 = new DateTime($this->Date_Rend);

        $stmt->execute([$date1->format('Y-m-d')]);

        return $stmt;
    }
}
