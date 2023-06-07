<style>
    #main-flex {
        display: flex;

    }
    .sub-page-box {
        box-shadow: -2px -1px 25px -10px rgba(0, 0, 0, 0.75);
        border-radius: 12px;
        padding-top: 1vw;
        padding-left: 4vw;
        padding-right: 4vw;
        padding-bottom: 2vw;
        margin: auto;
        overflow-y: auto;
        height: auto;
        max-height:80vh;
    }

    .sub-page-headerBox {}

    .sub-page-header {
        color: black;
        font-size: 2rem;
        font-family: Black-Pure;
        border-bottom: 3px solid #1a8766;

    }

    #content-box {}
</style>

<div id="main-flex">
    <?php
        include("./components/sidebar.php");
    ?>
    <?php
        include("./components/content.php");
    ?>


</div>