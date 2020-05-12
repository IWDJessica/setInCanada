<?php
class Favourite 
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
    private $tableName = "favourite_service_provider";

    // object properties
    public $serviceProviderId;
    public $userId;
    public $updated;
    public $deleted;

    //constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function createOrUpdate()
    {
        $query = "INSERT INTO " . $this->tableName . "
                  (service_provider_id, user_id, deleted)
                  VALUES (:serviceProviderId, :userId, :deleted)
                  ON DUPLICATE KEY UPDATE deleted = :deleted;";

        $statement = $this->conn->prepare($query);
        // print_r($statement);
        //bind values
        $statement->bindParam(":serviceProviderId", $this->serviceProviderId);
        $statement->bindParam(":userId", $this->userId);
        $statement->bindParam(":deleted", $this->deleted);

        //execute query
        if ($statement->execute()) {
            return true; //beautiful
        }
        return false;
    }

    public function getUserFavourites($userIdQuery)
    {
        $query = "SELECT fsp.service_provider_id, fsp.user_id, fsp.updated, sp.businessName, 
                         s.name as serviceName, s.type as serviceType
                  FROM favourite_service_provider fsp
                  INNER JOIN service_provider sp
                    ON sp.id = fsp.service_provider_id
                  INNER JOIN service s
                    ON sp.id = s.service_provider_id
                  WHERE user_id = :userId
                  AND fsp.deleted = 0";//only bring not deleted favourite
        
        $statement = $this->conn->prepare($query);

        //bind
        $statement->bindParam("userId", $userIdQuery);

        //execute
        $statement->execute();
        return $statement;
    }
}
?>