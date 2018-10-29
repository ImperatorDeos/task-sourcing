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
     <link rel="stylesheet" href="style.css" title="Style Sheet" type="text/css" />
  </head>

  <body>
  <?php
    /*List all tasks with and option to edit each individual task */
    echo "Users";
    echo '<table>
            <tr><th>First Name</th><th>Last Name</th><th>username</th><th>Admin</th><th>Edit</th></tr>';


    //$query = "SELECT * FROM member INNER JOIN admin ON member.username = admin.username ORDER BY lname, fname";
    $query = "SELECT * FROM member";
    $result = pg_query($db,$query);
    while($users = pg_fetch_array($result)) {
      echo '<tr><td>'.$users['fname'].'</td><td>'.$users['lname'].'</td><td>'.$users['username'].'</td><td>'.$tasks['admin.username'].'</td>
      <td><form action="edit-user.php" method="POST"><input id="blank" type="hidden" name="userid" value="'.$users['username'].'"> <input type="submit" name="edit" id="submit" value="Edit User"/></form></td></tr>';
    }


    $chkadmin = "SELECT * FROM admin WHERE username = '$username'";
    echo '</table>';

    //Cant get the link to work:





  }else{
    //if user is not logged in
    header ('location: login.php');
  }

  ?>



  </body>



  </html>
