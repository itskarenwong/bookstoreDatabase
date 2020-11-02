<!-- insertPublisher.php
     A PHP script to access the bookstore database "bw_db17"
     through MySQL
     -->
<html>
<head>
<title> Insert a New Publisher </title>
</head>
<body>
<form action  = "http://css1.seattleu.edu/~kwong1/dbtest/db.html" method = "get">
    <input type = "submit"  value = "Go back to Home Page" />	
</form> 
</br>
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
</body>
</html>