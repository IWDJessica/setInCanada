<?php

class Profile
{
    /**
     * database connection
     *
     * @var PDOConnection
     */
    private $conn;
    /**
     * table name
     *
     * @var string
     */
    private $table_name = "user";
    
    // object properties
    public $id;
    public $firstName;
    public $lastName;
    public $email;
    public $created;
    public $lastAccess;
    public $country;
    public $phoneNumber;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // used by select drop-down list
    public function readProfile($emailQuery)
    {
       //select all data
        $query = "SELECT *
                FROM " . $this->table_name . "
               WHERE email='".$emailQuery."'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function updateProfile()
    {
        // echo "f " . $this->firstName . " l: " .$this->lastName . " e: ".$this->email. " la: ".$this->country. "p: " .$this->phoneNumber;
        // die();

        $query = "UPDATE ". $this->table_name . " 
                 SET 
                     firstName=:firstName, 
                     lastName=:lastName, 
                     country=:country, 
                     phoneNumber=:phoneNumber
                 WHERE email=:email";
        // echo $query;

        $stmt = $this->conn->prepare($query);
        //sanitize
        $this->firstName = htmlspecialchars(strip_tags($this->firstName));
        $this->lastName = htmlspecialchars(strip_tags($this->lastName));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->country = htmlspecialchars(strip_tags($this->country));
        $this->phoneNumber = htmlspecialchars(strip_tags($this->phoneNumber));
        //bind values
        $stmt->bindParam(":firstName", $this->firstName);
        $stmt->bindParam(":lastName", $this->lastName);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":country", $this->country);
        $stmt->bindParam(":phoneNumber", $this->phoneNumber);
        //execute query
        // if ($stmt->execute()) {
        //     return true;
        // }
        // return false;

        if(!$stmt){
            echo "<p>CONN prepare: ".$conn->errorCode()."</p>\n<p>Message ".implode($conn->errorInfo())."</p>\n";
            // exit(1);
            return false;
        }


        $status = $stmt->execute();

        if(!$status){
            echo "<p>EXE execute: ".$stmt->errorCode()."</p>\n<p>Message ".implode($stmt->errorInfo())."</p>\n";
            return false;
        }

        return true;
    }

}