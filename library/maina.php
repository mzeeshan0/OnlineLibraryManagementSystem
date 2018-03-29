<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Search Result</title>

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



    
      <div class="common_content">
<?php
	$con = mysql_connect("localhost","root","");
	if(!$con)
	{
		die('could not connect'.mysql_error());
	}
	mysql_select_db("library" , $con);
	if(!empty($_POST['bookname']))
	{
		$keyword = $_POST['bookname'];
		$result = mysql_query("select * from book where name = '$keyword';");
	}
	else if(!empty($_POST['author']))
	{	
		$keyword = $_POST['author'];
		$result = mysql_query("select * from book where author = '$keyword';");
	}
	else if(!empty($_POST['subject']))
	{	
		$keyword = $_POST['subject'];
		$result = mysql_query("select * from book where subject = '$keyword';");
	}
	
?>
        
"Search result for <font color='blue'><?php echo $keyword ?> </font>..."<br><br>
<table>
<tr><td><font color='blue'>Book Name</font></td>
<td><font color='blue'>Author Name</font></td>
<td><font color='blue'>Edition</font></td>
<td><font color='blue'>Subject</font></td>
<td><font color='blue'>Copies Available</font></td>
<td><font color="blue">Issue</font></td>
<td><font color="blue">Discard</font></td>

<?php 

	if($result)
	{

		while($heloo = mysql_fetch_array($result))
		{
			$name=$heloo['name'];
			$edition=$heloo['edition'];
			$author=$heloo['author'];
			$copy=$heloo['copy'];
			$subject=$heloo['subject'];
			echo 
			"<form action='issuestudent.php' method='post'><tr>
				<td>$name</td>
				<td>$author</td>
				<td>$edition</td>
				<td>$subject</td>
				<td>$copy</td>";
			if($copy > 0)
				echo "<td> <button name='OPTION' type='submit' value='$name' style='Background-color:gray; width:100px; color:white'>ISSUE</button></td></form>";
			echo "<form action='discardbook.php' method='post'><td> <button name='b' type='submit' value='$name' style='Background-color:gray; width:100px; color:white'>discard</button></td></form>";
			echo "</tr>";
			
		}
	}
?>
		
</table>

        
        </div>
      <div class="top_content">
 
        <div class="column_two border_left">
		
          </div>
      </div>
    </div>

    
    
    <!--start footer from here-->
    <div id="footer"></div>
	
    <!--/. end footer from here-->
  </div>

</div>

</body></html>