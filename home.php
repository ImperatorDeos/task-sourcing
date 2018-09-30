<?xml version="1.0" encoding="UTF-8"?>
<html xmlns="http://www.w3.org/1999/xhtml"
      xml:lang="en">
  <head>
  <?php
  //start session
  session_start();
  //check  session vaiable username is present and user logged in
  if(isset($_SESSION['username']))
  {
  ?>
     <title>Login</title>
     <link rel="stylesheet" href="style.css" title="Style Sheet" type="text/css" />
     <?php
     //include relevant files
      include "header.php";
      include "connection.php";
     ?>
  </head>

  <body>
  <?php
    echo "working login";



  }else{
    //if user is not logged in
    header ('location: login.php');
  }

  ?>



  </body>



  </html>
