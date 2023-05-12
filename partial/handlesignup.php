<?php
$showError="false";
if($_SERVER['REQUEST_METHOD']=="POST"){
    include "dbconnect.php";
    $user_email=$_POST['signupEmail'];
    $pass=$_POST['signuppassword'];
    $cpass=$_POST['signupcpassword'];

    $existsql="SELECT * FROM `users` WHERE user_email='.$user_email.'";
    $result=mysqli_query($conn,$existsql);
    $num=mysqli_num_rows($result);
    if($num>0){
        $showerror="Email is Exist";
    }
    else{
        if($pass==$cpass){
            $hash=password_hash($pass,PASSWORD_DEFAULT);
            $sql="INSERT INTO `users` (`user_email`, `user_pass`, `timestamp`) VALUES ('$user_email', '$hash', current_timestamp())";
            $result=mysqli_query($conn,$sql);
            if($result){
                $showAlert=true;
                header("Location:/forum/index.php?signupsuccess=true ");
                exit();
            }
        }
        else{
            $showError="Password Do not Match";
        }
    }
    header("Location:/forum/index.php?signupsuccess=false&error=$showError");
}
?>