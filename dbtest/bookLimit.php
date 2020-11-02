<!-- bookLimit.php
     A PHP script to access the bookstore database "bw_db17"
     through MySQL
     -->
<html>
<head>
<title> Search Results </title>
</head>
<body>
<form action  = "http://css1.seattleu.edu/~kwong1/dbtest/bookLimit.php" method = "post">
	<b> Limit search to: </b>
    <textarea  rows = "1"  cols = "20" name = "numOfBooks" placeholder = "Number of books"></textarea>
	<b> book(s). </b>
	</br>
    <input type = "reset"  value = "Clear" />
    <input type = "submit"  value = "Search" />
</form> 

<TABLE BORDER = "0">
<TR>
<TD>
<form action  = "http://css1.seattleu.edu/~kwong1/dbtest/book.php" method = "get">
    <input type = "submit"  value = "Go back to Book Table" />	
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

// Select the movie database named test
$er = mysql_select_db("bw_db17", $db);
if (!$er) {
    print "Error - Could not select the bookstore database";
    exit;
}

$numOfBooks = $_POST['numOfBooks'];

$query = "SELECT * FROM Book LIMIT $numOfBooks";

// handle HTML special characters
$query_html = htmlspecialchars($query);

// Execute the query
$result = mysql_query($query);
if (!$result) {
    print "Error - The number exceeded the number of Books stored in this database.";
    $error = mysql_error();
    print "<p>" . $error . "</p>";
    exit;
}

// Get the number of rows in the result
$num_rows = mysql_num_rows($result);
print "Number of books: $num_rows <br />";

// Get the number of fields in the rows
$num_fields = mysql_num_fields($result);

// Get the first row
$row = mysql_fetch_array($result);

// Display the results in a table
print "<table border='border'><caption> <h2> Results </h2> </caption>";
print "<tr align = 'center'>";

// Produce the column labels
$keys = array_keys($row);
for ($index = 0; $index < $num_fields; $index++) 
    print "<th>" . $keys[2 * $index + 1] . "</th>";

print "</tr>";

// Output the values of the fields in the rows
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