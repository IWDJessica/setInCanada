<?php

class Provider
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
    private $table_name = "service_provider";
  
    // object properties
    public $id;
    public $businessName;
    public $image;
    public $contactNumber;
    public $email;
    public $service;
    public $name;
    public $type;
    public $price;
    public $service_hours;
    public $attributes;
    public $imageService;
    public $street;
    public $city;
    public $province;
    public $postal_code;



    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Read All Vendors
    public function readAllProviders($service)
    {
       //select all data
        
       $query = "SELECT
                service_provider.id as id,
                service_provider.firstName,
                service_provider.lastName,
                service_provider.businessName, 
                service_provider.image,
                service_provider.contactNumber,
                service_provider.email, 
                service.name as serviceName,
                service.type as serviceType,
                service_details.price as servicePrice,	
                service_details.service_hours,	
                service_details.attributes as serviceAttributes,
                service_details.image as serviceImage,
                service_location.street,
                service_location.city,
                service_location.province,
                service_location.postal_code
            FROM service_provider 
            INNER JOIN service ON service_provider.id = service.service_provider_id 
            LEFT JOIN service_details ON service_details.service_id = service.id  
            LEFT JOIN service_location ON service_location.service_id = service.id
            WHERE service.type='".$service."'";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // used by select drop-down list
    public function readProvider($id)
    {
       
        $query = "SELECT 
                        service_provider.businessName, 
                         service_provider.image as image, 
                         service_provider.contactNumber,
                         service_provider.email,
                         service.name,
                         service.type,
                         service_details.price,	
                         service_details.service_hours,	
                         service_details.attributes,
                         service_details.image as imageService,
                         service_location.street,
                         service_location.city,
                         service_location.province,
                         service_location.postal_code
                 FROM service_provider INNER JOIN service ON service_provider.id = service.service_provider_id 
                 
                 LEFT Join service_details ON service_details.service_id=service.id  

                 LEFT JOIN service_location ON service_location.service_id=service.id

                WHERE service_provider.id='".$id."'";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create()
    {

        $query = "INSERT INTO ". $this->table_name . " 
                 (firstName, lastName, email, contactNumber, businessName, image, 
		  status, acceptTerms, acceptEmail, created) 
		values (:firstName, :lastName, :email, :contactNumber, :businessName, :image, 
          :status, :acceptTerms, :acceptEmail, :created);
          SET @lastId = LAST_INSERT_ID();

          INSERT INTO service
            (name, type, service_provider_id)  
             values (:name, :type, @lastId );

             SET @lastService = LAST_INSERT_ID();
           
             INSERT INTO service_location 
            (service_id, street, city, province, postal_code)
             values (@lastService , :street, :city, :province, :postalCode);       
            
             INSERT INTO service_details 
             (service_id, price, service_hours, attributes, image) 
             values (@lastService, :price, :service_hours, :attributes, :imageService);
             
          
         "; 
        //    (service_id, price, service_hours, attributes, image) 
        //      values (@lastService , :price, :service_hours, :attributes, :imageService);
        // // echo $query;

        $stmt = $this->conn->prepare($query);

        //sanitize
        $this->firstName = htmlspecialchars(strip_tags($this->firstName));
        $this->lastName = htmlspecialchars(strip_tags($this->lastName));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->contactNumber = htmlspecialchars(strip_tags($this->contactNumber));
        $this->businessName = htmlspecialchars(strip_tags($this->businessName));
        $this->image = htmlspecialchars(strip_tags($this->image));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->acceptTerms = htmlspecialchars(strip_tags($this->acceptTerms));
        $this->acceptEmail = htmlspecialchars(strip_tags($this->acceptEmail));
        $this->created = htmlspecialchars(strip_tags($this->created));

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->type = htmlspecialchars(strip_tags($this->type));

        $this->price = htmlspecialchars(strip_tags($this->price));
        // $this->service_hours = htmlspecialchars(strip_tags($this->service_hours));
        // $this->attributes = htmlspecialchars(strip_tags($this->attributes));
        $this->imageService = htmlspecialchars(strip_tags($this->imageService));

        $this->street = htmlspecialchars(strip_tags($this->street));
        $this->city = htmlspecialchars(strip_tags($this->city));
        $this->province = htmlspecialchars(strip_tags($this->province));
        $this->postalCode = htmlspecialchars(strip_tags($this->postalCode));
    
        //bind values
        $stmt->bindParam(":firstName", $this->firstName);
        $stmt->bindParam(":lastName", $this->lastName);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":contactNumber", $this->contactNumber);
        $stmt->bindParam(":businessName", $this->businessName);   
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":acceptTerms", $this->acceptTerms);
        $stmt->bindParam(":acceptEmail", $this->acceptEmail);
        $stmt->bindParam(":created", $this->created);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":type", $this->type);

         $stmt->bindParam(":street", $this->street);
        $stmt->bindParam(":city", $this->city);
        $stmt->bindParam(":province", $this->province);
        $stmt->bindParam(":postalCode", $this->postalCode);
   
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":service_hours", $this->service_hours);
        $stmt->bindParam(":attributes", $this->attributes);
        $stmt->bindParam(":imageService", $this->imageService);
    

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
    public function getByEmail($email)
    {
        $query = "SELECT id, firstName, lastName, email 
                  FROM " . $this->table_name . "
                  WHERE email = '" . $email . "' LIMIT 1;";

        //prepare query statement
        $stmt = $this->conn->prepare($query);

        //execute query
        $stmt->execute();

        return $stmt;
    }

}
