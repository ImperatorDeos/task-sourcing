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


  echo "From this page you will be able to edit all entries in this Database";
  /* only admins should be ables to access these pages */
  echo '<ul id="admin-men">
  <li><a href="admin-tasks.php">Edit Tasks</a></li>
  <li><a href="admin-bids.php">Edit Bids</a></li>
  <li><a href="admin-wins.php">Edit Wins</a></li>
  <li><a href="admin-users.php">Edit Users</a></li>
  </ul>';



  }else if(isset($_SESSION['username'])){
    //if user is not logged in
      header ('location: home.php');
  }else{
      header ('location: login.php');
  }

  ?>



  </body>



  </html>
