<?php
    
    class DBHelper
    {
         const DB_USER = "root";
    const DB_PASSWORD = "Tushitha2514";
    const DB_HOST = "127.0.0.1";
    const DB_NAME = "comicdb";
    const CHARSET = "utf8mb4";
        
        static protected  $PDO_connection = null;
        
        static function initializeDatabase()
        {
            try
            {
                $data_source_name = "mysql:host=".self::DB_HOST.";charset=".self::CHARSET;
                $pdo = new PDO($data_source_name,self::DB_USER,self::DB_PASSWORD);
                $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                
                $pdo->query("drop database if exists comicdb");
                $pdo->query("create database comicdb");
                
                $pdo->query("use comicdb");

                //table country
                $pdo->query("CREATE TABLE country (
                    countryId INT UNSIGNED NOT NULL AUTO_INCREMENT,
                    countryName VARCHAR(255) NOT NULL,
                    countryCode CHAR(2) NOT NULL,
                    PRIMARY KEY (countryId)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
                ");
                //table province
                $pdo->query("CREATE TABLE provinces (
                    provinceId INT UNSIGNED NOT NULL AUTO_INCREMENT,
                    provinceName VARCHAR(255) NOT NULL,
                    provinceCode CHAR(2) NOT NULL,
                    countryId INT UNSIGNED NOT NULL,
                    PRIMARY KEY (provinceId),
                    FOREIGN KEY (countryId) REFERENCES country(countryId)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
                ");
                //table author
                $pdo->query("CREATE TABLE authors (
                    authorId INT UNSIGNED NOT NULL AUTO_INCREMENT,
                    authorName VARCHAR(255) NOT NULL,
                    shortDesc TEXT,
                    PRIMARY KEY (authorId)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
                ");
                //table publishers
                $pdo->query("CREATE TABLE publishers (
                    publisherId INT UNSIGNED NOT NULL AUTO_INCREMENT,
                    publisherName VARCHAR(255) NOT NULL,
                    PRIMARY KEY (publisherId)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
                ");
                //table category
                $pdo->query("CREATE TABLE categories (
                    categoryId INT UNSIGNED NOT NULL AUTO_INCREMENT,
                    categoryName VARCHAR(255) NOT NULL,
                    PRIMARY KEY (categoryId)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;                
                ");
                //table books
                $pdo->query("CREATE TABLE books (
                    bookId INT UNSIGNED NOT NULL AUTO_INCREMENT,
                    bookTitle VARCHAR(255) NOT NULL,
                    availableQty INT UNSIGNED NOT NULL,
                    shortDesc TEXT,
                    categoryId INT UNSIGNED NOT NULL,
                    authorId INT UNSIGNED NOT NULL,
                    publishedDate DATE,
                    publisherId INT UNSIGNED,
                    price DECIMAL(10,2) NOT NULL,
                    imgUrl VARCHAR(255),
                    PRIMARY KEY (bookId),
                    FOREIGN KEY (categoryId) REFERENCES categories(categoryId),
                    FOREIGN KEY (authorId) REFERENCES authors(authorId),
                    FOREIGN KEY (publisherId) REFERENCES publishers(publisherId)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
                ");                
                //table users
                $pdo->query("CREATE TABLE users (
                    userID INT UNSIGNED NOT NULL AUTO_INCREMENT,
                    FirstName VARCHAR(255) NOT NULL,
                    LastName VARCHAR(255) NOT NULL,
                    Email VARCHAR(255) NOT NULL,
                    DOB DATE,
                    Password VARCHAR(255) NOT NULL,
                    Phone VARCHAR(20),
                    addr1 VARCHAR(255),
                    city VARCHAR(255),
                    provinceId INT UNSIGNED,
                    postalCode VARCHAR(20),
                    PRIMARY KEY (userID),
                    FOREIGN KEY (provinceId) REFERENCES provinces(provinceId)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
                ");                
                //table cart
                $pdo->query("CREATE TABLE cart (
                    cartId INT UNSIGNED NOT NULL AUTO_INCREMENT,
                    userId INT UNSIGNED NOT NULL,
                    bookId INT UNSIGNED NOT NULL,
                    quantity INT UNSIGNED NOT NULL,
                    PRIMARY KEY (cartId),
                    FOREIGN KEY (userId) REFERENCES users(userID),
                    FOREIGN KEY (bookId) REFERENCES books(bookId)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
                ");
                //table orders
                $pdo->query("CREATE TABLE orders (
                    orderId INT UNSIGNED NOT NULL AUTO_INCREMENT,
                    bookId INT UNSIGNED NOT NULL,
                    quantity INT UNSIGNED NOT NULL,
                    userId INT UNSIGNED NOT NULL,
                    PRIMARY KEY (orderId),
                    FOREIGN KEY (bookId) REFERENCES books(bookId),
                    FOREIGN KEY (userId) REFERENCES users(userID)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
                ");
                //table payment
                $pdo->query("CREATE TABLE payment (
                    paymentId INT UNSIGNED NOT NULL AUTO_INCREMENT,
                    orderId INT UNSIGNED NOT NULL,
                    amount DECIMAL(10,2) NOT NULL,
                    payment_type VARCHAR(50) NOT NULL,
                    status VARCHAR(50) NOT NULL,
                    PRIMARY KEY (paymentId),
                    FOREIGN KEY (orderId) REFERENCES orders(orderId)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
                ");
                               
                
                //insert basic table data
                $pdo->query("INSERT INTO country (countryName, countryCode)
                            VALUES
                             ('United States', 'US'),
                             ('Canada', 'CA'),
                             ('Australia', 'AU');
                ");
                $pdo->query("INSERT INTO provinces (provinceName, provinceCode, countryId)
                            VALUES
                                ('Alberta', 'AB', (SELECT countryId FROM country WHERE countryCode = 'CA')),
                                ('British Columbia', 'BC', (SELECT countryId FROM country WHERE countryCode = 'CA')),
                                ('Manitoba', 'MB', (SELECT countryId FROM country WHERE countryCode = 'CA')),
                                ('New Brunswick', 'NB', (SELECT countryId FROM country WHERE countryCode = 'CA')),
                                ('Nova Scotia', 'NS', (SELECT countryId FROM country WHERE countryCode = 'CA')),
                                ('Ontario', 'ON', (SELECT countryId FROM country WHERE countryCode = 'CA')),
                                ('Quebec', 'QC', (SELECT countryId FROM country WHERE countryCode = 'CA')),
                                ('Saskatchewan', 'SK', (SELECT countryId FROM country WHERE countryCode = 'CA'));
                ");
                $pdo->query("INSERT INTO publishers (publisherName) 
                            VALUES
                                ('Marvel Comics'),
                                ('DC Comics'),
                                ('Image Comics'),
                                ('Dark Horse Comics'),
                                ('IDW Publishing');
                ");
                $pdo->query("INSERT INTO authors (authorName, shortDesc) 
                            VALUES
                                ('Stan Lee', 'Co-creator of many Marvel Comics characters.'),
                                ('Jack Kirby', 'Co-creator of many Marvel Comics characters.'),
                                ('Alan Moore', 'Known for works like Watchmen and V for Vendetta.'),
                                ('Frank Miller', 'Known for works like Batman: The Dark Knight Returns and Sin City.'),
                                ('Neil Gaiman', 'Known for works like Sandman and The Sandman Universe.'),
               					('Mari Bolte', 'Authored dozen of books for newly independent readers.'),
                                ('Bob Montana', 'known as the creator of the characters from Archie Comics.');
                ");
                $pdo->query("INSERT INTO categories (categoryName) VALUES 
                                ('Superheroes'),
                                ('Fantasy'),
                                ('Science Fiction'),
                                ('Mystery'),
                                ('Webcomics');
                ");
                $pdo->query("INSERT INTO books (bookTitle, availableQty, shortDesc, categoryId, authorId, publishedDate, publisherId, price, imgUrl) 
                            VALUES
                                ('Spider-Man', 100, 'The adventures of Spider-Man.', 1, 1, '2023-01-15', 1, 12.99, 'spiderman_vol1.jpg'),
                                ('Batman', 75, 'A graphic novel by Frank Miller.', 2, 4, '1986-05-01', 2, 14.99, 'dark_knight_returns.jpg'),
                                ('Watchmen', 50, 'A graphic novel by Alan Moore.', 3, 3, '1987-09-01', 2, 16.99, 'watchmen.jpg'),
                                ('Sandman ', 80, 'A graphic novel by Neil Gaiman.', 4, 5, '1989-01-01', 5, 18.99, 'sandman_preludes.jpg'),
              					('Cindrella', 100, 'A graphic novel by Mari Bolte.', 1, 6, '2023-01-15', 1, 22.99, 'cindrella.jpeg'),
								('Archie', 80, 'A graphic novel by Bob Montana.', 1, 7, '2023-01-15', 1, 12.99, 'archie.jpeg');
                ");
            }
            catch(PDOException $e)
            {
                echo "Connection failed: ".$e->getMessage();
            }
        }
        
        function __construct()
        {
            if(self::$PDO_connection == null)
            {
                try
                {
                    $data_source_name = "mysql:host=".self::DB_HOST.";dbname=".self::DB_NAME.";charset=".self::CHARSET;
                    self::$PDO_connection = new PDO($data_source_name,self::DB_USER,self::DB_PASSWORD);
                    self::$PDO_connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                }
                catch(PDOException $e)
                {
                    echo "Connection failed: ".$e->getMessage();
                }
                
            }
        }
        
        function getConnection()
        {
            return self::$PDO_connection;
        }
         static function getProvinces()
         {
            try
            {
                $pdo = self::$PDO_connection;
                $query = "SELECT provinceId, provinceName FROM provinces ";
                $statement = $pdo->query($query);
                $provinces = $statement->fetchAll(PDO::FETCH_ASSOC);
                return $provinces;
            }
            catch(PDOException $e)
            {
                echo "Error fetching provinces: ".$e->getMessage();
                return [];
            }
        }
    }
?>
