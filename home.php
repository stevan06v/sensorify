<?php
session_start();
if (!isset($_SESSION['guest-login'])) {
    $_SESSION['guest-login'] = false;
}
if (!isset($_SESSION['login'])) {
    $_SESSION['login'] = false;
}
if (!isset($_SESSION['username_err'])) {
    $_SESSION['username_err'] = "";
}
if (!isset($_SESSION['email_err'])) {
    $_SESSION['email_err'] = "";
}
if (!isset($_SESSION['last_guestURL'])) {
    $_SESSION['last_guestURL'] = "./home.php?enter=guest";
}

if(!isset($_SESSION['login'])){
    $_SESSION['login'] = false;
}

?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sensorify</title>
    <link rel="stylesheet" href="./style/style.css">
    <script src="https://kit.fontawesome.com/61efd671c0.js" crossorigin="anonymous"></script>
    <script src="./scripts//script.js" defer></script>
    <script src='./scripts/modules/PopupEngine/PopupEngine.js'></script>
</head>

<body>
    <?php
    if (isset($_GET['enter'])) {
        switch ($_GET['enter']) {
            case 'guest':
                if (
                    isset($_GET['login']) &&
                    isset($_GET['enter']) &&
                    $_GET['login'] == "success" &&
                    $_SESSION['guest-login'] == true
                ) {
                    echo "your are successfully logged in as a guest!!!";
                } else {
                    include('./components/guest.php');
                }
                break;
            case 'login':
                include('./components/login.php');
                break;
            default:
                include('./components/signup.php');
                break;
        }
    } else {
        include('./components/signup.php');
    }



    ?>
</body>


</html>