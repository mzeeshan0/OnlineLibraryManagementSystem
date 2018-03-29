`<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Home Page</title>
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
            <li><a href="mains.php">Home</a></li>
			<li><a href="history.php">View History</a></li>
			<li><a href="studentReserved.php">View Reserved books</a></li>
            <li><a href="contact2.php">Contact/Feedback</a></li>
			<li><a href="logout.php">Log out</a></li>
          </ul>
        </div>
      </div>

    </div>

    <div class="right_section">
      <div class="common_content">
        <html>
<head>
<title>Library Management System</title>
</head>

<?php
//Kamal Ashraf - 12105001//
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
  $con = mysql_connect("localhost","root","");
  if(!$con)
  {
    die('could not connect'.mysql_error());
  }
  mysql_select_db("library" , $con);
  $book = $_POST['b'];
echo "do you really want to discard <font color='blue'>".$book."</font>?";
  echo "<form action='discardbook2.php' method='post'>
 <input type='hidden' name='b' value='$book' />
 <input type='submit' value='yes'/></form>";

  ?>




<body>

</body>
</html>


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