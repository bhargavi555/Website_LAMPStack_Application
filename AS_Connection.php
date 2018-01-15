<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
 <title>Connection</title>
 </head>
 <body>
 <?php
          
  $hostname = "students"; 		//hostname
$username = "z1744852";				//username
$password = "19930717";			//password
$db = "z1744852";					//database

$conn = mysqli_connect($hostname,$username,$password);		//connecting to the host
if (!$conn) {
die("could not connect to the database:" .mysql_error());		//display error on failure
}
//echo "Connected";
$db_select = mysqli_select_db($conn, $db);    //connecting to database
if (!$db_select) {
  die("Database selection failed: " . mysqli_error());
}
        class visitorCounter {

            var $timeout = 300;
            var $count = 0;
            var $error;
            var $i = 0;

            function visitorCounter() {
              
                $this->ip = $this->ipCheck();
                $this->new_user();
                //$this->delete_user();
                $this->count_users();
                }

            function ipCheck() {
                if (getenv('HTTP_CLIENT_IP')) {
                    $ip = getenv('HTTP_CLIENT_IP');
                    }
                elseif (getenv('HTTP_X_FORWARDED_FOR')) {
                    $ip = getenv('HTTP_X_FORWARDED_FOR');
                    }
                elseif (getenv('HTTP_X_FORWARDED')) {
                    $ip = getenv('HTTP_X_FORWARDED');
                    }
                elseif (getenv('HTTP_FORWARDED_FOR')) {
                    $ip = getenv('HTTP_FORWARDED_FOR');
                    }
                elseif (getenv('HTTP_FORWARDED')) {
                    $ip = getenv('HTTP_FORWARDED');
                    }
                else {
                    $ip = $_SERVER['REMOTE_ADDR'];
                    }
                return $ip;
                }
            function new_user() {
                global $conn;
                $checkIP = "SELECT ip FROM visitorCounter WHERE ip='$this->ip'";
                $resultCekIp=mysqli_query($conn,$checkIP);
                $countCekIp=mysqli_num_rows($resultCekIp);
                if($countCekIp>0){
                    $insert1 = mysqli_query ($conn,"UPDATE visitorCounter SET  date=NOW(),count=count+1, distinct_ip='$this->ip' WHERE ip='$this->ip'");
                    if (!$insert1) {
                        $this->error[$this->i] = "Unable to record new visitor\r\n";            
                        $this->i ++;
                        }
                      
  }
                else{
                    $insert2 = mysqli_query ($conn,"INSERT INTO visitorCounter (ip,count,distinct_ip,date) VALUES ( '$this->ip',1,'$this->ip',NOW())");
                    if (!$insert2) {
                        $this->error[$this->i] = "Unable to record new visitor\r\n";            
                        $this->i ++;
                        }
                    }

                  $mycount =mysqli_query($conn,"SELECT count FROM visitorCounter AS times WHERE ip='$this->ip'");
                  while ($row = $mycount->fetch_assoc()) {
                    echo "THE NUMBER OF TIMES YOU VISITED THIS SITE : ";
                    echo $row['count']."<br>"."<br>";
                }
                 $timestamp =mysqli_query($conn,"SELECT date FROM visitorCounter AS timings WHERE ip='$this->ip'");
                  while ($row = $timestamp->fetch_assoc()) {
                    echo "YOUR LAST VISITED DATE OF THIS SITE: ";
                    echo $row['date']."<br>"."<br>";

                       }
                  

                }
           
            function count_users() {
                 global $conn;

                   
                   $sql= mysqli_query($conn,"SELECT count(DISTINCT(ip)) AS visit FROM visitorCounter");
                  echo "\n";
                  
                  echo" NUMBER OF UNIQUE VISITIORS UNTIL NOW: ";
                     
                  echo $sql->fetch_object()->visit;  
                 




                
                }
            }
        ?>