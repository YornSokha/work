<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Index page</title>
</head>
<body>
<form action="CompanyController.php" method="post">
	<h1>Welcome to our service!</h1>
	<input type="hidden" name="form_state" value="index">
	<button type="submit" name="btn_register" value="register">Register company</button>
	<button type="submit" name="btn_list_company" value="list">List company</button>
</form>
</body>
</html>

