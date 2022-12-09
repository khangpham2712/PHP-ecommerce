<?php
    include './core/ratingAndCmt.php';

    $id = $_GET['id'];
    $comment = loadComment($id);
    if ($comment->num_rows == 0){
        echo "<i id='log-cmt'>No comment.</i>";
    }
    else {
        while($row = $comment->fetch_array(MYSQLI_BOTH)) {
?>

<div class="user-name">
    <?php echo $row['userName'];
        if($row['type'] == 1){
            echo "<small> - admin</small>";
        }
    ?>
</div>
<div class="cmt-time">
    <?php echo $row['time']; ?>
</div>
<p class="cmt-content"><?php echo $row['content']; ?></p>



<?php } } ?>