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
        border-radius: 50%;
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
    #profile_image {
        cursor: pointer;
    }
    .user-sub-head {
        font-size: 20px;
        font-family: Black-Pure;
        color: black;
        margin-bottom: 1vw;
        border-bottom: #1a8766 solid 2px;
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
<div class="sub-page-box">
    <?php
    //name, lastname, user_name, email, password
    $placeholders = array("New first name", "New last name", "New user name", "New email-address", "New password", "Retype password", "Phone number", "Country", "Zip Code","City", "Street","House no.");
    $types = array("text", "text", "text", "email", "password", "password","phonenumber","text","text","text","text","text");
    $names = array("name", "lastname", "user_name", "email", "password","new-password", "phone_number", "country", "zip_code", "city", "street", "house_number");
    $text = array("Name", "Lastname", "Username", "Email address","Password","New Password", "Phone number", "Country", "Zip Code", "City","Street", "House no." );

    require_once("./classes/repositories/UserRepository.class.php");
    $user_repo = new UserRepository();
    $conn = $user_repo->getConnection();
    $file_dest = "";


    # change profile-image
    if (!empty($_POST["submit"])) {
        upload_file();
        // exec("rm -r $file_dest"); 
        $sql = "update users set image_dest='" . $file_dest . "' where user_name='" . $_SESSION['username'] . "'";
        $result = $conn->query($sql);

        echo '
            <script>
                setTimeout(function() {
                    window.location.href = window.location.href;
                }, 10);        
            </script>
        ';
    }

    # ape-form
    for ($i = 0; $i < sizeof($names); $i++) {
        if (isset($_POST[$names[$i]])) {
            if ($names[$i] == 'user_name' && !empty($_POST[$names[$i]])) {
                # check if user exits
                if (!$user_repo->exitsUsername($_POST[$names[$i]])) {
                    $sql = "update users set $names[$i]='" . str_replace(' ', '', $_POST[$names[$i]]) . "' where user_name='" . $_SESSION['username'] . "'";
                    $result = $conn->query($sql);
                    $_SESSION['username'] = $_POST[$names[$i]];
                    // refresh sidebar(update name)
                    echo "
                    <script>
                        setTimeout(function() {
                            window.location.href = window.location.href;
                        }, 10); 
                    </script>
                ";
                } else {
                    $modal_sender->triggerModal("User-error", "Username is already taken or empty.");
                }
            } else {
                if (!empty($_POST[$names[$i]])) {
                    $sql = "update users set $names[$i]='" . str_replace(' ', '', $_POST[$names[$i]]) . "' where user_name='" . $_SESSION['username'] . "'";
                    $result = $conn->query($sql);
                    $modal_sender->triggerNotification($text[$i] . " got successfully updated.");
                } else {
                    $modal_sender->triggerModal("User-error", "$names[$i] is already taken.");
                }
            }
            
        }
    }

    #  password ape-form
    if (isset($_POST['password']) && isset($_POST['retype-password'])) {
        if (!empty($_POST['password']) && !empty($_POST['retype-password'])) {
            if (str_replace(' ', '', $_POST['password']) == str_replace(' ', '', $_POST['retype-password'])) {
                $query = "update users set password = '" . $_POST['password'] . "' where user_name = '" . $_SESSION['username'] . "'";
                $result = $conn->query($query);
                $modal_sender->triggerNotification('Password for: ' . $_SESSION['username'] . ' successfully updated.');
            } else {
                $modal_sender->triggerModal("User-error", "Wrong password");
            }
        } else {
            $modal_sender->triggerModal("User-error", "Empty password-field");
        }
    }


    # get db-data
    $user_name = $_SESSION['username'];

    $name = $user_repo->getNamebyUsername($user_name);
    $lastname = $user_repo->getLastNamebyUsername($user_name);
    $image_dest = $user_repo->getImageDestbyUsername($user_name);

    echo '
        <div class="account-props">
        <form action="./home.php?content=user" method="post" enctype="multipart/form-data">
                <div id="image-selector"> 
                    <img src="' . $image_dest . '" id="profile_image" class="profile-image-acc no-darg" alt="profile_image" onclick="triggerClick()">
                    <label for="fileimage"></label>
                    <input onchange="displayProfileImage(this)" id="fileimage" type="file" name="file" accept="image/png, image/jpg, image/svg, image/jpeg"/> 
                </div>
            <input type="submit" id="submit" name="submit" style="display:none;" value="send">
        </form>
            <div>
                <div class="account-name">' . $name . ' ' . $lastname . '</div>
                <div class="user-name">@' . $user_name . '</div>
            </div>
    </div>';

    echo "<div id='settings-content'>";
    echo "<div id='changeSettingsBox'>";


    $values = array(
        $name,
        $lastname,
        $user_name,
        $user_repo->getEmailbyUsername($user_name)
    );

    echo "<div class='user-sub-head'>Change your data: </div>";
    for ($i = 0; $i < 4; $i++) {
        echo ' 
        <form action="./home.php?content=user" method="post">
                <div class="settings-box">
                    <input type="' . $types[$i] . '" name="' . $names[$i] . '" class="input2" placeholder="' . $placeholders[$i] . '" value="'.$values[$i].'">
                    <input type="submit" value="save" name="button" class="submit">
                </div>
            </form>';
    }

    $password = $user_repo->getPasswordbyUsername($user_name);
    echo '
    <form action="./home.php?content=user" method="post">
        <div class="settings-box">
            <input type="password" name="password" class="input2" placeholder="New password" value="' . $password . '">
        </div>
        <div class="settings-box">
            <input type="password" name="retype-password" class="input2" placeholder="Retype new password" value="'.$password.'">
            <input type="submit" value="save" name="button" class="submit">
        </div>
    </form>
    ';
    echo "</div>";




    $values_sec = array(
        $user_repo->getPhoneNumberbyUsername($user_name),
        $user_repo->getCountrybyUsername($user_name),
        $user_repo->getZipCodebyUsername($user_name),
        $user_repo->getCitybyUsername($user_name),
        $user_repo->getStreetbyUsername($user_name),
        $user_repo->getHouseNumberbyUsername($user_name)
    );

    echo "<div>";
    echo "<div class='user-sub-head'>Add your data: </div>";
    for ($i = 6; $i < sizeof($names); $i++) {
        echo ' 
            <form action="./home.php?content=user" method="post">
                <div class="settings-box">
                    <input type="' . $types[$i] . '" name="' . $names[$i] . '" class="input2" placeholder="' .  $placeholders[$i] . '" value="' . $values_sec[$i-6] . '">
                    <input type="submit" value="save" name="button" class="submit" >
                </div>
            </form>';
    }

    echo "</div>";
    echo "</div>";

    function upload_file()
    {
        $upload_dir = "./upload/";
        global $file_dest;
        $file_name = $_FILES['file']['name'];
        $file_tmp_name = $_FILES['file']['tmp_name'];
        $file_error = $_FILES['file']['error'];
        $file_ext = explode('.', $file_name);
        $file_actual_ext = strtolower(end($file_ext));
        $allowed = array('jpg', 'jpeg', 'png');
        if (in_array($file_actual_ext, $allowed)) {
            if ($file_error === 0) {
                $file_name_new = uniqid('', true) . "." . $file_actual_ext;
                if (!is_dir($upload_dir)) {
                    # path, permissions
                    mkdir($upload_dir, 0777);
                }
                $file_dest = './upload/' . $file_name_new;
                move_uploaded_file($file_tmp_name, $file_dest);
                compress_image($file_dest, $file_actual_ext);
            }
        }
    }
    function compress_image($dest, $file_extenetion)
    {
        $height = 170 * 4;
        $width = 170 * 4;
        if ($file_extenetion == "jpg" || $file_extenetion == "jpeg") {
            $image = imagecreatefromjpeg($dest);
            imagejpeg(imagescale($image, $width, $height), $dest);
        } else {
            $image = imagecreatefrompng($dest);
            imagepng(imagescale($image, $width, $height), $dest);
        }
    }

    ?>
</div>