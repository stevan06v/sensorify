<?php

if (isset($_GET['content'])) {
    switch ($_GET['content']) {
        case "overview":
            echo "overview";
            break;
        case "map":
            echo "map";
            break;
        case "config":
            echo "config";
            break;
        case "devices":
            echo "devices";
            break;
        case "users":
            echo "users";
            break;
        case "history":
            echo "history";
            break;
        case "docs":
            echo "docs";
            break;
        case "rooms":
            echo "rooms";
            break;
        case "user":
            echo "user";
            break;
        default:
            echo "default";
            break;
    }
    echo "loaded";
}
