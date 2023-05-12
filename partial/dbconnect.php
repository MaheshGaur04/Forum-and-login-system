<?php
$servername="localhost:3307";
$username="root";
$password="";
$database="iforum";

$conn = mysqli_connect($servername,$username,$password,$database);
if(!$conn){
    die("The Database is not connected due to thi error-->".mysqli_connect_error());
}
?>