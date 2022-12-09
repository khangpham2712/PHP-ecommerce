<?php
  include "./core/auth.php";

  if (checkLogin()) {
      header("Location: home");
  }
  $success = true;
  $log = "";

  $email= "";
  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $log = Auth($email,$password);
    $success = false;
  }
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/login.css">
    <link rel="icon" href="assets/images/logo_apple_1.png">
</head>
<body>
  <div class="center">
    <h1>Login</h1>
    <form action="" method="POST">
        <div class="txt_field">
            <input type="email" name="email" id="email" required value=<?php echo "'$email'"; ?>>
            <span></span>
            <label for="username">Email</label>
        </div>
        <div class="txt_field">
            <input type="password" name="password" id="password" required>
            <span></span>
            <label for="password">Password</label>
        </div>
        <div class="pass"><a href="#">Forgot password?</a> </div>
        <?php
          if($log!="") {
            echo "<small class='log-fail'>$log</small>";
          }
        ?>
        <input type="submit" value="Login">
        <div class="signup_link">
            Do not have account ?
            <a href="signup">Sign up</a>
        </div>
        <div class="signup_link">
          <a href="home">Go to Home</a>
        </div>
    </form>
</div>
  
  
  <script src="./js/script.js"></script>
</body>
</html>