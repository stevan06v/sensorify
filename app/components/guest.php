<?php
// Click-simulation in js

if (
    isset($_POST['name']) &&
    isset($_POST['lastname']) &&
    isset($_POST['guest-id'])
) {

    $regex = "/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*.{3,}$/";

    if (
        preg_match($regex, $_POST['name']) &&
        preg_match($regex, $_POST['lastname']) 
    ) {
        header("Location: home.php?enter=guest&login=success");
        $_SESSION['last_guestURL'] = "./home.php?enter=guest&login=success";
        $_SESSION['guest-login'] = true;     
    } else {
        $_SESSION['guest-login'] = false;
        $_SESSION['last_guestURL'] = "./home.php?enter=guest";
    }
} else {
    if (!$_SESSION['guest-login']) {
        generateGuestLogin();
    } else {
        header("Location: home.php?enter=guest?login=success");
        $_SESSION['last_guestURL'] = "./home.php?enter=guest&login=success";
    }
}


function generateGuestLogin()
{
    echo "
    <div class='guest-login-wrapper'>
        <div id=left-arrow-box>
            <a href='./home.php?enter=login'><img src='./img/left.svg' class='arrow' alt='left-arrow' id='left-arrow'></a>
        </div>
    
        <form action='./home.php?enter=guest' method='post' id='guestin'>
            <h3 id='login_headline'>(Guest) Log in</h3>
    
            <div id='signup-grid'>
                <div id='input-box'>
                    <input type='text' id='name' class='input' name='name' placeholder='First name' required>
                    <br>
                    <input type='text' id='lastname' class='input' name='lastname' placeholder='Last name' required>
                    <br>
                    <input type='text' id='guest-id' readonly class='input' name='guest-id' placeholder='Guest-ID' required>
                </div>
            
               <input type='submit' id='guestin-btn'>

                <a href='#' id='guest-link' >
                    <img src='./img/guest.svg' id='guest-icon' alt='guest'>
                </a>
            </div>
        </form>
    
        <div id='right-arrow-box'>
            <a href='./home.php?enter=signup'><img src='./img/right.svg' class='arrow' alt='right-arrow' id='right-arrow'></a>
        </div>
    </div>
    ";
}
