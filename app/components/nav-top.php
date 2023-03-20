
<style>

#nav-top
{
    display: flex;
    justify-content: space-between;
    width: max-content;
    align-items: center;
    background-color: white;
    z-index: 5;
}
.nav-item{
    /* background-color: #1a8766; */
    padding-top: 1.5vw;
    padding-bottom: 1.5vw;
    margin-right:2.2vw ;
    padding-top: 2vh;
    padding-bottom: 2vh;
    cursor: pointer;
    color: hsla(0, 0%, 0%, 0.7);
    font-family: ExtraBold;
    text-decoration: none;
}

</style>
<div id="nav-top">
    <?php
    
    $navItems =  array("DEFAULT","TRAFFIC","BICYCLE");
    $links = array("./home.php?content=map&type=default",
    "./home.php?content=map&type=traffic",
    "./home.php?content=map&type=bicycle");


    for ($i=0; $i < 3; $i++) { 
        echo "<a href='". $links[$i] ."' class='nav-item'>". strtoupper($navItems[$i]) ."</a>";
    }
    
        
        
    ?>
</div>