<?php
require_once "./classes/repositories/OverviewRepository.class.php";
$overview_repo = new OverviewRepository();
?>
<style>
    .sub-page-box {
        box-shadow: -2px -1px 25px -10px rgba(0, 0, 0, 0.75);
        border-radius: 12px;
        padding-top: 1vw;
        padding-left: 4vw;
        padding-right: 4vw;
        padding-bottom: 2vw;
        /* margin: auto; */
        overflow-y: auto;
        height: auto;
    }

    #sub-grid {
        margin: auto;
        display: grid;
        grid-template-columns: auto auto auto;
        justify-content: center;
        align-items: center;
        gap: 1vw;
    }

    .profile-image {
        width: 5vw;
    }

    #user-address {}

    #rooms {
        display: grid;
        grid-template-columns: auto auto auto;
        justify-content: center;
        gap: 1vw;
    }


    #users {
        display: grid;
        grid-template-columns: auto auto auto;
        justify-content: center;
        align-items: center;
        margin: auto;
        gap: 1vw;
    }

    .main-box {
        box-shadow: -2px -1px 15px -10px rgba(0, 0, 0, 0.75);
        border-radius: 12px;
        padding: 1vw;

        max-width: 20vw;
        max-height: 35vh;
        overflow-y: auto;
    }

    .sub-page-header-header {
        color: black;
        position: sticky;
        top: 0;
        background-color: white;
        font-size: 1.5rem;
        font-family: Black-Pure;
        border-bottom: 3px solid #1a8766;
    }

    a {
        cursor: pointer;
    }

    .room_image {
        width: 4vw;
    }

    .room-preview {
        opacity: .5;
        padding: .5vw;
        border-radius: 12px;
        border: #1a876678 solid 3px;
        transition: ease opacity .5s;
    }

    .room-preview:hover {
        opacity: 1;
    }

    .address-prop {
        text-align: center;
        outline: none;
        padding: .4vw;
        margin-bottom: .5vh;
        font-family: BoldItalic;
        border-radius: 5px;
        border: 2px solid #1a876678;
    }
</style>

<div class="sub-page-box">
    <h3 class="sub-page-header" style="text-align: left;">Overview: </h3>
    <div id="sub-grid">


        <div class="main-box">
            <p class="sub-page-header-header">Your users: </p>
            <div id="users">
                <?php

                $user_images = $overview_repo->get_user_overview();

                while ($row = $user_images->fetch_assoc()) {
                    echo "                        
                        <img src='" . $row['image_dest'] . "' alt='' srcset='' class='profile-image'>
                    ";
                }
                ?>
            </div>
        </div>


        <div class="main-box">
            <p class="sub-page-header-header">Your Rooms: </p>
            <div id="rooms">

                <?php
                $user_id = $user_repo->getUserIDbyName($_SESSION['username']);
                $rooms = $overview_repo->get_rooms_by_user_id($user_id);

                while ($row = $rooms->fetch_assoc()) {
                    echo "          
                     <div class='room-preview'> 
                            <a href='./home.php?content=rooms&show=" . $row['room_id'] . "'>
                                <img class='room_image' src='./img/overview/room.svg' alt='room'>
                            </a>    
                    </div>
                        ";
                }

                ?>
            </div>
        </div>

        <div class="main-box">
            <p class="sub-page-header-header">Your Address: </p>

            <?php

            $user_id = $user_repo->getUserIDbyName($_SESSION['username']);
            $user_address = $overview_repo->get_current_address($user_id)->fetch_assoc();

            echo '
            <input type="text" class="address-prop" value="' . $user_address["country"] . '"><br>
            <input type="text" class="address-prop" value="' . $user_address["city"] . '"><br>
            <input type="text" class="address-prop" value="' . $user_address["zip_code"] . '"><br>
            <input type="text" class="address-prop" value="' . $user_address["street"] . '"><br>
            <input type="text" class="address-prop" value="' . $user_address["house_number"] . '"><br>
                        
            ';
            ?>
        </div>

        <div class="main-box">
            <p style="color: black; font-size:2rem; text-align: center; font-family:BoldItalic ;">
                <?php
                echo $overview_repo->count_users()->fetch_assoc()['count'];
                ?>
            </p>
        </div>

        <div class="main-box">
            <p style="color: black; font-size:2rem; text-align: center; font-family:BoldItalic ;">
                <?php
                echo $overview_repo->count_rooms($user_id)->fetch_assoc()['count'];
                ?>
            </p>
        </div>

    </div>
</div>