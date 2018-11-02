<?xml version="1.0" encoding="UTF-8"?>
<html xmlns="http://www.w3.org/1999/xhtml"
      xml:lang="en">
  <head>
     <title>Login</title>
     <link rel="stylesheet" href="style.css" title="Style Sheet" type="text/css" />
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

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
    <div class="login-title">
      <h1 class="display-4"> Task Sourcing! </h1>
    </div>

      <div class="login-form">
      <form action="login.php" method="POST">
        <div  class="form-group">
          <label for="user">Username:</label> <input type="text" class="form-control" name="user" id="user">
        </div>
        <div  class="form-group">
          <label for="pass">Password:</label> <input type="password" class="form-control" name="pass" id="pass">
        </div>
        <input type="submit" class="btn btn-primary" id="login" value="Login" name="submit">
      </form>
    </div>


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
      if($password != $userdata['password'] || ($password == "" && $username = "")){
        echo '<div class="alert alert-danger" role="alert">
                <div class="myalert">
                  Please try again!
                </div>
              </div>';
      }else if($username == $checkuserdata['username']){
        //check if user is an admin or not - if so assign admin status
		      session_regenerate_id();
		      $_SESSION['fname'] = $userdata['fname'];
          $_SESSION['lname'] = $userdata['lname'];
		      $_SESSION['username'] = $userdata['username'];
          $_SESSION['admin'] = $userdata['username'];
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
