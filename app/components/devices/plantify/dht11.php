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
        margin: auto;
    }

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

    #minVal {
        text-align: center;
        font-family: BoldItalic;
        color: black;

    }

    #maxVal {
        text-align: center;
        font-family: BoldItalic;
        color: black;
    }

    #dht-sensor {
        display: grid;
        grid-template-columns: auto auto;
        gap: 2vw;
    }
</style>

<div id='dht-sensor'>
    <div id='temperaturePlugIn'>
        <div id='maxVal'>50 °C</div>
        <div id='temperatureProgress'>
            <div id='temperatureBar'>...</div>
        </div>
        <div id='minVal'>0 °C</div>
    </div>

    <div id='humidityPlugIn'>
        <div id='maxVal'>100 %</div>
        <div id='humidityProgress'>
            <div id='humidityBar'>...</div>
        </div>
        <div id='minVal'>0 %</div>
    </div>
</div>

<?php echo "
<script>
    // in seconds
    let requestBreak = 5;
    let humidityBefore = 0;
    let temperatureBefore = 0;
    let hasReadOnce = false;
    let temperatureBar = document.getElementById('temperatureBar');
    let humidityBar = document.getElementById('humidityBar');

    setInterval(() => {
        fetch('http://" . $ip_address . "/dht11')
            .then((res) => {
                return res.json()
            })
            .then((data) => {
                let humidity = data.humidity;
                let actualTemperature = data.temperature;

                let temperature = calcTemperaturePercentage(actualTemperature);

                temperatureBar.innerHTML = actualTemperature + '°C';
                humidityBar.innerHTML = humidity + '%';


                if (hasReadOnce) {

                    // reading after is bigger than reading before
                    if (humidity > humidityBefore) {
                        moveUp(humidityBefore, humidity, humidityBar);
                        humidityBefore = humidity;
                    } else {
                        moveDown(humidityBefore, humidity, humidityBar);
                        humidityBefore = humidity;
                    }

                    // temperature
                    if (temperature > temperatureBefore) {
                        moveUp(temperatureBefore, temperature, temperatureBar);
                        temperatureBefore = temperature;
                    } else {
                        moveDown(temperatureBefore, temperature, temperatureBar);
                        temperatureBefore = temperature;
                    }

                } else {
                    moveUp(0, humidity, humidityBar);
                    moveUp(0, temperature, temperatureBar);

                    humidityBefore = humidity;
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

    function moveUp(from, to, elem) {
        var i = 0;
        if (i == 0) {
            i = 1;
            elem.style.height = from + '%'
            var height = 1;
            var id = setInterval(frame, 10);

            function frame() {
                if (height >= to) {
                    clearInterval(id);
                    i = 0;
                } else {
                    height++;
                    elem.style.height = height + '%';
                }
            }
        }
    }

    function moveDown(from, to, elem) {
        var i = 0;
        if (i == 0) {
            i = 1;
            elem.style.height = from + '%';
            var height = from;
            var id = setInterval(frame, 10);

            function frame() {
                if (height <= to) {
                    clearInterval(id);
                    i = 0;
                } else {
                    height--;
                    elem.style.height = height + '%';
                }
            }
        }
    }
</script>
";
?>