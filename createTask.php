<!DOCTYPE html>
<?php
	session_start();
?>
<html>
<title>Create Task</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}
body, html {
    height: 100%;
    line-height: 1.8;
}
.w3-bar .w3-button {
    padding: 20px;
}
.row::after {
    content: "";
    clear: both;
    display: table;
}
[class*="col-"] {
    float: left;
    padding: 15px;
}
.col-1 {width: 8.33%;}
.col-2 {width: 16.66%;}
.col-3 {width: 25%;}
.col-4 {width: 33.33%;}
.col-5 {width: 41.66%;}
.col-6 {width: 50%;}
.col-7 {width: 58.33%;}
.col-8 {width: 66.66%;}
.col-9 {width: 75%;}
.col-10 {width: 83.33%;}
.col-11 {width: 91.66%;}
.col-12 {width: 100%;}
</style>
<body>

<!-- Create Task -->
<div class="w3-container w3-light-grey" style="padding:96px" id="home">
  <h1 class="w3-center">Create Task</h1>
  <p class="w3-center w3-large">Create a new task to start!</p>
  <div class="w3-row-padding" style="margin-top:64px padding:128px 16px">
    <div class="w3-content" align="center">
      <form action="createTask.php" method="POST" >
        
        <div class="row">
          <span>Task Title</span>
          <div class="col-12">
            <input class="w3-input w3-border" type="text" placeholder="Task Title" required name="tasktitle">
          </div>
        </div>
        
        <div class="row">
          <span>Description</span>
          <div class="col-12">  
            <textarea class="w3-input w3-border" type="textarea" placeholder="Description of task..." required name="taskdescription"></textarea>
          </div>
        </div>

        <div class="row">
          <span>Location</span>
          <div class="col-12">  
            <textarea class="w3-input w3-border" type="textarea" placeholder="Location of task..." required name="taskdescription"></textarea>
          </div>
        </div>
        
        <div class="row">
          <div class="col-6">
            <span>Start Date</span>
            <input class="w3-input w3-border" type="date" required name="starttaskdate">
          </div>

         
        </div>

        <div class="row">
          <div class="col-6">
            <span>Start Time</span>
            <input class="w3-input w3-border" type="time" required name="starttasktime">
          </div>
          <div class="col-6">
            <span>End Time</span>  
            <input class="w3-input w3-border" type="time" required name="endtasktime">
          </div>
        </div>
        
        <div class="row">
          <div class="col-6">
            <span>Task Price</span>
            <input class="w3-input w3-border" type="number" placeholder="Task Price in SGD" required name="taskprice">
          </div>

      
        </div>
        <p>
          <button class="w3-button w3-black" type="submit" name = "create">
            <i class="fa fa-pencil"></i> CREATE
          </button>
        </p>
      </form>
    </div>
  </div>

</div>

<?php
  if(isset($_POST['create'])) {
    // Connect to database. NEED TO CHANGE  
    $db     = pg_connect("host=localhost port=5432 dbname=CS2102 user=postgres password=root");

    $rn = $_SESSION['username']; // current session user

    //PLEASE CHECK IF THIS IS CORRECT!! Thanks
    $result = pg_query($db, "SELECT createTask('$rn', '$_POST[tname]', '$_POST[tdiscrip]','$_POST[location]',
						'$_POST[tasktype]', '$_POST[taskprice]', '$_POST[starttaskdate]', '$_POST[sdate]','$_POST[starttime]', '$_POST[endtime]',
						'$_POST[setprice]')");
    
    if(!$result) {
      echo "<script>
              var startDate = new Date('$_POST[sdate]');
    
              var today = new Date();
              today.setHours(0,0,0,0);
            if (startDate < today){
                alert('Check that your start date is not in the past.');
              } else {
                alert('Error in adding task. Try again!');
              }
              
            </script>";
    } else {
      echo "<script> alert('Success!') </script>";
    }
  }  
?>