<style>
    #humidityProgress {
        width: 5vw;
        background-color: #ddd;
        height: 25vh;
        border-radius: 10px;
        transform: rotate(180deg);
    }

    #humidityBar {
        height: 1%;
        height: 30px;
        background-color: #1a8766;
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
    }

    #humidityProperties {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 25vh;
        margin-left: .5vw;
    }

    #temperatureProgress {
        width: 5vw;
        background-color: #ddd;
        height: 25vh;
        border-radius: 10px;
        transform: rotate(180deg);
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
    }

    #temperatureProperties {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 25vh;
        margin-left: .5vw;
    }
</style>




<div id="temperaturePlugIn">
    <div id="temperatureProgress">
        <div id="temperatureBar">reading...</div>
    </div>
    <div id="temperatureProperties">
        <div id="maxVal">50 °C</div>
        <div id="minVal">0 °C</div>
    </div>
</div>


<div id="humidityPlugIn">

    <div id="humidityProgress" class="humidityProperties">
        <div id="maxVal">100 %</div>
        <div id="humidityBar">reading...</div>
    </div>

    <div id="humidityProperties">

        
    </div>

</div>


<script>
    let humidityBefore = 0;
    let temperatureBefore = 0;
    let hasReadOnce = false;
    let temperatureBar = document.getElementById("temperatureBar");
    let humidityBar = document.getElementById("humidityBar");



    setInterval(() => {
        fetch("http://192.168.0.184/dht11")
            .then((res) => {
                return res.json()
            })
            .then((data) => {

                let humidity = data.humidity;
                let actualTemperature = data.temperature;
                let temperature = calcTemperaturePercentage(actualTemperature);

                temperatureBar.innerHTML = `${actualTemperature} °C`;
                humidityBar.innerHTML = `${humidity} %`;

                if (hasReadOnce) {
                    // reading after is bigger than reading before
                    if (humidity > humidityBefore) {
                        moveUp(humidityBefore, humidity, humidityBar);
                        moveUp(temperatureBefore, temperature, temperatureBar);

                        humidityBefore = humidity;
                        temperatureBefore = temperature;
                    } else {
                        moveDown(humidity, humidityBefore, humidityBar);
                        moveDown(temperature, temperatureBefore, temperatureBar);

                        temperatureBefore = temperature;
                        humidityBefore = humidity;
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
    }, 1000);


    function calcTemperaturePercentage(currentTemp) {
        let maxTemp = 50;
        let minTemp = 0;

        return (maxTemp - currentTemp) * 100 / (maxTemp - minTemp);
    }

    function moveUp(from, to, elem) {
        var i = 0;
        if (i == 0) {
            i = 1;

            elem.style.height = from + "%"

            var height = 1;
            var id = setInterval(frame, 10);

            function frame() {
                if (height >= to) {
                    clearInterval(id);
                    i = 0;
                } else {
                    height++;
                    elem.style.height = height + "%";
                }
            }
        }
    }

    function moveDown(from, to, elem) {
        var i = 0;
        if (i == 0) {
            i = 1;

            elem.style.height = from + "%";
            var height = from;

            var id = setInterval(frame, 10);

            function frame() {
                if (height <= to) {
                    clearInterval(id);
                    i = 0;
                } else {
                    height--;
                    elem.style.height = height + "%";
                }
            }
        }
    }
</script>