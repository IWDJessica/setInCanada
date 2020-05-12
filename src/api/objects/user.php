<?php
class User
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
    private $tableName = "user";

    //object properties
    public $id;
    public $firstName;
    public $lastName;
    public $email;
    public $password;
    public $created;
    public $lastAccess;

    /**
     * constructor with conn as database connection
     *
     * @param PDOConnection $conn
     */
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getByEmail($email)
    {
        $query = "SELECT id, firstName, lastName, email, password, created, lastAccess
                  FROM " . $this->tableName . "
                  WHERE email = '" . $email . "' LIMIT 1;";

        //prepare query statement
        $stmt = $this->conn->prepare($query);

        //execute query
        $stmt->execute();

        return $stmt;
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->tableName . "
                  (firstName, lastName, email, password, created, lastAccess)
                  VALUES(:firstName, :lastName, :email, :pass, :created, :lastAccess);";

        $stmt = $this->conn->prepare($query);

        //sanitize
        $this->firstName = htmlspecialchars(strip_tags($this->firstName));
        $this->lastName = htmlspecialchars(strip_tags($this->lastName));
        $this->email = htmlspecialchars(strip_tags($this->email));

        //bind values
        $stmt->bindParam(":firstName", $this->firstName);
        $stmt->bindParam(":lastName", $this->lastName);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":pass", $this->password);
        $stmt->bindParam(":created", $this->created);
        $stmt->bindParam(":lastAccess", $this->lastAccess);

        //execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function readOne()
    {

        // query to read single record
        $query = "SELECT * FROM
        " . $this->tableName . "
        WHERE email = :email AND password= :pass ";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind id of product to be updated

        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":pass", $this->password);
        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->id = $row['id'];
        $this->firstName = $row['firstName'];
        $this->lastName = $row['lastName'];
        $this->lastAccess = $row['lastAccess'];
 
   
        return $stmt;
    }
}
