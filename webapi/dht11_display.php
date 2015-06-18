<html>
<head>
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 15px;
}
</style>
</head>
<body>
<H1> My Home Temperature</H1>
<body>

<?php
$dbhost = 'localhost';
$dbuser = '<user>';
$dbpass = '<password>';
$dbname = 'njvijay_iot';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);

if(mysqli_connect_errno())
{
  die('Could not connect: ' . mysqli_connect_error());
}


$result = mysqli_query($conn,"SELECT * FROM dht11");
echo "<table border = \"1\" >";
echo <<< EOL
<tr>
    <th>TEMP Capture time</th>
    <th>Temp in Celcius</th>
    <th>Temp in Farenheit </th>
    <th>Humidity</th>
  </tr>
EOL;

while($row = mysqli_fetch_assoc($result)) 
{
echo "  <tr>";
echo "    <td>".$row['rec_time']."</td>";
echo "    <td>".$row['temp_cel']."</td>";
echo "    <td>".$row["temp_f"]."</td>";
echo "    <td>".$row["humidity"]."</td>";
echo "  </tr>";
 
}
echo "</table>";
mysqli_close($conn);
?>
</body>
</html>
