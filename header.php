<?php
   $conn = mysqli_connect("localhost", "root", "", "lab07assignment");
 
// Check connection
if(!$conn){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
   
   $user_check = $_SESSION["name"];
   
   $ses_sql = mysqli_query($conn,"select * from user where name = '$user_check'");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row["name"];
   $ut = $row["user_type"];
   
   if(!isset($_SESSION["name"])){
      header("location:login.php");
      die();
   }
?>


<div class="topnav">
  <a href="user_home.php">Home</a> 
  <a href = "profile.php">Profile</a>
  <a href = "changepass.php">Change Password</a>
  <?php 
    if($ut == 'admin')
    {
      echo "<a href = 'view_users.php'>View Users</a>";
    }
   ?>
  <a href = "logout.php">Logout</a>
</div>