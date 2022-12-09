<?php 
    include 'core/process.php';
	

	if(checkLogin()){
		if(checkAdmin()) {
		  header('Location: admin/user-info');
		}	 
	}
	else{
		header('Location: login');
	}

	$wrong_confirm = false;
	$wrong_pass = false;
    $log = NULL;
	$success = 0;

	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		// Change info
		$name = $_POST['name'];
		$email = $_POST['email'];
		$oldPass = $_POST['oldPass'];
		$newPass = $_POST['newPass'];
		$confirmPass = $_POST['confirmPass'];
		if(!checkPass($oldPass)){
			$wrong_pass = true;
		}
		else{
			if($newPass != '') $oldPass = $newPass;
			$result = updateUser($name, $oldPass);
			if(!$result){
				$log = "Cập nhật thông tin không thành công!";
			}
			else {
				$_SESSION['user']['userName'] = $name;
				$_SESSION['user']['password'] = $oldPass;
				$log = "Cập nhật thông tin thành công!";
				$success = 1;
			}
		}
	}

	$name = $_SESSION['user']['userName'];
	$email = $_SESSION['user']['email'];
	include "include/header.php";
?>
<link rel="stylesheet" href="./assets/css/common.css">
<div class="container user-info-container padding-top">
	<h2 class="title">User info</h2>
  <form action="" id="user-info" method="POST" class="form-user">
		<div class="form-group row">
			<label for="username" class="col-sm-2 col-form-label">Username</label>
			<div class="col-sm-10">
				<input  type="text" class="form-control form-user-edit" name="name" id="username" placeholder="Name..." readonly="readonly" required value=<?php echo "'$name'";?>>
				<a class="btn btn-primary" onclick="editEnable('username')" id="username-change">Change username</a>
				
			</div>
			<div><small id="wrong-name" class="log-fail" style='color: red;'></small></div>
			
		</div>
		<div class="form-group row">
			<label for="email" class="col-sm-2 col-form-label">Email</label>
    		<div class="col-sm-10">
				<input type="email" class="form-control form-user-edit" name="email" id="email" placeholder="Email..." readonly="readonly" required value=<?php echo "'$email'";?>>
    		</div>
		</div>			
		<div class="form-group row" id="current-password">
			<label for="oldPassword" class="col-sm-2 col-form-label">Current password</label>
			<div class="col-sm-10">
				<input  type="password" class="form-control form-user-edit" name="oldPass" id="oldPassword" placeholder="Current password...">
			</div>
		</div>
		<a class="btn btn-primary" onclick="changePasswordShow()" id="changePasswordButton">Change password</a>
		<div id="changePassword">
			<div class="form-group row">
				<label for="password" class="col-sm-2 col-form-label">New password</label>
				<div class="col-sm-4">
					<input  type="password" class="form-control form-user-edit" name="newPass" id="password" placeholder="New password...">
				</div>
				<div class="col-sm-4">
					<input  type="password" class="form-control form-user-edit" name="confirmPass" id="confirm_password" onkeyup="check();" placeholder="Confirm password...">
				</div>
			</div>
			
		</div>
		<div>
			<small id="wrong-confirm" style='color: red;'></small>
			<?php if($wrong_pass) {?>
				<small class="log-fail" style="color: red;">Wrong password.</small>
			<?php }?>
			
			<?php if($log!=NULL) {
				if($success) {
					echo "<small id='log-success' class='log-success'>$log</small>";
				}
				else
					echo "<small id='log-success' class='log-fail'>$log</small>";
				
			}?>
		</div>
		<input type="submit" class="btn btn-primary" id="button-submit" value="Update">
	</form>
</div>

<script src="assets/js/check.js"></script>

<?php
    include 'include/footer.php';
?>