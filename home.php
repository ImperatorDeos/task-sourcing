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
     <title>Home</title>
     
  </head>

  <body>
  <?php
    echo "<h3>Today's latest tasks:</h3>";
    /*List top 5 tasks with and option to bid on each individual task */
    echo '<table class="table">
            <tr><th>Task Name</th><th>Description</th><th>Location</th><th>Date</th><th>Start</th><th>End</th><th>Ask Price</th><th>Bid</th></tr>';
    $query = "SELECT * FROM task WHERE active='TRUE' ORDER BY sdate DESC LIMIT 5";
    $result = pg_query($db,$query);
    while($tasks = pg_fetch_array($result)) {
      echo '<tr><td>'.$tasks['tname'].'</td><td>'.$tasks['tdiscrip'].'</td><td>'.$tasks['location'].'</td><td>'.$tasks['sdate'].'</td><td>'.$tasks['starttime'].'</td><td>'.$tasks[endtime].'</td><td>'.$tasks['setprice'].'</td>
      <td><form action="bid.php" method="POST"><input id="blank" type="hidden" name="Taskid" value="'.$tasks['tid'].'"> <input class="btn btn-secondary btn-sm" type="submit" name="placebid" id="submit" value="Bid"/></form></td></tr>';
    }
    echo '</table>';



  }else{
    //if user is not logged in
    header ('location: login.php');
  }

  ?>



  </body>



  </html>
