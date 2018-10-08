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
     <title>Tasks</title>
     <link rel="stylesheet" href="style.css" title="Style Sheet" type="text/css" />
     <?php
     //include relevant files
     include "connection.php";
     ?>
  </head>

  <body>
  <?php
    //Query selecting all task names
    echo "All tasks:";

    $query = "SELECT tname FROM task";
    $result = pg_query($db,$query);
    while($row = pg_fetch_array($result)) {
        echo $row['tname'];
        echo "<br>";
    }
    //Cant get the link to work:
    //echo "<a href="Home.php">Home</a>";




  }else{
    //if user is not logged in
    header ('location: login.php');
  }

  ?>



  </body>



  </html>
