<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Enter New Book</title>

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
            <li><a href="enter-new-book.php">Home</a></li>
            <li><a href="login.php">Enter a new book</a></li>
			<li><a href="record-of-a-student.php">See Record of a Student</a></li>
           <li><a href="bookrecord.php">Book History</a></li>
			<li><a href="reservel.php">Books reserved by Students</a></li>
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
$con = mysql_connect("localhost" ,"root" , "");
if(!$con)
{
die('could not connect'.mysql_error());
}
mysql_select_db("library" , $con);
$book_name = $_POST['bookname'];
$book_author =  $_POST['bookauthor'];
$book_ed = $_POST['booked'];
$book_subject = $_POST['booksubject'];
$book_noc =  $_POST['booknoc'];

if ($book_name == "" || $book_author == "" || $book_ed == "" || $book_subject == "" || $book_noc == ""){
echo "please fill all fields";
exit;}     

if (is_numeric($book_name)){
echo "Book name must be in Alphabetics.";
exit;}

if (is_numeric($book_author)){
echo "Author name must be in Alphabetics.";
exit;}

if (is_numeric($book_subject)){
echo "Book Subject must be in Alphabetics.";
exit;}

if (!is_numeric($book_noc)){
echo "Number of copies of books must be in Numeric Digits.";
exit;}


else{
$query= "insert into book (name, author, edition, copy, subject) values ('$book_name' , '$book_author', '$book_ed' ,'$book_noc','$book_subject' )";
if(!mysql_query($query, $con))
{
die('Error' . mysql_error());
}
echo "Record added successfully <br />";
echo 
"Book Name: $book_name <br /> 
Book Author name: $book_author <br />
Book Edition: $book_ed <br />
Book Subject: $book_subject <br />
Number of copies: $book_noc <br />";
	}	
mysql_close($con);
?>

        
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