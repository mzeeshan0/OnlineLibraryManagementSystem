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
    ?>

      
<?php
	$con = mysql_connect("localhost","root","");
	if(!$con)
	{
		die('could not connect'.mysql_error());
	}
	mysql_select_db("library" , $con);
	if (isset($_POST['DISCARD']))
	{	$bno = intval(substr($_POST['DISCARD'],8));
		$sno = intval(substr($_POST['DISCARD'],0,8));
		$delreserve = mysql_query("delete from reserve where sno='$sno' and bno='$bno';");
		mysql_query("update book set copy=copy+1 where book_id='$bno'");
	}
	$sno=$_SESSION['user']['username'];
	$result = mysql_query("select * from reserve where sno='$sno';");

	$matches=mysql_num_rows($result);
	if ($matches==0)
		echo "you have not reserved any book yet.";
	if ($matches>0)
	{

echo "<table>
<tr><td><font color='blue'>Student ID</font></td>
<td><font color='blue'>Book ID</font></td>
<td><font color='blue'>Book Name</font></td>
<td><font color='blue'>Date</font></td>
<td><font color='blue'>Discard</font></td>";


		while($heloo = mysql_fetch_array($result))
		{
			$sno=$heloo['sno'];
			$bno=$heloo['bno'];
			$bname=$heloo['book_name'];
			$date=$heloo['book_date'];
			$comb=$sno."".$bno;
			echo 
			"<form action='studentReserved.php' method='post'><tr>
				<td>$sno</td>
				<td>$bno</td>
				<td>$bname</td>
				<td>$date</td>
				<td> <button name='DISCARD' type='submit' value='$comb' style='Background-color:gray; width:100px; color:white'>DISCARD</button></td>
			</tr></form>";
			
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