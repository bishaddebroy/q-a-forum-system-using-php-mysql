<?php 
	session_start();

	if(!isset($_SESSION["name"])){
      header("location:login.php");
      die();
   }
   else {
   	header("location:user_home.php");
   }


?>