<?php
    include '../core/process.php';
    if(!checkAdmin()){
        header('Location: ../login');
    }
    include 'include/header.php';

    $user = getUserList();

?>
<link rel="stylesheet" href="../assets/css/common.css">
<div class="container padding-top">
    <h2 class="title">List of Users</h2>
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>No.</th>
                <th>User name</th>
                <th>Email</th>
                <th class="text-center">State</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $no = 1;
                while($row = $user->fetch_array(MYSQLI_BOTH)) {
                $id = $row['userId'];
                $name = $row['userName'];
                $email = $row['email'];
                $state = $row['state'];
                echo "<tr>";
                echo "<td>$no</td>";
                $no++;
                echo "<td>$name</td>";
                echo "<td>$email</td>";
                if($state) {
                    echo '<td class="text-center"><a href="lock_user.php?id=' . $id . '"><i class="fa fa-unlock" style="color: green;"></i></a></td>';
                }
                else {
                    echo '<td class="text-center"><a href="unlock_user.php?id=' . $id . '"><i class="fa fa-lock" style="color: red;"></i></a></td>';
                }
                echo '<td><a style="color:red;text-decoration:none;" href="delete_user.php?id=' . $id . '"><button class="btn btn-danger">Delete</button></td>';
                echo "</tr>";
            } ?>
        </tbody>
    </table>
    <a class="btn btn-primary more-button" href="add-account">Add Account</a>
</div>
<p style="height: 336px;"></p>
<?php include 'include/footer.php'; ?>