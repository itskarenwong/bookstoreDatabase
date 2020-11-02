<!-- authorSearch.php
     A PHP script to access the bookstore database "bw_db17"
     through MySQL
     -->
<html>
<head>
<title> Search Results </title>
</head>
<body>
<b>Search Author by name:</b>
<form action  = "http://css1.seattleu.edu/~kwong1/dbtest/authorSearch.php" method = "post">

    <textarea  rows = "1"  cols = "20" name = "firstName" placeholder = "First Name"></textarea>
    <textarea  rows = "1"  cols = "20" name = "lastName" placeholder = "Last Name"></textarea>
	</br>
    <input type = "reset"  value = "Clear" />
    <input type = "submit"  value = "Search" />
</form>  

<TABLE BORDER = "0">
<TR>
<TD>
<form action  = "http://css1.seattleu.edu/~kwong1/dbtest/author.php" method = "get">
    <input type = "submit"  value = "Go back to Author Table" />	
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

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];

if(strlen($firstName) == 0 and strlen($lastName) == 0)
{
	print "Fields were empty! ";
}
else if(strlen($firstName) == 1 and strlen($lastName) == 0 )
{
	$query = "SELECT * FROM Author WHERE fname LIKE '$firstName%'";
}
else if(strlen($firstName) == 0 and strlen($lastName) == 1 )
{
	$query = "SELECT * FROM Author WHERE lname LIKE '$lastName%'";
}
else if(strlen($firstName) == 1 and strlen($lastName) == 1 )
{
	$query = "SELECT * FROM Author WHERE fname LIKE '$firstName%' AND lname LIKE '$lastName%'";
}
else if(strlen($firstName) == 0 and strlen($lastName) > 0)
{
	$query = "SELECT * FROM Author WHERE lname = '$lastName'";
}
else if (strlen($firstName) > 0 and strlen($lastName) == 0)
{
	$query = "SELECT * FROM Author WHERE fname = '$firstName'";
}
else{
	$query = "SELECT * FROM Author WHERE fname = '$firstName' AND lname = '$lastName'";
}

$query_html = htmlspecialchars($query);

$result = mysql_query($query);
if (!$result) {
    print "Error - Author named $fname $lname cannot be found.";
    $error = mysql_error();
    print "<p>" . $error . "</p>";
    exit;
}

$num_rows = mysql_num_rows($result);
print "Number of authors found: $num_rows <br />";

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