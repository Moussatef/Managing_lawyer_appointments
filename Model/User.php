<?php

class User
{
    // DB stuff
    private $conn;
    public $Ref;
    public $ID_USER;
    public $NAME;
    public $F_Name;
    public $EMAIL;


    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function get_Users()
    {
        // Create query
        $req = "SELECT * FROM user u INNER JOIN referance r on u.ID_USER = r.ID_USER";
        // Prepare statement
        $stmt = $this->conn->prepare($req);
        // Execute query
        $stmt->execute();

        return $stmt;
    }
    public function get_User()
    {
        $req = "SELECT * FROM user u INNER JOIN referance r on u.ID_USER = r.ID_USER WHERE r.Ref = ?  LIMIT 0,1";

        // Prepare statement
        $stmt = $this->conn->prepare($req);

        // Bind ID
        $stmt->bindParam(1, $this->Ref);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->ID_USER = $row['ID_USER'];
        $this->Ref = $row['Ref'];
        $this->NAME = $row['NAME'];
        $this->F_Name = $row['F_Name'];
        $this->EMAIL = $row['EMAIL'];
    }
    public function Insert_User()
    {
        $cmp = 0;
        $req_check_email = "SELECT EMAIL FROM user WHERE email=?";
        $req1 = "INSERT INTO user 
                SET NAME = ? , F_Name = ?  , EMAIL = ? ";

        $req2 = "SELECT ID_USER FROM user ORDER BY ID_USER DESC LIMIT 1 ";
        $req3 = "INSERT INTO referance SET ID_USER = ? , Ref = ?";

        //chack if Email is already exeste in table on database
        $stmt = $this->conn->prepare($req_check_email);

        // Clean data
        $this->NAME = htmlspecialchars(strip_tags($this->NAME));
        $this->F_Name = htmlspecialchars(strip_tags($this->F_Name));
        $this->EMAIL = htmlspecialchars(strip_tags($this->EMAIL));

        $stmt->execute([$this->EMAIL]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $numRow = $stmt->rowCount();
        if ($numRow > 0) {
            printf("Email : %s already existe ...!!\n", $row['EMAIL']);
            return false;
        }


        $stmt1 = $this->conn->prepare($req1);
        if ($stmt1->execute([$this->NAME, $this->F_Name, $this->EMAIL]))
            $cmp++;

        if ($stmt2 = $this->conn->query($req2))
            $cmp++;

        $row = $stmt2->fetch(PDO::FETCH_ASSOC);

        $this->ID_USER = $row['ID_USER'];

        $this->Ref = $row['ID_USER'] . strtoupper($this->NAME) . strtoupper($this->F_Name) . date("Ymd");

        $stmt3 = $this->conn->prepare($req3);

        if ($stmt3->execute([$this->ID_USER, $this->Ref]))
            $cmp++;

        if ($cmp === 3)
            return true;

        // Print error if something goes wrong
        printf("Error: %s %s %s.\n", $stmt1->error, $stmt2->error, $stmt3->error);

        return false;
    }

    public function Update_User()
    {
        $req = "UPDATE user 
                SET NAME = ?,
                    F_Name = ?,
                    EMAIL = ?
                WHERE ID_USER IN (SELECT ID_USER FROM referance WHERE Ref = ? ) ";

        $stmt = $this->conn->prepare($req);

        $this->NAME = htmlspecialchars(strip_tags($this->NAME));
        $this->F_Name = htmlspecialchars(strip_tags($this->F_Name));
        $this->EMAIL = htmlspecialchars(strip_tags($this->EMAIL));
        $this->Ref = htmlspecialchars(strip_tags($this->Ref));

        $stmt->bindParam('1', $this->NAME);
        $stmt->bindParam('2', $this->F_Name);
        $stmt->bindParam('3', $this->EMAIL);
        $stmt->bindParam('4', $this->Ref);

        if ($stmt->execute())
            return true;

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    public function Delete_User()
    {
        $req = "DELETE FROM user WHERE ID_USER IN (SELECT ID_USER FROM referance WHERE Ref = ? )";

        $stmt = $this->conn->prepare($req);

        $this->Ref = htmlspecialchars(strip_tags($this->Ref));

        if ($stmt->execute([$this->Ref]))
            return true;

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}
