<?php
	session_start();
	if ($_SESSION['login'] != 1 && $_SESSION['admin'] != 1){
		header("Location: login.php");
		exit();
	}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
  <title>Lista meczów Wisła-Cracovia</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</head>

<body>
<br><br><br>
<div class = "container">
<h1 class="display-4">Lista</h1>
<?php
	$conn = pg_connect("host=(insert hostname here) dbname=(insert dbname here) user=(insert username here) password=(insert password here)");
	$stat = pg_connection_status($conn);
	if($stat === PGSQL_CONNECTION_OK){
		pg_query("SET search_path TO ti2");
		$result = pg_query("SELECT * FROM mecz ORDER BY data");
		$counter = pg_query("SELECT COUNT(*) FROM mecz");
		$count = pg_fetch_row($counter);
		if ($count[0] > 0) {
			echo "<table><tr class='nagl'><th>ID</th><th>Data</th><th>Gole dla Wisły</th><th>Gole dla Cracovii</th></tr>";
			while($row = pg_fetch_assoc($result)) {
				echo "<tr>";
				echo "<td>" . $row["id_meczu"]. "</td><td>" . $row["data"] . "</td><td>" . $row["bramki_wis"]. "</td><td>" . $row["bramki_cra"]."</td>";
				echo "</tr>";
			}
			echo "</table>";
		} 
		else {
			echo "<strong>Brak meczów.</strong>";
		}
	}
?>
<br/> <hr/>	
<span class="powr"><a class="btn btn-secondary" href="index.php">Powrót</a></span>
</div>
</body>
</html>