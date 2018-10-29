<?php

// include connection to database
include "connection.php";

//end session
session_start();
session_destroy();

//redirect to login
header ('Location: login.php');

?>
