<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    <link rel="stylesheet" href="./style/style.css">
    <script src="https://kit.fontawesome.com/61efd671c0.js" crossorigin="anonymous"></script>
    <script src="./scripts//script.js" defer></script>
</head>

<body>
    <?php

    if (isset($_GET['enter'])) {
        switch ($_GET['enter']) {
            case 'guest':
                include('./components/guest.php');
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

    if($_SESSION['login'] == true){
        echo "login succeded";
    }



    ?>
</body>

</html>