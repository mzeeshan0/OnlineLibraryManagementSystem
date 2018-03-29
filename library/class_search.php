<?php
class Book       //Class Defining
{
          //Declaring Private Members
   private $keywords;
   private $SearchType;
   private $result;
   private $query;
   private $tosearch;
   private $matches;
   private $stype;
   

          //public function to get type of service
public function GetInfo()
      {
         $this->SearchType=$_POST['searchtype'];

         if($this->SearchType=="name"){
           $this->SearchType="byname";
           $this->Keywords=trim($_POST['booknm']);
         }

         if($this->SearchType=="author")
         {
           $this->SearchType="byauthor";
           $this->Keywords=$_POST['authorslct']; 
         }

         if($this->SearchType=="subject")
         {
           $this->SearchType="bysubject";
           $this->Keywords=$_POST['subjectslct'];
         }
      }

            //Public Function to Insert the Values into Database
            //and to Print the values
  public function Search()
       {
        $this->stype=$this->SearchType;
        $this->tosearch=$this->Keywords;
            
          if ($this->stype=="byname")
          {
            $this->query= "select * from book where name LIKE '%$this->tosearch%' ";
            $this->result= mysql_query($this->query);
            }

            if ($this->stype=="byauthor")
          {
            $this->query= "select * from book where author = '$this->tosearch' ";
            $this->result= mysql_query($this->query);
            }

            if ($this->stype=="bysubject")
          {
            $this->query= "select * from book where subject = '$this->tosearch' order by author";
            $this->result= mysql_query($this->query);
            }
        }
            



public function Display()
        {
            $this->matches=mysql_num_rows($this->result);
            if ($this->matches==0)
                echo"sorry, no result.";
            if ($this->matches>0){
              echo "Search result for <font color='blue'>''$this->tosearch''</font>...<br><br>";
              echo "<table border='1' width='600' cellpadding='3' cellspacing='0'>
              <tr><td><font color='blue'>Book Name</font></td>
              <td><font color='blue'>Author Name</font></td>
              <td><font color='blue'>Edition</font></td>
              <td><font color='blue'>Subject</font></td>
              <td><font color='blue'>Reserve</font></td></tr>";
              while($row = mysql_fetch_array($this->result)){
              $bookid=$row["book_id"];  
              $bookname=$row["name"];
              $bookauthor=$row["author"];
              $booked=$row["edition"];
              $booksubject=$row["subject"];
              $booknoc=$row["copy"];

              echo "<tr><td>$bookname</td>
              <td>$bookauthor</td>
              <td>$booked</td>
              <td>$booksubject</td>";
              echo "<td>";
              if ($booknoc==0)
                echo "Not Available";
              if ($booknoc>0)
                print '<center><a href="reserve.php?bookid='.$row['book_id'].'" class="button-link">Reserve</a></center>';
              echo "</td></tr>";

              }}
              echo "</table>"; 
          }

}; //End Class
?>
