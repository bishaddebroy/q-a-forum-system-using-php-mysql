<?php
   
   
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      $conn = mysqli_connect("localhost", "root", "", "lab07assignment");
 echo "hello";
// Check connection
if(!$conn){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

      $myusername = mysqli_real_escape_string($conn,$_POST['name']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['password']); 
      
      $sql = "SELECT * FROM user WHERE name = '$myusername' AND password = '$mypassword'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
                
      if($count == 1) {
         session_start();
         $_SESSION["name"] = $myusername;
         $_SESSION["password"] = $mypassword;
         $_SESSION["id"] = $row["id"];
         $_SESSION["user_type"] = $row["user_type"];
         $_SESSION["email"] = $row["email"];
         header("location:user_home.php");
         
      }else {
         $error = "Your Login Name or Password is invalid";
         echo $error;
      }
   }
?>


<html>
   
   <head>
      <title>Login</title>
   </head>
   
   <body>  
      <form action = "<?php echo $_SERVER["PHP_SELF"]; ?>" method = "post">
         <table>
            <tr>
               <td>
                  <label>UserName:</label>
               </td>
               <td>
                  <input type = "text" name = "name"/>
               </td>
            </tr>

            <tr>
               <td>
                  <label>Password:</label>
               </td>
               <td>
                  <input type = "password" name = "password"/>
               </td>
            </tr> 

            <td>
               <input type = "submit" value = "submit"/>
            </td>
            <td>
               <a href="registration.php">Register</a>
            </td>
            
         </table>
         
         
      </form>
   </body>
</html>