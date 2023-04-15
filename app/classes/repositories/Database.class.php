<?php
class Database
{
    //sensorify.ddns.net
    private static $dbserver = "localhost";
    private static $dbname = "sensorifydb";
    private static $dbusername = "stevan";
    private static $dbpassword = "Stevan2006";

    function getDataSource()
    {
        //self refers to static properties in the class 
        $connection = new mysqli(self::$dbserver, self::$dbusername, self::$dbpassword, self::$dbname);
        if ($connection->connect_error) {
            echo '
            <script>
                window.addEventListener("load", function () {
                    PopupEngine.createModal({
                        heading: "Database error",
                        text: "Connection lost",
                        buttons: [
                            {
                                text: "continue",
                                closePopup: true
                            }
                        ]
                    })
                })
            </script>';
        }else{
            return $connection;
        }
    }
    function isReachable()
    {
        if (mysqli_ping($this->getDataSource())) {
            return true;
        } else {
            return false;
        }
    }
}
