<?php
?>

<html>

<head>
	<title>Test</title>
</head>

<body bgcolor="white">

<?php
$link = pg_connect("host=localhost dbname=work user=postgres password=allweb17");
$result = pg_exec($link, "select * from companies");
$numrows = pg_numrows($result);
echo "<p>link = $link<br>
  result = $result<br>
  numrows = $numrows</p>
  ";
?>

<table border="1">
	<tr>
		<th>name</th>
		<th>First name</th>
		<th>ID</th>
	</tr>
	<?php

	// Loop on rows in the result set.

	for($ri = 0; $ri < $numrows; $ri++) {
		echo "<tr>\n";
		$row = pg_fetch_array($result, $ri);
		echo " <td>", $row["name"], "</td>
   <td>", $row["city"], "</td>
   <td>", $row["x_meb"], "</td>
  </tr>
  ";
	}
	pg_close($link);
	?>
</table>

</body>

</html>
