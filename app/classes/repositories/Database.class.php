
<?php
class Database
{
    private static $dbserver = "sensorify.ddns.net";
    private static $dbname = "sensorifydb";
    private static $dbusername = "stevan";
    private static $dbpassword = "Stevan2006";
    function getDataSource()
    {
        try {
            //self refers to static properties in the class 
            $connection = new mysqli(self::$dbserver, self::$dbusername, self::$dbpassword, self::$dbname);
            return $connection;
        } catch (mysqli_sql_exception $error) {
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
