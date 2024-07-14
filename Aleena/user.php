<?php
require_once ("../Sandhya/db/DBHelper.php");

$dbHelper = new DBHelper();

class user
{
    protected $userId;
    protected $firstName;
    protected $lastName;
    protected $email;
    protected $DOB;
    protected $password;
    protected $phone;
    protected $addr1;
    protected $city;
    protected $provinceId;
    protected $postalCode;

    public function __construct($userId, $firstName, $lastName, $email, $DOB, $password, $phone,$addr1,$city,$provinceId,$postalCode)
    {
        $this->userId = $userId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->DOB = $DOB;
        $this->password = $password;
        $this->phone = $phone;
        $this->addr1 = $addr1;
        $this->city = $city;
        $this->provinceId = $provinceId;
        $this->postalCode=$postalCode;
    }

    // getter methods
    public function getUserId()
    {
        return $this->userId;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getDOB()
    {
        return $this->DOB;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getAddr1()
    {
        return $this->addr1;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getPostalCode()
    {
        return $this->postalCode;
    }

    //Method to insert data into user table
    public static function insertUser($firstName, $lastName, $email, $DOB, $password, $phone,$addr1,$city,$provinceId,$postalCode)
    {
        try {

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
          
            $pdo = new DBHelper();
            $query = "INSERT INTO users(FirstName,LastName,Email,DOB,Password,Phone,addr1,city,provinceId,postalCode)
            VALUES (:firstName,:lastName,:email,:DOB,:password,:phone,:addr1,:city,:provinceId,:postalCode)";
            $stmt = $pdo->getConnection()->prepare($query);
            $stmt->execute(['firstName' => $firstName, 'lastName' => $lastName, 'email' => $email,
            'DOB' => $DOB, 'password' => $hashedPassword, 'phone' => $phone, 'addr1'=>$addr1, 'city'=>$city,
            'provinceId'=>$provinceId, 'postalCode'=>$postalCode ]);

            if ($stmt->rowCount() > 0) {
                
                echo "<h3 style:'blue'>Registration successful!</h3>";

                // Reset form values
                $firstName = '';
                $lastName = '';
                $email = '';
                $DOB = '';
                $password = '';
                $phone = '';
                $addr1 = '';
                $city = '';
                $provinceId = '';
                $postalCode = '';
            } else {
                // Show error message if an exception occurs
                echo "<h3>Failed to register</h3>";
            }
        } catch (PDOException $ex) {
            // Return error message if an exception occurs        
            return "Error inserting item: " . $ex->getMessage();
        }
    } 

    function getRowCount(){ return $this->stmt->rowCount();}

}
