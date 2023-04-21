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
            throw new Exception("SQL error occured: " . $err->getMessage());
        }
    }
    function delete_by_room_id($room_id)
    {
        $sql = "delete from rooms where room_id = " . $room_id;
        $result = $this->connection->query($sql);
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

    function get_room_name_by_room_id($id)
    {
        $query = "select room_name from rooms where room_id='".$id."'";
        if ($result = $this->connection->query($query)) {
            if ($result->num_rows >= 0) {
                return $result;
            }
        }
    }
}
