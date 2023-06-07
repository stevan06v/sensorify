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
if (!isset($_SESSION['login'])) {
    $_SESSION['login'] = false;
}
if (!isset($_SESSION['username'])) {
    $_SESSION['username'] = "";
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

    <script src="./scripts/script.js" defer></script>
    <script src="./libs/modules/PopupEngine/popupEngine.js"></script>


    <link rel="stylesheet" href="//cdn.jsdelivr.net/gh/highlightjs/cdn-release@11.7.0/build/styles/default.min.css">
    <script src="//cdn.jsdelivr.net/gh/highlightjs/cdn-release@11.7.0/build/highlight.min.js"></script>
    
    <script>
        PopupEngine.init({
            doLogs: true
        })
    </script>
</head>

<body>

    <!-- Loading screen -->
    <div class="loading" id="loading-screen">
        <div class="loading-spinner"></div>
    </div>



    <script>
        // Show the loading screen
        document.getElementById('loading-screen').style.display = 'flex';

        try {
            // Load the content from the database using AJAX
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    // Hide the loading screen
                    document.getElementById('loading-screen').style.display = 'none';

                    // Update the content with the response from the server
                    document.getElementById('content').innerHTML = xhr.responseText;
                }
            };
            xhr.open('GET', './home.php', true);
            xhr.send();
        } catch (e) {

        }
    </script>


    <?php
    require_once "./classes/repositories/UserRepository.class.php";
    require_once "./classes/ModalSender.class.php";


    $modal_sender = new ModalSender();

    if ($_SESSION['login']) {
        include("./components/main.php");
       # header("Location: ./home.php?content=user");
    }


    if (isset($_GET['enter'])) {
        switch ($_GET['enter']) {
            case 'guest':
                if (
                    isset($_GET['login']) &&
                    $_GET['login'] == "success" &&
                    $_SESSION['guest-login']
                ) {
                    echo "your are successfully logged in as a guest!!!";
                } else {
                    include('./components/guest.php');
                }
                break;
            case 'login':
                if (
                    isset($_GET['login']) &&
                    $_GET['login'] == "success"
                    &&
                    $_SESSION['login']
                ) {
                    include("./components/main.php");
                } else {
                    include('./components/login.php');
                }
                break;
            default:
                if (
                    isset($_GET['login'])
                    &&
                    $_GET['login'] == "success"
                    &&
                    $_SESSION['login']
                ) {
                    include("./components/main.php");
                } else {
                    include('./components/signup.php');
                }
                break;
        }
    } else {
        include('./components/signup.php');
    }



    ?>
</body>


</html>