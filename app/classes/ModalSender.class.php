<?php
class ModalSender{
    function triggerModal($head,$message){
        echo '
         <script>
                window.addEventListener("load", function () {
                    PopupEngine.createModal({
                        heading: "'. $head .'",
                        text: "'. $message .'",
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
}