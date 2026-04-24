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

$sql = "INSERT INTO t_study (studentid, firstname, lastname , email, term , company, addres, province, startdate, enddate, contact )
VALUES ('6510101702', 'chan', 'back','exo009@gmail.com', '2/2026', 'yg team','614 korea','korea','2026-02-01','2026-03-14','Mr.sehun')";

if ($connect->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $connect->error;
}

$connect->close();
?>