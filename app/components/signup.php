<?php

//get the database class out of classes

require_once './classes/repositories/UserRepository.class.php';
require_once './classes/model/User.class.php';

$user_repo = new UserRepository();

$file_dest = "";
$name = "";
$username = "";
$lastname = "";
$email = "";
$password = "";
# define regex patterns for ultra-uncrackable-giga-mega-peta-security
$name_regex = "/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*.{3,}$/";
$username_regex = "/^[a-zA-Z0-9_]{3,20}$/";
$lastname_regex = "/^[a-zA-Z0-9_]{3,20}$/";
$email_regex = "/^[\w-\.]+@([\w-]+\.)+[\w-]{2,}$/";
// at least 8 letters, one special char, one lowercase letter
$password_regex = "/^(?=.*[@#$%^&+=-€])(?=.*[A-Z])(?=.*[a-z]).{8,}$/";

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
    if (
        # checking data for injections...
        preg_match($name_regex, $_POST['name']) &&
        preg_match($username_regex, $_POST['username']) &&
        preg_match($lastname_regex, $_POST['lastname']) &&
        preg_match($password_regex, $_POST['password'])
    ) {
        # read the data out of the post-request(ape-form)
        $username = $_POST['username'];
        $email = $_POST['email'];
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $password = $_POST['password'];
        //$name, $lastname, $username, $password, $email
        $user = new User($username, $lastname, $username, $password, $email, $file_dest);
    } else {
        header('Location: home.php?login=cancelled');
    }
    if (!($user_repo->getConnection())) {
        header('Location: home.php?login=cancelled?connection=failed');
                
        $modal_sender->triggerModal("Database error", "Connection to database failed.");
    } else {
        if (!$user_repo->exitsUsername($user->getUsername()) && !$user_repo->exitsEmail($user->getEmail())) {
            upload_File();
            $user->setImageDest($file_dest);

            if (!$user_repo->insert($user)) {
                array_push($_SESSION['errors'], "error occurred while inserting into database!");
                # remove file after error --> user not in database
                exec("rm -r $file_dest");
                header('Location: home.php?login=cancelled');

                $modal_sender->triggerModal("Database error", "Error occured while inserting data into database." );
            } else {
                $_SESSION['login'] = true;
                $user_repo->getConnection()->close();
                $_SESSION['username'] = $user->getUsername();
                header('Location: home.php?enter=signup&login=success');
            }
        } else {
            $_SESSION['login'] = false;
            header('Location: home.php?login=cancelled');
        }
    }
} else {
    if (!$_SESSION['login']) {
        load_signUpForm();
    }
}


function exists_username($username, $connection)
{
    $sql = "select user_name from users where user_name='$username'";
    $result = $connection->query($sql);
    if ($result->num_rows == 0) {
        return false;
    } else {
        $_SESSION['username_err'] = $username;
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
        $_SESSION['email_err'] = $email;
        return true;
    }
}
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
            header("Location: home.php?uploadsuccess");
        }
    }
}
# php-gd library
function compress_image($dest, $file_extenetion)
{
    $height = 170;
    $width = 170;
    if ($file_extenetion == "jpg" || $file_extenetion == "jpeg") {
        $image = imagecreatefromjpeg($dest);
        imagejpeg(imagescale($image, $width, $height), $dest);
    } else {
        $image = imagecreatefrompng($dest);
        imagepng(imagescale($image, $width, $height), $dest);
    }
}
function load_signUpForm()
{
    function print_email()
    {
        if (empty($_SESSION['email_err'])) {
            echo "<input type='email' id='email' class='input' name='email' placeholder='Email address' required> <br>";
        } else {
            $email =  "placeholder='" . "This email is taken" . "'";
            echo "<input type='email' id='email' class='input' name='email' $email required> <br>";
            unset($_SESSION['email_err']);
            global $modal_sender;
            $modal_sender->triggerModal("Sign-up error", "Email already exists!");
        }
    }
    function print_user()
    {
        if (empty($_SESSION['username_err'])) {
            echo "<input type='text' id='username' class='input' name='username' placeholder='User name' required><br>";
        } else {
            $msg =  "placeholder='" . "This user name is taken" . "'";
            echo "<input type='text' id='username' class='input' name='username' $msg required> <br>";
            unset($_SESSION['username_err']);
            global $modal_sender;
            $modal_sender->triggerModal("Sign-up error", "Username already exists!");
        }
    }

    $last_guestURL = $_SESSION['last_guestURL'];

    echo "
<div class='form-swapper-flex'>
    <div id=left-arrow-box>
    <a href='$last_guestURL'><img src='./img/left.svg' class='arrow' alt='left-arrow' id='left-arrow'></a>
    </div>

    <form id='signup' action='./home.php' method='post' enctype='multipart/form-data'>
    <h3 id='login_headline'>Sign up</h3>
    <div id='signup-grid'>
        <div id='input-box'>";

    print_user();
    echo "
            <input type='text' id='name' class='input' name='name' placeholder='First name' value='' required>
            <br>
            <input type='text' id='lastname' class='input' name='lastname' placeholder='Last name' value='' required>
            <br>";
    print_email();
    echo "    
            <input type='password' id='password' class='input' name='password' placeholder='Password' value='' required>
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
<div id='right-arrow-box'>
<a href='./home.php?enter=login'><img src='./img/right.svg' class='arrow' alt='right-arrow' id='right-arrow'></a>
</div>
</div>
";
}
