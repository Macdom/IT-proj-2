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
  <title>Dodaj mecz</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="../style/form_style.css">
  <script src="script.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</head>

<body>

<?php
	$data = $wisla = $cracovia = $dataErr = $wislaErr = $cracoviaErr = "";
	$conn = pg_connect("host=(insert hostname here) dbname=(insert dbname here) user=(insert username here) password=(insert password here)");
	$stat = pg_connection_status($conn);
	$valid = true; $post = true;
	
	if($stat === PGSQL_CONNECTION_OK){
	if (isset($_POST['wyslij'])){
		if(empty($_POST["data"])){
			$dataErr = "Nie wpisano pola Data.\n";
			$valid = false;
		}
		else{
			$data = test_input($_POST["data"]);
		}	
		
		if(empty($_POST["wisla"])){
			$wislaErr = "Nie wpisano ilości bramek dla Wisły.\n";
			$valid = false;
		}
		else{
			$wisla = test_input($_POST["wisla"]);
			if(!((is_numeric($wisla)) && (intval($wisla) >= 0) && (intval($wisla) < 10))) {
				$nazwiskoErr = "Liczba bramek musi być nieujemna i mniejsza od 10.\n"; 
				$valid = false;
			}	
		}	
		
		if(empty($_POST["cracovia"])){
			$cracoviaErr = "Nie wpisano ilości bramek dla Cracovii.\n";
			$valid = false;
		}
		else{
			$cracovia = test_input($_POST["cracovia"]);
			if(!((is_numeric($cracovia)) && (intval($cracovia) >= 0) && (intval($cracovia) < 10))) {
				$nazwiskoErr = "Liczba bramek musi być nieujemna i mniejsza od 10.\n"; 
				$valid = false;
			}	
		}				
	
		if ($valid = true){
			pg_query("SET search_path TO ti2");
			pg_query("INSERT INTO mecz(data, bramki_wis, bramki_cra) VALUES('$data', '$wisla', '$cracovia')");
			header("Location: zapisane.html");
			exit();
		}
	}
	}
	
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?> 

	<div class="container">
	<br><br><br>
		<h1 class="display-4">Dodaj wynik meczu</h1>
		
		<div class="row">
		<div class="col-sm-9">
			<div class="form-group row">
			<label for="data" class="col-sm-4 col-form-label"><b></b></label>
			</div>

		<form enctype="multipart/form-data" name="form" id="form" method="post"
			action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>"  onsubmit = "return Walidacja()">  
			<div class="form-group row">
				<label for="data" class="col-sm-4 col-form-label"><b>Data meczu:</b></label>
				<div class="col-sm-7">	
					<input type="date" class="form-control" id="data" name="data" value="<?php echo $data;?>">	
				</div>
			</div>	
			<div class="form-group row">
				<label for="wisla" class="col-sm-4 col-form-label"><b>Gole Wisły:</b></label>
				<div class="col-sm-7">	
					<input type="text" class="form-control" id="wisla" name="wisla" value="<?php echo $wisla;?>" placeholder="Gole...">	
				</div>
			</div>			
			<div class="form-group row">
				<label for="cracovia" class="col-sm-4 col-form-label"><b>Gole Cracovii:</b></label>
				<div class="col-sm-7">	
					<input type="text" class="form-control" id="cracovia" name="cracovia" value="<?php echo $cracovia;?>" placeholder="Gole...">	
				</div>
			</div>		
			
			<div class="form-group row">
			<div class="col-sm-4">
				</div>
				<div class="col-sm-7">
					<input type="submit" id="wyslij" name="wyslij" class="btn btn-primary" value="Wyślij">
					<a class="btn btn-secondary" href="index.php">Powrót</a>
				</div>
			</div>	
		</form>
			
		<div class="row">
				<div class="col-sm-4">
				</div>
				<div class="col-sm-7">		
			</div></div>
			<br>
		</div>
			<div class="col-sm-3">	
			<br><br>
			<p><span class="error"><?php echo $dataErr;?></span></p>
			<p><span class="error"><?php echo $wislaErr;?></span></p>
			<p><span class="error"><?php echo $cracoviaErr;?></span></p>
			</div>
		</div>
	</div>
</body>
</html>