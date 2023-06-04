<style>
    #grid-box {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 2vw;
    }

    code {
        font-size: 15px;
        width: 40vw;
    }

    .sub-page-header {}

    .input2 {
        margin-bottom: .5vh;
        outline: none;
        padding: .5vw;
        border-radius: 5px;
        font-family: BoldItalic;
        color: #000;
        border: 1px solid #1a876667;
        font-size: 15px;
    }

    #download {
        width: 10vw;
        opacity: .5;
        cursor: pointer;
        transition: ease 1s opacity;
    }

    #download:hover {
        opacity: 1;
    }
</style>

<h3 class="sub-page-header">
    Configure your device:
</h3>



<div id="grid-box">

    <div id="config-box">

        <?php

        if (isset($_POST['download'])) {

            # json-path
            $path = "./generated-configs/config.json";

            # get post-req-data
            $ssid = $_POST['ssid'];
            $psk = $_POST['psk'];
            $server = $_POST['server'];
            $port = $_POST['port'];

            # create json obj
            $json_obj = new stdClass();

            # assign values
            $json_obj->ssid = $ssid;
            $json_obj->psk = $psk;
            $json_obj->server = $server;
            $json_obj->port = $port;

            # json to string
            $json_str = json_encode($json_obj);

            if (file_exists($path)) {
                file_put_contents($path, $json_str);
                $modal_sender->triggerNotification("Downloading config.json...");

                echo "
                    <script defer>
                            window.addEventListener('load', function () {
                                let fileToDownload = document.getElementById('file-to-download');
                                fileToDownload.href = '$path';
                                fileToDownload.click();
                                })
                    </script>
                ";

                
            } else {
                $modal_sender->triggerModal("JSON-error", "There is no config.json file!");
            }
        }

        echo '
        <form action="./home.php?content=config&config-selection=' . $_SESSION["config-selection"] . '" method="post">

            <input type="text" name="ssid" id="ssid" placeholder="SSID" class="input2"><br>
            <input type="text" name="psk" id="psk" placeholder="Wlan password" class="input2"><br>
            <input type="text" name="server" id="server" placeholder="Server IP-Address" class="input2"><br>
            <input type="text" name="port" id="port" placeholder="Port" class="input2">
            
            <a style="display:none;" id="file-to-download" href="./test" download></a>
            <input style="display:none;" type="submit" value="download" name="download" id="actual-download">
        </form>';

        ?>
    </div>


    <div id="json-box">

        <pre>
            <code id="display-json" class="language-json">

            </code>
        </pre>

    </div>

    <img id="download" src="./components/config-generators/img/download.svg" alt="download">

</div>

<script>
    let download = document.getElementById('download');
    let actualDownload = document.getElementById('actual-download');
    let ssidElem = document.getElementById('ssid');
    let pskElem = document.getElementById('psk');
    let serverElem = document.getElementById('server');
    let portElem = document.getElementById('port');


    let displayJson = document.getElementById('display-json');

    renderJSON();

    function renderJSON() {
        let code = `{\n   "ssid": "",\n   "psk": "",\n   "server": "",\n   "port":""\n}`;
        displayJson.innerHTML = code;

        let ssid = "";
        let psk = "";
        let server = "";
        let port = "";

        let elements = [ssidElem, pskElem, serverElem, portElem];

        elements.forEach(iterator => {
            iterator.addEventListener("keyup", () => {
                ssid = ssidElem.value;
                psk = pskElem.value;
                server = serverElem.value;
                port = portElem.value;

                let code = `{\n   "ssid": "${ssid}",\n   "psk": "${psk}",\n   "server": "${server}",\n   "port":"${port}"\n}`;
                displayJson.innerHTML = code;

                // start highlight js
                hljs.highlightAll();
            });
        });

        download.addEventListener("click", () => {
            if (ssidElem.value != "" && pskElem.value != "" && serverElem.value != "" && portElem.value != "") {
                actualDownload.click();
            } else {
                PopupEngine.createModal({
                    heading: "JSON-error",
                    text: "There are empty fields!",
                    buttons: [{
                        text: "continue",
                        closePopup: true
                    }]
                })
            }
        })
        // start highlight js
        hljs.highlightAll();
    }
</script>
