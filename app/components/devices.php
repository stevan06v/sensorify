<style>
    .room-flex {
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: black;
        margin: auto;
        gap: 2vw;
    }

    .sensor-creator {
        width: auto;
        box-shadow: -2px -1px 25px -10px rgba(0, 0, 0, 0.75);
        padding: 2.5vw;
        display: block;
        justify-content: center;
        border-radius: 15px;
        max-width: 500px;
    }

    .device-input {
        margin-bottom: 1vh;
        color: #1a8766;
        border: 2px solid #1a876667;
        font-size: 15px;
        padding: .5vw;
        border-radius: 5px;
        outline: none;
        font-family: BoldItalic;
        color: black;
    }

    .sub-page-header {
        text-align: center;
    }

    select {
        font-size: 15px;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        width: auto;
        outline: none;
        margin-bottom: 1vh;

    }

    .sub-page-header {
        margin-bottom: 2vh;
    }

    form {
        display: grid;
        justify-content: center;
    }

    #submit {
        margin: auto;
    }

    .device-box {
        font-family: BoldItalic;
        text-align: center;
        padding: 0.5vh 1vw 0.5vh 1vw;
        border-radius: 10px;
        box-shadow: -2px -1px 15px -10px rgba(0, 0, 0, 0.75);
    }

    .device-name{
        margin-top: 2vh;
        margin-bottom: 2vh;
    } 

    #device-grid {
        display: grid;
        grid-template-columns: auto auto auto;
        gap: 1vw;
    }

</style>
<?php
require_once "./classes/repositories/RoomRepository.class.php";
require_once "./classes/repositories/UserRepository.class.php";
require_once "./classes/repositories/RoomAccessRepository.class.php";
require_once "./classes/repositories/DeviceRepository.class.php";
$room_repo = new RoomRepository();
$room_access_repo = new RoomAccessRepository();
$user_repo = new UserRepository();
$device_repo = new DeviceRepository();

?>

<div class="room-flex">
    <div class="sub-page-box">

        <?php
        if (isset($_POST['add'])) {
            if (
                !empty($_POST['device-name']) &&
                !empty($_POST['device-ip']) &&
                !empty($_POST['type-selection']) &&
                !empty($_POST['room-selection'])
            ) {

                $device_repo->insert($_POST['device-ip'], $_POST['room-selection'], $_POST['type-selection'], $_POST['device-name']);
                $modal_sender->triggerNotification(strtoupper($_POST['type-selection']) . " successfully added!");
            } else {
                $modal_sender->triggerModal("Device error", "Empty fields!");
            }
        }

        ?>

        <div id="device-grid">
            <?php
            $devices = $device_repo->get_devices();

            while ($row = $devices->fetch_assoc()) {
                $ip_address = $row['ip_address'];
                echo '<div class="device-box">';
                    echo "<div class='device-name'>" . $row['device_name'] . "</div>";
                    include("./components/devices/plantify/" . $row["device_type"] . ".php");
                    echo "<div class='device-name'>" . $room_repo->get_room_name_by_room_id($row['room_id']) . "</div>";

                echo '</div>';
            }

            ?>
        </div>

    </div>

    <div class="sensor-creator">
        <div class="sub-page-header">Smart device</div>
        <form action="./home.php?content=devices" method="post" enctype="multipart/form-data">

            <input type="text" name="device-name" class="device-input" placeholder="Device name">
            <input type="text" name="device-ip" class="device-input" placeholder="IP-address">
            <select name="type-selection" id="type">

                <?php
                $device_types = array("dht11", "humidity", "moisture", "temperature", "plantify");
                foreach ($device_types as $iterator) {
                    echo '<option value="' . $iterator . '">' . $iterator . '</option>';
                }
                ?>
            </select>
            <select name="room-selection" id="room">

                <?php
                $user_id = $user_repo->getUserIDbyName($_SESSION['username']);
                $rooms = $room_repo->getRooms();

                while ($row = $rooms->fetch_assoc()) {
                    if ($room_access_repo->hasAccess($row['room_id'], $user_id)) {
                        echo '<option value="' . $row['room_id'] . '">' . $room_repo->get_room_name_by_room_id($row['room_id']) . '</option>';
                    }
                }
                ?>

            </select>
            <input type="submit" name="add" id="submit" value="add">
        </form>
    </div>
</div>

</div>