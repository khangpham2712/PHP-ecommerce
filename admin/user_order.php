<?php

    include '../core/process.php';
    if(!checkAdmin()){
        header('Location: ../login');
    }
    include 'include/header.php';

    $carts = getAllCart();

?>
<link rel="stylesheet" href="../assets/css/common.css">
<div class="container padding-top">
<h2 class="title">Orders of Users</h2>
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>No.</th>
                <th>User</th>
                <th>Total (₫)</th>
                <th>Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $i = 1;
                while($row = $carts->fetch_array(MYSQLI_BOTH)){
                    $username = $row['userName'];
                    $price = $row['totalPrice'];
                    $time = $row['time'];
                    $cartId = $row['cartId'];
                    $userId = $row['userId'];
                    echo "<tr>";
                    echo "<td>$i</td>";
                    echo "<td>$username</td>";
                    echo "<td>" . number_format($price, 0, '' ,'.') . "</td>";
                    echo "<td>$time</td>";
                    echo "<td><a href='user_order_detail.php?id=$cartId&userId=$userId'><button class='btn btn-primary'>Detail</button></a></td>";
                    echo "</tr>";
                    $i++;
                }
            ?>
        </tbody>
    </table>
</div>
<p style="height: 390px;"></p>
<?php include 'include/footer.php'; ?>