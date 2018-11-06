<?xml version="1.0" encoding="UTF-8"?>
<html xmlns="http://www.w3.org/1999/xhtml"
      xml:lang="en">
  <head>
  <?php
  //start session
  session_start();
  //check  session vaiable username is present and user logged in
  if(isset($_SESSION['admin']))
  {
    //include relevant files
    include "connection.php";
    include "header.php";
  ?>
     <title>Edit Winner</title>

  </head>

  <body>
  <?php
    /*List all wins with and option to edit/delete each individual win */
    echo "Winners:";
    echo '<table class="table">
            <tr><th>Task Name</th><th>Task Owner</th><th>Task Winner</th><th>Ask Price</th><th>Winning Price</th><th>Delete Win</th></tr>';
    $query = "SELECT * FROM winner INNER JOIN bids on bids.bid = winner.bid";
    $result = pg_query($db,$query);
    while($wins = pg_fetch_array($result)) {
      /*get the task name and owner of the task bid on */
      $tid = $wins['tid'];
      $qry = "SELECT * FROM task WHERE tid = '$tid'";
      $tresult = pg_query($db,$qry);
      $task = pg_fetch_array($tresult);

      echo '<tr><td>'.$task['tname'].'</td><td>'.$task['username'].'</td><td>'.$wins['username'].'</td><td>'.$task['setprice'].'</td><td>'.$wins['price'].'</td>
      <td><form action="edit-wins.php" method="POST"><input id="blank" type="hidden" name="winbid" value="'.$wins['bid'].'"><input id="blank" type="hidden" name="wusername" value="'.$wins['username'].'"><input id="blank" type="hidden" name="Taskid" value="'.$tid.'"> <input class="btn btn-secondary btn-sm" type="submit" name="delete" id="submit" value="Delete Win"/></form></td></tr>';
    }
    echo '</table>';

    //<td><form action="edit-wins.php" method="POST"><input id="blank" type="hidden" name="winbid" value="'.$wins['bid'].'"><input id="blank" type="hidden" name="wusername" value="'.$wins['username'].'"><input id="blank" type="hidden" name="Taskid" value="'.$tid.'"> <input class="btn btn-secondary btn-sm" type="submit" name="edit" id="submit" value="Edit Win"/></form></td>



  }else{
    //if user is not logged in
    header ('location: login.php');
  }

  ?>



  </body>



  </html>
