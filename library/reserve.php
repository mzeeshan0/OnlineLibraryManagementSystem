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

  $userid=$_SESSION['user']['username'];
  $query="select sum(fine) from history where s_no='$userid'";
    $result=mysql_query($query);
    $row = mysql_fetch_row($result);
    $fine=$row[0];
    if ($fine>0)
      echo "please clear your dues first.";


    else
    {
  $bookid=$_GET['bookid'];
  
  $query= "select name from book where book_id ='$bookid'";
  $result= mysql_query($query);

	while($row = mysql_fetch_array($result))
	{                
              $BookName=$row["name"];
    }

	  $query = "select count(*) from reserve where sno ='$userid'";
    $query_result = mysql_query($query);
    $row = mysql_fetch_row($query_result);
    $UserReserveCount=$row[0];

    $query = "select count(*) from history where s_no ='$userid'";
    $query_result = mysql_query($query);
    $row = mysql_fetch_row($query_result);
    $UserHistoryCount=$row[0];

    $totalCount=$UserReserveCount+$UserHistoryCount;
    if ($totalCount==3)
       echo "you can not reserve/issue more than 3 books.";


    if ($totalCount<3)
    {
        $query = "select sno, bno from reserve where sno='$userid' AND bno='$bookid'";
        $result = mysql_query($query);
        $row = mysql_fetch_row($result);

        if ($row)
            echo "you can not reserve same book twice.";
    
          if (!$row)
          {
            date_default_timezone_set("Asia/Karachi");
            mysql_query("insert into reserve values ('$userid', '$bookid', '$BookName', curdate());");
            mysql_query("update book set copy=copy-1 where name='$BookName'");
            echo "<font color='blue'>You have Successfully reserved </font> ".$BookName ;
          }
    }
    }
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