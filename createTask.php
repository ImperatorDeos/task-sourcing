<?xml version="1.0" encoding="UTF-8"?>
<html xmlns="http://www.w3.org/1999/xhtml"
      xml:lang="en">
  <head>
  <?php
  //start session
  session_start();
  //check  session vaiable admin is present and user logged in
  //only admins can access this page
  if(isset($_SESSION['username']))
  {
    //include relevant files
    include "connection.php";
    include "header.php";
  ?>
     <title>Create Task</title>
     <link rel="stylesheet" href="style.css" title="Style Sheet" type="text/css" />
  </head>

  <body>
  <?php
  echo 'The following link to forms to assist you in creating your task:</br>';
  echo '<form action="createTask.php" method="POST">
            <input type="submit" name="one" id="submit" value="Car Wash" />
        </form>';
  echo '<form action="createTask.php" method="POST">
          <input type="submit" name="two" id="submit" value="Dog Walk" />
        </form>';
  echo '<form action="createTask.php" method="POST">
          <input type="submit" name="three" id="submit" value="Install Software" />
        </form></br>';


  /*Check if update variable is present, if so load in variables changed from the form */
    if(isset($_POST['task'])){

      $tname = $_POST['tname'];
      $tdiscrip = $_POST['tdiscrip'];
      $location = $_POST['location'];
      $date = $_POST['date'];
      $stime = $_POST['stime'];
      $etime = $_POST['etime'];
      $username = $_POST['username'];
      $active = "True";
      $price = $_POST['price'];
      $date_now = new DateTime();
      date_format($date, "d/m/Y");
      date_format($date_now, "d/m/Y");


      /*Date check is not working - time check has not been tested*/
      if($date_now > $date && $stime > $etime){

      }else{
        //SQL query to insert into bid table
          $qry = "INSERT INTO task (tname, tdiscrip, location, sdate, starttime, endtime, username, active, setprice) VALUES ('$tname','$tdiscrip','$location','$date','$stime','$etime','$username','$active','$price')";
          $result = pg_query($db,$qry);
      }

      if(!$result)
      {
        //if query fails, giver user options to go back or try again
        echo "Failed to create task, try again";
        echo '<form action="createTask.php" method="POST"><input type="submit" name="createTask" id="submit" value="Try Again"/></form>';
        echo '<form action="task.php" method="POST"><input type="submit" name="back" id="submit" value="Back"/></form>';

      }else{
        //if query successful, give user option to go back
           echo "Task created!";
           echo '<form action="task.php" method="POST"><input type="submit" name="back" id="submit" value="Back"/></form>';
      }
    }else if(isset($_POST['one'])){
      $date_now = new DateTime(); //create a new date object

      /**Sample form for user - can submit as is or edit **/
      echo '  <form action="createTask.php" method="POST">
                 Task Name: <br><input type="text"  pattern="^[^\']*$" name="tname" value="Car Wash" required></br>
                 Task Description: <br><input type="text" pattern="^[^\']*$" name="tdiscrip" value="Please help washing my car" required></br>
                 Location: <br><input type="text" pattern="^[^\']*$" name="location" value="Singapore" required></br>
                 Date: <br><input type="text" name="date" onfocus="(this.type=\'date\')" value="'; echo date_format($date_now, "d/m/Y"); echo '" required></br>
                 Start Time: <br><input type="text"  onfocus="(this.type=\'time\')" name="stime" value="12:00 PM" required></br>
                 End Time: <br><input type="text" onfocus="(this.type=\'time\')" name="etime" value="1:00 PM" required></br>
                 Price: <br><input type="text" name="price" value="50" required></br>
                 <input type="hidden" name="username" value="'.$_SESSION['username'].'" required>
                 <input type="submit" name="task" id="submit" value="Create Task" />
               </form>';

    }else if(isset($_POST['two'])){
      $date_now = new DateTime();

      echo '  <form action="createTask.php" method="POST">
                 Task Name: <br><input type="text"  pattern="^[^\']*$" name="tname" value="Dog Walk" required></br>
                 Task Description: <br><input type="text" pattern="^[^\']*$" name="tdiscrip" value="Please walk my Dog 2km" required></br>
                 Location: <br><input type="text" pattern="^[^\']*$" name="location" value="Singapore" required></br>
                 Date: <br><input type="text" name="date" onfocus="(this.type=\'date\')" value="'; echo date_format($date_now, "d/m/Y"); echo '" required></br>
                 Start Time: <br><input type="text"  onfocus="(this.type=\'time\')" name="stime" value="6:00 PM" required></br>
                 End Time: <br><input type="text" onfocus="(this.type=\'time\')" name="etime" value="7:00 PM" required></br>
                 Price: <br><input type="text" name="price" value="10" required></br>
                 <input type="hidden" name="username" value="'.$_SESSION['username'].'" required>
                 <input type="submit" name="task" id="submit" value="Create Task" />
               </form>';


    }else if(isset($_POST['three'])){
      $date_now = new DateTime();

      echo '  <form action="createTask.php" method="POST">
                 Task Name: <br><input type="text"  pattern="^[^\']*$" name="tname" value="Install Software" required></br>
                 Task Description: <br><input type="text" pattern="^[^\']*$" name="tdiscrip" value="Please help install Unix on my PC" required></br>
                 Location: <br><input type="text" pattern="^[^\']*$" name="location" value="National University of Singapore" required></br>
                 Date: <br><input type="text" name="date" onfocus="(this.type=\'date\')" value="'; echo date_format($date_now, "d/m/Y"); echo '" required></br>
                 Start Time: <br><input type="text"  onfocus="(this.type=\'time\')" name="stime" value="3:00 PM" required></br>
                 End Time: <br><input type="text" onfocus="(this.type=\'time\')" name="etime" value="4:00 PM" required></br>
                 Price: <br><input type="text" name="price" value="20" required></br>
                 <input type="hidden" name="username" value="'.$_SESSION['username'].'" required>
                 <input type="submit" name="task" id="submit" value="Create Task" />
               </form>';

    }else{
      /*Display form to create task*/
        /*Display in editable format */
        echo '
                  <form action="createTask.php" method="POST">
                   Task Name: <br><input type="text"  pattern="^[^\']*$" name="tname" value="" required></br>
                   Task Description: <br><input type="text" pattern="^[^\']*$" name="tdiscrip" value="" required></br>
                   Location: <br><input type="text" pattern="^[^\']*$" name="location" value="" required></br>
                   Date: <br><input type="date" name="date" value="" required></br>
                   Start Time: <br><input type="time" name="stime" value="" required></br>
                   End Time: <br><input type="time" name="etime" value="" required></br>
                   User Belonging Too: <br><input type="hidden" name="username" value="'.$_SESSION['username'].'" required></br>
                   Price: <br><input type="text" name="price" value="" required></br>
                   <input type="submit" name="task" id="submit" value="Create Task" />

                 </form>';
    }

  }else{
    //if user is not logged in
    header ('location: login.php');
  }

  ?>



  </body>



  </html>
