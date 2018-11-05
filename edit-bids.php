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
     <title>Edit bids</title>

  </head>

  <body>
  <?php

    if(isset($_POST['update'])){
      $bid = $_POST['Bidid'];
      $price = $_POST['bidprice'];

      //SQL query to update member table
      $qry = "UPDATE bids SET price='$price' WHERE bid= '$bid'";
      $result1 = pg_query($db,$qry);
      if(!$result1){
        //if query fails, giver user options to go back or try again
        //echo $bid;
        echo "Failed to update, try again</br>";
        echo '<form action="edit-bids.php" method="POST"><input id="blank" type="hidden" name="Bidid" value="'.$bid.'"> <input class="btn btn-primary btn-sm" type="submit" name="edit" id="submit" value="Try Again"/></form>';
        echo '<form action="admin-bids.php" method="POST"><input class="btn btn-secondary btn-sm" type="submit" name="back" id="submit" value="Back"/></form>';

      }else{
        //if query successful, give user option to go back
           echo "Updated successfully!</br>";
           echo '<form action="admin-bids.php" method="POST"><input class="btn btn-secondary btn-sm" type="submit" name="back" id="submit" value="Back"/></form>';
      }
    }else if(isset($_POST['delete'])){
      $bid = $_POST['Bidid'];
      $qery = "DELETE FROM bids WHERE bid='$bid'";
      $result2 = pg_query($db,$qery);
      if(!$result2){
        //if query fails, giver user options to go back or try again

        echo "Failed to delete, try again</br>";
        echo '<form action="edit-bids.php" method="POST"><input id="blank" type="hidden" name="Bidid" value="'.$bid.'"> <input class="btn btn-primary btn-sm" type="submit" name="delete" id="submit" value="Try Again"/></form>';
        echo '<form action="admin-bids.php" method="POST"><input class="btn btn-secondary btn-sm" type="submit" name="back" id="submit" value="Back"/></form>';

      }else{
        //if query successful, give user option to go back
           echo "Deleted successfully!</br>";
           echo '<form action="admin-bids.php" method="POST"><input class="btn btn-secondary btn-sm" type="submit" name="back" id="submit" value="Back"/></form>';
      }

    }else{
      /*Fetch bid information from database */
        $bid = $_POST['Bidid'];
        $query = "SELECT * FROM bids WHERE bid = '$bid'";
        $result = pg_query($db,$query);
        $bid = pg_fetch_array($result);

        echo '<form action="edit-bids.php" method="POST">
                <label for="bidprice">New Bid Price: </label>
                  <input class="form-control" type="text" name="bidprice" value="'.$bid['price'].'" required>
                  <input type="hidden" name="Bidid" value="'.$bid['bid'].'">
                <input class="btn btn-secondary btn-sm" type="submit" name="update" id="submit" value="Edit Bid" />
              </form>';
    }

  }else{
    //if user is not logged in
    header ('location: login.php');
  }

  ?>



  </body>



  </html>
