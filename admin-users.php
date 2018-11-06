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
     <title>Edit Users</title>

  </head>

  <body>
  <?php
    /*List all tasks with and option to edit each individual task */
    echo "<h2>Users</h2>";
    echo '<table class="table">
            <tr><th>First Name</th><th>Last Name</th><th>username</th><th>Admin</th><th>Edit</th></tr>';

    $query = "SELECT * FROM member ORDER BY lname ASC";
    $result = pg_query($db,$query);


    while($users = pg_fetch_array($result)) {
      $username = $users['username'];
      $chkadmin = "SELECT username FROM admin WHERE username = '$username'";
      $test = pg_query($db,$chkadmin);
      echo '<tr><td>'.$users['fname'].'</td><td>'.$users['lname'].'</td><td>'.$username.'</td>';
      /*Check to see if query for admin test returned results*/
        if( pg_num_rows($test) == 0){
          echo '<td>No</td>';
        }else{
          echo '<td class="admin-yes">Yes</td>';
        }
      echo '<td><form action="edit-users.php" method="POST"><input id="blank" type="hidden" name="userid" value="'.$users['username'].'"> <input class="btn btn-secondary btn-sm" type="submit" name="edit" id="submit" value="Edit User"/></form></td></tr>';
    }

    echo '</table>';


  }else{
    //if user is not logged in
    header ('location: login.php');
  }

  ?>



  </body>



  </html>
