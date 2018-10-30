<?xml version="1.0" encoding="UTF-8"?>
<html xmlns="http://www.w3.org/1999/xhtml"
      xml:lang="en">
  <head>
  <?php
  //start session
  session_start();
  //check  session vaiable username is present and user logged in
  if(isset($_SESSION['admin'])){
    //include relevant files
    include "connection.php";
    include "header.php";
  ?>
     <title>Edit Users</title>
     <link rel="stylesheet" href="style.css" title="Style Sheet" type="text/css" />
  </head>

  <body>
  <?php


  if(isset($_POST['update'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $admin = $_POST['admin'];
    $password = $_POST['password'];
    $userid = $_POST['userid'];

    //SQL query to update member table
    $qry = "UPDATE member SET fname='$fname', lname='$lname', password='$password' WHERE username='$userid'";
    $result = pg_query($db,$qry);

    $num1 = FALSE; //variable to test if follow is executed

    /*** check if value is yes or no
    ** If yes, check if user s admin in admin table
      If not, add user to admin table and change trigger
      If user is already in table, change trigger

    ** If no, check if user exisits in admin table
      If the user exists, delete from the table and change trigger
      If user is not in the table, change the trigger
    ***/
    if($admin == "Yes"){
      $step1 = "SELECT * FROM admin WHERE username = '$userid'";
      $resultstep1 = pg_query($db,$step1);
      if(pg_num_rows($resultstep1)==0){
        $step2 = "INSERT INTO admin (username) VALUES ('$userid')";
        $resultstep2 = pg_query($db,$step2);
        if(!$resultstep2){

        }else{
          $num1 = TRUE;
        }
      }else if(pg_num_rows($resultstep1) > 0){
        $num1 = TRUE;
      }

    }else if ($admin == "No"){
      $step3 = "SELECT * FROM admin WHERE username = '$userid'";
      $resultstep3 = pg_query($db,$step3);
      if(pg_num_rows($resultstep3)>0){
        $step4 = "DELETE FROM admin WHERE username = '$userid'";
        $resultstep4 = pg_query($db,$step4);
        if(!$resultstep4){

        }else{
          $num1 = TRUE;
        }
      }else if(pg_num_rows($resultstep3) == 0){
        $num1 = TRUE;
      }

    }

    /*Check that query executed*/
    if(!$result || !$num1){
      //if query fails, giver user options to go back or try again
      echo "Failed to update, try again";
      echo $admin;
      echo '<form action="edit-users.php" method="POST"><input id="blank" type="hidden" name="userid" value="'.$userid.'"> <input type="submit" name="edit" id="submit" value="Try Again"/></form>';
      echo '<form action="admin-users.php" method="POST"><input type="submit" name="back" id="submit" value="Back"/></form>';

    }else{
      //if query successful, give user option to go back
         echo "Updated successfully!";
         echo '<form action="admin-users.php" method="POST"><input type="submit" name="back" id="submit" value="Back"/></form>';
    }
  }else{
  /*Fetch user id and find information about user in database */
    $userid = $_POST['userid'];
    $query = "SELECT * FROM member WHERE username = '$userid'";
    $result = pg_query($db,$query);
    $user = pg_fetch_array($result);

    $chkadmin = "SELECT username FROM admin WHERE username = '$userid'";
    $test = pg_query($db,$chkadmin);
    if( pg_num_rows($test) == 0){
      $num = "No";
    }else{
      $num = "Yes";
    }
  //  echo "Edit:";
    /*Display in editable format */
    echo '  <form action="edit-users.php" method="POST">
               First Name: <br><input type="text"  pattern="^[^\']*$" name="fname" value="'.$user['fname'].'" required></br>
               Last Name: <br><input type="text"  pattern="^[^\']*$" name="lname" value="'.$user['lname'].'" required></br>';
               /*check if user is trying to edit self, if so do not allow to edit admin status*/
              if($_SESSION['admin'] == $userid){
                 echo "Cannot edit own admin status </br>";
                echo '<input type="hidden" name="admin" value="'.$num.'">';
               }else{
                 echo 'Admin: <br><input type="text" pattern="(Yes|No)" name="admin" value="'.$num.'" required></br>';

               }
    echo '     Password: <br><input type="text"  name="password" value="'.$user['password'].'" required></br>
              <input type="hidden" name="userid" value="'.$userid.'">
               <input type="submit" name="update" id="submit" value="Update User" />
             </form>';
  }





  }else{
    //if user is not logged in
    header ('location: login.php');
  }

  ?>



  </body>



  </html>
