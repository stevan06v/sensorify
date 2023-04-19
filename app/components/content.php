<?php

if (isset($_GET['content'])) {
    include("./components/". $_GET['content'] . ".php");
}
