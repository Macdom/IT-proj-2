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
  <title>Mecze Wisła-Cracovia</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</head>

<body>
	<div class="container">
	<br><br><br>
		<h1 class="display-4">Mecze Wisła-Cracovia</h1>
		 <div class="dropdown">
			<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Mecze</button>
			<ul class="dropdown-menu">
				<li><a class="dropdown-item" href="nowy.php">Dodaj nowy wynik meczu</a></li>
				<li><a class="dropdown-item" href="lista.php">Przejrzyj wyniki meczów</a></li>
				<li><a class="dropdown-item" href="wykres.php">Sporządź wykres</a></li>
			</ul><br/><hr/>
			<a class="btn btn-secondary" href="dok.html">Dokumentacja</a><br/><hr/>
			<a class="btn btn-warning" href="logout.php">Wyloguj się</a>
		</div> 
	</div>
</body>
</html>