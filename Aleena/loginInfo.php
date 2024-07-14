<?php
    require_once ("../Sandhya/db/DBHelper.php");

    function login($email,$password)
    {      
        $pdo = new DBHelper();
        
        $query = "SELECT userID,Password from users where Email=:email";
            
            $stmt = $pdo->getConnection()->prepare($query);
            $stmt->execute(["email"=>$email]);   
            if($stmt->rowCount()==1)
            {
                $row=$stmt->fetch(PDO::FETCH_ASSOC);
                if(password_verify($password,$row["Password"]))
                {
                  // Start the session
                    session_start();

                    // Set the userID in the session variable
                    $_SESSION["userID"] = $row["userID"];
                
                    header("Location: ../Rajveer/index.php"); 
                    exit();
                }
                else 
                {
                    echo "Invalid password\n";
                    return false;
                }
            }
            else
            {
                return false;
            }
            return false;
        }

        function getRowCount(){ return $this->stmt->rowCount();}
    
?>
