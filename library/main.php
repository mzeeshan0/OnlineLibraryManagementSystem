<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Librarian Home Page</title>

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


      
        <h2>Welcome Librarian...</h2>
		<div class="kamal">
		<ul>
		<li><font color="blue">You can search the book by keyword or can browse all books by Author name or by Subject name.</font></li>
		<li>To discard a book, Search  for the book and click on </font><font color="green">''Discard Book''</font><font color="blue"> from the list.</font></li>
		</ul></div>
		<br>
<?php 
	$con = mysql_connect("localhost","root","");
	if(!$con)
	{
		die('could not connect'.mysql_error());
	}
	mysql_select_db("library" , $con);
?>
 
<form action="maina.php" method="post">
Enter book name: <input type="text" name="bookname" /><br>
<input type="submit"  value="Search"/></form>
<br>

Browse All Books By<br>
<form action="maina.php" method="post">
Author: 
	<select name="author">
	<?php
	$result = mysql_query("select distinct author from book group by author;");
	if($result)
	{
		while($row = mysql_fetch_array($result))
		{
			$name=$row['author'];	
			echo "<option value='$name' name='author'>$name</option>";
		}
	}
		?>
	</select><br />
	<input type="submit" value="Browse By Author"/>
</form>
<br>

Browse All Books By<br>
<form action="maina.php" method="post">
Subject: 
	<select name="subject">
	<?php
	$result = mysql_query("select distinct subject from book group by subject;");
	if($result)
	{
		while($row = mysql_fetch_array($result))
		{
			$name=$row['subject'];	
			echo "<option value='$name' name='subject'>$name</option>";
		}
	}
		?>
	</select><br />
	<input type="submit" value="Browse By Subject"/>
</form>

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