<!-- deletePublisher.php
     A PHP script to access the bookstore database "bw_db17"
     through MySQL
     -->
<html>
<head>
<title> Delete a New Publisher </title>
</head>
<body>
<form action  = "http://css1.seattleu.edu/~kwong1/dbtest/db.html" method = "get">
    <input type = "submit"  value = "Go back to Home Page" />	
</form> 
</br>
<form action  = "http://css1.seattleu.edu/~kwong1/dbtest/deleteResult.php" method = "post">
    <textarea  rows = "1"  cols = "20" name = "pid" placeholder = "Publisher ID"></textarea>
    <textarea  rows = "1"  cols = "20" name = "pname" placeholder = "Publisher Name"></textarea>
	</br>
    <input type = "reset"  value = "Clear" />
    <input type = "submit"  value = "Delete" />
</form>
</body>
</html>