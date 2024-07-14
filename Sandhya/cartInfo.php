<?php
require_once ("db/DBHelper.php");
class CartInfo
{
    protected $cartId;
    protected $userId;
    protected $bookId;
    protected $quantity;
    protected $bookTitle;
    protected $price;
    protected $imgUrl;

    // Static variable to hold the temporary cart items
    private static $tempCartItems = [];


    public function __construct($cartId, $userId, $bookId, $quantity, $bookTitle, $price, $imgUrl)
    {
        $this->cartId = $cartId;
        $this->userId = $userId;
        $this->bookId = $bookId;
        $this->quantity = $quantity;
        $this->bookTitle = $bookTitle;
        $this->price = $price;
        $this->imgUrl = $imgUrl;
    }

    // getter methods
    public function getCartId()
    {
        return $this->cartId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getBookId()
    {
        return $this->bookId;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getBookTitle()
    {
        return $this->bookTitle;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getImgUrl()
    {
        return $this->imgUrl;
    }

    // Method to add an item to the temp cart
    public static function addTempCartItem($item)
    {
        self::$tempCartItems[] = $item;
    }

    // Method to remove an item from the temp cart
    public static function removeTempCartItem($index)
    {
        if (isset(self::$tempCartItems[$index])) {
            unset(self::$tempCartItems[$index]);
        }
    }

    // Method to update the quantity of the specified item in the temp cart
    public static function updateTempCartQuantity($index, $newQuantity)
    {
        echo $index;
        if (isset(self::$tempCartItems[$index])) {

            // Update the quantity of the specified item
            self::$tempCartItems[$index]->quantity = $newQuantity;
        }


    }
    // Method to get all items in the temp cart
    public static function getTempCartItems()
    {
        return self::$tempCartItems;
    }

    // Method to retrieve cart information from database based on user id
    public static function getCartDetails($userId)
    {
        $pdo = new DBHelper();
        $query = "SELECT c.cartId, c.userId, c.bookId, c.quantity, b.bookTitle, b.price, b.imgUrl 
                    FROM cart c, books b WHERE c.bookId = b.bookId AND c.userId = :user";
        $stmt = $pdo->getConnection()->prepare($query);
        $stmt->execute(['user' => $userId]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

    //Method to update the quantity of cart item
    public static function updateCartQuantity($userId, $cartId, $quantity)
    {
        try {
            $pdo = new DBHelper();
            $query = "UPDATE cart SET quantity = :qty WHERE cartId = :cartID AND userId = :user";
            $stmt = $pdo->getConnection()->prepare($query);
            $stmt->execute(['qty' => $quantity, 'cartID' => $cartId, 'user' => $userId]);

            if ($stmt->rowCount()) {
                // Return success message 
                return "success";
            } else {
                // Return error message if no rows were affected
                return "Failed to update quantity. Cart item not found or quantity unchanged.";
            }
        } catch (PDOException $ex) {
            // Return error message if an exception occurs
            return "Error updating quantity: " . $ex->getMessage();
        }
    }

    //Method to delete the cart item
    public static function deleteCartItem($userId, $cartId)
    {
        try {
            $pdo = new DBHelper();
            $query = "DELETE FROM cart WHERE cartId = :cartID and  userId = :user";
            $stmt = $pdo->getConnection()->prepare($query);
            $stmt->execute(['cartID' => $cartId, 'user' => $userId]);
            if ($stmt->rowCount()) {
                // Return success message 
                return "success";
            } else {
                // Return error message if no rows deleted
                return "Failed to delete cart Item, cart item not found";
            }

        } catch (PDOException $ex) {
            // Return error message if an exception occurs
            return "Error updating quantity: " . $ex->getMessage();
        }

    }
    //Method to insert item to cart table
    public static function insertCartItem($userId, $bookId, $quantity)
    {
        try {
            $pdo = new DBHelper();
            $query = "INSERT INTO cart (userId, bookId, quantity) VALUES (:user, :bookId, :quantity)";
            $stmt = $pdo->getConnection()->prepare($query);
            $stmt->execute(['user' => $userId, 'bookId' => $bookId, 'quantity' => $quantity]);


            if ($stmt->rowCount() > 0) {
                // Return success message 
                return "success";
            } else {
                // Return error message if an exception occurs
                return "Failed to insert item to cart";
            }
        } catch (PDOException $ex) {
            // Return error message if an exception occurs        
            return "Error inserting item: " . $ex->getMessage();
        }
    }
    

}

