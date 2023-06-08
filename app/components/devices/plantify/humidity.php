<style>
    #humidityProgress {
        width: 5vw;
        background-color: #ddd;
        height: 25vh;
        border-radius: 10px;
        transform: rotate(180deg);
        margin: auto;
    }

    #humidityBar {
        height: 1%;
        height: 30px;
        background-color: #008ffc;
        border-radius: 10px;
        transform: rotate(180deg);
        text-align: center;
        margin: auto;
        padding: 1vw;
        font-family: BoldItalic;
        color: black;
        font-size: 1rem;
    }

    #humidityPlugIn {
        display: flex;
        flex-direction: column;
        margin: auto;
    }

    #humidityProperties {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        font-family: BoldItalic;
        height: 25vh;
        margin-left: .5vw;
    }

    #minVal {
        text-align: center;
        font-family: BoldItalic;
    }

    #maxVal {
        text-align: center;
        font-family: BoldItalic;
    }
</style>


<div id='humidityPlugIn'>
    <div id='maxVal'>100 %</div>
    <div id='humidityProgress'>
        <div id='humidityBar'>...</div>
    </div>
    <div id='minVal'>0 %</div>
</div>

<?php
echo "
<script>
    // in secs
    let requestBreak = 5;
    let humidityBefore = 0;
    let hasReadOnce = false;
    let humidityBar = document.getElementById('humidityBar');


    setInterval(() => {
        fetch('http://" . $ip_address . "/humidity')
            .then((res) => {
                return res.json()
            })
            .then((data) => {

                let humidity = data.humidity;
                humidityBar.innerHTML = humidity + '%';

                if (hasReadOnce) {
                    // reading after is bigger than reading before
                    if (humidity > humidityBefore) {
                        moveUp(humidity);
                        humidityBefore = humidity;
                    } else {
                        moveDown(humidity, humidityBefore);
                        humidityBefore = humidity;
                    }
                } else {
                    moveUp(humidity);

                    humidityBefore = humidity;
                    hasReadOnce = true;
                }
            })
            .catch((err) => {
                console.log(err);
            })
    }, requestBreak * 1000);

    function moveUp(to) {
        var i = 0;
        if (i == 0) {
            i = 1;
            var height = 1;
            var id = setInterval(frame, 10);

            function frame() {
                if (height >= to) {
                    clearInterval(id);
                    i = 0;
                } else {
                    height++;
                    humidityBar.style.height = height + '%';
                }
            }
        }
    }
    
    function moveDown(from, to) {
        var i = 0;
        if (i == 0) {
            i = 1;

            humidityBar.style.height = from + '%';
            var height = from;

            var id = setInterval(frame, 10);

            function frame() {
                if (height <= to) {
                    clearInterval(id);
                    i = 0;
                } else {
                    height--;
                    humidityBar.style.height = height + '%';
                }
            }
        }
    }
</script>
";
?>