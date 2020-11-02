<!-- insertResult.php
     A PHP script to access the bookstore database "bw_db17"
     through MySQL
     -->
<html>
<head>
<title> Insert Result </title>
</head>
<body>
<b>Insert another Publisher:</b>
<form action  = "http://css1.seattleu.edu/~kwong1/dbtest/insertResult.php" method = "post">
    <textarea  rows = "1"  cols = "20" name = "pid" placeholder = "Publisher ID"></textarea>
    <textarea  rows = "1"  cols = "20" name = "pname" placeholder = "Publisher Name"></textarea>
	<textarea  rows = "1"  cols = "20" name = "city" placeholder = "City"></textarea>
    <textarea  rows = "1"  cols = "20" name = "state" placeholder = "State"></textarea>
	<textarea  rows = "1"  cols = "20" name = "country" placeholder = "Country"></textarea>
    <textarea  rows = "1"  cols = "20" name = "phone" placeholder = "Phone number"></textarea>
	</br>
    <input type = "reset"  value = "Clear" />
    <input type = "submit"  value = "Insert" />
</form>

<TABLE BORDER = "0">
<TR>
<TD>
<form action  = "http://css1.seattleu.edu/~kwong1/dbtest/publisher.php" method = "get">
    <input type = "submit"  value = "Go back to Publisher Table" />	
</form> 
</TD>	
<TD>
<form action  = "http://css1.seattleu.edu/~kwong1/dbtest/db.html" method = "get">
    <input type = "submit"  value = "Go back to Home Page" />	
</form>
</TD>
</TR>
</TABLE>

<?php

$db = mysql_connect("cssql.seattleu.edu", "user17", "kWonosari12!");

if (!$db) {
     print "Error - Could not connect to MySQL";
     exit;
}

$er = mysql_select_db("bw_db17", $db);
if (!$er) {
    print "Error - Could not select the bookstore database";
    exit;
}

$pid = $_POST['pid'];
$pname = $_POST['pname'];
$city = $_POST['city'];
$state = $_POST['state'];
$country = $_POST['country'];
$phone = $_POST['phone'];


$query = "INSERT INTO Publisher VALUES ($pid,'$pname','$city','$state','$country',$phone)";

$query_html = htmlspecialchars($query);

$result = mysql_query($query);
if (!$result) {
    print "Error - Publisher cannot be inserted into the table!";
    $error = mysql_error();
    print "<p>" . $error . "</p>";
    exit;
}

$insertedTuple = "SELECT * FROM Publisher WHERE pid = $pid";

$num_rows = mysql_num_rows($insertedTuple);

$num_fields = mysql_num_fields($insertedTuple);

$row = mysql_fetch_array($insertedTuple);

print "Publisher was successfully inserted into the table!";

print "<table border='border'><caption> <h2> Results </h2> </caption>";
print "<tr align = 'center'>";

$keys = array_keys($row);
for ($index = 0; $index < $num_fields; $index++) 
    print "<th>" . $keys[2 * $index + 1] . "</th>";

print "</tr>";

for ($row_num = 0; $row_num < $num_rows; $row_num++) {

    print "<tr align = 'center'>";
    $values = array_values($row);
	
    for ($index = 0; $index < $num_fields; $index++){
        $value = htmlspecialchars($values[2 * $index + 1]);
        print "<td>" . $value . "</td> ";
    }

    print "</tr>";
    $row = mysql_fetch_array($insertedTuple);
}

print "</table>";

mysql_close($db);
?>
</body>
</html>