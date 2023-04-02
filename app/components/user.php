<style>
    .account-props {
        display: flex;
        gap: 2vw;
        align-items: center;
        padding: 1.5vw;
    }

    .account-name {
        font-size: 3rem;
        font-family: Black-Pure;
        color: black;
    }

    .user-name {
        margin-top: -1vh;
        font-family: MediumItalic;
        font-size: 15px;
    }

    .sub-page-box {
        height: auto;
    }

    .profile-image-acc {
        width: 12vw;
        border-radius: 160px;
        border: #1a87669a solid 3px;
        box-shadow: 0px 0px 3px 0px rgba(0, 0, 0, 0.52);
    }

    .input2 {
        outline: none;
        color: #1a8766;
        font-family: BoldItalic;
        font-size: 15px;
        display: block;
        text-align: left;
        border-radius: 5px;
        width: 16vw;
        padding: 0.3vw;
        /* justify-content: center; */
        transition: ease width .4s;
        border: 1px solid #1a876667;
        color: #000000;
        cursor: pointer;
        background-color: rgb(255, 255, 255);
        box-shadow: 0px 0px 1px 0px rgba(0, 0, 0, 0.52);
    }

    .settings-box {
        display: flex;
        gap: 1vw;
        margin-bottom: 1vh;
    }

    #settings-content {
        padding-left: 1.5vw;
        padding-right: 1.5vw;
        display: flex;
        gap: 2vw;

    }

    .submit {
        padding: 0.6vw;
        display: block;
        font-size: 0.8rem;
        font-family: ExtraBold;
        cursor: pointer;
        color: white;
        border-radius: 5px;
        background-color: #1a8766;
        border: none;
        margin: auto;
        box-shadow: -2px -1px 20px -10px rgba(0, 0, 0, 0.75);
    }

    .user-sub-head {
        font-size: 20px;
        font-family: Black-Pure;
        color: black;
        margin-bottom: 1vw;
        border-bottom: #1a8766 solid 2px;
    }
</style>


<div class="sub-page-box">
    <?php
    require_once("./classes/repositories/UserRepository.class.php");
    $user_repo = new UserRepository();


    # get db-data
    $user_name = $_SESSION['username'];
    $name = $user_repo->getNamebyUsername($user_name);
    $lastname = $user_repo->getLastNamebyUsername($user_name);
    $image_dest = $user_repo->getImageDestbyUsername($user_name);


    echo '
        <div class="account-props">
            <img src="' . $image_dest . '" alt="" srcset="" class="profile-image-acc no-darg">
            <div>
                <div class="account-name">' . $name . ' ' . $lastname . '</div>
                <div class="user-name">@' . $user_name . '</div>
            </div>
    </div>';



    $placeholders = array("New first name", "New last name", "New user name", "New email-address", "New password", "Retype password");
    $types = array("text", "text", "text", "email", "password", "password");
    $names = array("name", "lastname", "username", "email", "passord", "new-passord");

    echo "<div id='settings-content'>";
    echo "<div id='changeSettingsBox'>";

    echo "<div class='user-sub-head'>Change your data: </div>";
    for ($i = 0; $i < 6; $i++) {
        echo ' 
                        <form action="./home.php?content=user" method="post">
                                <div class="settings-box">
                                    <input type="' . $types[$i] . '" name="' . $names[$i] . '" class="input2" placeholder="' . $placeholders[$i] . '">
                                    <input type="submit" value="edit" name="button" class="submit">
                                </div>
                            </form>';
    }
    echo "</div>";

    echo "<div>";
    echo "<div class='user-sub-head'>Add your data: </div>";
    for ($i = 0; $i < 6; $i++) {
        echo ' 
                        <form action="./home.php?content=user" method="post">
                                <div class="settings-box">
                                    <input type="' . $types[$i] . '" name="' . $names[$i] . '" class="input2" placeholder="' . $placeholders[$i] . '">
                                    <input type="submit" value="edit" name="button" class="submit" >
                                </div>
                            </form>';
    }

    echo "</div>";
    echo "</div>";


    if (!empty($_POST['button'])) {
    }




    ?>



</div>