<style>
    .sub-page-box {}

    .sub-page-headerBox {}

    .sub-page-header {}

    #accounts {}

    .account {}

    .account-props {}

    .profile-image {
        width: 3vw;
    }

    .account-name {}

    .user-name {}

    .delete_user {}
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
            $sql = "delete from $table where user_id=".$_GET["delete"];
            if($_GET["delete"] == $user_repo->getUserIDbyName($_SESSION['username']) ){
                echo "cannot delete active user";
            }else{
                if ($result = $conn->query($sql)) {
                    echo $_GET["delete"] . "just got deleted";
                }
            }
        }

        if ($result = $conn->query($query)) {
            if ($result->num_rows >= 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '
        <div class="account">
            <div class="account-props">
                <img src="'.$row["image_dest"]. '" alt="" srcset="" class="profile-image">
                <div>
                    <div class="account-name">'.$row["name"].'.'.$row["lastname"].'</div>
                    <div class="user-name">'.$row["user_name"]. '</div>
                </div>
            </div>
            <a href="./home.php?content=users&delete='.$row["user_id"].'"><img class="delete_user" src="./img/left.svg" alt="" srcset=""></a>
        </div>
            ';
                }
            } else {
                echo "no users are selected";
            }
        }

        ?>
    </div>
</div>