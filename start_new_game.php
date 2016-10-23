	

<?php
	
	include('database.php');
	global $pdo;
	
	
	
	if(isset($_POST["dollar-amount"]) && (isset($_POST["player-name"]) && !empty($_POST["player-name"]))){
		
		$noDollarSign = str_replace("$", "",$_POST["dollar-amount"]); //remove user input dollar sign
		
		if(!is_numeric($noDollarSign)){
		  header('Location: ./index.php'); //dont do anything if input is not numeric
		}
		
		try{
		
		$dollar = floatval($noDollarSign);
		$name = $_POST["player-name"];
		date_default_timezone_set("America/New_York");
		$date = date('Y-m-d H:i:s');
		
		$sql="INSERT INTO casino_game (gameInSession, gamePlayNumber, gamePlayerName, gameLastPlayedDate, gameTotalDollars, gameStartDate) VALUES(?,?,?,?,?,?)";
        $newGame = $pdo->prepare($sql);
        $newGame->execute(array(true, 0, $name, $date, $dollar, $date));
        
		}catch(\Exception $e) {
		
		echo "ERROR: " . $e->getMessage();
	}
		header('Location: ./index.php');
		
	}else{
		header('Location: ./index.php');
	}

?>
				
				
	   