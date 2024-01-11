<?php

session_start();
if (!empty($_SESSION['user'])){
    header("Location: /dashboard.php");
}
if (isset($_SESSION['msg']) && $_SESSION['msg'] !='') {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
$msg = '';
require_once('header.php');
$token = trim('guest'.rand(200103747,99999999).time());
$_SESSION['id'] = md5($token);

if (isset($_POST['login'])){
    // echo '<script>alert("success");</script>';
$username = trim($_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$sql = "SELECT * FROM `users` WHERE `user_name` =? ";

$stmt = mysqli_stmt_init($conn);

mysqli_stmt_prepare($stmt, $sql);

mysqli_stmt_bind_param($stmt, "s", $username);

mysqli_stmt_execute($stmt);

$res = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($res)) {

	$pwdcheck = password_verify($password, $row['pass']);
	$user_id = $row['user_id'];
	$user_level = $row['user_level'];

	if ($pwdcheck == true) {
        $token = $_SESSION['id'];
        $_SESSION['token'] = $token;
        $_SESSION['user'] = $user_id;

		$_SESSION['user_level'] = $user_level;
		
	    header("Location: /dashboard.php");

	} else {

         echo '<script>alert("invalid login details");</script>';
         $msg = 'invalid login details';

	}
} else {

    echo '<script>alert("invalid login details");</script>';
    $msg = 'invalid login details';


}   
}
?>
<h1 class="text-center" style="font-family: Mistral">Biometric Verification and Promotion Management System </h1> 
<div class="login-form">
    <form action="" method="post">
		<div class="avatar">
			<img src="/assets/images/avatar.png" alt="Avatar">
		</div>
        <h2 class="text-center">E-promote Login </h2>   
        <div class="form-group">
        	<input type="text" class="form-control" name="username" placeholder="Username" required="required">
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required="required">
        </div>        
        <div class="form-group">
            <input type="hidden" name="login">
            <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-sign-in" ></i></button>
        </div>
		<div class="clearfix">
            <label class="pull-left checkbox-inline"><input type="checkbox"> Remember me</label>
            <a href="#" class="pull-right">Forgot Password?</a>
        </div>
    </form>
    <p class="text-center text-danger small"><?php echo $msg; ?></p>
</div>

<?php require_once('footer.php'); ?>