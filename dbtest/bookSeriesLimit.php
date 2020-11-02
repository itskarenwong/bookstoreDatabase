<!-- bookSeriesLimit.php
     A PHP script to access the bookstore database "bw_db17"
     through MySQL
     -->
<html>
<head>
<title> Search Results </title>
</head>
<body>
<form action  = "http://css1.seattleu.edu/~kwong1/dbtest/bookSeriesLimit.php" method = "post">
	<b> Limit search to: </b>
    <textarea  rows = "1"  cols = "40" name = "numOfBookSeries" placeholder = "Number of book series"></textarea>
	<b> book series(s). </b>
	</br>
    <input type = "reset"  value = "Clear" />
    <input type = "submit"  value = "Search" />
</form>
</br>
<form action  = "http://css1.seattleu.edu/~kwong1/dbtest/seriesGroup.php" method = "get">
    <input type = "submit"  value = "Group Book Series" />	
</form> 
<TABLE BORDER = "0">
<TR>
<TD>
<form action  = "http://css1.seattleu.edu/~kwong1/dbtest/series.php" method = "get">
    <input type = "submit"  value = "Go back to Book Series Table" />	
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

$numOfBookSeries = $_POST['numOfBookSeries'];

$query = "SELECT * FROM Series LIMIT $numOfBookSeries";

$query_html = htmlspecialchars($query);

$result = mysql_query($query);
if (!$result) {
    print "Error - The number exceeded the number of Book Series stored in this database.";
    $error = mysql_error();
    print "<p>" . $error . "</p>";
    exit;
}

$num_rows = mysql_num_rows($result);
print "Number of book series: $num_rows <br />";

$num_fields = mysql_num_fields($result);

$row = mysql_fetch_array($result);

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
    $row = mysql_fetch_array($result);
}

print "</table>";

mysql_close($db);
?>
</body>
</html>