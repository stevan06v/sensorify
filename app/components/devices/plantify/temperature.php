<style>
    #temperatureProgress {
        width: 5vw;
        background-color: #ddd;
        height: 25vh;
        border-radius: 10px;
        transform: rotate(180deg);
        margin: auto;
    }

    #temperatureBar {
        height: 1%;
        height: 30px;
        background-color: #f4e027;
        border-radius: 10px;
        transform: rotate(180deg);
        text-align: center;
        margin: auto;
        padding: 1vw;
        font-family: BoldItalic;
        color: black;
        font-size: 1rem;

    }

    #temperaturePlugIn {
        display: flex;
        flex-direction: column;
        margin: auto;
    }

    #temperatureProperties {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
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



<div id='temperaturePlugIn'>
    <div id='maxVal'>50 °C</div>
    <div id='temperatureProgress'>
        <div id='temperatureBar'>...</div>
    </div>
    <div id='minVal'>0 °C</div>
</div>

<?php
echo "
<script>
    // in seconds
    let requestBreak = 5;
    let temperatureBefore = 0;
    let hasReadOnce = false;
    let temperatureBar = document.getElementById('temperatureBar');


    setInterval(() => {
        fetch('http://".$ip_address."/temperature')
            .then((res) => {
                return res.json()
            })
            .then((data) => {

                let actualTemperature = data.temperature;

                temperatureBar.innerHTML = actualTemperature + '°C';

                let temperature = calcTemperaturePercentage(actualTemperature);

                if (hasReadOnce) {
                    // reading after is bigger than reading before
                    if (temperature > temperatureBefore) {
                        moveUp(temperatureBefore, temperature);
                        temperatureBefore = temperature;
                    } else {
                        moveDown(temperature, temperatureBefore);
                        temperatureBefore = temperature;
                    }
                } else {
                    moveUp(0, temperature);

                    temperatureBefore = temperature;
                    hasReadOnce = true;
                }
            })
            .catch((err) => {
                console.log(err);
            })
    }, requestBreak * 1000);

    function calcTemperaturePercentage(currentTemp) {
        let maxTemp = 50;
        let minTemp = 0;

        return (maxTemp - currentTemp) * 100 / (maxTemp - minTemp);
    }

    function moveUp(from, to) {
        var i = 0;
        if (i == 0) {
            i = 1;

            temperatureBar.style.height = from + '%';
            var height = 1;
            var id = setInterval(frame, 10);

            function frame() {
                if (height >= to) {
                    clearInterval(id);
                    i = 0;
                } else {
                    height++;
                    temperatureBar.style.height = height + '%';
                }
            }
        }
    }

    function moveDown(from, to) {
        var i = 0;
        if (i == 0) {
            i = 1;

            temperatureBar.style.height = from + '%';
            var height = from;

            var id = setInterval(frame, 10);

            function frame() {
                if (height <= to) {
                    clearInterval(id);
                    i = 0;
                } else {
                    height--;
                    temperatureBar.style.height = height + '%';
                }
            }
        }
    }
</script>
";?>