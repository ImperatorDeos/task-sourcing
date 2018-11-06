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
     <title>Select a Winning Bid</title>

  </head>

  <body>
  <?php


  /*Check if insert variable is present, if so load in variablesto select winner */
    if(isset($_POST['winner'])){

      $username = $_POST['username'];

      $bid = $_POST['bid'];
      $tid = $_POST['tid'];


      //SQL query to insert into bid table
        $qry = "INSERT INTO winner (username, bid, tid) VALUES ('$username','$bid','$tid')";
        $result = pg_query($db,$qry);


      if(!$result)
      {
        //if query fails, giver user options to go back or try again
        echo "Failed to Select winner, try again</br>";
        echo '<form action="winner.php" method="POST"><input id="blank" type="hidden" name="Taskid" value="'.$tid.'"> <input class="btn btn-primary btn-sm" type="submit" name="selectwinner" id="submit" value="Try Again"/></form>';
        echo '<form action="profile.php" method="POST"><input class="btn btn-secondary btn-sm" type="submit" name="back" id="submit" value="Back"/></form>';

      }else{
        //if query successful, give user option to go back
           echo "Winner selected, congratulations!</br>";
           echo '<form action="profile.php" method="POST"><input class="btn btn-secondary btn-sm" type="submit" name="back" id="submit" value="Back"/></form>';
           $query = "UPDATE task SET active='FALSE' WHERE tid='$tid'";
           $test = pg_query($db,$query);
      }
    }else{
      /*Fetch task id and find information of bids on that task in database */

        $tid = $_POST['Taskid'];

        $query = "SELECT * FROM bids WHERE tid = '$tid'";
        $result = pg_query($db,$query);

        echo '<table class="table">
                <th>User</th><th>Bid Price</th><th>Select Winner</th>';
        while($bids = pg_fetch_array($result)){
          echo '<tr><td>'.$bids['username'].'</td><td>'.$bids['price'].'</td>
          <td><form action="winner.php" method="POST"><input id="blank" type="hidden" name="username" value="'.$bids['username'].'"><input id="blank" type="hidden" name="bid" value="'.$bids['bid'].'"><input id="blank" type="hidden" name="tid" value="'.$bids['tid'].'"> <input class="btn btn-secondary btn-sm" type="submit" name="winner" id="submit" value="Select Winner"/></form></td></tr>';
        }


    }

  }else{
    //if user is not logged in
    header ('location: login.php');
  }

  ?>



  </body>



  </html>
