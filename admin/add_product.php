<?php 

    include '../core/process.php';
    if(!checkAdmin()){
        header('Location: ../login');
    }
    
    $correctPrice = true;
    $correctName = true;
    $correctUrl1 = true;
    $correctUrl2 = true;
    $correctUrl3 = true;
    $correctUrl4 = true;
    $success = true;

    
    $name = '';
    $price = '';
    $des = '';
    $url1 = '';
    $url2 ='';
    $url3 = '';
    $url4 = '';

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $des = $_POST['des'];
        $url1 = $_POST['url1'];
        $url2 = $_POST['url2'];
        $url3 = $_POST['url3'];
        $url4 = $_POST['url4'];
        $type = $_POST['type'];

        if($url2=='') $url2 = $url1;
        if($url3=='') $url3 = $url1;
        if($url4=='') $url4 = $url1;

        $price = round($price, 2);

        $conn = newConnection();
        $query = "INSERT INTO `Products` (`name`, `price`, `des`, `url1`, `url2`, `url3`, `url4`, `type`) VALUES ('$name', $price, '$des', '$url1', '$url2', '$url3', '$url4', $type)";
        $result = $conn->query($query);
        if($result){
            header("Location: product-list");
        }
        else{
            $success = false;
        }
        $conn->close();
    }

    include 'include/header.php';

    

?>
<link rel="stylesheet" href="../assets/css/common.css">
<div class="container padding-top">
    <h2 class="title">Add product</h2>
    <form action="" method="POST" id="edit-product">
        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" type="text" name="name" id="name" placeholder="Product name..." required value=<?php echo "'$name'"; ?>>
            <div><small class='log-fail' id='log-name'></small></div>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <div class="input-group mb-4">
                <div class="input-group-prepend">
                <div class="input-group-text">₫</div>
                </div>
                <input type="text" class="form-control" name="price" id="price" placeholder="Product price..." required value=<?php echo "$price"; ?>>
                
            </div>
            <div><small class='log-fail' id='log-price'></small></div>
        </div>
        <div class="form-group">
            <label for="image1">Image 1</label>
            <input type="text" class="form-control" name="url1" id="url1" placeholder="Link of 1st image..." required value=<?php echo "'$url1'"; ?>>
        </div>
        <div class="form-group">
            <label for="image2">Image 2</label>
            <input type="text" class="form-control" name="url2" id="url2" placeholder="Link of 2nd image..." value=<?php echo "'$url2'"; ?>>
        </div>
        <div class="form-group">
            <label for="image3">Image 3</label>
            <input type="text" class="form-control" name="url3" id="url3" placeholder="Link of 3rd image..." value=<?php echo "'$url3'"; ?>>
        </div>
        <div class="form-group">
            <label for="image4">Image 4</label>
            <input type="text" class="form-control" name="url4" id="url4" placeholder="Link of 4th image..." value=<?php echo "'$url4'"; ?>>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="des" id="des" cols="30" rows="10" placeholder="Product description..."><?php echo "$des"?></textarea>
        </div>
        <div class="form-group">
            <label for="type">Product type</label>
            <select name="type" id="type" class="form-control">
                <option value="1">MacBook Air</option>
                <option value="2">MacBook Pro</option>
                <option value="3">iMac</option>
                <option value="4">iPad Air</option>
                <option value="5">iPad Pro</option>
                <option value="6">iPad Mini</option>
                <option value="7">iPhone 13</option>
                <option value="8">iPhone 12</option>
                <option value="9">iPhone 11</option>
                <option value="10">Apple Watch Series 7</option>
                <option value="11">Apple Watch SE</option>
                <option value="12">Apple Watch Series 3</option>
                <option value="13">Apple Watch Nike</option>
            </select>
        </div>
        <div>
            <?php if(!$success) { ?>
            <small class="log-fail">Add product FAILED.</small>
            <?php } ?>
        </div>
        <input class="btn btn-primary" type="submit" value="Add">
    </form>
</div>


<script src="../assets/js/check.js"></script>
<?php
    include 'include/footer.php';
?>