<?php
    include '../core/process.php';

    if(checkLogin()){
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        if(isset($_GET['userId'])) {
            $userId = $_GET['userId'];
    
        }
        else {
            header('Location: user-order');
        }
        include "include/header.php";
    }
    else{
        header('Location: login');
    }

    $item_list = getCartItem($id);
    $user = getUserInfo($userId);
    $row_user = $user->fetch_array(MYSQLI_BOTH);
?>
<link rel="stylesheet" href="../assets/css/common.css">
<div class="container padding-top">
    <h2 class="title"><?php echo $row_user["userName"]?>'s order details</h2>
    <strong>Email:</strong> <?php echo $row_user["email"]?><br><br>
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>No.</th>
                <th>Product</th>
                <th class="text-center">Quantity</th>
                <th class="text-right">Unit Price (₫)</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $i = 1;
                $totalPrice = 0;
                while($row = $item_list->fetch_array(MYSQLI_BOTH)){
                    $name = $row['name'];
                    $quantity = $row['quantity'];
                    $price = $row['price'];
                    $totalPrice += $price * $quantity;
                    echo "<tr>";
                    echo "<td>$i</td>";
                    echo "<td>$name</td>";
                    echo "<td class='text-center'>$quantity</td>";
                    echo "<td class='text-right'>". number_format($price, 0, '' ,'.') ."</td>";
                    echo "</tr>";
                    $i++;
                }
                echo "<tr>";
                echo "<td></td>";
                echo "<td></td>";
                echo '<td class="text-right">Total price</td>';
                echo '<td class=text-right>' . number_format($totalPrice, 0, '' ,'.') . '</td>';
                echo "</tr>";

                $ship = round($totalPrice*0.02, 2);
                echo "<tr>";
                echo "<td></td>";
                echo "<td></td>";
                echo '<td class="text-right">Shipping fee</td>';
                echo '<td class=text-right>' . number_format($ship, 0, '' ,'.') . '</td>';
                echo "</tr>";

                $totalPrice = round($totalPrice + $ship, 2);
                echo "<tr>";
                echo "<td></td>";
                echo "<td></td>";
                echo '<td class="text-right"><strong>Total</strong></td>';
                echo '<td class=text-right><strong>' . number_format($totalPrice, 0, '' ,'.') . '</strong></td>';
                echo "</tr>";
            ?>
        </tbody>
    </table>
</div>
<p style="height: 195px;"></p>
<?php
    include 'include/footer.php';
?>