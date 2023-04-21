<style>
    #room-flex {
        display: flex;
        margin: auto;
        gap: 3vw;
        align-items: center;

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

    .room_image {
        width: 15vw;
        height: 15vh;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px
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
    .room-flex{
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: black;
    }
    .creation_date{
        font-family: BoldItalic;
        color: black;
    }
</style>


<script>
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
        let button = document.getElementById("submit");
        console.log("click");
        button.click();
    }
</script>

<div id="room-flex">

    <div class="sub-page-box">
        <h3 class="sub-page-header" style="text-align: left;">
            Manage your rooms:
        </h3>

        <div id="rooms">
            <?php

            require_once "./classes/model/Room.class.php";
            require_once "./classes/repositories/RoomRepository.class.php";
            require_once "./classes/repositories/UserRepository.class.php";
            require_once "./classes/ImageUploader.class.php";
            require_once "./classes/ModalSender.class.php";

            $dir = "./upload/rooms/";
            $image_uploader = new ImageUploader($dir);
            $user_repo = new UserRepository();
            $modal_sender = new ModalSender();
            $room_repo = new RoomRepository();

            $rooms = array();
            $user_id = $user_repo->getUserIDbyName($_SESSION['username']);


            if (isset($_GET['delete'])) {
                $room_id = $_GET['delete'];
                try {
                    $room_repo->delete_by_room_id($room_id);
                    $modal_sender->triggerNotification("Room got successfully deleted.");
                } catch (Exception $err) {
                    $modal_sender->triggerModal("Room error", "Error while deleting room.");
                }
            }


            if (isset($_POST['submit'])) {

                $room_name = $_POST['room-name'];
                $file_dest = $image_uploader->upload(680, 500);

                $room = new Room($room_name, $user_id, $file_dest);

                if (!empty($room->get_room_name()) && !empty($room->get_room_image())) {
                    try {
                        $room_repo->insert($room, $user_id);
                        $modal_sender->triggerNotification("Room added successully.");
                    } catch (Exception $err) {
                        $modal_sender->triggerModal("Room error", "Error occured while adding room.");
                    }
                } else {
                    $modal_sender->triggerModal("Room error", "Empty fields.");
                }
            }

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
                        <img class="room_image" src="' . $iterator->get_room_image() . '" alt="room_image">
                        
                        <div class="room-flex">
                            <div class="room_name">' . $iterator->get_room_name() . '</div>
                            <div class="creation_date">' . $iterator->get_creation_date() . '</div>
                        </div>

                        <a class="submit" href="./home.php?content=rooms&delete=' . $iterator->get_room_id() . '">remove</a>
                    </div>
                    
                    ';
                }
            } catch (Exception $err) {
                $modal_sender->triggerModal("Room error", "Error occured reading rooms.");
            }

            ?>
        </div>
    </div>

    <div class="room-creator">
        <div class="sub-page-header">Room editor</div>
        <form action='./home.php?content=rooms' method='post' enctype='multipart/form-data'>
            <div id='image-selector'>
                <img src='./img/plus.svg' id='profile_image' class='file_image' alt='profile_image' onclick='triggerClick()'>
                <label for='fileimage'></label>
                <input onchange='displayImage(this)' id='fileimage' type='file' name='file' accept='image/png, image/jpg, image/svg, image/jpeg' />
            </div>

            <input type='text' name='room-name' class='input' placeholder='Room name'>

            <input type='submit' name='submit' id='submit' value='create'>
        </form>


    </div>

</div>