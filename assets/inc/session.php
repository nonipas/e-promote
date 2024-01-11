<?php 
session_start();
if (!isset($_SESSION['user'])){
    echo '<script>alert("Please login first");
    window.location.replace("/")
    </script>';
    
}
if ($_SESSION['id'] != $_SESSION['token']){
    session_destroy();
    header("Location: /");
}
if (isset($_GET['logout'])){
    if($_CET['logout']==true){
        session_destroy();
        header("Location: /");
    }
}

$user ='SELECT user_name FROM users WHERE user_Id ='.$_SESSION['user'];
$user_res = mysqli_query($conn, $user);
$row = mysqli_fetch_assoc($user_res);
?>