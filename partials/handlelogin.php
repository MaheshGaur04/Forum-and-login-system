<?php
$showerror="false";
if($_SERVER['REQUEST_METHOD']=="POST"){
    include "dbconnect.php";
    $email=$_POST['loginEmail'];
    $pass=$_POST['loginPass'];
    $sql="select * from users where user_email='$email'";
    $result=mysqli_query($conn,$sql);

    $num=mysqli_num_rows($result);
    if($num==1){
        $row=mysqli_fetch_assoc($result);
        if(password_verify($pass,$row['user_pass'])){
           session_start();
           $_SESSION['loggedin']=true;
           $_SESSION['sno']=$row['sno'];
           $_SESSION['useremail']=$email;
           echo "Logged in".$email;
        }
        header("Location: /forum/index.php");
    }
    header("Location: /forum/index.php");
}
?>