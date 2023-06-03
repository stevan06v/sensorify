
<?php
class RoomAccessRepository
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

    function insert($room_id, $user_id)
    {
        try {
            $sql = "INSERT INTO rooms_access (room_id, user_id) 
            VALUES ($room_id, $user_id)";

            return mysqli_query($this->connection, $sql);
        } catch (mysqli_sql_exception $err) {
            echo $err->getMessage();
            throw new Exception("SQL error occurred: " . $err->getMessage());
        }
    }

    function check_participant_count(){

    }

    function revoke_room_access($room_id, $user_id)
    {
        try {
            $sql = "DELETE FROM rooms_access where room_id = $room_id && user_id = $user_id";
            return mysqli_query($this->connection, $sql);
        } catch (mysqli_sql_exception $err) {
            throw new Exception("SQL error occurred: " . $err->getMessage());
        }
    }


    function get_room_participants($room_id)
    {
        $query = "select user_id from rooms_access where room_id = " . $room_id;
        if ($result = $this->connection->query($query)) {
            if ($result->num_rows >= 0) {
                return $result;
            }
        }
    }

    function hasAccess($room_id, $user_id)
    {
        $query = "select room_id from rooms_access where user_id = $user_id";
        $accessible_rooms = array();
        if ($result = $this->connection->query($query)) {
            if ($result->num_rows >= 0) {
                while ($row = $result->fetch_assoc()) {
                    array_push($accessible_rooms, $row['room_id']);
                }
            }
        }
        return in_array($room_id, $accessible_rooms);
    }

    function updateAccess($user_id,  $room_id){
        $query = "update rooms_access set user_id = $user_id where room_id = $room_id and user_id = $user_id";
        $result = $this->connection->query($query);
    }
}
?>
