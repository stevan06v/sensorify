<style>
    #room-flex {
        display: flex;
        margin: auto;
        gap: 3vw;
        align-items: center;
    }

    #room-block {
        display: grid;
        grid-template-columns: auto;
        justify-content: center;
        margin: auto;
    }

    .room-creator {
        width: auto;
        box-shadow: -2px -1px 25px -10px rgba(0, 0, 0, 0.75);
        padding: 2.5vw;
        border-radius: 15px;
        max-width: 500px;
    }

    .sub-page-header {
        margin-bottom: 1vw;
        text-align: center;
    }

    .sub-page-box {
        height: auto;
        max-height: 60vh;

    }


    .file_image {
        cursor: pointer;
        width: 100%;
        height: 8vw;
        border: #1a876698 5px solid;
        opacity: 0.4;
        box-shadow: -2px -1px 15px -10px rgba(0, 0, 0, 0.75);
        -webkit-user-drag: none;
        border-radius: 5px;
    }

    .input {
        margin-top: 1vw;
        width: 100%;
        margin: auto;
        padding-left: 0;
        padding-right: 0;
        padding-top: 1vh;
        padding-bottom: 1vh;
    }

    #submit {
        margin-top: 1vw;
        width: 100%;
    }

    #image-selector {
        display: flex;
        justify-content: center;
        margin-bottom: 1vw;
    }

    #rooms {
        display: grid;
        grid-template-columns: auto auto;
        gap: 1vw;
    }

    .room_image_box {
        cursor: pointer;
        display: block;
        width: 15vw;
        height: 8vw;
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px
    }

    .room_image {
        display: block;
        margin: auto;
        width: 100%;
        height: 10vw;
    }

    .room {
        border-radius: 15px;
    }

    .room_name {
        font-size: 1.2rem;
        color: black;
        font-family: ExtraBold;
    }

    .submit {
        width: auto;
        padding: 0.5vw;
        display: block;
        font-size: 0.8rem;
        font-family: ExtraBold;
        text-align: center;
        cursor: pointer;
        color: white;
        border-radius: 5px;
        background-color: #1a8766;
        border: none;
        margin: auto;
        box-shadow: -2px -1px 20px -10px rgba(0, 0, 0, 0.75);
    }

    .room-flex {
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: black;
        gap: 2vw;
    }

    .creation_date {
        font-family: BoldItalic;
        color: black;
    }

    #room_thumbmail {
        display: block;
        width: 40vw;
        height: 15rem;
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;
        border-radius: 5px;
    }

    /* Style for label */
    label {
        font-size: 16px;
        font-weight: bold;
    }

    /* Style for select box */
    select {
        font-size: 14px;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        width: 200px;
    }

    /* Style for option */
    option {
        font-size: 14px;
        padding: 8px;
    }

    #room-name-input {
        padding: 6px;
        outline: none;
        color: #1a8766;
        font-family: BoldItalic;
        font-size: 14px;
        display: block;
        text-align: left;
        border-radius: 5px;
        width: 16vw;

        transition: ease width .4s;
        border: 1px solid #1a876667;
        color: #000000;
        cursor: pointer;
        background-color: rgb(255, 255, 255);
        box-shadow: 0px 0px 1px 0px rgba(0, 0, 0, 0.52);

    }

    .room-form-flex {
        display: flex;
        justify-content: center;
        gap: 1.5vw;
    }
</style>

<?php
require_once "./classes/model/Room.class.php";
require_once "./classes/repositories/RoomRepository.class.php";
require_once "./classes/repositories/UserRepository.class.php";
require_once "./classes/repositories/RoomAccessRepository.class.php";
require_once "./classes/ImageUploader.class.php";
require_once "./classes/ModalSender.class.php";


$dir = "./upload/rooms/";
$image_uploader = new ImageUploader($dir);
$user_repo = new UserRepository();
$modal_sender = new ModalSender();
$room_repo = new RoomRepository();
$room_access_repo = new RoomAccessRepository();

$rooms = array();
$user_id = $user_repo->getUserIDbyName($_SESSION['username']);
?>
<script>
    // load imageinto page
    function displayRoomThumbmail(e) {
        if (e.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.querySelector("#room_thumbmail")
                    .style
                    .backgroundImage = "url('" + e.target.result + "')";

                document.getElementById("room_thumbmail")
                    .style
                    .opacity = "1";
            };
            reader.readAsDataURL(e.files[0]);
            simulateClickRoom();
        }
    }

    function simulateClickRoom() {
        let button = document.getElementById("change-room-image");
        console.log("click");
        button.click();
    }

    // load imageinto page
    function displayProfileImage(e) {
        if (e.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document
                    .querySelector("#profile_image")
                    .setAttribute("src", e.target.result);
                document.getElementById("profile_image").style.opacity = "1";
            };
            reader.readAsDataURL(e.files[0]);
            simulateClick();
        }
    }

    function simulateClick() {
        let button = document.getElementById("submit-room");
        console.log("click");
        button.click();
    }
</script>

<?php

isset($_GET['show']) && $room_access_repo->hasAccess($_GET['show'], $user_id) ? $style = "room-block" : $style = "room-flex";
echo '<div id="' . $style . '">';
?>
<div class="sub-page-box">
    <h3 class="sub-page-header" style="text-align: left;">
        <?php
        isset($_GET['show']) && $room_access_repo->hasAccess($_GET['show'], $user_id) ? $title = $room_repo->get_room_name_by_room_id($_GET['show']) : $title = "Manage the rooms: ";
        echo $title;
        ?>
    </h3>

    <?php
    isset($_GET['show']) && $room_access_repo->hasAccess($_GET['show'], $user_id) ? $id = "rooms-no-grid" : $id = "rooms";
    echo '<div id="' . $id . '">';

    ?>

    <?php
    if (isset($_GET['delete'])) {
        $room_id = $_GET['delete'];
        if ($room_access_repo->hasAccess($_GET['delete'], $user_id)) {

            try {
                $img_path = $room_repo->get_room_image_path_by_room_id($room_id);
                if (file_exists($img_path)) {
                    unlink($img_path);
                }
                $room_repo->delete_by_room_id($room_id);
                $modal_sender->triggerNotification("Room got successfully deleted.");
            } catch (Exception $err) {
                $modal_sender->triggerModal("Room error", "Error while deleting room.");
            }
        } else {
            $modal_sender->triggerModal("Room error", "You can not delete the room. You do not have permissions.");
        }
    }

    if (isset($_POST['submit'])) {
        $room_name = $_POST['room-name'];
        $file_dest = $image_uploader->upload(680, 500);

        $room = new Room($room_name, $user_id, $file_dest);

        if (!empty($room->get_room_name()) && !empty($room->get_room_image())) {
            try {
                $room_repo->insert($room, $user_id);

                $room_id = $room_repo->get_current_room_id();

                # user who created room --> can access it 
                $room_access_repo->insert($room_id, $user_id);

                $modal_sender->triggerNotification("Room added successully.");
            } catch (Exception $err) {
                $modal_sender->triggerModal("Room error", "Error occured while adding room.");
            }
        } else {
            $modal_sender->triggerModal("Room error", "Empty fields.");
        }
    }

    if (isset($_GET['show'])) {
        if ($room_access_repo->hasAccess($_GET['show'], $user_id)) {
            if (isset($_POST['change-room-image'])) {
                try {

                    $old_img_path = $room_repo->get_room_image_path_by_room_id($_GET['show']);

                    # delete old image 
                    if (file_exists($old_img_path)) {
                        unlink($old_img_path);
                    }

                    $file_dest = $image_uploader->upload(800, 800);

                    $room_repo->update_room_image_by_room_id($_GET['show'], $file_dest);

                    $modal_sender->triggerNotification("Image got successfully updated");
                } catch (Exception $err) {
                    $modal_sender->triggerModal("Room error", "Image could not be updated.");
                }
            }

            if (isset($_POST['modify-room'])) {
                $room_name = $_POST['room-name'];
                $selection = $_POST['admin-selection'];

                try {
                    $room_repo->update_user_id_by_room_id($selection, $_GET['show']);
                    $room_repo->update_room_name_by_room_id($room_name, $_GET['show']);

                    $room_access_repo->updateAcess($selection, $_GET['show']);

                    $modal_sender->triggerNotification("Room got sucessfully updated");

                    $curr_user_id = $user_repo->getUserIDbyName($_SESSION['username']);

                    if($selection != $curr_user_id){
                        header("Location: ./home.php?content=rooms");
                        echo '
                        <script>
                        document.getElementsByTagName("body")[0].style.display = "none";
                            setTimeout(function() {
                                window.location.href = window.location.href;
                            }, 10);        
                        </script>
                    ';
                    }

                } catch (Exception $err) {
                    $modal_sender->triggerModal("Room error", "Update failed");
                }
            }

            $image_path = $room_repo->get_room_image_path_by_room_id($_GET['show']);


            echo '
            <form action="./home.php?content=rooms&show=' . $_GET['show'] . '" method="post" enctype="multipart/form-data">
                        <div id="image-selector"> 
                            <div id="room_thumbmail" style="cursor:pointer; background-image:url(\'' . $image_path . '\');" onclick="triggerClick()"></div>
                            <label for="fileimage"></label>
                            <input onchange="displayRoomThumbmail(this)" id="fileimage" type="file" name="file" accept="image/png, image/jpg, image/svg, image/jpeg"/> 
                        </div>
                    <input type="submit" id="change-room-image" name="change-room-image" style="display:none;" value="send">
                </form>
        ';

            echo '
                    <div id="room_show_flex">
                        <form action="./home.php?content=rooms&show=' . $_GET['show'] . '" method="post">
                        
                        <div class="room-form-flex">
                        <div>    
                            <label style="font-family:ExtraBold; color:black; font-size:1.2rem;" for="admin-selection">Room owner:</label>
                            <select name="admin-selection" id="country">
                ';

            $table = 'users';
            $query = "select * from $table";


            $curr_room_owner_id = $room_repo->get_user_id_by_room_id($_GET['show']);
            $curr_room_user_name = $user_repo->getUserNamebyId($curr_room_owner_id);

            echo '<option value="' .  $curr_room_owner_id . '">' . $curr_room_user_name . '</option>';
            if ($result = $room_repo->get_connection()->query($query)) {
                if ($result->num_rows >= 0) {
                    while ($row = $result->fetch_assoc()) {
                        if ($row['user_id'] == $curr_room_owner_id) {
                            continue;
                        } else {
                            echo '<option value="' . $row['user_id'] . '">' . $row['user_name'] . '</option>';
                        }
                    }
                }
            }

            $curr_room_name = $room_repo->get_room_name_by_room_id($_GET['show']);

            echo '  
        </select>
        </div>
            <input name="room-name" id="room-name-input" placeholder="Change room name" value="' . $curr_room_name . '">
        </div>

        <input id="submit" type="submit" name="modify-room" value="send">
                        </form>
                    </div>';
        } else {
            generate_rooms();
            $modal_sender->triggerModal("Room error", "Missing permissions to enter the room.");
        }
    } else {
        generate_rooms();
    }


    function generate_rooms()
    {
        global $room_repo, $user_id, $modal_sender, $rooms;
        try {
            $result_set = $room_repo->getRooms($user_id);
            while ($row = $result_set->fetch_assoc()) {

                $room = new Room($row['room_name'], $row['user_id'], $row['room_image']);

                $room->set_room_id($row['room_id']);

                $room->set_creation_date($row['creation_date']);

                array_push($rooms, $room);
            }
            foreach ($rooms as $iterator) {
                echo '
                        <div class = "room">
                            <a class="room_image_box" style="background-image:url(\'' . $iterator->get_room_image() . '\');" href="./home.php?content=rooms&show=' . $iterator->get_room_id() . '"></a>
                                <div class="room-flex">
                                    <div class="room_name">' . $iterator->get_room_name() . '</div>
                                    <div class="creation_date">' . $iterator->get_formatted_creation_date() . '</div>
                                </div>
                                <a class="submit" href="./home.php?content=rooms&delete=' . $iterator->get_room_id() . '">remove</a>
                            </div>
                            ';
            }
        } catch (Exception $err) {
            $modal_sender->triggerModal("Room error", "Error occured reading rooms.");
        }
    }

    ?>
</div>
</div>

<?php
if (!isset($_GET['show']) || !$room_access_repo->hasAccess($_GET['show'], $user_id)) {
    echo '
    <div class="room-creator">
    <div class="sub-page-header">Room editor</div>
    <form action="./home.php?content=rooms" method="post" enctype="multipart/form-data">
        <div id="image-selector">
            <img src="./img/plus.svg" id="profile_image" class="file_image" alt="profile_image" onclick="triggerClick()">
            <label for="fileimage"></label>
            <input onchange="displayImage(this)" id="fileimage" type="file" name="file" accept="image/png, image/jpg, image/svg, image/jpeg" />
        </div>
        <input type="text" name="room-name" class="input" placeholder="Room name">
        <input type="submit" name="submit" id="submit" value="create">
    </form>
</div>
</div>';
}



?>