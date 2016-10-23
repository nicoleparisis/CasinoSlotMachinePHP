

<?php
	
	include('database.php');
	global $pdo;
	
	
	
	if((isset($_POST["added_cash"]) && !empty($_POST["added_cash"])) && (isset($_POST["current_game_total"]) && !empty($_POST["current_game_total"]))){
		
		$noDollarSign = str_replace("$", "",$_POST["added_cash"]); //remove user input dollar sign 
		
		if(!is_numeric($noDollarSign)){
		  header('Location: ./index.php'); //dont do anything if input is not numeric
		}
		
		try{
		
		$addCash = floatval($noDollarSign);
		$currentTotal = floatval($_POST["current_game_total"]);
		$newTotal = $currentTotal + $addCash;
		
	    $sql="UPDATE casino_game SET gameTotalDollars =? WHERE gameInSession=1";
        $updateTotal = $pdo->prepare($sql);
        $updateTotal->execute(array($newTotal));
        
		}catch(\Exception $e) {
		
		echo "ERROR: " . $e->getMessage();
	}
		header('Location: ./index.php');
		
	}else{
		header('Location: ./index.php');
	}

?>
				
				
	   