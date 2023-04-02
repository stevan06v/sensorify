<?php


if (isset($_GET['content'])) {
    switch ($_GET['content']) {
        case "overview":
            echo "<h1>overview</h1>";
            break;
        case "map":
            include("./components/nav-top.php");
            include("./components/map.php");
            break;
        case "config":
            echo "<h1>config</h1>";
            break;
        case "devices":
            echo "<h1>devices</h1>";
            break;
        case "users":
            include("./components/users.php");
            break;
        case "history":
            echo "<h1>history</h1>";
            break;
        case "docs":
            echo "<h1>docs</h1>";
            break;
        case "rooms":
            echo "<h1>rooms</h1>";
            break;
        case "user":
            echo "<h1>user</h1>";
            break;
        default:
            echo "<h1>default<h1>";
            break;
        }
}

