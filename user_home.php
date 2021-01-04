<?php
   $conn = mysqli_connect("localhost", "root", "", "lab07assignment");
 
// Check connection
if(!$conn){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
   session_start();
   
   $user_check = $_SESSION["name"];
   $user_id = $_SESSION["id"];
   
   $ses_sql = mysqli_query($conn,"select * from user where name = '$user_check'");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row["name"];
   
   if(!isset($_SESSION["name"])){
      header("location:login.php");
      die();
   }

   if(isset($_POST["submit"]))
   {
      $p = $_POST["post"];
      $sql = "insert into posts(user_id, post, created_at) values('$user_id', '$p', now())";
      $insql = mysqli_query($conn, $sql);
      header("location:user_home.php");
   }
   if(isset($_POST["comment"]))
   {
      $p = $_POST["answer"];
      $pid = $_POST["post_id"];
      $csql = "insert into comments(user_id, comment, post_id, created_at) values('$user_id', '$p','$pid', now())";
      $comsql = mysqli_query($conn, $csql);
      header("location:user_home.php");
   }
   function userselectUsingId($id)
   {  
      Global $conn;
      $sql = "SELECT * FROM user WHERE id=".$id;
      $res = mysqli_query($conn, $sql);
      $result = mysqli_fetch_array($res, MYSQLI_ASSOC);
      return $result;
   }
   function allpostselect()
   {  
      Global $conn;
      $sql = "SELECT * FROM posts";
      $res = mysqli_query($conn, $sql);
      $result = mysqli_fetch_all($res, MYSQLI_ASSOC);
      return $result;
   }
   function allcommentselect($id)
   {  
      Global $conn;
      $sql = "SELECT * FROM comments where post_id=".$id;
      $res = mysqli_query($conn, $sql);
      $result = mysqli_fetch_all($res, MYSQLI_ASSOC);
      return $result;
   }

   $posts = allpostselect();

?>

<html>
   
   <head>
      <title>Home</title>
      <link rel="stylesheet" type="text/css" href="style.css">
   </head>
   
   <body>
      <?php include_once 'header.php' ; ?>
      
      <div class="container">
      <br>
      <br>
      <form method="post">
         <textarea type="text" name="post" placeholder="ask your question" style="height: 100px; width: 500px"></textarea>
         <input type="submit" name="submit" value="Ask">
      </form>
      <br>
      <br>

      <?php 
         foreach ($posts as $post) {
            $content = $post["post"];
            $comments = allcommentselect($post["id"]);
            $user = userselectUsingId($post["user_id"]);
            $user_name = $user["name"];

            ?>
            <div class="question">
               <h3>Question</h3>
               <p><?php echo $user_name; ?></p>
               <p><?php echo $content; ?></p>
               <form method="post">
                  <textarea type="text" name="answer" placeholder="answer" style="height: 50px; width: 200px"></textarea>
                  <input type="hidden" name="post_id" value="<?php echo $post['id'];?>" >
                  <input type="submit" name="comment" value="answer">
               </form>
               <?php 
                  $i = 1;
                  foreach ($comments as $comment) {
                     $commenter = userselectUsingId($comment["user_id"]);
                        $commenter_name = $commenter["name"];
                        $c = $comment["comment"];
                        ?>
                        <div class="answer">
                           <h5>Answer <?php echo $i++; ?></h5>
                           <p><?php echo $commenter_name; ?></p>
                           <p><?php echo $c; ?></p>
                           
                        </div>
               <?php
                  }
                ?>

               <br>
               <br>
            </div>

      <?php
         }
       ?>


       </div>
   </body>
   
</html>