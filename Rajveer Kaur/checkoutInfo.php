<?php
require_once('../Sandhya/db/DBHelper.php');
require_once("../Sandhya/cartInfo.php");

class CheckoutInfo
{
    protected $dbHelper;

    public function __construct()
    {
        $this->dbHelper = new DBHelper();
    }

    // Function to insert order details into the database
    public static function insertOrder($userId, $orderId, $bookId, $quantity)
    {
        try {
            $pdo = new DBHelper();
            $query = "INSERT INTO orders (userId, orderId, bookId, quantity) VALUES (:userId, :orderId, :bookId, :quantity)";
            $stmt = $pdo->getConnection()->prepare($query);
            $stmt->execute(['userId' => $userId, 'orderId' => $orderId, 'bookId' => $bookId, 'quantity' => $quantity]);
    
            if ($stmt->rowCount() > 0) {
                // Return success message 
                return "success";
            } else {
                // Return error message if no rows were affected
                return "Failed to insert order";
            }
        } catch (PDOException $ex) {
            // Return error message if an exception occurs        
            return "Error inserting order: " . $ex->getMessage();
        }
    }
    

    // // Function to insert payment details into the database
    public static function insertPayment($orderId, $amount, $paymentType, $status)
    {
        try {
            $pdo = new DBHelper();
            $query = "INSERT INTO payment (orderId, amount, payment_type, status) VALUES (:orderId, :amount, :paymentType, :status)";
            $stmt = $pdo->getConnection()->prepare($query);
            $stmt->execute(['orderId' => $orderId, 'amount' => $amount, 'paymentType' => $paymentType, 'status' => $status]);
    
            if ($stmt->rowCount() > 0) {
                // Return success message 
                return "success";
            } else {
                // Return error message if no rows were affected
                return "Failed to insert payment";
            }
        } catch (PDOException $ex) {
            // Return error message if an exception occurs        
            return "Error inserting payment: " . $ex->getMessage();
        }
    }

     // Method to retrieve cart information from database based on user id
     public static function getCartDetails($userId)
     {
        echo "User";
       
         $pdo = new DBHelper();
         $query = "SELECT c.cartId, c.userId, c.bookId, c.quantity, b.bookTitle, b.price
                     FROM cart c, books b WHERE c.bookId = b.bookId AND c.userId = :user";
         $stmt = $pdo->getConnection()->prepare($query);
               //  echo $query;
         $stmt->execute(['user' => $userId]);
         $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // echo "Result: <pre>" . print_r($result, true) . "</pre>"; // Echo the $result
 
         $cartInfos = [];
         foreach ($result as $row) {
             $cartInfo = new CartInfo(
                 $row['cartId'],
                 $row['userId'],
                 $row['bookId'],
                 $row['quantity'],
                 $row['bookTitle'],
                 $row['price'],
                 $row['imgUrl']
             );
             $cartInfos[] = $cartInfo;
         }
         return $cartInfos;
         
     }
    
}

