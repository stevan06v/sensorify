<?php
session_start();

if (!isset($_SESSION['login'])) {
    $_SESSION['login'] = false;
}

if (!isset($_SESSION['errors'])) {
    $_SESSION['errors'] = array();
    $errors = $_SESSION['errors'];
} else {
    $errors = $_SESSION['errors'];
}

$file_dest = "";
$name = "";
$username = "";
$lastname = "";
$email = "";
$password = "";

# define regex patterns for ultra-uncrackable-giga-mega-peta-security
$name_regex = "/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/";
$username_regex = "/^[a-zA-Z0-9_]{3,20}$/";
$lastname_regex = "/^[a-zA-Z0-9_]{3,20}$/";
$email_regex = "/^[\w-\.]+@([\w-]+\.)+[\w-]{2,}$/";
$password_regex = "/^[a-zA-Z0-9_]{3,20}$/";


if (
    isset($_POST['username']) &&
    isset($_POST['name']) &&
    isset($_POST['lastname']) &&
    isset($_POST['email']) &&
    isset($_POST['password']) &&
    isset($_POST['submit']) &&
    $_SESSION['login'] == false &&
    empty($_SESSION['errors'])
) {
    if ( # checking data for injections...
        preg_match($name_regex, $_POST['name']) &&
        preg_match($username_regex, $_POST['username']) &&
        preg_match($lastname_regex, $_POST['lastname']) &&
        preg_match($password_regex, $_POST['password'])
    ) {
        # read the data out of the post-request(ape-form)
        $name = $_POST['name'];
        $username = $_POST['username'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
    } else {
        array_push($_SESSION['errors'], "Check the input data...");
        header("Location: home.php");
    }

    echo $name . ": " . $username . ", " . $lastname . ", " . $email . ", " . $password;

    $dbserver = "sensorify.ddns.net";
    $dbname = "sensorifydb";
    $dbusername = "stevan";
    $dbpassword = "Stevan2006";
    $connection = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_errno());
    } else {
        if (!exists_username($username, $connection) && !exists_email($email, $connection)) {

            # uploads selected file if user does not exist
            upload_File();

            $sql = "insert into users (name,lastname,user_name,email,password,image_dest)"
                . "values('$name','$lastname','$username','$email','$password','$file_dest')";

            if (!mysqli_query($connection, $sql)) {
                array_push($_SESSION['errors'], "error occurred while inerting into database!");
            }
            $_SESSION['login'] = true;
        } else {

            array_push($_SESSION['errors'], "$username already exists!");
            array_push($_SESSION['errors'], "$email already exists!");

            $_SESSION['login'] = false;
            header('Location: home.php');
        }
        mysqli_close($connection);
    }
} else {
    if (!$_SESSION['login']) { # check if session is false -> error occured -> reload form
        load_signUpForm();
    }
}

# check if data base contains-same username
function exists_username($username, $connection)
{
    $sql = "select user_name from users where user_name='$username'";
    echo $username;
    $result = $connection->query($sql);
    echo $result->num_rows;
    if ($result->num_rows == 0) {
        return false;
    } else {
        return true;
    }
}

function exists_email($email, $connection)
{
    $sql = "select user_name from users where email='$email'";
    $result = $connection->query($sql);
    if ($result->num_rows == 0) {
        return false;
    } else {
        return true;
    }
}

function upload_file()
{
    global $file_dest;
    # read image methods
    $file = $_FILES['file']; # output -> array ['name'], [type]...
    # $file-> propeteries
    $file_name = $_FILES['file']['name'];
    $file_tmp_name = $_FILES['file']['tmp_name']; # temp location of the file
    $file_size = $_FILES['file']['size']; # size of the file
    $file_error = $_FILES['file']['error']; # error of the file
    $file_ext = explode('.', $file_name);
    # Lowercase the last element of the file JPEG -> jpeg
    $file_actual_ext = strtolower(end($file_ext)); 
    $allowed = array('jpg', 'jpeg', 'png', 'svg'); 
    if (in_array($file_actual_ext, $allowed)) { 
        if ($file_error === 0) {
            if ($file_size <= 2_000_000) { # max image size
                
                $file_name_new = uniqid('', true) . "." . $file_actual_ext; 
                $file_dest = './upload/' . $file_name_new;

                // toDo: Convert given image to 170x170 
                // cube: https://3dtransforms.desandro.com/cube

                # move temp file loaction to new location
                move_uploaded_file($file_tmp_name, $file_dest);
                header("Location: home.php?uploadsuccess");
            } else {
                array_push($_SESSION['errors'], "$file_name too large!");
                $_SESSION['login'] = false; 
                header("Location: home.php");
            }
        } else {
            array_push($_SESSION['errors'], "Error occured while uploading file!");
            $_SESSION['login'] = false; 
            header("Location: home.php");
        }
    } else {
        array_push($_SESSION['errors'], "No image added added!");
        $_SESSION['login'] = false; 
        header("Location: home.php");
    }
}

function load_signUpForm()
{
    global $errors;

    if (!empty($errors)) {
        foreach ($errors as $key) {
            echo "$key <br>";
        }
        unset($_SESSION['errors']);
    }
    echo "
<div class='form-swapper-flex'>

<div id=left-arrow-box>
<img src='./img/left.svg' class='arrow' alt='left-arrow' id='left-arrow'></div>



    <form id='signup' action='./home.php' method='post' enctype='multipart/form-data'>
    <h3 id='login_headline'>Sign up</h3>
    <div id='signup-grid'>
        <div id='input-box'>
            <input type='text' id='username' class='input' name='username' placeholder='User Name' required>
            <br>
            <input type='text' id='name' class='input' name='name' placeholder='First Name' required>
            <br>
            <input type='text' id='lastname' class='input' name='lastname' placeholder='Last Name' required>
            <br>
            <input type='email' id='email' class='input' name='email' placeholder='Email Address' required>
            <br>
            <input type='password' id='password' class='input' name='password' placeholder='Password' required>
            <br>
        </div>
        <div id='image-selector'> 
        <img src='./img/plus.svg' id='profile_image' class='file_image' alt='profile_image' onclick='triggerClick()'>
            <label for='fileimage'></label>
            <input onchange='displayImage(this)' id='fileimage' type='file' name='file' accept='image/png, image/jpg, image/svg, image/jpeg'/> 
        </div>
    </div>
    <input type='submit' id='submit' name='submit'>
</form>

<div id=right-arrow-box>
<img src='./img/right.svg' class='arrow' alt='right-arrow' id='right-arrow'>
</div>


</div>

";
}
