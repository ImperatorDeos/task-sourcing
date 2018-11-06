<?xml version="1.0" encoding="UTF-8"?>
<html xmlns="http://www.w3.org/1999/xhtml"
      xml:lang="en">
  <head>
  <?php
  //start session
  session_start();
  //check  session vaiable admin is present and user logged in
  //only admins can access this page
  if(isset($_SESSION['username'])){
    //include relevant files
    include "connection.php";
    include "header.php";
  ?>
     <title>Edit Wins</title>

  </head>

  <body>
  <?php

    /*if(isset($_POST['update'])){
      $obid = $_POST['obid'];
      $ouser = $_POST['ouser'];
      $otid = $_POST['otid'];

      $username = $_POST['username'];
      $bid = $_POST['bid'];
      $tid = $_POST['tid'];

      $qry = "DELETE FROM winner WHERE bid='$obid' AND username='$ouser' AND tid='$otid'";
      $result1 = pg_query($db,$qry);
      if(!$result1){
        //if query fails, giver user options to go back or try again
        //echo $obid;
        //echo $bid;
        echo "Failed delete</br>";
        echo '<form action="edit-wins.php" method="POST"><input id="blank" type="hidden" name="ouser" value="'.$ouser.'"><input id="blank" type="hidden" name="obid" value="'.$obid.'"><input id="blank" type="hidden" name="Taskid" value="'.$bid.'"> <input class="btn btn-primary btn-sm" type="submit" name="edit" id="submit" value="Try Again"/></form>';
        echo '<form action="admin-wins.php" method="POST"><input class="btn btn-secondary btn-sm" type="submit" name="back" id="submit" value="Back"/></form>';

      }else{
        //SQL query to insert into bid table
          $qry = "INSERT INTO winner (username, bid, tid) VALUES ('$username','$bid','$tid')";
          $result2 = pg_query($db,$qry);

        if(!$result2){
          //if query fails, giver user options to go back or try again
          //echo $bid;
          echo "Failed to update, try again</br>";
          echo '<form action="edit-wins.php" method="POST"><input id="blank" type="hidden" name="ouser" value="'.$ouser.'"><input id="blank" type="hidden" name="obid" value="'.$obid.'"><input id="blank" type="hidden" name="Taskid" value="'.$bid.'"> <input class="btn btn-primary btn-sm" type="submit" name="edit" id="submit" value="Try Again"/></form>';
          echo '<form action="admin-wins.php" method="POST"><input class="btn btn-secondary btn-sm" type="submit" name="back" id="submit" value="Back"/></form>';

        }else{
          //if query successful, give user option to go back
             echo "Updated successfully!</br>";
             echo '<form action="admin-wins.php" method="POST"><input class="btn btn-secondary btn-sm" type="submit" name="back" id="submit" value="Back"/></form>';
        }
      }


    }else*/
    /*check if variable is present to request the deletion of the win*/
    if(isset($_POST['delete'])){

      $obid = $_POST['winbid'];
      $ouser = $_POST['wusername'];
      $otid = $_POST['Taskid'];

      //delete from win from table
      $qery = "DELETE FROM winner WHERE bid='$obid' AND username='$ouser' AND tid='$otid'";
      $result3 = pg_query($db,$qery);

      //return state of task to active - allowing user to select new winner
      $qry = "UPDATE task SET active='True' WHERE tid='$otid'";
      $result = pg_query($db,$qry);

      if(!$result3 || !$result){
        //if query fails, giver user options to go back or try again

        echo "Failed to delete, try again</br>";
        echo '<form action="edit-wins.php" method="POST"><input id="blank" type="hidden" name="winbid" value="'.$obid.'"><input id="blank" type="hidden" name="wusername" value="'.$ouser.'"><input id="blank" type="hidden" name="Taskid" value="'.$otid.'"><input class="btn btn-primary btn-sm" type="submit" name="delete" id="submit" value="Try Again"/></form>';
        echo '<form action="admin-wins.php" method="POST"><input class="btn btn-secondary btn-sm" type="submit" name="back" id="submit" value="Back"/></form>';

      }else{
        //if query successful, give user option to go back
           echo "Deleted successfully!</br>";
           echo '<form action="admin-wins.php" method="POST"><input class="btn btn-secondary btn-sm" type="submit" name="back" id="submit" value="Back"/></form>';
      }

    }/*else{
      //Fetch bid information from database - to select new winner

        $otid = $_POST['Taskid'];
        $obid = $_POST['wbid'];
        $ouser = $_POST['wusername'];

        $query = "SELECT * FROM bids WHERE tid = '$otid'";
        $result = pg_query($db,$query);

        echo '<table class="table">
                <th>User</th><th>Bid Price</th><th>Select Winner</th>';
        while($bids = pg_fetch_array($result)){
          echo '<tr><td>'.$bids['username'].'</td><td>'.$bids['price'].'</td>
          <td><form action="edit-wins.php" method="POST"><input id="blank" type="hidden" name="otid" value="'.$otid.'"><input id="blank" type="hidden" name="ouser" value="'.$ouser.'"><input id="blank" type="hidden" name="obid" value="'.$obid.'"><input id="blank" type="hidden" name="username" value="'.$bids['username'].'"><input id="blank" type="hidden" name="bid" value="'.$bids['bid'].'"><input id="blank" type="hidden" name="tid" value="'.$bids['tid'].'">
           <input class="btn btn-secondary btn-sm" type="submit" name="update" id="submit" value="Select As Winner"/></form></td></tr>';
        }

    }*/


  }else{
    //if user is not logged in
    header ('location: login.php');
  }

  ?>



  </body>



  </html>
