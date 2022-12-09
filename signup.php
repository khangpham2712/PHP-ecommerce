<?php

    include 'core/process.php';

    $email = "";
    $name = "";

    $isExistEmail = false;
    $noSuccess = false;
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $name = $_POST['username'];
        $password = $_POST['password'];

        if(isExistEmail($email)) {
            $isExistEmail = true;
        }
        else{
            $result = addUser($name, $email,$password, 0);
            if(!$result) {
                $noSuccess = true;
            }
            else
                header('Location: login');
        }
    }
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/login.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="./assets/js/script.js"></script>
    <link rel="icon" href="assets/images/logo_apple_1.png">
</head>
<body>
  <div class="center">
    <h1>Signup</h1>
    <form action="" method="post" id="signup">
        <div class="txt_field">
            <input type="email" name="email" id="email" required value=<?php echo $email;?>>
            <span></span>
            <label for="email">Email</label>
            
        </div>
        <div class="txt_field">
            <input type="text" name="username" id="username" required value=<?php echo $name;?>>
            <span></span>
            <label for="username">Username</label>
        </div>
        <div class="txt_field">
            <input type="password" name="password" id="password" required>
            <span></span>
            <label for="password">Password</label>
        </div>
        <div class="txt_field" id="text_field">
            <input type="password" name="confirm_password" id="confirm_password" required onkeyup="check();">
            <span></span>
            <label for="confirm_password" id="label_confirm">Confirm password</label>
        </div>
        <div>
        
        </div>
        <small id="log" class="log-fail"></small>
        <?php if($noSuccess) {?>
            <small class="log-fail">Create account SUCCESSFULLY.</small>
        <?php }?>
        <?php if($isExistEmail) {?>
            <small class="log-fail">Email is EXISTED.</small>
        <?php }?>
        <input type="submit" value="Signup">
        <div class="signup_link">
            Had account ?
            <a href="login">Login</a>
        </div>
        <div class="signup_link">
          <a href="home">Go to Home</a>
        </div>
    </form>
</div>

<script src="assets/js/check.js"></script>

</body>
</html>