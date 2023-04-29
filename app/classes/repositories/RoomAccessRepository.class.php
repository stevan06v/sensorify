
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
            throw new Exception("SQL error occured: " . $err->getMessage());
        }
    }

    function hasAccess($room_id, $user_id)
    {
        $query = "select room_id from rooms_access where user_id = $user_id";
        $acessable_rooms = array();
        if ($result = $this->connection->query($query)) {
            if ($result->num_rows >= 0) {
                while ($row = $result->fetch_assoc()) {
                    array_push($acessable_rooms, $row['room_id']);
                }
            }
        }
        return in_array($room_id, $acessable_rooms);
    }
}
?>
