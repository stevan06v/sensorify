<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
        margin-bottom: 0;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .2s;
        transition: .2s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .2s;
        transition: .2s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>


<?php

require_once "./classes/model/Device.class.php";

$devices = array();


for ($i = 0; $i < sizeof($devices); $i++) {

    echo "
    <div class='sub-page-box'>

        <label class='switch'>
            <input type='checkbox' id='mySwitchButton'>
            <span class='slider round'></span>
        </label>

        <form id='myForm' method='GET' style='display:none;'>
            <input type='hidden' name='switchState' id='switchState'>
        </form>

        <div id='switchStateOutput'></div>
    </div>
    ";
}

?>

<script>
    let switchButton = document.getElementById("mySwitchButton");
    let form = document.getElementById("myForm")
    let switchStateOutput = document.getElementById("switchStateOutput");

    switchButton.addEventListener("change", function() {
        let switchState = switchButton.checked ? "on" : "off";
        console.log(switchState);
        fetch("home.php?content=devices&state=" + switchState)
            .then(response => {
                response.json()
            })
            .then(data => {
                console.log(data);
                switchStateOutput.innerHTML = "State: " + data.state;
            })
            .catch(error => console.error(error));
    });
</script>


<?php
if (isset($_GET['state'])) {

    $switchState = $_GET["state"];

    $response = array("state" => true);

    echo json_encode($response);
}


include("./components/devices/plantify/humidity.php");
include("./components/devices/plantify/temperature.php");





?>