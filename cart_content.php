<?php
    include './core/process.php';
?>

<table class="table table-striped">
    <thead class="thead-dark">
        <tr>
            <th scope="col"> </th>
            <th scope="col">Product</th>
            <th scope="col" class="text-center">Quantity</th>
            <th scope="col" class="text-right">Price (₫)</th>
            <th>  </th>
        </tr>
    </thead>
    <tbody id="cart-content">
    <?php
        foreach($_SESSION['cart'] as $id => $quantity){
            $product = getProduct($id);
            $url = $product['url1'];
            $price = $product['price'];
        ?>

        <tr>
            <td class="img-container"><a href=<?php echo "'product.php?id=$id'"; ?>><img src=<?php echo "'$url'"; ?> class="img-cart" alt="image"/></a> </td>
            <td class="product-name"><a style="text-decoration: none; color: black" href=<?php echo "'product.php?id=$id'"; ?>><?php echo $product['name']; ?></a></td>
            <td><input class="form-control quantity-product" id=<?php echo "'quantity$id'"; ?> type="number" value=<?php echo "$quantity"; ?> min="1" onchange="changeQuantity(<?php echo $id; ?>)"/></td>
            <td class="text-right price-item"><?php echo $price*$quantity; ?></td>
            <td class="text-right"><button class="btn btn-sm btn-danger" onclick="remove(<?php echo $id; ?>)"><i class="fa fa-trash"></i> </button> </td>
        </tr>
        <?php 
            }
        ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Total price</td>
            <td class="text-right" id="total">0 ₫</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Shipping fee</td>
            <td class="text-right" id="ship">0 ₫</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><strong>Total</strong></td>
            <td class="text-right" id="total-and-ship" style="font-weight: bold;">0 ₫</td>
        </tr>
    </tbody>
</table>

<script src="./assets/js/cart.js"></script>
