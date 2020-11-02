<!-- deleteResult.php
     A PHP script to access the bookstore database "bw_db17"
     through MySQL
     -->
<html>
<head>
<title> Delete Result </title>
</head>
<body>
<b>Delete another Publisher:</b>
<form action  = "http://css1.seattleu.edu/~kwong1/dbtest/deleteResult.php" method = "post">
    <textarea  rows = "1"  cols = "20" name = "pid" placeholder = "Publisher ID"></textarea>
    <textarea  rows = "1"  cols = "20" name = "pname" placeholder = "Publisher Name"></textarea>
	</br>
    <input type = "reset"  value = "Clear" />
    <input type = "submit"  value = "Delete" />
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


if(is_null($pid) and strlen($pname) == 0)
{
	print "Fields were empty! ";
}
else if($pid >= 0 and strlen($pname) == 0)
{
	$query = "DELETE FROM Publisher WHERE pid = $pid";
}
else if(is_null($pid) and strlen($pname) == 1 )
{
	$query = "DELETE FROM Publisher WHERE pname LIKE '$pname%'";
}
else if(is_null($pid) and strlen($pname) > 1 )
{
	$query = "DELETE FROM Publisher WHERE pname = '$pname'";
}
else
{
	$query = "DELETE FROM Publisher WHERE pid = $pid and pname = '$pname'";
}

$query_html = htmlspecialchars($query);

$result = mysql_query($query);
if (!$result) {
    print "Error - No publisher was deleted from the table!";
    $error = mysql_error();
    print "<p>" . $error . "</p>";
    exit;
}
print "Publisher was deleted from the database!";

mysql_close($db);
?>
</body>
</html>