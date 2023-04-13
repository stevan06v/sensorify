<style>
    .popupEngineNotification {
        box-shadow: -2px -1px 15px -10px rgba(0, 0, 0, 0.75);
        font-family: BlackItalic;
        color: black;
        background-color: white;
        gap: 2vw;
        border: 3px solid #1a8766;
        border-radius: 7px;
        padding: 1vw;
    }

    .popupEngineNotificationContainer {
        font-size: 1.3rem;
        
    }               

    .popupEngineNotificationText {
        font-size: 1.3rem;
    }

    .popupEngineModalContent {
        width: max-content;
        border-radius: 15px;
        color: black;
        background-color: white;
        box-shadow: -2px -1px 15px -10px rgba(0, 0, 0, 0.75);
        border: 5px solid #1a8766;
    }


    .popupEngineModalHeading {
        font-family: BlackItalic;
        font-size: 2rem;
    }

    .popupEngineModalText {
        font-family: MediumItalic;
        font-size: 1rem;
    }

</style>


<?php
class ModalSender
{
    function triggerModal($head, $message)
    {
        echo '
         <script>
                window.addEventListener("load", function () {
                    PopupEngine.createModal({
                        heading: "' . $head . '",
                        text: "' . $message . '",
                        buttons: [
                            {
                                text: "continue",
                                closePopup: true
                            }
                        ]
                    })
                })
            </script>
        ';
    }
    function triggerNotification($msg)
    {
        echo '
        <script>
        window.addEventListener("load", function () {
                PopupEngine.createNotification({
                    text: "' . $msg . '",
                    lifetime: 2_000,
                    position: ["bottom", "right"]
                })
            })
        </script>
        ';
    }
}
