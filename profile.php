<?php
   $conn = mysqli_connect("localhost", "root", "", "lab07assignment");
 
// Check connection
if(!$conn){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
   session_start();
   
   $user_check = $_SESSION["name"];
   
   $ses_sql = mysqli_query($conn,"select * from user where name = '$user_check'");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row["name"];
   
   if(!isset($_SESSION["name"])){
      header("location:login.php");
      die();
   }
?>

<!DOCTYPE html>
<html>
<head>
   <title>Profile</title>
</head>
<body>
   <table>
      <tr>
         <td colspan="2">Profile</td>
      </tr>

      <tr>
         <td>ID</td>
         <td><?php echo $row["id"]; ?></td> 
      </tr>

      <tr>
         <td>Name</td>
         <td><?php echo $row["name"]; ?></td>
      </tr>

      <tr>
         <td>Email</td>
         <td><?php echo $row["email"]; ?></td>
      </tr>

      <tr>
         <td>User Type</td>
         <td><?php echo $row["user_type"]; ?></td>
      </tr>

      <tr>
         <td colspan="2"><a href="<?php if($row["user_type"] == "admin") echo "admin_home.php"; else echo "user_home.php"; ?>">Go Home</a></td>
      </tr>

   </table>
</body>
</html>