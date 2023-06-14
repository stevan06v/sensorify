<?php
// require database class
require_once "./classes/repositories/Database.class.php";

class DeviceRepository
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
    
    function get_devices()
    {
        $query = "select * from devices";
        if ($result = $this->connection->query($query)) {
            if ($result->num_rows >= 0) {
                return $result;
            }
        }
    }

    function delete_device($device_id)
    {
        $query = "delete from devices where device_id = " .$device_id;
        if ($result = $this->connection->query($query)) {
                return $result;
        }
    }

    function insert($ip_address, $room_id, $type, $name)
    {
        try {
            $sql = "INSERT INTO devices (ip_address, room_id, device_type, device_name) values ('". $ip_address."','". $room_id."','". $type."','". $name."')";
            return mysqli_query($this->connection, $sql);
        } catch (mysqli_sql_exception $err) {
            echo $err->getMessage();
            throw new Exception("SQL error occurred: " . $err->getMessage());
        }
    }
}