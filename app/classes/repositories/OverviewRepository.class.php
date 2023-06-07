<?php
// require database class
require_once "./classes/repositories/Database.class.php";

class OverviewRepository
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


    function get_user_overview()
    {
        $query = "select image_dest from users";
        if ($result = $this->connection->query($query)) {
            if ($result->num_rows >= 0) {
                return $result;
            }
        }
    }
    function count_users(){
        $query = "select count(*) as count from users";
        if ($result = $this->connection->query($query)) {
            if ($result->num_rows >= 0) {
                return $result;
            }
        } 
    }
    function count_rooms($user_id){
        $query = "select count(*) as count from rooms where user_id=". $user_id;
        if ($result = $this->connection->query($query)) {
            if ($result->num_rows >= 0) {
                return $result;
            }
        } 
    }

    function get_current_address($user_id){
        $query = "select city, country, street, zip_code, house_number from users where user_id = ". $user_id;
        if ($result = $this->connection->query($query)) {
            if ($result->num_rows >= 0) {
                return $result;
            }
        }
    }

    function get_rooms_by_user_id($user_id)
    {
        $query = "select room_name, room_id from rooms where user_id= $user_id";
        if ($result = $this->connection->query($query)) {
            if ($result->num_rows >= 0) {
                return $result;
            }
        }
    }



    function get_room_name_by_room_id($room_id)
    {
        $query = "select room_name from rooms where room_id='" . $room_id . "'";
        try {
            $result = $this->connection->query($query);
            if ($result->num_rows == 0) {
                throw new Exception("Room not found.");
            } else {
                $row = $result->fetch_assoc();
                return $row["room_name"];
            }
        } catch (mysqli_sql_exception $err) {
            throw new Exception("SQL error occurred: " . $err->getMessage());
        }
    }
}
