<?php
include('database.php');


function update_total($gameID, $currentTotal, $bet, $winOrLose, $howManyRowWins){
	
	global $pdo;
	$newTotal;
	echo $bet. " (bet)<br>";
	echo $currentTotal. " (current)<br>";
	
	
   if(strtolower($winOrLose) == "lose"){
	  $newTotal = $currentTotal - $bet;
		echo $winOrLose. " (win or lose)<br>";
		echo $newTotal. " (new total)<br>";
	}else{
		echo $winOrLose. " (win or lose)<br>";
		if($howManyRowWins == 1){   
			
		  if($bet == .50){
		  	$win =  ($bet * 4);
		  	$newTotal = $currentTotal + $win;//The incentive for betting more is that your winnings are increased but you keep the same odds
		  }else if($bet == 1.00){
		  	$win = ($bet * 4.1);
		  	$newTotal = $currentTotal + $win;
		  }else if($bet == 1.50){
		  	$win = ($bet * 4.2);
		  	$newTotal = $currentTotal + $win;
		  }else if($bet == 2.00){
		  	$win = ($bet * 4.3);
		  	$newTotal = $currentTotal + $win;
		  }else if($bet == 2.50){
		  	$win = ($bet * 4.4);
		  	$newTotal = $currentTotal + $win;
		  }else if($bet == 3.00){
		  	$win = ($bet * 4.5);
		  	$newTotal = $currentTotal + $win;
		  }else if($bet == 3.50){
		  	$win =($bet * 4.6);
		  	$newTotal = $currentTotal + $win;
		  }else if($bet == 4.00){
		  	$win = ($bet * 4.7);
		  	$newTotal = $currentTotal + $win;
		  }
		}else if($howManyRowWins == 2){    //winnings are multiplied by 2 because you won twice
			if($bet == .50){
			$win = (($bet * 4) * 2);
		  	$newTotal = $currentTotal + $win;
		  }else if($bet == 1.00){
		  	$win = (($bet * 4.1)* 2);
		  	$newTotal = $currentTotal + $win;
		  }else if($bet == 1.50){
		  	$win = (($bet * 4.2)* 2);
		  	$newTotal = $currentTotal + $win;
		  }else if($bet == 2.00){
		  	$win = (($bet * 4.3)* 2);
		  	$newTotal = $currentTotal + $win;
		  }else if($bet == 2.50){
		  	$win = (($bet * 4.3)* 2);
		  	$newTotal = $currentTotal + $win;
		  }else if($bet == 3.00){
		  	$win = (($bet * 4.5)* 2);
		  	$newTotal = $currentTotal + $win;
		  }else if($bet == 3.50){
		  	$win = (($bet * 4.6)* 2);
		  	$newTotal = $currentTotal + $win;
		  }else if($bet == 4.00){
		  	$win = (($bet * 4.7)* 2);
		  	$newTotal = $currentTotal + $win;
		  }
		}else if($howManyRowWins == 3){
			if($bet == .50){
			$win =(($bet * 4) * 3);
		  	$newTotal = $currentTotal + $win;
		  }else if($bet == 1.00){
		  	$win = (($bet * 4.1)* 3);
		  	$newTotal = $currentTotal + $win;
		  }else if($bet == 1.50){
		  	$win = (($bet * 4.2)* 3);
		  	$newTotal = $currentTotal + $win;
		  }else if($bet == 2.00){
		  	$win = (($bet * 4.3)* 3);
		    $newTotal = $currentTotal + $win;
		  }else if($bet == 2.50){
		  	$win = (($bet * 4.4)* 3);
		  	$newTotal = $currentTotal + $win;
		  }else if($bet == 3.00){
		  	$win = (($bet * 4.5)* 3);
		  	$newTotal = $currentTotal + $win;
		  }else if($bet == 3.50){
		  	$win =(($bet * 4.6)* 3);
		  	$newTotal = $currentTotal + $win;
		  }else if($bet == 4.00){
		  	$win = (($bet * 4.7)* 3);
		  	$newTotal = $currentTotal + $win;
		  }
		}else if($howManyRowWins == 4){
			if($bet == .50){
			$win = (($bet * 4) * 4);
		  	$newTotal = $currentTotal + $win;
		  }else if($bet == 1.00){
		  	$win = (($bet * 4.1)* 4);
		  	$newTotal = $currentTotal + $win;
		  }else if($bet == 1.50){
		  	$win = (($bet * 4.2)* 4);
		  	$newTotal = $currentTotal + $win;
		  }else if($bet == 2.00){
		  	$win = (($bet * 4.3)* 4);
		  	$newTotal = $currentTotal + $win;
		  }else if($bet == 2.50){
		  	$win = (($bet * 4.4)* 4);
		  	$newTotal = $currentTotal + $win;
		  }else if($bet == 3.00){
		  	$win = (($bet * 4.5)* 4);
		  	$newTotal = $currentTotal + $win;
		  }else if($bet == 3.50){
		  	$win = (($bet * 4.6)* 4);
		  	$newTotal = $currentTotal + $win;
		  }else if($bet == 4.00){
		  	$win = (($bet * 4.7)* 4);
		  	$newTotal = $currentTotal + $win;
		  }
		}
		 $sql2 = "INSERT INTO casino_winnings (gameID, betAmount, winAmount) VALUES (?, ?, ?)";
         $insertWin = $pdo->prepare($sql2);
         $insertWin->execute(array($gameID, $bet, $win));
	
	  echo $newTotal. " (new total)<br>";
	}

  $sql="UPDATE casino_game SET gameTotalDollars =? WHERE gameInSession=1";
        $updateTotal = $pdo->prepare($sql);
        $updateTotal->execute(array($newTotal));
		
		date_default_timezone_set("America/New_York");
		$date = date('Y-m-d H:i:s');
		
		$sql2="UPDATE casino_game SET gameLastPlayedDate =? WHERE gameInSession=1";
        $updateTotal2 = $pdo->prepare($sql2);
        $updateTotal2->execute(array($date));
 
}


?>
