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
        
        <?php
		 $con = mysql_connect("localhost","root","");
  if(!$con)
  {
    die('could not connect'.mysql_error());
  }
  mysql_select_db("library" , $con);
        $SearchType=$_POST['searchtype'];

         if($SearchType=="name"){
           $SearchType="byname";
           $Keywords=trim($_POST['booknm']);
         }

         if($SearchType=="author")
         {
           $SearchType="byauthor";
           $Keywords=$_POST['authorslct']; 
         }

         if($SearchType=="subject")
         {
           $SearchType="bysubject";
           $Keywords=$_POST['subjectslct'];
         }




$stype=$SearchType;
        $tosearch=$Keywords;
            
          if ($stype=="byname")
          {
            $query= "select * from book where name LIKE '%$tosearch%' ";
            $result= mysql_query($query);
            }

            if ($stype=="byauthor")
          {
            $query= "select * from book where author = '$tosearch' order by name";
            $result= mysql_query($query);
            }

            if ($stype=="bysubject")
          {
            $query= "select * from book where subject = '$tosearch' order by author";
            $result= mysql_query($query);
            }



		$matches=mysql_num_rows($result);
            if ($matches==0)
                echo"sorry, no result.";
            if ($matches>0){
              echo "Search result for <font color='blue'>''$tosearch''</font>...<br><br>";
              echo "<table border='1' width='600' cellpadding='3' cellspacing='0'>
              <tr><td><font color='blue'>Book Name</font></td>
              <td><font color='blue'>Author Name</font></td>
              <td><font color='blue'>Edition</font></td>
              <td><font color='blue'>Subject</font></td>
              </tr>";
              while($row = mysql_fetch_array($result)){
              $bookid=$row["book_id"];  
              $bookname=$row["name"];
              $bookauthor=$row["author"];
              $booked=$row["edition"];
              $booksubject=$row["subject"];
              $booknoc=$row["copy"];

              echo "<tr><td>$bookname</td>
              <td>$bookauthor</td>
              <td>$booked</td>
              <td>$booksubject</td></tr>";

              }}
              echo "</table>";
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