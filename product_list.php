
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


    $id = NULL;
    $q = NULL;
    $price = NULL;
    $begin = NULL;
    if(isset($_GET['id'])) $id = $_GET['id'];
    if(isset($_GET['q'])) $q = $_GET['q'];
    if(isset($_GET['price'])) $price = $_GET['price'];
    
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    
    if($page=='' || $page==1){
        $begin = 0;
    }
    else{
        $begin = ($page-1)*6;
    }
    // if ($id != 0)
    $result = searchProduct($id, $q, $price, $begin);
    // else
        // $result = getAllProduct(0, $q, $price);
    

?>

<div class="container product-list-container" style="padding-top: 130px;">
    <div id="toast"></div>
    <div class="row">
        
        <?php include 'include/filter.php'; ?>

        <div class="col">
            <div class="row">
            
                <?php
                    if($result->num_rows==0){
                        echo "<i style='margin-left:20px;'>No product found.</i>";
                    }
                    else {
                    while($row = $result->fetch_array(MYSQLI_BOTH)) {
                        $productId = $row['productId'];
                ?>
                    <div class='col-12 col-md-6 col-lg-4'>
                        <div class='card-product-list' style='margin-bottom: 20px'>
                            <a href=<?php echo "product.php?id=$productId"; ?>><img class='card-img-top' src=<?php $url = $row['url1']; echo "'$url'";?> alt='Card image cap' height="350px"></a>
                            <div class='card-body'>
                                <a style="text-decoration: none; color: black;" href=<?php echo "product.php?id=$productId"; ?> title='View Product'>
                                    <h4 class='card-title'><?php echo $row['name'];?></h4>
                                    <p class='card-text'><?php echo $row['des'];?></p>
                                    <div class='row' style="margin-top: 15px;">
                                        <div class='col'>
                                            <div class='price-product-list'><?php echo number_format($row['price'], 0, '' ,'.'); ?> ₫</div>
                                        </div>
                                        <div class='col-md-5'>
                                        <?php
                                            if($USER == 1) {
                                        ?>
                                            <form action="core/add_to_cart.php" method="POST">
                                                <input hidden type="number" name="quantity" id="quantity" value="1" class="quantity" min="1">
                                                <input type="hidden" name="id" value=<?php echo "'$productId'"; ?>>
                                                <input class="btn btn-primary btn-add-to-cart" style="width: 100%; margin-top: 5px;" type="submit" value="Add to cart"></input>
                                            </form>
                                        <?php 
                                            }
                                            else if ($USER == 0) {
                                        ?>
                                                <a class="btn btn-primary btn-add-to-cart" id="add-to-cart" style="width: 100%; margin-top: 5px">Add to cart</a>
                                        <?php
                                            }
                                        ?>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php
                    } }
                ?>
            </div>
            <?php 
            if($result->num_rows!=0){
            ?>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item" id="btn-prev">
                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                    </li>
                    <?php
                    $params=getParams();
                    $all_product_with_id = getAllProduct($id, $q, $price);
                    $number_page = 0;
                    if ($q != null || $price != null)
                        $number_page = ceil($all_product_with_id->num_rows/6);
                    else
                        $number_page = ceil(countResult($id)/6);
                    for( $i=1; $i <= $number_page; $i++ ){
                        $params['page']=$i;
                        printf('<li class="page-item page-num" id="page-%1$d"><a class="page-link" href="?%2$s">%1$d</a></li>', $i, buildQuery( $params ));
                    }
                    ?>
                    <li class="page-item" id="btn-next">
                      <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
            <?php } ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(() => {
        var searchParam = new URLSearchParams(window.location.search);
        var id = searchParam.get("id");
        var page = searchParam.get("page");
        if (page == 1 || page == null) {
            $("#btn-prev").addClass("disabled");
        }
        if (page == $(".page-num").length || page == null) {
            $("#btn-next").addClass("disabled");
        }
        $("#page-" + page).addClass("disabled");
        $("#btn-next a").attr("href", `?id=${id}&page=${parseInt(page)+1}`);
        $("#btn-prev a").attr("href", `?id=${id}&page=${parseInt(page)-1}`);
        $("#add-to-cart").click(() => {
            showToast("Add to cart failed !", "Please login to add product to cart", "error", 3000);
            setTimeout(() => {window.location.href = "./login.php"}, 3000);
        });
    });
</script>

<?php
    include 'include/footer.php';
?>