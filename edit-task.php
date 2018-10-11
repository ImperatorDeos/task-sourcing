<?xml version="1.0" encoding="UTF-8"?>
<html xmlns="http://www.w3.org/1999/xhtml"
      xml:lang="en">
  <head>
  <?php
  //start session
  session_start();
  //check  session vaiable admin is present and user logged in
  //only admins can access this page
  if(isset($_SESSION['admin']))
  {
    //include relevant files
    include "connection.php";
    include "header.php";
  ?>
     <title>Edit Task</title>
     <link rel="stylesheet" href="style.css" title="Style Sheet" type="text/css" />
  </head>

  <body>
  <?php


  /*Check if update variable is present, if so load in variables changed from the form */
    if(isset($_POST['update'])){
      $tname = $_POST['tname'];
      $tdiscrip = $_POST['tdiscrip'];
      $location = $_POST['location'];
      $date = $_POST['date'];
      $stime = $_POST['stime'];
      $etime = $_POST['etime'];
      $username = $_POST['username'];
      $active = $_POST['active'];
      $price = $_POST['price'];
      $tid = $_POST['tid'];

      //SQL query to update task table
      $qry = "UPDATE task SET tname='$tname', tdiscrip='$tdiscrip', location='$location', sdate='$date', starttime='$stime', endtime='$etime', username='$username', active='$active', setprice='$price'  WHERE tid='$tid'";
      $result = pg_query($db,$qry);
      if(!$result)
      {
        //if query fails, giver user options to go back or try again
        echo "Failed to update, try again";
        echo '<form action="edit-task.php" method="POST"><input id="blank" type="hidden" name="Taskid" value="'.$tid.'"> <input type="submit" name="edit" id="submit" value="Try Again"/></form>';
        echo '<form action="admin-tasks.php" method="POST"><input type="submit" name="back" id="submit" value="Back"/></form>';

      }else{
        //if query successful, give user option to go back
           echo "Updated successfully!";
           echo '<form action="admin-tasks.php" method="POST"><input type="submit" name="back" id="submit" value="Back"/></form>';
      }
    }else{
      /*Fetch task id and find information from task in database */
        $tid = $_POST['Taskid'];
        $query = "SELECT * FROM task WHERE tid = '$tid'";
        $result = pg_query($db,$query);
        $task = pg_fetch_array($result);
        //echo "Edit:";
        /*Display in editable format */
        echo '  <form action="edit-task.php" method="POST">
                   Task Name: <br><input type="text"  pattern="^[^\']*$" name="tname" value="'.$task['tname'].'" required></br>
                   Task Description: <br><input type="text" pattern="^[^\']*$" name="tdiscrip" value="'.$task['tdiscrip'].'" required></br>
                   Location: <br><input type="text" pattern="^[^\']*$" name="location" value="'.$task['location'].'" required></br>
                   Date: <br><input type="text" name="date" value="'.$task['sdate'].'" required></br>
                   Start Time: <br><input type="text" name="stime" value="'.$task['starttime'].'" required></br>
                   End Time: <br><input type="text" name="etime" value="'.$task['endtime'].'" required></br>
                   User Belonging Too: <br><input type="text" name="username" value="'.$task['username'].'" required></br>
                   Active: <br><input type="text" name="active" value="'.$task['active'].'" required></br>
                   Price: <br><input type="text" name="price" value="'.$task['setprice'].'" required></br>
                  <input type="text" name="tid" value="'.$task['tid'].'">
                   <input type="submit" name="update" id="submit" value="Update Task" />
                 </form>';

    }







  }else{
    //if user is not logged in
    header ('location: login.php');
  }

  ?>



  </body>



  </html>
