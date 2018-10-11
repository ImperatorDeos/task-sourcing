<?xml version="1.0" encoding="UTF-8"?>
<html xmlns="http://www.w3.org/1999/xhtml"
      xml:lang="en">
  <head>
     <title>Login</title>
     <link rel="stylesheet" href="style.css" title="Style Sheet" type="text/css" />
     <?php
     //start session
     session_start();
     //check  session vaiable username is present and user logged in
     if(isset($_SESSION['username']))
     {
       header('location: home.php');
     }
     //include connection to database
      include "connection.php";

     ?>
  </head>

  <body>

      <form action="login.php" method="POST">
        <label for="user">Username:</label> <input type="text" name="user" id="user">
        <label for="pass">Password:</label> <input type="password" name="pass" id="pass">
        <input type="submit" id="login" value="Login" name="submit">
      </form>

    <?php
    //check for user input
     if (isset($_POST['submit'])){

    	session_start();

    	$username = $_POST['user'];
    	$password = $_POST['pass'];


      $query = "SELECT * FROM member WHERE username = '$username'";
      $chkadmin = "SELECT * FROM admin WHERE username = '$username'";

      /*check for username & password*/
    	$result = pg_query($db,$query);
      $userdata = pg_fetch_array($result);

      /*check for admin */
      $chkresult = pg_query($db,$chkadmin);
      $checkuserdata = pg_fetch_array($chkresult);

      //verify that password matches pasword stored in database
      if($password != $userdata['password']){
        echo "Please try again";
      }else if($username == $checkuserdata['username']){
        //check if user is an admin or not - if so assign admin status
		      session_regenerate_id();
		      $_SESSION['fname'] = $userdata['fname'];
          $_SESSION['lname'] = $userdata['lname'];
		      $_SESSION['username'] = $userdata['username'];
          $_SESSION['admin'] = TRUE;
		      session_write_close();
          //redirect to home page
		      header('location: home.php');
	     }else{
           //create session with attributes of user details
         session_regenerate_id();
         $_SESSION['fname'] = $userdata['fname'];
         $_SESSION['lname'] = $userdata['lname'];
         $_SESSION['username'] = $userdata['username'];
         session_write_close();
         //redirect to home page
         header('location: home.php');

       }


    }



    ?>




  </body>
  </html>
