

<?php
	
	include('database.php');
	global $pdo;
	
	if(isset($_POST["game_id"])){
		
		try{
		
		$gameID = intval($_POST["game_id"]);
		date_default_timezone_set("America/New_York");
		$date = date('Y-m-d H:i:s');
		
		$sql1="UPDATE casino_game SET gameEndDate =? WHERE gameID=?"; //update game is over in database
        $updateGame1 = $pdo->prepare($sql1);
        $updateGame1->execute(array($date, $gameID));
		
	    $sql="UPDATE casino_game SET gameInSession =? WHERE gameID=?";
        $updateGame = $pdo->prepare($sql);
        $updateGame->execute(array(false, $gameID));
		
		$file = "./average_playtime.xml";       //create xml node for reporting
		$node = "game";
		
		$doc = new DOMDocument('1.0');
		$doc->preserveWhiteSpace = false;
		$doc->load($file);
		$doc->formatOutput = true;
		
		$root = $doc->documentElement;
		
		unset($_POST['submit']);
		
		$statement = "SELECT gameTotalDollars, gameStartDate, gameEndDate FROM casino_game WHERE gameID=?";
		
		$getPlayingTime = $pdo->prepare($statement);
        $getPlayingTime->execute(array($gameID));		
        
		$game = $doc->createElement($node);
		$game = $root->appendChild($game);
		
		$theGame = $getPlayingTime->fetchAll();
		
		 foreach ($theGame as $row) { //add node in xml file
		 			
		 		
		 	//$playTime = round(abs($row['gameEndDate'] - $row['gameStartDate']) / 60,2). " minutes";
			 
			$start = new DateTime($row['gameEndDate']);
            $end = new DateTime($row['gameStartDate']);

            $interval = date_diff($start,$end);

            $playTime = $interval->format('%h:%i:%s');
			
            $time = $doc->createElement("time_played", $playTime);
			$game->appendChild($time);
			$amt = $doc->createElement("amount_cashed_out", $row['gameTotalDollars']);
			$game->appendChild($amt);
          }
		
		$doc->save($file) or die("Something went Wrong"); 
		
        
		}catch(\Exception $e) {
		
		echo "ERROR: " . $e->getMessage();
	}
		header('Location: ./index.php');
		
	}else{
		header('Location: ./index.php');
	}

?>
				
				
	   