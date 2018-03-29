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

        

<?php
$con = mysql_connect("localhost","root","");
	if(!$con)
	{
		die('could not connect'.mysql_error());
	}
	mysql_select_db("library" , $con);
	
	if(!isset($_POST['id']))
	{
		$var = $_POST['OPTION'];
		echo "<font color='blue'>Enter ID of Student.</font>		
		<form method='post'>
		Enter Student ID: <input type='text' name='id' /><br>";
		echo"<input type='hidden' name='OPTION' value='$var'/>
		<input type='submit' value='View Record'/></form>";
	}
	else
	{
		$name = $_POST['OPTION'];
		$id = $_POST['id'];
		$q="select sum(fine) from history where s_no='$id'";
    	$r=mysql_query($q);
    	$row = mysql_fetch_row($r);
    	$fine=$row[0];
    	if ($fine>0)
      		echo "Student dues must be cleared.";

      	if ($fine==0)
      	{
      		$b = mysql_query("select book_id from book where name= '$name';");
			while($row = mysql_fetch_array($b))
				$bid = $row['book_id'];

      	$q = "select s_no, b_no from history where s_no='$id' AND b_no='$bid'";
        $r = mysql_query($q);
        $row = mysql_fetch_row($r);

        if ($row)
            echo "Book <font color='blue'>".$name."</font> is already in student's record.";
        if (!$row)
        {
		$result = mysql_query("select count(s_no) from history where s_no = '$id' and returned_on is null");
		if($result)
		{	
			$row = mysql_fetch_row($result);
			$count = $row[0];
		}
		$bookresult = mysql_query("select book_id,copy from book where name= '$name';");
		if($bookresult)
		{
			while($heloo = mysql_fetch_array($bookresult))
			{
				$bid = $heloo['book_id'];
				$copy = $heloo['copy'];
			}
		}
		if($copy > 0 and $count<3)
		{
			$query = mysql_query("update book set copy = copy-1 where book_id = $bid;");
			$querytwo = mysql_query("insert into history values('$id','$bid','$name',curdate(),null,0,0);");
			echo "$name"." issued to "."$id";
		}
		if($count == 3)
		{
			echo "Student Already have 3 books in his/her record";
		}
	}
	}
}
?>
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