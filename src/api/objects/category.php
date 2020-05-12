<?php
class Category
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
    private $table_name = "category";

    // object properties
    public $catId;
    public $catName;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // used by select drop-down list
    public function readCategory()
    {
        //select all data
        $query = "SELECT catId, catName
                FROM " . $this->table_name . "
                WHERE catStatus=1
                ORDER BY catOrder";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;

        // get retrieved row
        // $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // // set values to object properties
        // $this->catId = $row['catId'];
        // $this->catName = $row['catName'];
    }
}
