<html>
   
   <head>
      <style>
         .error {color: red;}
      </style>
   </head>
   
   <body>

      <?php
         // define variables and set to empty values
         $idErr = $passwordErr = $confirmpasswordErr = $nameErr = $emailErr = $usertypeErr = "";
         $id = $password = $confirmpassword = $name = $email = $usertype = "";
         $namePat = "/^(([a-zA-Z]*){1}\s{1}([a-zA-Z]*){0,1}\s{1}([a-zA-Z]*){1}){4,25}$/";
         $emailPat = "/^[_a-z0-9\-\+]+(\.[_a-z0-9\-\+]+)*@[a-z0-9\-\+]+(\.[a-z0-9\-\+]+)*(\.[a-z]{2,3})$/";
         $passwordPat = "/^(?=(.*[a-z]){1,})(?=(.*[\d]){1,})(?!.*[\W])(?!.*\s).{8,20}$/";
         
         
         if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["name"])) {
               $nameErr = "Name is required";
            }else {
               $name = test_input($_POST["name"]);
               //check if name is well-formed
               if(!preg_match($namePat, $name)) {
                  $nameErr = "Invalid name format";
               }
            }
            
            if (empty($_POST["email"])) {
               $emailErr = "Email is required";
            }else {
               $email = test_input($_POST["email"]);
               
               // check if e-mail address is well-formed
               if(!preg_match($emailPat, $email)) {
                  $emailErr = "Invalid email format";
               }
            }

            
            if (empty($_POST["password"])) {
               $passwordErr = "Password is required";
            }else {
               $password = test_input($_POST["password"]);
               //check if password is well-formed
               if(!preg_match($passwordPat, $password)) {
                  $passwordErr = "Invalid password format";
               }
            }
            
            if(empty($_POST["confirmpassword"])) {
               $confirmpasswordErr = "Confirm password is required";
            }else {
               $confirmpassword = test_input($_POST["confirmpassword"]);
               //check if confirm password is equal to password
               if($password != $confirmpassword) {
                  $confirmpasswordErr = "confirm password does not match password";
               }
            }
            
         }
         
         function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
         }

         ?>


      
      <h2>Registration</h2>
     
      <p><span class = "error">* required field.</span></p>
     
      <form method = "post" action = "bigbrother_sql.php">
         <table>

            <tr>
               <td>Name:</td>
               <td><input type = "text" name = "name" required>
                  <span class = "error">* <?php echo $nameErr;?></span>
               </td>
            </tr>
           
            <tr>
               <td>E-mail: </td>
               <td><input type = "text" name = "email" required>
                  <span class = "error">* <?php echo $emailErr;?></span>
               </td>
            </tr>

            <tr>
               <td>Password: </td>
               <td><input type = "password" name = "password" required>
                  <span class = "error">* <?php echo $passwordErr;?></span>
               </td>
            </tr>

            <tr>
               <td>Confirm Password: </td>
               <td><input type = "password" name = "password" required>
                  <span class = "error">* <?php echo $confirmpasswordErr;?></span>
               </td>
            </tr>
            
            <td>
               <input type = "submit" name = "submit" value = "Submit"> 
            </td>

            <td>
               <a href="login.php">Login</a>
            </td>
            
         </table>
         
      </form>
      
   
   </body>
</html>