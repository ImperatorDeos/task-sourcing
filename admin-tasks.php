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
     <title>Edit Tasks</title>
     <link rel="stylesheet" href="style.css" title="Style Sheet" type="text/css" />
  </head>

  <body>
  <?php
    /*List all tasks with and option to edit each individual task */
    echo "Tasks";
    echo '<table class="table">
            <tr><th>Task Name</th><th>Description</th><th>Location</th><th>Date</th><th>Start</th><th>End</th><th>Ask Price</th><th>Edit Task</th><th>Delete Task</th></tr>';
    $query = "SELECT * FROM task ORDER BY tid";
    $result = pg_query($db,$query);
    while($tasks = pg_fetch_array($result)) {
      echo '<tr><td>'.$tasks['tname'].'</td><td>'.$tasks['tdiscrip'].'</td><td>'.$tasks['location'].'</td><td>'.$tasks['sdate'].'</td><td>'.$tasks['starttime'].'</td><td>'.$tasks[endtime].'</td><td>'.$tasks['setprice'].'</td>
      <td><form action="edit-task.php" method="POST"><input id="blank" type="hidden" name="Taskid" value="'.$tasks['tid'].'"> <input type="submit" name="edit" id="submit" value="Edit Task"/></form></td>
      <td><form action="edit-task.php" method="POST"><input id="blank" type="hidden" name="Taskid" value="'.$tasks['tid'].'"> <input type="submit" name="delete" id="submit" value="Delete Task"/></form></td></tr>';
    }
    echo '</table>';

    //Cant get the link to work:





  }else{
    //if user is not logged in
    header ('location: login.php');
  }

  ?>



  </body>



  </html>
