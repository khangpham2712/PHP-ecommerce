
<?php
    include '../core/process.php';
    if(!checkAdmin()){
        header('Location: ../home');
    }
    include 'include/header.php';

    $hightlight = get_HightLight(0);
?>

<!-- highlights -->
<link rel="stylesheet" href="../assets/css/common.css">
<div class="container padding-top">
    <h2 class="title">Highlights</h2>
</div>
<?php
        // array("Mac")
        for ($i = 15; $i <= 18; $i++) {
            $hightlight = get_HightLight($i);
            if ($hightlight->num_rows != 0) {
    ?>
<div class="container">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php
            $idx = -1;
            while($row = $hightlight->fetch_array(MYSQLI_BOTH)) {
              $url = $row['url1'];
              $name = $row['name'];
              $id = $row['productId'];
              $des = $row['des'];
              $idx++;
            ?>
            <a href="product.php?id=<?php echo $id ?>" style="text-decoration: none">
                <div class="carousel-item <?php echo ($idx == 0)? "active": ""; ?>">
                    <img class="d-block w-30" src=<?php echo $url ?> height="300" style="margin: auto;">
                    <p style="height: 150px;"></p>
                    <div class="carousel-caption d-none d-md-block" style="text-align: center;">
                        <h2 class="black">
                            <?php echo $name ?>
                        </h2>
                        <a href="product.php?id=<?php echo $id ?>" class="btn btn-carousel-dark" style="width: 30%;">Detail</a>
                    </div>
                </div>
            </a>
            <?php } ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <!-- <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: black;"></span> -->
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angles-left" class="svg-inline--fa fa-angles-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" style="color: black; width: 35px"><path fill="currentColor" d="M77.25 256l137.4-137.4c12.5-12.5 12.5-32.75 0-45.25s-32.75-12.5-45.25 0l-160 160c-12.5 12.5-12.5 32.75 0 45.25l160 160C175.6 444.9 183.8 448 192 448s16.38-3.125 22.62-9.375c12.5-12.5 12.5-32.75 0-45.25L77.25 256zM269.3 256l137.4-137.4c12.5-12.5 12.5-32.75 0-45.25s-32.75-12.5-45.25 0l-160 160c-12.5 12.5-12.5 32.75 0 45.25l160 160C367.6 444.9 375.8 448 384 448s16.38-3.125 22.62-9.375c12.5-12.5 12.5-32.75 0-45.25L269.3 256z"></path></svg>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <!-- <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: black;"></span> -->
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angles-right" class="svg-inline--fa fa-angles-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" style="color: black; width: 35px"><path fill="currentColor" d="M246.6 233.4l-160-160c-12.5-12.5-32.75-12.5-45.25 0s-12.5 32.75 0 45.25L178.8 256l-137.4 137.4c-12.5 12.5-12.5 32.75 0 45.25C47.63 444.9 55.81 448 64 448s16.38-3.125 22.62-9.375l160-160C259.1 266.1 259.1 245.9 246.6 233.4zM438.6 233.4l-160-160c-12.5-12.5-32.75-12.5-45.25 0s-12.5 32.75 0 45.25L370.8 256l-137.4 137.4c-12.5 12.5-12.5 32.75 0 45.25C239.6 444.9 247.8 448 256 448s16.38-3.125 22.62-9.375l160-160C451.1 266.1 451.1 245.9 438.6 233.4z"></path></svg>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
<?php if ($i != 18) { ?>
<hr style="width:50%; border-top: 1px solid #9e9e9e">
<?php } ?>
<p style="height: 50px;"></p>
<?php 
            }
        }
    ?>
<!-- end highlights -->

<?php
    include 'include/footer.php';
?>