<?xml version="1.0" encoding="UTF-8"?>
<html xmlns="http://www.w3.org/1999/xhtml"
      xml:lang="en">
  <head>

    <ul id="menu">
      <li><a href="Home.php">Home</a></li>
      <li><a href="Account.php">Profile</a></li>
      <div id="search">
        <form method="POST" id="searchform" action="search.php">
          <div>
            <input type="text" placeholder="Task" name="s" id="s" onfocus="defaultInput(this)" onblur="clearInput(this)">
            <li><a href="logout.php">Logout</a></li>
          </div>
        </form>
      </div>
    </ul>
  </head>

</html>
