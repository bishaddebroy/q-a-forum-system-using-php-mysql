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

   $sql = mysqli_query($conn,"select * from user");
   $rows = mysqli_fetch_all($sql,MYSQLI_ASSOC);
   
   $login_session = $row["name"];
   
   if(!isset($_SESSION["name"])){
      header("location:login.php");
      die();
   }
?>

<!DOCTYPE html>
<html>
<head>
   <title>View Users</title>
</head>
<body>
   <table>
      <tr>
         <td colspan="4">Users</td>
      </tr>
      <tr>
         <td>ID</td>
         <td>Name</td>
         <td>Email</td>
         <td>User Type</td>
      </tr>
      <?php foreach ($rows as $r): ?>
         <tr>
            <td><?php echo $r["id"]; ?></td>
            <td><?php echo $r["name"]; ?></td>
            <td><?php echo $r["email"]; ?></td>
            <td><?php echo $r["user_type"]; ?></td>
         </tr>
         
      <?php endforeach ?>

      <tr>
         <td colspan="4"><a href="<?php if($row["user_type"] == "admin") echo "admin_home.php"; else echo "user_home.php"; ?>">Go Home</a></td>
      </tr>

   </table>
</body>
</html>