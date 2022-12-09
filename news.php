<?php
    include "./core/auth.php";
    if(checkLogin()){
      include "include/header.php";
    }
    else{
      include "include/header_notlogin.php";
    }
?>
<link rel="stylesheet" href="./assets/css/common.css">
<div class="container about-ctn padding-top">
<h2 class="title">News</h2>

    <section class="about">
        <div class="row three-cards">
            <h3 class="d-block"><a target="blank" href="https://www.apple.com/newsroom/2021/11/the-reimagined-apple-the-grove-now-open-in-los-angeles/">The reimagined Apple The Grove now open in Los Angeles</a></h3>
            <p class="text-justify">
                The entirely new Apple The Grove opened this Friday, November 19, at the popular shopping destination in Los Angeles. Located in the heart of the open-air plaza, the brand new store is nearly twice the size of the original building and was redesigned to be a new gathering place for the Los Angeles community to discover Apple’s products and services, get support, and participate in free Today at Apple sessions or popular Photo Walks at The Grove...
                <a target="blank" href="https://www.apple.com/newsroom/2021/11/the-reimagined-apple-the-grove-now-open-in-los-angeles/">Read more</a>
            </p>
        </div>
        <div class="row three-cards">
            <h3 class="d-block"><a target="blank" href="https://www.apple.com/newsroom/2021/11/apple-announces-self-service-repair/">Apple announces Self Service Repair</a></h3>
            <p class="text-justify">
                CUPERTINO, CALIFORNIA Apple today announced Self Service Repair, which will allow customers who are comfortable with completing their own repairs access to Apple genuine parts and tools. Available first for the iPhone 12 and iPhone 13 lineups, and soon to be followed by Mac computers featuring M1 chips, Self Service Repair will be available early next year in the US and expand to additional countries throughout 2022. Customers join more than 5,000 Apple Authorized Service Providers (AASPs) and 2,800 Independent Repair Providers who have access to these parts, tools, and manuals...
                <a target="blank" href="https://www.apple.com/newsroom/2021/11/apple-announces-self-service-repair/">Read more</a>
            </p>
        </div>

        <div class="row three-cards">
            <h3 class="d-block"><a target="blank" href="https://www.apple.com/newsroom/2021/11/disney-melee-mania-coming-this-december-exclusively-on-apple-arcade/">“Disney Melee Mania” coming this December exclusively on Apple Arcade</a></h3>
            <p class="text-justify">
                Apple’s breakthrough gaming service delivers the ultimate family-friendly gaming destination with more than 200 games for players to enjoy this holiday season, including “LEGO Star Wars: Castaways” and “NBA 2K22 Arcade Edition”
            </p>
            <p class="text-justify">
                Apple today announced “Disney Melee Mania” from Mighty Bear Games will be joining the more than 200 incredibly fun games on its popular gaming subscription service, Apple Arcade. Players will join forces in rumble-ready teams featuring iconic and fan-favorite Disney1 and Pixar1 characters, who will duke it out in a dazzling, never-before-seen virtual arena. From Wreck-It Ralph, Elsa, and Mickey Mouse to Frozone, Moana, and Buzz Lightyear, each player will choose their unique holographic hero to battle in 3v3 matches with friends and foes as they vie to become the ultimate Disney champions...
                <a target="blank" href="https://www.apple.com/newsroom/2021/11/disney-melee-mania-coming-this-december-exclusively-on-apple-arcade/">Read more</a>
            </p>
        </div>
    </section>
</div>

<?php
    include 'include/footer.php';
?>