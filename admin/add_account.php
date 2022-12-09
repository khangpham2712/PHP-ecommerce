<?php 

    include '../core/process.php';
    if(!checkAdmin()){
        header('Location: ../login');
    }
    include 'include/header.php';

    $wrongEmail = false;

    $log = -1;

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $type = $_POST['type'];
        if(isExistEmail($email)){
            $log = 2;
        }
        else {
            $result = addUser($name, $email, $password, $type);
            if($result) $log = 1;
            else $log = 0;
        }
        
    }

?>
<link rel="stylesheet" href="../assets/css/common.css">
<div class="container padding-top">
    <h2 class="title">Add account</h2>
    <form action="" method="POST" id="add-user">
    <div class="form-group">
        <label for="name">Username:</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Username..." required>
        <small class="log-fail" id="name-log"></small>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="Email..." required>
        <?php if($wrongEmail) { ?>
            <small class="log-fail" id="email-log">Email is existed.</small>
        <?php } ?>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Password..." required>
            <small class="log-fail" id="password-log"></small>
        </div>
        <div class="form-group col-md-6">
            <label for="confirm-password" id='label_confirm'>Confirm password:</label>
            <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm password..." required onkeyup="check();">
            <small class="log-fail" id="password-match"></small>
        </div>
    </div>
    <div class="form-group">
        <label for="type">Role</label>
        <select name="type" id="type" class="custom-select">
            <option value="0">User</option>
            <option value="1">Admin</option>
        </select>
    </div>
    <div>
        <?php if($log!=-1) {
            if($log==1)
                echo "<i class='log-success' style='color: green'>SUCCESSFULLY</i>";
            elseif($log == 2)
                echo "<i class='log-fail'>Email is EXISTED</i>";
            else
                echo "<i class='log-fail'>FAIL</i>";
        } ?>
    </div>
    <input class="btn btn-primary" value="Add" type="submit"/>
    </form>
</div>

<script src="../assets/js/check.js"></script>
<p style="height: 60px;"></p>
<?php
    include 'include/footer.php';
?>