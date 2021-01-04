<?php

$conn = mysqli_connect("localhost", "root", "", "lab07assignment");
 
// Check connection
if(!$conn){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
if(isset($_POST["submit"]))
{
$sqlpassword=$_POST["password"];
$sqlname=$_POST["name"];
$sqlemail=$_POST["email"];
$sqlut="user";
 
$sql = "INSERT INTO user (password, name, email, user_type)VALUES ('$sqlpassword', '$sqlname', '$sqlemail', '$sqlut')";
if(mysqli_query($conn, $sql)){
    	header("location:login.php");
} else{
    echo "ERROR:Record not created sucessfully ";
}
}
 

?>