
<?php

    include '../core/process.php';
    if(!checkAdmin()){
        header('Location: ../login');
    }
    include 'include/header.php';

    $id = NULL;
    $q = NULL;
    $price = NULL;
    if(isset($_GET['id'])) $id = $_GET['id'];
    if(isset($_GET['q'])) $q = $_GET['q'];
    if(isset($_GET['price'])) $price = $_GET['price'];
    $result = getAllProduct($id, $q, $price);


?>
<div class="container product-list-container" style="padding-top: 130px;">
    <a class="btn btn-primary more-button" href="add-product" style='margin-bottom: 15px;'>Add product</a>
    <div class="row">
        <?php include '../include/filter.php';?>

        <div class="col">
            <div class="row">
            
                <?php
                    if($result->num_rows==0){
                        echo "<i style='margin-left:20px;'>No products found.</i>";
                    }
                    else {
                    while($row = $result->fetch_array(MYSQLI_BOTH)){
                        $productId = $row['productId'];
                ?>
                    <div class='col-12 col-md-6 col-lg-4'>
                        <div class='card-product-list' style='margin-bottom: 20px'>
                            <a href=<?php echo "product.php?id=$productId"; ?>><img class='card-img-top' src=<?php $url = $row['url1']; echo "'$url'";?> alt='Card image cap' height="350px"></a>
                            <div class='card-body'>
                            <a style="text-decoration: none; color: black;" href=<?php echo "product.php?id=$productId"; ?> title='View Product'>
                                <h4 class='card-title'><?php echo $row['name'];?></h4>
                                <p class='card-text'><?php echo $row['des'];?></p>
                            </a>
                                <div class='row' style="margin-top: 15px;">
                                    <div class='col'>
                                        <div class='price-product-list'><?php echo number_format($row['price'], 0, '' ,'.'); ?> ₫</div>
                                    </div>
                                    <div class='col-md-5'>
                                        <a href=<?php echo "edit-product?id=$productId"; ?> class='btn btn-warning btn-block'>Edit</a>
                                        <a href=<?php echo "delete_product.php?id=$productId"; ?> class='btn btn-danger btn-block'>Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    } }
                ?>
            </div>
        </div>
    </div>
</div>

<?php
    include 'include/footer.php';
?>