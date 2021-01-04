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


   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      $currpass = $_POST['currpass'];
      $newpass = mysqli_real_escape_string($conn,$_POST['newpass']); 
      $repass = mysqli_real_escape_string($conn,$_POST['repass']); 
      
      if($currpass == $row["password"]){
         if($newpass == $repass){
            $upsql = mysqli_query($conn, "update user set password = '$newpass' where name = '$user_check'");
            echo "password updated successfully";
         }else {
            echo "Re type your new password";
         }
      }else {
         echo "Your current password is not correct";
      }

   }
?>


<html>
   
   <head>
      <title>Login</title>
      <link rel="stylesheet" type="text/css" href="style.css">
      
   </head>
   
   <body>  
      <?php include_once 'header.php' ; ?>

      <form action = "<?php echo $_SERVER["PHP_SELF"]; ?>" method = "post">
         <table>
            <tr>
               <td>
                  <label>Current Password:</label>
               </td>
               <td>
                  <input type = "password" name = "currpass"/>
               </td>
            </tr> 

            <tr>
               <td>
                  <label>New Password:</label>
               </td>
               <td>
                  <input type = "password" name = "newpass"/>
               </td>
            </tr> 

            <tr>
               <td>
                  <label>Retype Password:</label>
               </td>
               <td>
                  <input type = "password" name = "repass"/>
               </td>
            </tr> 

            <td>
               <input type = "submit" value = "submit"/>
            </td>
            <td>
               <a href="<?php if($row["user_type"] == "admin") echo "admin_home.php"; else echo "user_home.php"; ?>">Home</a>
            </td>
            
         </table>
         
         
      </form>
   </body>
</html>