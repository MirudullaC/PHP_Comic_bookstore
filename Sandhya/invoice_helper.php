<?php
require_once ("../Aleena/user.php");
require_once ("db/DBHelper.php");
class InvoiceHelper
{
   // Static function to get user details
   public static function getUserDetails($userId)
   {
      
       $pdo = new DBHelper();
       // query to retrieve user details
       $query = "SELECT * FROM users WHERE userID = :userId";

       // Prepare and execute the query
       $stmt = $pdo->getConnection()->prepare($query);
       $stmt->execute(['userId' => $userId]);

       // Fetch the result
       $result = $stmt->fetch(PDO::FETCH_ASSOC);

       // if user exists
       if ($result) {
           // Create a new user object with the retrieved data
           $user = new user(
               $result['userID'],
               $result['FirstName'],
               $result['LastName'],
               $result['Email'],
               $result['DOB'],
               $result['Password'],
               $result['Phone'],
               $result['addr1'],
               $result['city'],
               $result['provinceId'],
               $result['postalCode']
           );

           // Return the user object
           return $user;
       } else {
           // If user does not exist, return null
           return null;
       }
   }
   public static function getOrderDetails($userId) {
    
    $pdo = new DBHelper();

    // query to fetch order detaila
    $query = "SELECT o.orderId, b.bookTitle, b.price, o.quantity
              FROM orders o
              JOIN books b ON o.bookId = b.bookId
              WHERE o.userId = :userId";

    // Prepare and execute the query
    $stmt = $pdo->getConnection()->prepare($query);
    $stmt->execute(['userId' => $userId]);

    // Fetch the results 
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // return the array of details
    return $results;
}

}
?>
