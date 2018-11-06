<?xml version="1.0" encoding="UTF-8"?>
<html xmlns="http://www.w3.org/1999/xhtml"
      xml:lang="en">
  <head>
  <?php
  //start session
  session_start();
  //check  session vaiable username is present and user logged in
  //only admin can access this page
  if(isset($_SESSION['username']) && isset($_SESSION['admin']))
  {
    //include relevant files
     include "header.php";
     include "connection.php";
  ?>
     <title>Admin</title>
     <link rel="stylesheet" href="style.css" title="Style Sheet" type="text/css" />
  </head>

  <body>
  <?php


  echo "<h4>From this page you will be able to edit all entries in this Database: </h4>";
  /* only admins should be ables to access these pages */
  echo ' <div class="btn-group">
            <a href="admin-tasks.php"><button class="btn btn-secondary btn-lg" type="button">Edit Tasks</button></a>
            <a href="admin-bids.php"><button class="btn btn-secondary btn-lg" type="button">Edit Bids</button></a>
            <a href="admin-wins.php"><button class="btn btn-secondary btn-lg" type="button">Edit Wins</button></a>
            <a href="admin-users.php"><button class="btn btn-secondary btn-lg" type="button">Edit Users</button></a>
          </div>';

  }else if(isset($_SESSION['username'])){
    //if user is not logged in as admin
      header ('location: home.php');
  }else{
      header ('location: login.php');
  }

  ?>



  </body>



  </html>
