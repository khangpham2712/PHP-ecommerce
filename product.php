<?php
    include './core/process.php';
    $USER = 0;
    if(checkLogin()){
        if(checkAdmin()) {
          header('Location: admin/product-list');
        }
        else {
          include "include/header.php";   
          $USER = 1;
        }
             
    }
    else{
        include "include/header_notlogin.php";
    }


    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $conn = newConnection();
        $query = "SELECT * FROM Products WHERE productId=".$id;
        $result = $conn->query($query);
        $product = $result->fetch_array(MYSQLI_BOTH);
        $name = $product['name'];
        $price = $product['price'];
        $des = $product['des'];
        $url1 = $product['url1'];
        $url2 = $product['url2'];
        $url3 = $product['url3'];
        $url4 = $product['url4'];
        $id = $product['productId'];


        $conn->close();
    }
    else {
        header('Location: product-list');
    }

?>
</body>
<link rel="stylesheet" href="./assets/css/common.css">
<body style="margin-top: -25px; padding: 0; font-family: Roboto, sans-serif;">
<div class="container container-product padding-top">
    <h2 class="title">Product info</h2>
    <div id="toast"></div>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
            <img src=<?php echo "$url1"; ?> id="img1" class="img-large img-focus" alt="" height="500px">
            <img src=<?php echo "$url1"; ?> id="img2" class="img-small col-md-3" alt="">
            <img src=<?php echo "$url2"; ?> id="img3" class="img-small col-md-3" alt="">
            <img src=<?php echo "$url3"; ?> id="img4" class="img-small col-md-3" alt="">
            <img src=<?php echo "$url4"; ?> id="img5" class="img-small col-md-3" alt="">
            </div>
        </div>
        <div class="col-md-6">
            <div class="info-product">
                <div class="name-product">
                    <?php echo $name; ?>
                </div>
                <div class="description">
                    <?php echo $des; ?>
                </div>
                <div class="price-product">
                    <?php echo number_format($price, 0, '' ,'.'); ?> ₫
                </div>
                <div class="rate">
                    <span class="rate-title">Rating:</span>
                    <span class="star">
                        <span style="margin-right: 5px;">
                            <?php echo $product['rate']; ?>
                        </span>
                        <i class='fa fa-star'></i>

                    <span class="quantity-rate">(<?php echo $product['rateQuantity']; ?>)</span>
                    </span>
                </div>
                
                <?php
                    if($USER == 1) {
                ?>
                    <form action="core/add_to_cart.php" method="POST">
                        <label for="quantity">Input quantity:</label>
                        <input type="number" name="quantity" id="quantity" value="1" class="quantity" min="1">
                        <br>
                        <input type="hidden" name="id" value=<?php echo "'$id'"; ?>>
                        <input class="btn btn-primary btn-add-to-cart" style="width: 50%;" type="submit" value="Add to cart"></input>
                    </form>
                <?php 
                    }
                    else if ($USER == 0) {
                ?>
                        <a class="btn btn-primary btn-add-to-cart" id="add-to-cart" style="width: 50%;">Add to cart</a>
                <?php
                    }
                    else if($USER == 2){
                ?>
                    <a class="btn btn-primary btn-add-to-cart" type="submit" href=<?php echo "'edit_product.php?id=$id'"; ?>>Edit</a>
                <?php
                    }
                ?>
                
            </div>
        </div>
    </div> 
</div>

<input type="hidden" name="id" id="id" value=<?php echo "$id"; ?>>
<?php if($USER > 0) { ?>
<div class="container">
    <?php if($USER == 1) { ?>
    <div class="row">
        <div class="feedback">
            <section class='rating-widget'>
                <h5 class="rate-title">Rating:</h5>
                <div class='rating-stars text-center'>
                    <ul id='stars'>
                        <li class='star' title='Poor' data-value='1'>
                            <i class='fa fa-star fa-fw'></i>
                        </li>
                        <li class='star' title='Fair' data-value='2'>
                            <i class='fa fa-star fa-fw'></i>
                        </li>
                        <li class='star' title='Average' data-value='3'>
                            <i class='fa fa-star fa-fw'></i>
                        </li>
                        <li class='star' title='Good' data-value='4'>
                            <i class='fa fa-star fa-fw'></i>
                        </li>
                        <li class='star' title='Excellent' data-value='5'>
                            <i class='fa fa-star fa-fw'></i>
                        </li>
                    </ul>
                </div>
                
                <button class="btn btn-primary" id="send-rating" style="display: block;">Send Rating</button>
            </section>
            <div class="success-box" style="margin-top: 10px">
                <div class='clearfix'></div>
                <div class='text-message'></div>
                <div class='clearfix'></div>
            </div>
        </div>
    </div>
    <?php } ?>
    <br>
    <div class="row">
        <h5 class="rate-title">Comment:</h5>
        <div class="comment" id="comment-box" style="margin-top: 0px;">
            <div class="form-group">
                <textarea name="cmt" id="cmt" rows="5" class="form-control" placeholder="Write your comment..."></textarea>
            </div>
            <button class="btn btn-primary" id="send-cmt">Send comment</button>

        </div>
    </div>
    
</div>

<?php } ?>
<div class="container">
    <div class="row">
        <div class="comment">
            <div class="cmt-item" id="cmt-item">
            </div>
        </div>
    </div>
</div>
<script src="./assets/js/product.js"></script>
<script>
    $(document).ready(() => {
        $("#add-to-cart").click(() => {
            showToast("Add to cart failed !", "Please login to add product to cart", "error", 3000);
            setTimeout(() => {window.location.href = "./login.php"}, 3000);
        });
        var id = parseInt($("#id").val(), 10);
        $("#cmt-item").load("comment.php?id=" + id);
    });
</script>

<?php
    include 'include/footer.php';
?>