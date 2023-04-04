<style>
    #accounts {
        display: grid;
        grid-template-columns: auto auto;
        gap: 1vw;
    }

    .account {
        width: 25vw;
        display: flex;
        justify-content: space-between;
        padding: 1vw;
        -webkit-box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.28);
        -moz-box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.28);
        box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.28);
        border-radius: 12px;
        align-items: center;
        gap: 2vw;
    }

    .account-props {
        display: flex;
        gap: 1vw;
        align-items: center;
    }

    .profile-image {
        width: 4vw;
    }

    .account-name {

        font-family: Black-Pure;
        color: black;
        font-size: 1.2rem;
    }

    .current-user {
        border: solid 3px #1a8766;
    }

    .user-name {
        font-family: MediumItalic;
        margin-top: -0.4vh;
    }

    .sub-page-box{
        overflow: auto;
    } 
    
    .delete_user {
        width: 2.2vw;
    }
</style>
<div class="sub-page-box">
    <div class="sub-page-headerBox">
        <h3 class="sub-page-header">
            Edit your accounts:
        </h3>
    </div>
    <div id="accounts">
        <?php
        require_once("./classes/repositories/Database.class.php");
        require_once("./classes/repositories/UserRepository.class.php");
        $datbase = new Database();
        $user_repo = new UserRepository();
        $conn = $datbase->getDataSource();

        $table = "users";
        $query = "select * from $table";

        if (isset($_GET["delete"])) {
            $sql = "delete from $table where user_id=" . $_GET["delete"];
            if ($_GET["delete"] == $user_repo->getUserIDbyName($_SESSION['username'])) {
                $modal_sender->triggerModal("Account-error", "Your are logged in as: @" . $_SESSION['username']);
            } else {
                $user = $user_repo->getUserNamebyId($_GET["delete"]);
                if ($result = $conn->query($sql)) {
                    $modal_sender->triggerModal("Notification", "$user just got deleted.");
                }
            }
        }
        $curr_user = "current-user";
        if ($result = $conn->query($query)) {
            if ($result->num_rows >= 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '
                    <div class="account">
                        <div class="account-props">
                            <img src="' . $row["image_dest"] . '" alt="" srcset="" class="profile-image">
                            <div>
                                <div class="account-name">' . $row["name"] . ' ' . $row["lastname"] . '</div>
                                <div class="user-name">@' . $row["user_name"] . '</div>
                            </div>
                        </div>
                        <a href="./home.php?content=users&delete=' . $row["user_id"] . '"><img class="delete_user" src="./img/sidebar/grey/trash-can.svg" alt="" srcset=""></a>
                    </div>';
                }
            } else {
                echo "no users are selected";
            }
        }
        ?>
    </div>
</div>