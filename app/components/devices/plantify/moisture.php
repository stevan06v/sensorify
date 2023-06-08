<style>
    #moistureProgress {
        width: 5vw;
        background-color: #ddd;
        height: 25vh;
        border-radius: 10px;
        transform: rotate(180deg);
    }

    #moistureBar {
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

    #moisturePlugIn {
        display: flex;
    }

    #moistureProperties {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 25vh;
        margin-left: .5vw;
    }
</style>



<div id="moisturePlugIn">
    <div id="moistureProgress">
        <div id="moistureBar">reading...</div>
    </div>
    <div id="moistureProperties">
        <div id="maxVal">100 %</div>
        <div id="minVal">0 %</div>
    </div>
</div>


<script>
    // in secs
    let requestBreak = 5; 
    let moistureBefore = 0;
    let hasReadOnce = false;
    let moistureBar = document.getElementById("moistureBar");

    setInterval(() => {
        fetch("http://192.168.0.184/moisture")
            .then((res) => {
                return res.json()
            })
            .then((data) => {

                let moisture = data.moisture;

                moistureBar.innerHTML = `${moisture} %`;

                if (hasReadOnce) {
                    // reading after is bigger than reading before
                    if (moisture > moistureBefore) {
                        moveUp(moistureBefore, moisture);
                        moistureBefore = moisture;
                    } else {
                        moveDown(moisture, moistureBefore);
                        moistureBefore = moisture;
                    }
                } else {
                    moveUp(0, moisture);

                    moistureBefore = moisture;
                    hasReadOnce = true;
                }
            })

            .catch((err) => {
                console.log(err);
            })
    }, requestBreak * 1000);

    function moveUp(from, to) {
        var i = 0;
        if (i == 0) {
            i = 1;

            moistureBar.style.height = from + "%"

            var height = 1;
            var id = setInterval(frame, 10);

            function frame() {
                if (height >= to) {
                    clearInterval(id);
                    i = 0;
                } else {
                    height++;
                    moistureBar.style.height = height + "%";
                }
            }
        }
    }

    function moveDown(from, to) {
        var i = 0;
        if (i == 0) {
            i = 1;

            moistureBar.style.height = from + "%";
            var height = from;

            var id = setInterval(frame, 10);

            function frame() {
                if (height <= to) {
                    clearInterval(id);
                    i = 0;
                } else {
                    height--;
                    moistureBar.style.height = height + "%";
                }
            }
        }
    }
</script>