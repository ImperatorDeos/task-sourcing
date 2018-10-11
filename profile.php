<?xml version="1.0" encoding="UTF-8"?>
<html xmlns="http://www.w3.org/1999/xhtml"
      xml:lang="en">
  <head>
  <?php
  //start session
  session_start();
  //check  session vaiable username is present and user logged in
  if(isset($_SESSION['username']))
  {
    //include relevant files
     include "header.php";
     include "connection.php";
  ?>
     <title><?php echo $_SESSION['fname']."'s "; ?>Profile</title>
     <link rel="stylesheet" href="style.css" title="Style Sheet" type="text/css" />
  </head>

  <body>
  <?php
  $username = $_SESSION['username'];
  $fname = $_SESSION['fname'];
  $lname = $_SESSION['lname'];

  echo '<h1>'.$fname.'\'s Profile</h1>';

  echo '<h3>First Name:</h3>'.$fname;
  echo '<p><h3>Last Name:</h3>'.$lname.'</p>';

  /*Find and display all the active tasks that belong to this user */
  echo '<h3>Current Active Tasks</h3>';
  $query = "SELECT * FROM task WHERE username = '$username' AND active = TRUE";
  $result = pg_query($db,$query);
  echo '<table>
          <tr><th>Task Name</th><th>Description</th><th>Location</th><th>Date</th><th>Start</th><th>End</th><th>Price</th></tr>';
  while($tasks = pg_fetch_array($result)){
    echo '<tr><td>'.$tasks['tname'].'</td><td>'.$tasks['tdiscrip'].'</td><td>'.$tasks['location'].'</td><td>'.$tasks['sdate'].'</td><td>'.$tasks['starttime'].'</td><td>'.$tasks[endtime].'</td><td>'.$tasks['setprice'].'</td></tr>';
  }
  echo '</table>';

  /*Find and display all the tasks that this user has bid on*/

  echo '<h3>Tasks Bid on</h3>';

    echo '<table>
            <tr><th>Task Name</th><th>Description</th><th>Location</th><th>Date</th><th>Start</th><th>End</th><th>Ask Price</th><th>Bid Price</th></tr>';
    $query = "SELECT * FROM task INNER JOIN bids on bids.tid = task.tid WHERE bids.username = '$username'";
    $result = pg_query($db,$query);
    while($tasks = pg_fetch_array($result)){
      echo '<tr><td>'.$tasks['tname'].'</td><td>'.$tasks['tdiscrip'].'</td><td>'.$tasks['location'].'</td><td>'.$tasks['sdate'].'</td><td>'.$tasks['starttime'].'</td><td>'.$tasks[endtime].'</td><td>'.$tasks['setprice'].'</td><td>'.$tasks['price'].'</td></tr>';
    }
  echo '</table>';



  /*Find and display all the tasks that this user has Won*/

  echo '<h3>Tasks Won</h3>';

    echo '<table>
            <tr><th>Task Name</th><th>Description</th><th>Location</th><th>Date</th><th>Start</th><th>End</th><th>Ask Price</th><th>Bid Price</th></tr>';
    $query = "SELECT * FROM task INNER JOIN bids on bids.tid = task.tid INNER JOIN winner on winner.tid = task.tid WHERE winner.username = '$username'";
    $result = pg_query($db,$query);
    while($tasks = pg_fetch_array($result)){
      echo '<tr><td>'.$tasks['tname'].'</td><td>'.$tasks['tdiscrip'].'</td><td>'.$tasks['location'].'</td><td>'.$tasks['sdate'].'</td><td>'.$tasks['starttime'].'</td><td>'.$tasks[endtime].'</td><td>'.$tasks['setprice'].'</td><td>'.$tasks['price'].'</td></tr>';
    }
  echo '</table>';





  /*Find and display all the past tasks that belong to this user*/
  echo '<h3>Past Tasks</h3>';
  $query = "SELECT * FROM task WHERE username = '$username' AND active = FALSE";
  $result = pg_query($db,$query);
  echo '<table>
          <tr><th>Task Name</th><th>Description</th><th>Location</th><th>Date</th><th>Start</th><th>End</th><th>Price</th></tr>';
  while($tasks = pg_fetch_array($result)){
    echo '<tr><td>'.$tasks['tname'].'</td><td>'.$tasks['tdiscrip'].'</td><td>'.$tasks['location'].'</td><td>'.$tasks['sdate'].'</td><td>'.$tasks['starttime'].'</td><td>'.$tasks[endtime].'</td><td>'.$tasks['setprice'].'</td></tr>';
  }
  echo '</table>';







  }else{
    //if user is not logged in
    header ('location: login.php');
  }

  ?>



  </body>



  </html>
