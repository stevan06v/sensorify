<style>
    .config_box {
        padding: .8vw;
        box-shadow: 0px 0px 1px 0px rgba(0, 0, 0, 0.52);
        border-radius: 10px;
        cursor: pointer;
    }

    #config_grid {
        display: grid;
        grid-template-columns: auto auto auto auto;
        gap: 1vw;
        justify-content: center;
        align-items: center;
    }

    code{
        max-width: 20vw;
    } 
    .config-image {
        width: 7vw;
    }
</style>

<div class="sub-page-box">

    <?php
    
    if (!isset($_SESSION["config-selection"])) {
        $_SESSION["config-selection"] = "";
    }

    if (isset($_GET['config-selection'])) {
        $_SESSION["config-selection"] = $_GET['config-selection'];
        include($_GET['config-selection']);
    } else {

        $previews = array(
            './components/config-generators/img/json.svg',
            './components/config-generators/img/in-progress.svg',
            './components/config-generators/img/in-progress.svg',
            './components/config-generators/img/in-progress.svg',
            './components/config-generators/img/in-progress.svg',
            './components/config-generators/img/in-progress.svg',
            './components/config-generators/img/in-progress.svg',
            './components/config-generators/img/in-progress.svg'
        );
        $configs = array(
            './components/config-generators/capacitive-soil-generator.php',
            './components/config-generators/capacitive-soil-generator.php',
            './components/config-generators/capacitive-soil-generator.php',
            './components/config-generators/capacitive-soil-generator.php',
            './components/config-generators/capacitive-soil-generator.php',
            './components/config-generators/capacitive-soil-generator.php',
            './components/config-generators/capacitive-soil-generator.php',
            './components/config-generators/capacitive-soil-generator.php'
        );
        $names = array(
            'Capacitive-soil-sensor',
            'In progress...',
            'In progress...',
            'In progress...',
            'In progress...',
            'In progress...',
            'In progress...',
            'In progress...'
        );
        echo '
            <h3 class="sub-page-header">
                Choose your config-generator:
            </h3>
            ';

        echo '<div id="config_grid">';
        for ($i = 0; $i < sizeof($previews); $i++) {
            echo '
                <a class="config_box" href="./home.php?content=config&config-selection=' . $configs[$i] . '">
                    <img class="config-image" src="' . $previews[$i] . '" alt="' . $previews[$i] . '">
                </a>
                ';
        }

        echo '</div>';
    }



    ?>


</div>