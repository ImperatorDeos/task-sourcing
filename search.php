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
    include "connection.php";
    include "header.php";
  ?>
     <title>Search - Tasks</title>

  </head>

  <body>
  <?php
    /*results for a value searched*/

    //store value to be searched
    $searchvalue = $_POST['search'];
    //echo '<form action="createTask.php" method="POST"><input class="btn btn-secondary btn-lg" type="submit" name="createTask" id="submit" value="Create New Task"/></form></br>';
    echo '`<h4>Results for: '.$searchvalue.'</h4>';
    echo '<table class="table">
            <tr><th>Task Name</th><th>Description</th><th>Location</th><th>Date</th><th>Start</th><th>End</th><th>Ask Price</th><th>Bid</th></tr>';

    $query = "SELECT * FROM task WHERE (tname ILIKE '%".$searchvalue."%' OR tdiscrip ILIKE '%".$searchvalue."%' OR username ILIKE '%".$searchvalue."%' OR location ILIKE '%".$searchvalue."%') AND active='TRUE' ORDER BY sdate DESC";
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
