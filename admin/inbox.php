<?php 

    include '../core/process.php';
    if(!checkAdmin()){
        header('Location: ../login');
    }
    include 'include/header.php';

    $inboxList = getInbox();
?>
<link rel="stylesheet" href="../assets/css/common.css">
<div class="container padding-top">
    <h2 class="title">Inbox</h2>
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>No.</th>
                <th>User</th>
                <th>Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $no = 1;
                while($row = $inboxList->fetch_array(MYSQLI_BOTH)){
                    $id = $row['messageId'];
                    $userName = $row['userName'];
                    $time = $row['time'];
                    $msg = $row['content'];
                    echo "<tr>";
                    echo "<td>$no</td>";
                    echo "<td>$userName</td>";
                    echo "<td>$time</td>";
                    echo "<td><button class='btn btn-primary' id='seeDetailBtn$id' value='1' onclick=".'"seeDetail('."'$msg'".", $id".')"'.">View</button></td>";
                    echo "</tr>";
                    echo "<tr id='detail$id'></tr>";
                    $no++;
                }
            ?>
        </tbody>
    </table>
</div>

<script src="./assets/js/script.js"></script>
<p style="height: 390px;"></p>
<?php
    include 'include/footer.php';
?>