<?php
$host = "127.0.0.1";
$dbuser = "root";
$dbpass = "";
$dbname = "test";

$connect = mysqli_connect($host,$dbuser,$dbpass,$dbname,'3306');
if($connect){
	echo "Connect Success";
}else{
	echo "Connect Failed";
}
echo "<br><br>";

$sql = "SELECT studentid, firstname, lastname , email, term , company, addres, province, startdate, enddate, contact FROM t_study"; // Your SQL query
$result = $connect->query($sql);
if ($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "id: " . $row["studentid"]. " firstName- " . $row["firstname"]. "lastname-" . $row["lastname"]."<br> 
        Email:". $row["email"]." term-". $row["term"]." company-". $row["company"]."<br>
        addres:". $row["addres"]."province- ". $row["province"]."<br>
        start-". $row["startdate"]."end- ". $row["enddate"]."<br>";
    }
 }else {
    echo "or";
    }
$connect->close();
?>