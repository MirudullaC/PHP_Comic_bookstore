<?php

// Include the DBHelper class if not already included
require_once ("../Sandhya/db/DBHelper.php");


class Product
{
    private $id;
    private $imgUrl;
    private $bookTitle;
    private $price;
    private $description; // New property for product details page

    // Constructor
    public function __construct($id, $imgUrl, $bookTitle, $price, $description = null)
    {
        $this->id = $id;
        $this->imgUrl = $imgUrl;
        $this->bookTitle = $bookTitle;
        $this->price = $price;
        $this->description = $description;
    }

    // Getter methods
    public function getId()
    {
        return $this->id;
    }

    public function getImgUrl()
    {
        return $this->imgUrl;
    }

    public function getBookTitle()
    {
        return $this->bookTitle;
    }

    public function getPrice()
    {
        return $this->price;
    }
    // Getter method for description
    public function getDescription()
    {
        return $this->description;
    }

    // Method to retrieve all products from the database (for product page)
    public static function getAllProducts()
    {
        $pdo = new DBHelper();
        $query = "SELECT bookId, imgUrl, bookTitle, price FROM books";
        $stmt = $pdo->getConnection()->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $products = [];
        foreach ($result as $row) {
            $product = new Product(
                $row['bookId'],
                $row['imgUrl'],
                $row['bookTitle'],
                $row['price']
            );
            $products[] = $product;
        }
        return $products;
    }

    // Method to get product details from the database (for product details page)
    public static function getProductDetails($productId)
    {
        $pdo = new DBHelper();
        $query = "SELECT bookId, imgUrl, bookTitle, price, shortDesc FROM books WHERE bookId = :id";
        $stmt = $pdo->getConnection()->prepare($query);
        $stmt->execute(['id' => $productId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $product = new Product(
                $result['bookId'],
                $result['imgUrl'],
                $result['bookTitle'],
                $result['price'],
                $result['shortDesc']
            );
            return $product;
        } else {
            return null; // Product not found
        }
    }
    public static function getProductsByCategory($categoryId)
    {
        $pdo = new DBHelper();
        $query = "SELECT * FROM books WHERE categoryId = :categoryId";
        $stmt = $pdo->getConnection()->prepare($query);
        $stmt->execute(['categoryId' => $categoryId]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $products = [];
        foreach ($result as $row) {
            $product = new Product(
                $row['bookId'],
                $row['imgUrl'],
                $row['bookTitle'],
                $row['price'],
                $row['category_id']
            );
            $products[] = $product;
        }
        return $products;
    }
}


?>
