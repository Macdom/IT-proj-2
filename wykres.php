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
  <title>Wisła-Cracovia - wykres</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  <script src="script.js" defer></script>
</head>

<body>
	<div class="container">
	<br><br><br>
		<h1 class="display-4">Mecze Wisła-Cracovia - wykres</h1>
	<?php
		$conn = pg_connect("host=(insert hostname here) dbname=(insert dbname here) user=(insert username here) password=(insert password here)");
		$stat = pg_connection_status($conn);
		if($stat === PGSQL_CONNECTION_OK){
			$wisla = $cracovia = $remis = 0;
			pg_query("SET search_path TO ti2");
			$result = pg_query("SELECT (bramki_wis - bramki_cra) AS wynik FROM mecz");
			$counter = pg_query("SELECT COUNT(*) FROM mecz");
			$count = pg_fetch_row($counter);
			if ($count[0] > 0) {
				while($row = pg_fetch_row($result)) {
					echo $row[0];
					if($row[0] > 0) $wisla++;
					else if ($row[0] < 0) $cracovia++;
					else $remis++;
				}
			} 
			else {
				echo "<strong>Brak meczów.</strong>";
			}
		}
	?>
		<p>Zwycięstwa <span class="wisla">Wisły</span>: <span id="wis_w"><?php echo $wisla; ?></span> </p>
		<p>Zwycięstwa <span class="cracovia">Cracovii</span>: <span id="cra_w"><?php echo $cracovia; ?></span></p>
		<p><span class="remis">Remisy</span>: <span id="r"><?php echo $remis; ?></span></p>
		<button class="btn btn-primary" onclick="rysuj();">Rysuj wykres</button>
		<canvas id="canvas" width="1000" height="600"></canvas>
		<span class="powr"><a class="btn btn-secondary" href="index.php">Powrót</a></span>
	</div>
</body>
</html>