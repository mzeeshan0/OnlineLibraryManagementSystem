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
	if( isset($_POST['ISSUE']))
	{
		$bno = intval(substr($_POST['ISSUE'],8));
		$sno = intval(substr($_POST['ISSUE'],0,8));
		$result = mysql_query("select * from reserve where sno='$sno' and bno='$bno';");

		if($result)
		{

			while($heloo = mysql_fetch_array($result))
			{
				$snoo=$heloo['sno'];
				$bnoo=$heloo['bno'];
				$bnamee=$heloo['book_name'];
				$datee=$heloo['book_date'];
				$reservebooks = mysql_query("insert into history values('$snoo','$bnoo','$bnamee',curdate(),null,0,0);");
				$delreserve = mysql_query("delete from reserve where sno='$snoo' and bno='$bnoo';");
			}
		}
	}
	if (isset($_POST['DISCARD']))
	{	$bno = intval(substr($_POST['DISCARD'],8));
		$sno = intval(substr($_POST['DISCARD'],0,8));
		$delreserve = mysql_query("delete from reserve where sno='$sno' and bno='$bno';");
		mysql_query("update book set copy=copy+1 where book_id='$bno'");
	}
	
	$result = mysql_query("select * from reserve;");
$matches=mysql_num_rows($result);
              if ($matches==0)
                echo "no student reserved any book.";
              if ($matches>0)
               {
	
	
?>
        

<table>
<tr><td><font color='blue'>Student ID</font></td>
<td><font color='blue'>Book ID</font></td>
<td><font color='blue'>Book Name</font></td>
<td><font color='blue'>Date</font></td>
<td><font color="blue">Issue</font></td>
<td><font color="blue">DISCARD</font></td>

<?php 

	if($result)
	{

		while($heloo = mysql_fetch_array($result))
		{
			$sno=$heloo['sno'];
			$bno=$heloo['bno'];
			$bname=$heloo['book_name'];
			$date=$heloo['book_date'];
			$comb=$sno."".$bno;
			echo 
			"<form action='reservel.php' method='post'><tr>
				<td>$sno</td>
				<td>$bno</td>
				<td>$bname</td>
				<td>$date</td>
				<td> <button name='ISSUE' type='submit' value='$comb' style='Background-color:gray; width:100px; color:white'>ISSUE</button></td>
				<td> <button name='DISCARD' type='submit' value='$comb' style='Background-color:gray; width:100px; color:white'>DISCARD</button></td>
			</tr></form>";
			
		}
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