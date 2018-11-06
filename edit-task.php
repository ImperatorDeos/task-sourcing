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
      if(!$result){
        //if query fails, giver user options to go back or try again
        echo "Failed to update, try again</br>";
        echo '<form action="edit-task.php" method="POST"><input id="blank" type="hidden" name="Taskid" value="'.$tid.'"> <input class="btn btn-primary btn-sm" type="submit" name="edit" id="submit" value="Try Again"/></form>';
        echo '<form action="admin-tasks.php" method="POST"><input class="btn btn-secondary btn-sm" type="submit" name="back" id="submit" value="Back"/></form>';

      }else{
        //if query successful, give user option to go back
           echo "Updated successfully!</br>";
           echo '<form action="admin-tasks.php" method="POST"><input class="btn btn-secondary btn-sm" type="submit" name="back" id="submit" value="Back"/></form>';
      }
    }else if(isset($_POST['delete'])){
      $taskid = $_POST['Taskid'];

      //SQL query to delete task from task table
      $qry = "DELETE FROM task WHERE tid='$taskid'";
      $result = pg_query($db,$qry);
      if(!$result){
        //if query fails, giver user options to go back or try again
        echo "Failed to delete, try again. Please note task cannot be deleted if it has been bid on or won</br>";
        echo '<form action="edit-task.php" method="POST"><input id="blank" type="hidden" name="Taskid" value="'.$taskid.'"> <input class="btn btn-primary btn-sm" type="submit" name="delete" id="submit" value="Try Again"/></form>';
        echo '<form action="admin-tasks.php" method="POST"><input class="btn btn-secondary btn-sm" type="submit" name="back" id="submit" value="Back"/></form>';

      }else{
        //if query successful, give user option to go back
           echo "Updated successfully!</br>";
           echo '<form action="admin-tasks.php" method="POST"><input class="btn btn-secondary btn-sm" type="submit" name="back" id="submit" value="Back"/></form>';
      }



    }else{
      /*Fetch task id and find information from task in database */
        $tid = $_POST['Taskid'];
        $query = "SELECT * FROM task WHERE tid = '$tid'";
        $result = pg_query($db,$query);
        $task = pg_fetch_array($result);
        echo '  <form action="edit-task.php" method="POST">
          <div class="form-group">
            <div class="form-row">
                   <label for="tname">Task Name: </label>
                    <input class="form-control" type="text"  pattern="^[^\']*$" name="tname" value="'.$task['tname'].'" required>
                  <label for="location">Location: </label>
                    <input class="form-control" type="text" pattern="^[^\']*$" name="location" value="'.$task['location'].'" required>
                <label for="price">Price: </label>
                  <input class="form-control" type="text" name="price" value="'.$task['setprice'].'" required>
              </div>
              <div class="form-row">
                <label for="date">Date: </label>
                  <input class="form-control" type="text" name="date" onfocus="(this.type=\'date\')" value="'.$task['sdate'].'" required>
                <label for="stime">Start Time: </label>
                  <input class="form-control" type="text" name="stime" onfocus="(this.type=\'time\')" value="'.$task['starttime'].'" required>
                <label for="etime">End Time: </label>
                  <input class="form-control" type="text" name="etime" onfocus="(this.type=\'time\')" value="'.$task['endtime'].'" required>
              </div>
              <div class="form-row">
                <label for="username">User Belonging: </label>
                  <input class="form-control" type="text" name="username" value="'.$task['username'].'" required>
                <label for="active">Active: </label>
                  <input class="form-control" type="text" name="active"';
                  /*Display true|false in a user friendly manner*/
                  if($task['active'] == "t"){
                    echo 'value="True"';
                  }else{
                    echo 'value="False"';
                  }
                  echo 'required>
              </div>

                <label for="tdiscrip">Task Description: </label>
                  <textarea class="form-control" pattern="^[^\']*$" name="tdiscrip" required>'.$task['tdiscrip'].'</textarea>
                   <input type="hidden" name="tid" value="'.$task['tid'].'">
                   <input class="btn btn-secondary btn-sm" type="submit" name="update" id="submit" value="Update Task" />
                   </div>
                 </form>';

    }


  }else{
    //if user is not logged in
    header ('location: login.php');
  }

  ?>



  </body>



  </html>
