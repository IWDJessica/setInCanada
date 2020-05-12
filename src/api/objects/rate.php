<?php
class Rate
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
    private $tableName = "rate_service_provider";

    // public properties
    public $userId;
    public $serviceProviderId;
    public $rate;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function createOrUpdate()
    {
        $query = "INSERT INTO " . $this->tableName . "
                  (service_provider_id, user_id, rate)
                  VALUES (:serviceProviderId, :userId, :rate)
                  ON DUPLICATE KEY UPDATE rate = :rate;";

        $state = $this->conn->prepare($query);

        //bind values
        $state->bindParam(":serviceProviderId", $this->serviceProviderId);
        $state->bindParam(":userId", $this->userId);
        $state->bindParam(":rate", $this->rate);

        //execute query
        if ($state->execute()) {
            return true;
        }
        return false;
    }

    public function getServiceProviderScore($serviceProviderId)
    {
        $query = "SELECT service_provider_id, rate
                  FROM rate_service_provider
                  WHERE service_provider_id = :serviceProviderId;";

        $state = $this->conn->prepare($query);

        //bind
        $state->bindParam("serviceProviderId", $serviceProviderId);

        //execute
        $state->execute();
        return $state;
        
    }
}
?>