<?php
$user_repo = new UserRepository();
if (
    isset($_POST['email']) &&
    isset($_POST['password']) &&
    isset($_POST['submit']) &&
    !empty($_POST['submit'])
) {
    $password_regex = "/^(?=.*[@#$%^&+=-€])(?=.*[A-Z])(?=.*[a-z]).{8,}$/";
    if (
        preg_match($password_regex, $_POST['password'])
    ) {
        if ($user_repo->existsUser($_POST['email'], $_POST['password'])) {
            header("Location: home.php?content=user");
            $_SESSION['login'] = true;
            $_SESSION['username'] = $user_repo->getUserNameByEmail($_POST['email']);;
        } else {
            generateLogin("");
            $modal_sender->triggerModal("Log-in error", "Can not find this user!");
        }
    } else {
        $_SESSION['login'] = false;

        generateLogin("");
        $modal_sender->triggerModal("Log-in error", "Regex does not match!");
    }
} else {
    if (!$_SESSION['login']) {
        generateLogin("");
    } else {
        header("Location: home.php?content=user");
    }
}
function generateLogin($err)
{
    echo "
    <div class='form-swapper-flex'>
    <div id=left-arrow-box>
        <a href='./home.php?enter=signup'><img src='./img/left.svg' class='arrow' alt='left-arrow' id='left-arrow'></a>
    </div>

    <form action='./home.php?enter=login' method='post' id='login'>
        <h3 id='login_headline'>Log in</h3>

        <div id='signup-grid'>
            <div id='input-box'>
                <input type='email' id='email' class='input' name='email' placeholder='Email Address' autocomplete='current-email' required>
                <br>
                <input type='password' id='password' class='input' name='password' placeholder='Password' autocomplete='current-password' required>
            </div>
            <a href='#' id='login-icon-box' >
                <img src='./img/login.svg' id='login-icon' alt='guest'>
            </a>
        </div> 
        <input type='submit' id='submit' name='submit' value='Log in'>
    </form>

    <div id='right-arrow-box'>
        <a href='./home.php?enter=guest'><img src='./img/right.svg' class='arrow' alt='right-arrow' id='right-arrow'></a>
    </div>
</div>
    ";
}
