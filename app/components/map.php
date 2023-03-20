<?php

if (isset($_GET['content']) && isset($_GET['type'])) {
    switch ($_GET['type']) {
        case "bicycle":
            echo "<iframe width='2000' height='700' frameborder='0' scrolling='no' marginheight='0' marginwidth='0' src='https://www.openstreetmap.org/export/embed.html?bbox=14.216002207671252%2C48.21241772543182%2C14.359339457427112%2C48.26421024309372&amp;layer=cyclosm'></iframe>";
            break;
        case "traffic":
                echo "<iframe width='2000' height='700' frameborder='0' scrolling='no' marginheight='0' marginwidth='0' src='https://www.openstreetmap.org/export/embed.html?bbox=14.216136932373049%2C48.213692646648035%2C14.359474182128908%2C48.26548387425215&amp;layer=transportmap' ></iframe>";
                break;
        default:
            echo "<iframe width='2000' height='700' frameborder='0' scrolling='no' marginheight='0' marginwidth='0' src='https://www.openstreetmap.org/export/embed.html?bbox=14.216136932373049%2C48.213692646648035%2C14.359474182128908%2C48.26548387425215&amp;layer=mapnik' ></iframe><br />";
                break;
    }
}
