<!DOCTYPE html>
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
            <li><a href="login.php">Login</a></li>
            <li><a href="contact.php">Contact/Feedback</a></li>
          </ul>
        </div>
      </div>

    </div>

    <div class="right_section">
      <div class="common_content">
        <h2>Welcome Guest...</h2>
		<?php
		$con = mysql_connect("localhost","root","");
  if(!$con)
  {
    die('could not connect'.mysql_error());
  }
  mysql_select_db("library" , $con);
  ?>

		<font color="blue">You can search the book by keyword or can browse all books by Author name or by Subject name.</font>
<br><br>    
<form action="searchresult.php" method="post">
Enter book name: <input type="text" name="booknm" /><br>
<input type="hidden" name="searchtype" value="name" />
<input type="submit" value="search"/></form>
<br>

<?php
$query="select author from book group by(author)";
$result=mysql_query($query);
?>
or browse all books by Author:<br>

<form action="searchresult.php" method="post">
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

<form action="searchresult.php" method="post">
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