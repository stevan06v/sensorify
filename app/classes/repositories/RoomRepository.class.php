<?php
// require database class
require_once "./classes/repositories/Database.class.php";

class RoomRepository
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

    function insert($room, $user_id)
    {
        try {
            $sql = "INSERT INTO rooms (room_name, user_id, room_image) 
            VALUES ('" . $room->get_room_name() . "', '" . $user_id . "', '" . $room->get_room_image() . "' )";
            return mysqli_query($this->connection, $sql);
        } catch (mysqli_sql_exception $err) {
            throw new Exception("SQL error occurred: " . $err->getMessage());
        }
    }

    function update_user_id_by_room_id($user_id, $room_id)
    {
        $sql = "update rooms set user_id = '$user_id' where room_id=$room_id";
        $result = $this->connection->query($sql);
    }


    function update_room_image_by_room_id($room_id, $room_image)
    {
        $sql = "update rooms set room_image = '$room_image' where room_id=$room_id";
        $result = $this->connection->query($sql);
    }
    function update_room_name_by_room_id($room_name, $room_id)
    {
        $sql = "update rooms set room_name = '$room_name' where room_id=$room_id";
        $result = $this->connection->query($sql);
    }


    function delete_by_room_id($room_id)
    {
        $sql = "delete from rooms where room_id = " . $room_id;
        $result = $this->connection->query($sql);
    }
    function get_connection()
    {
        return $this->connection;
    }

    function getRooms()
    {
        $query = "select * from rooms";
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
    function get_room_image_path_by_room_id($room_id)
    {
        $sql = "select room_image from rooms where room_id = '$room_id'";
        try {
            $result = $this->connection->query($sql);
            if ($result->num_rows == 0) {
                throw new Exception("Room not found.");
            } else {
                $row = $result->fetch_assoc();
                return $row["room_image"];
            }
        } catch (mysqli_sql_exception $err) {
            throw new Exception("SQL error occurred: " . $err->getMessage());
        }
    }

    function get_room_id_path_by_room_name($room_name)
    {
        $sql = "select room_id from rooms where room_name = '$room_name'";
        try {
            $result = $this->connection->query($sql);
            if ($result->num_rows == 0) {
                throw new Exception("Room not found.");
            } else {
                $row = $result->fetch_assoc();
                return $row["room_id"];
            }
        } catch (mysqli_sql_exception $err) {
            throw new Exception("SQL error occurred: " . $err->getMessage());
        }
    }
    function get_user_id_by_room_id($room_id)
    {
        $sql = "select user_id from rooms where room_id = '$room_id'";
        try {
            $result = $this->connection->query($sql);
            if ($result->num_rows == 0) {
                throw new Exception("Room not found.");
            } else {
                $row = $result->fetch_assoc();
                return $row["user_id"];
            }
        } catch (mysqli_sql_exception $err) {
            throw new Exception("SQL error occurred: " . $err->getMessage());
        }
    }

    function get_room_id_by_user_id($user_id)
    {
        $sql = "select room_id from rooms where user_id = '$user_id'";
        try {
            $result = $this->connection->query($sql);
            if ($result->num_rows == 0) {
                throw new Exception("Room not found.");
            } else {
                $row = $result->fetch_assoc();
                return $row["room_id"];
            }
        } catch (mysqli_sql_exception $err) {
            throw new Exception("SQL error occurred: " . $err->getMessage());
        }
    }

    function get_current_room_id()
    {
        $query = "SELECT MAX(room_id) as room_id FROM rooms";
        try {
            $result = $this->connection->query($query);
            if ($result->num_rows == 0) {
                throw new Exception("Room not found.");
            } else {
                $row = $result->fetch_assoc();
                return $row["room_id"];
            }
        } catch (mysqli_sql_exception $err) {
            throw new Exception("SQL error occurred: " . $err->getMessage());
        }
    }
}
