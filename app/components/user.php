<style>
    .account-props {
        display: flex;
        gap: 2vw;
        align-items: center;
        padding: 2vw;
    }

    .account-name {
        font-size: 2.7rem;
        font-family: Black-Pure;
        color: black;
    }

    .user-name {
        margin-top: -1vh;
        font-family: MediumItalic;
        font-size: 15px;
    }

    .sub-page-box {
        height: 65vh;
    }

    .profile-image-acc {
        width: 12vw;
        border-radius: 160px;
        border: #1a87669a solid 3px;
        box-shadow: 0px 0px 3px 0px rgba(0, 0, 0, 0.52);
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




    echo ' 
       <form action="./home.php?content=user" method="post">
            <input type="text" name="name" id="username" placeholder="Change username">
            <input type="submit" value="edit">
       </form>';
    echo ' 
       <form action="./home.php?content=user" method="post">
            <input type="text" name="name" id="username" placeholder="Change username">
            <input type="submit" value="edit">
       </form>';
    echo ' 
       <form action="./home.php?content=user" method="post">
            <input type="text" name="name" id="username" placeholder="Change username">
            <input type="submit" value="edit">
       </form>';
    echo ' 
       <form action="./home.php?content=user" method="post">
            <input type="text" name="name" id="username" placeholder="Change username">
            <input type="submit" value="edit">
       </form>';
    echo ' 
       <form action="./home.php?content=user" method="post">
            <input type="text" name="name" id="username" placeholder="Change username">
            <input type="submit" value="edit">
       </form>';
    echo ' 
       <form action="./home.php?content=user" method="post">
            <input type="text" name="name" id="username" placeholder="Change username">
            <input type="submit" value="edit">
       </form>';



    ?>


</div>