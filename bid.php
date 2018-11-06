<?xml version="1.0" encoding="UTF-8"?>
<html xmlns="http://www.w3.org/1999/xhtml"
      xml:lang="en">
  <head>
  <?php
  //start session
  session_start();
  //check  session vaiable admin is present and user logged in
  //only admins can access this page
  if(isset($_SESSION['username']))
  {
    //include relevant files
    include "connection.php";
    include "header.php";
  ?>
     <title>Bid on Task</title>

  </head>

  <body>
  <?php


  /*Check if update variable is present, if so load in variables changed from the form */
    if(isset($_POST['bid'])){

      $username = $_SESSION['username'];
      $price = $_POST['bidprice'];
      $tid = $_POST['tid'];
      $busername = $_POST['username']; //username of Belonging

      //SQL query to insert into bid table
        $qry = "INSERT INTO bids (price, username, tid) VALUES ('$price','$username','$tid')";
        $result = pg_query($db,$qry);





      if(!$result)
      {
        //if query fails, giver user options to go back or try again
        echo "Failed to place bid, try again </br>";
        echo '<form action="bid.php" method="POST"><input id="blank" type="hidden" name="Taskid" value="'.$tid.'"> <input class="btn btn-primary btn-sm" type="submit" name="placebid" id="submit" value="Try Again"/></form>';
        echo '<form action="task.php" method="POST"><input class="btn btn-secondary btn-sm" type="submit" name="back" id="submit" value="Back"/></form>';

      }else{
        //if query successful, give user option to go back
           echo "Bid placed, good luck!</br>";
           echo '<form action="task.php" method="POST"><input class="btn btn-secondary btn-sm" type="submit" name="back" id="submit" value="Back"/></form>';
      }
    }else{
      /*Fetch task id and find information from task in database */

        $tid = $_POST['Taskid'];
        $query = "SELECT * FROM task WHERE tid = '$tid'";
        $result = pg_query($db,$query);
        $task = pg_fetch_array($result);


        //echo "Edit:";
        /*Display in editable format */
        echo '

                  <div class="form-group">
                    <div class="form-row">
                      <label for="tname">Task Name: </label>
                        <input class="form-control" readonly type="text"  pattern="^[^\']*$" name="tname" value="'.$task['tname'].'" required>
                      <label for="location">Location: </label>
                        <input class="form-control" readonly type="text" pattern="^[^\']*$" name="location" value="'.$task['location'].'" required>
                      <label for="username">User Belonging Too: </label>
                        <input class="form-control" readonly type="text" name="username" value="'.$task['username'].'" required>
                      <label for="price">Price: </label>
                        <input class="form-control" readonly type="text" name="price" value="'.$task['setprice'].'" required>
                    </div>
                    <div class="form-row">
                      <label for="date">Date: </label>
                        <input class="form-control" readonly type="text" name="date" value="'.$task['sdate'].'" required>
                      <label for="stime">Start Time: </label>
                        <input class="form-control" readonly type="text" name="stime" value="'.$task['starttime'].'" required>
                      <label for="etime">End Time: </label>
                        <input class="form-control" readonly type="text" name="etime" value="'.$task['endtime'].'" required>

                    </div>
                    <label for="tdiscrip">Task Description: </label>
                  <textarea class="form-control" readonly pattern="^[^\']*$" name="tdiscrip" required>'.$task['tdiscrip'].'</textarea>
                   </div>';

                   /* SQL to find if user has bid on the task before */
                   /*$tester = "SELECT * FROM bids WHERE tid='$tid' AND username='$_SESSION['username']'";
                   $result2 = pg_query($db,$tester);
                   $testing = pg_fetch_array($result2);
                   $var = $testing['username'];*/


          if($task['username'] == $_SESSION['username']){
            echo "You cannot bid on your own tasks";
          }/*else if($var == $username){
            This code will be to alert user that they cannot bid on the same task twice
          }*/else{
            echo '<form action="bid.php" method="POST">
                <label for="bidprice">Your Bid Price: </label>
                <input class="form-control" type="text" name="bidprice" value="" required>
                <input type="hidden" name="tid" value="'.$task['tid'].'">
                <input type="hidden" name="busername" value="'.$task['username'].'">
                <input class="btn btn-secondary btn-sm" type="submit" name="bid" id="submit" value="Place Bid" />
          </form>';
          }

    }

  }else{
    //if user is not logged in
    header ('location: login.php');
  }

  ?>



  </body>



  </html>
