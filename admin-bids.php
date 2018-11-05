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
     <title>Edit Bids</title>

  </head>

  <body>
  <?php
    /*List all bids with and option to edit/delete each individual bid */
    echo "Bids (including winning bids and bids on inactive tasks):";
    echo '<table class="table">
            <tr><th>Task Name</th><th>Task Owner</th><th>Task Bidder</th><th>Bid Price</th><th>Edit Bid</th><th>Delete Bid</th></tr>';
    $query = "SELECT * FROM bids ORDER BY tid";
    $result = pg_query($db,$query);
    while($bids = pg_fetch_array($result)) {
      /*get the task name and owner of the task bid on */
      $tid = $bids['tid'];
      $qry = "SELECT * FROM task WHERE tid = '$tid'";
      $tresult = pg_query($db,$qry);
      $task = pg_fetch_array($tresult);

      echo '<tr><td>'.$task['tname'].'</td><td>'.$task['username'].'</td><td>'.$bids['username'].'</td><td>'.$bids['price'].'</td>
      <td><form action="edit-bids.php" method="POST"><input id="blank" type="hidden" name="Bidid" value="'.$bids['bid'].'"> <input class="btn btn-secondary btn-sm" type="submit" name="edit" id="submit" value="Edit Bid"/></form></td>
      <td><form action="edit-bids.php" method="POST"><input id="blank" type="hidden" name="Bidid" value="'.$bids['bid'].'"> <input class="btn btn-secondary btn-sm" type="submit" name="delete" id="submit" value="Delete Bid"/></form></td></tr>';
    }
    echo '</table>';



  }else{
    //if user is not logged in
    header ('location: login.php');
  }

  ?>



  </body>



  </html>
