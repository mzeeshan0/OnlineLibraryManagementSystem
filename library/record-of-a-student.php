<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>View Record of a Student</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>

<div id="wrapper"> 

  <div id="header"> 

    <div class="top_banner">
      <h2>Online Library System</h2>
      
    </div>

  </div>

  <div id="page_content">

    
    <div class="left_side_bar"> 

      <div class="col_1">
        <h1>Navigation</h1>
        <div class="box">
          <ul>
            <li><a href="main.php">Home</a></li>
			<li><a href="enter-new-book.php">Enter a new book</a></li>
			<li><a href="record-of-a-student.php">See Record of a Student</a></li>
            <li><a href="bookrecord.php">Book History</a></li>
			<li><a href="reservel.php">Books reserved by Students</a></li>
			<li><a href="logout.php">Log out</a></li>
			</ul>
        </div>
      </div>

    </div>

    <div class="right_section">
      <div class="common_content">


<?php
// First we execute our common code to connection to the database and start the session 
    require("login/common.php"); 
     
    // At the top of the page we check to see whether the user is logged in or not 
    if(empty($_SESSION['user'])) 
    { 
        // If they are not, we redirect them to the login page. 
        header("Location: login.php"); 
         
        // Remember that this die statement is absolutely critical.  Without it, 
        // people can view your members-only content without logging in. 
        die("Redirecting to login.php"); 
    } 
    ?>



        
<font color="blue">Enter ID of Student you want to see the Record.</font>		
<form action="record-of-a-student2.php" method="post">
Enter Student ID: <input type="text" name="id" /><br>
<input type="submit" value="View Record"/></form>
<br>


        </div>
      <div class="top_content">
 
        <div class="column_two border_left">
		
          </div>
      </div>
    </div>

    <div class="clear"></div>
    
    <!--start footer from here-->
    <div id="footer"></div>
	
    <!--/. end footer from here-->
  </div>

</div>

</body></html>