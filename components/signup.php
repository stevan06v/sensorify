

<?php
session_start();

if (!isset($_SESSION['login'])) {
    $_SESSION['login'] = false;
}

$name = "";
$username = "";
$lastname = "";
$email = "";
$password = "";

if (
    isset($_POST['username']) &&
    isset($_POST['name']) &&
    isset($_POST['lastname']) &&
    isset($_POST['email']) &&
    isset($_POST['password']) &&
    isset($_POST['submit']) &&
    $_SESSION['login'] == false
) {

    $name = $_POST['name'];
    $username = $_POST['username'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    $file_dest = "not defined" ;
    # read image methods
    $file = $_FILES['file']; # output -> array ['name'], [type]...
    $file_name = $_FILES['file']['name'];
    $file_tmp_name = $_FILES['file']['tmp_name']; # temp location of the file
    $file_size = $_FILES['file']['size']; # size of the file
    $file_error = $_FILES['file']['error']; # error of the file
    $file_type = $_FILES['file']['type'];

    # files allowings
    $file_ext = explode('.', $file_name); # trim filename and the type[jpeg]
    $file_actual_ext = strtolower(end($file_ext)); # Lowercase the last element of the file JPEG -> jpeg

    $allowed = array('jpg', 'jpeg', 'png', 'svg'); # list all file types which can be uploaded

    if (in_array($file_actual_ext, $allowed)) { # if extention is inside the array
        if ($file_error === 0) {
            if ($file_size <= 5_000_000_0) {
                $file_name_new = uniqid('', true) . "." . $file_actual_ext;
                $file_dest = './upload/' . $file_name_new; 
                # move temp file loaction to new location
                move_uploaded_file($file_tmp_name, $file_dest);
                header("Location: home.php?uploadsuccess");
            } else {
                echo "Your file is too large...";
            }
        } else {
            echo "Error occured while uploading your file!";
        }
    } else {
        echo "You cannot upload files of this type...";
    }

    echo $name . ": " . $username . ", " . $lastname . ", " . $email . ", " . $password;

    $dbserver = "sensorify.ddns.net";
    $dbname = "sensorifydb";
    $dbusername = "stevan";
    $dbpassword = "Stevan2006";
    $connection = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);


    if (!exists($username, $connection)) {
        if (!$connection) {
            die("Connection failed: " . mysqli_connect_errno());
        }

        $sql = "insert into users (name,lastname,user_name,email,password,image_dest)"
            . "values('$name','$lastname','$username','$email','$password','$file_dest')"; // filedest

        if (mysqli_query($connection, $sql)) {
            $last_id = mysqli_insert_id($connection);
            echo "Successfully inserted ID: " . $last_id;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        $_SESSION['login'] = true;
    } else {
        echo "<br>";
        echo "$username already exists";
        $_SESSION['login'] = false;
    }

    mysqli_close($connection);
} else {

    if (!$_SESSION['login']) {
        echo "
        <form id='signup' action='./home.php' method='post' enctype='multipart/form-data'>
        <h3 id='login_headline'>Sign-Up</h3>
        <div id='signup-grid'>
            <div id='input-box'>
                <input type='text' class='input' name='username' placeholder='User Name' required>
                <br>
                <input type='text' class='input' name='name' placeholder='First Name' required>
                <br>
                <input type='text' class='input' name='lastname' placeholder='Last Name' required>
                <br>
                <input type='email' class='input' name='email' placeholder='Email Address' required>
                <br>
                <input type='text' class='input' name='password' placeholder='Password' required>
                <br>
            </div>
            <div id='image-selector'> 
                <label for='fileimage'>
                    <img src='./img/user.svg' class='file_image' alt='profile_image'>
                </label>
                <input id='fileimage' type='file' name='file' accept='image/png, image/jpg, image/svg, image/jpeg'/> 
            </div>
        </div>
        <input type='submit' id='submit' name='submit'>
    </form>
";
    }
}

function exists($username, $connection)
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
