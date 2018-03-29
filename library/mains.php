<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Student Home Page</title>
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

    $con = mysql_connect("localhost","root","");
  if(!$con)
  {
    die('could not connect'.mysql_error());
  }
  mysql_select_db("library" , $con);
  


    echo "<font color='blue'><p align='right'>ID:</font> ". $_SESSION['user']['username']."</p>";
    echo "<font color='blue'><p align='right'>Name:</font> ". $_SESSION['user']['fullname']."</p>";
    ?>

<font color="blue">You can search the book by keyword or can browse all books by Author name or by Subject name.</font>
<br><br> 		
<form action="search.php" method="post">
Enter book name: <input type="text" name="booknm" /><br>
<input type="hidden" name="searchtype" value="name" />
<input type="submit" value="search"/></form>
<br>

<?php
$query="select author from book group by(author)";
$result=mysql_query($query);
?>
or browse all books by Author:<br>

<form action="search.php" method="post">
select author: 
<select name="authorslct">
<?php
while ($line = mysql_fetch_array($result))
  { ?>

<option value="<?php echo $line['author'];?>">
<?php echo $line['author'];?>
</option>
<?php } ?>
</select>

<input type="hidden" name="searchtype" value="author" />
<br />
<input type="submit" value="Browse by Author"/>
</form>
<br />

<?php
$query="select subject from book group by(subject)";
$result=mysql_query($query);
?>
or browse all books by Subject:<br>

<form action="search.php" method="post">
select author: 
<select name="subjectslct">
<?php
while ($line = mysql_fetch_array($result))
  { ?>

<option value="<?php echo $line['subject'];?>">
<?php echo $line['subject'];?>
</option>
<?php } ?>
</select>

<input type="hidden" name="searchtype" value="subject" />
<br />
<input type="submit" value="Browse by Author"/>
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