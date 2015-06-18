<html>
<body>
<H1> executing</H1>
<?php
$dbhost = 'localhost:3036';
$dbuser = '<your user id>';
$dbpass = '<your password>';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
$tm = $_GET["tme"];
$temp_cel = $_GET["temp_cel"];
$temp_f = $_GET["temp_f"];
$humidity = $_GET["humidity"];
echo $tm;
echo $temp_cel;

if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
$sql = "INSERT INTO dht11
       (rec_time,temp_cel,temp_f,humidity) 
       VALUES ('$tm',$temp_cel,$temp_f,$humidity )";

mysql_select_db('njvijay_iot');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
echo "Entered data successfully\n";
mysql_close($conn);
?>
</body>
</html>
