<?php

// require database class
require_once "./classes/repositories/Database.class.php";

class UserRepository
{
    private $connection;

    function __construct()
    {
        $database = new Database();
        try {
            $this->connection = $database->getDataSource();
        } catch (mysqli_sql_exception $err) {
            echo $err;  
            exit;
        }
    }
    function insert($user)
    {
        try {
            $sql = "INSERT INTO users (name, lastname, user_name, email, password, image_dest) 
            VALUES ('" . $user->getName() . "', '" . $user->getLastname() . "', '" . $user->getUsername() . "', '" . $user->getEmail() . "', '" . $user->getPassword() . "', '" . $user->getImageDest() . "')";
            return mysqli_query($this->connection, $sql);
        } catch (mysqli_sql_exception $err) {
            throw new Exception("SQL error occured: " . $err->getMessage());
        }
    }

    function existsUser($email, $password)
    {
        try {
            $sql = "SELECT * FROM users WHERE password = '" . $password . "' AND email = '" . $email . "'";

            $result = $this->connection->query($sql);

            if ($result->num_rows == 1) {
                return true;
            } else {
                return false;
            }
        } catch (mysqli_sql_exception $err) {
            throw new Exception("Error while checking data...: " . $err);
        }
    }
    function exitsUsername($username)
    {
        global $modal_sender;
        $sql = "select * from users where user_name = '$username'";
        try {
            $result = $this->connection->query($sql);
            if ($result->num_rows == 0) {
                return false;
            } else {
                $_SESSION['username_err'] = $username;
                return true;
            }
        } catch (mysqli_sql_exception $err) {
            $modal_sender->triggerModal("Database-error", "Lost connection to the database!");
        }
    }

    function exitsEmail($email)
    {
        $sql = "select * from users where email = '$email'";
        try {
            $result = $this->connection->query($sql);
            if ($result->num_rows == 0) {
                return false;
            } else {
                $_SESSION['email_err'] = $email;
                return true;
            }
        } catch (mysqli_sql_exception $err) {
            throw new Exception("SQL error occured: " . $err->getMessage());
        }
    }

    function getImageSrcByUserName($username)
    {
        $sql = "select image_dest from users where user_name = '$username'";
        try {
            $result = $this->connection->query($sql);
            if ($result->num_rows == 0) {
                throw new Exception("User not found.");
            } else {
                $row = $result->fetch_assoc();
                return $row["image_dest"];
            }
        } catch (mysqli_sql_exception $err) {
            throw new Exception("SQL error occured: " . $err->getMessage());
        }
    }

    function getUserNameByEmail($email)
    {
        $sql = "select user_name from users where email= '$email'";
        try {
            $result = $this->connection->query($sql);
            if ($result->num_rows == 0) {
                throw new Exception("User not found.");
            } else {
                $row = $result->fetch_assoc();
                return $row["user_name"];
            }
        } catch (mysqli_sql_exception $err) {
            throw new Exception("SQL error occured: " . $err->getMessage());
        }
    }

    function getUserIDbyName($name)
    {
        $sql = "select user_id from users where user_name= '$name'";
           $result = $this->connection->query($sql);
            if ($result->num_rows == 0) {
                return "user not found";
            } else {
                $row = $result->fetch_assoc();
                return $row["user_id"];
            }
    }


    //getters & setters
    function getConnection()
    {
        return $this->connection;
    }
}
