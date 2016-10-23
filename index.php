
<!DOCTYPE html>
<html>
	<head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.4.min.js"></script>
        <script src="./Script/casino.js"></script>
        <link rel="stylesheet" href="./Style/casino.css">
    </head>
<body>
<audio autoplay loop controls id="casino-floor"> <!-- HTML 5 requirement-->
  <source src="./audio/243644__xtrgamr__casino.wav" type="audio/wav"> 
Your browser does not support audio
</audio>
<?php
global $pdo;
include('database.php');
include('update_total_after_spin.php');

?>	
<div class="container" align="center">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h1>Lucky Strike Slot Machine</h1>
				<p>*There is a casino audio track playing in the background</p>
				
				<hr>
			</div>
		</div>
	
	<div class="row">
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<?php
			
				$statement = "SELECT gameID, gameInSession, gameTotalDollars FROM casino_game";
				
				$gameInSession = $pdo->query($statement);
				
				$currentGameInSession = false;
				
				foreach($gameInSession->FetchAll() as $game) {
				    	
				    		if($game['gameInSession']){
				    			$currentGameInSession = true;
								$currentGameDollarAmount = $game['gameTotalDollars'];
				    			break;
				    		}
					}
				
				if($currentGameInSession){
					echo "<form action=\"add_cash.php\" method=\"Post\">";
					echo "<input type=\"hidden\" value=\"". $currentGameDollarAmount.  "\" name=\"current_game_total\" />";
					echo "Add cash to current game: $<input type=\"text\" name=\"added_cash\"/><br><br><input type=\"submit\" class=\"btn btn-info\" value=\"Add Cash\"/>";
					echo "</form>";
				}else{
					echo "<br><br><a id=\"start-new-game\" class=\"btn btn-info\" href=\"#\">Start New Game</a>";
				}
			
			?>
			 <div class="new-game-fields">
				 <form action="start_new_game.php" method="post">
					 <br>
					 <br>
					 Enter Dollar Amount to start: $<input type="text" name="dollar-amount"/>
					 <br>
					 <br>
					 Enter First and Last Name: <input type="text" name="player-name"/>
					 <br>
					 <br>
					 <input type="submit" value="Get Started!" class="btn btn-success"/>
				 </form> 	
			 </div>
			 
		   </div>
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">	
			
	     <?php
	     
	     $sql = "SELECT gameID, gamePlayerName FROM casino_game WHERE gameInSession=1";
		 $thisGame = $pdo->query($sql);
		 
		 $getMyName = $thisGame->Fetch(); 
		 	
		 $myName = $getMyName['gamePlayerName'];
		 $myGameID = $getMyName['gameID'];
	     
	     if($currentGameInSession && isset($_POST["bet"]) && isset($_POST["current_play_amount"])){
	     	
			$bet = number_format($_POST["bet"], 2);
			$current = number_format($_POST["current_play_amount"], 2);
			
	     		
		 if($bet > $current){
		 	echo "<script>".
		 	"alert(\"You do not have enough credits to bet this amount. Add money to game or bet lower.\")".
		 	"</script>";
			echo "<table id=\"slot-machine\">". 		
			"<tr><td>". "X". "</td><td>". "X". "</td><td>". "X". "</td></tr>".
			"<tr><td>". "X". "</td><td>". "X". "</td><td>". "X". "</td></tr>".
			"<tr><td>". "X". "</td><td>". "X". "</td><td>". "X". "</td></tr>".
			"</table></div>";
			echo "<div class=\"col-xs-4 col-sm-4 col-md-4 col-lg-4\">";
		 }else{
				
				
	     $min = 1; $max = 7;
	     $rand1 = rand ($min , $max);
		 $rand2 = rand ($min , $max);
		 $rand3 = rand ($min , $max);
		 $rand4 = rand ($min , $max);
		 $rand5 = rand ($min , $max);
		 $rand6 = rand ($min , $max);
		 $rand7 = rand ($min , $max);
		 $rand8 = rand ($min , $max);
		 $rand9 = rand ($min , $max);

         $line1 = array($rand1, $rand2, $rand3);//automatic indexing
	     $line2 = array($rand4, $rand5, $rand6);
		 $line3 = array($rand7, $rand8, $rand9);
			
	    echo "<table id=\"slot-machine\">". 		
		"<tr><td>". $line1[0]. "</td><td>". $line1[1]. "</td><td>". $line1[2]. "</td></tr>".
		"<tr><td>". $line2[0]. "</td><td>". $line2[1]. "</td><td>". $line2[2]. "</td></tr>".
		"<tr><td>". $line3[0]. "</td><td>". $line3[1]. "</td><td>". $line3[2]. "</td></tr>".
		"</table></div>";
		
		$matches = array();//keeps track of all the matches because there could be more than one
		echo "<div class=\"col-xs-4 col-sm-4 col-md-4 col-lg-4\">";
		
		if($line1[0] == $line2[0] && $line2[0] == $line3[0]){ //3 matching 1st row vertical 
		    array_push($matches, "row1vertical");             // I am NOT using "else if" because more than one of these is a possibility
			                                                  // and I need to keep track of how many items got pushed to the array
			    echo "<span class=\"float-left\">".
			     "<h3>You won!!</h3>".
			     "<span class=\"win-board\"> <img src=\"./Images/Win6.jpg\" width=\"100\"/></span>".
			     "</span>";
		         
		}
		if($line1[1] == $line2[1] && $line2[1] == $line3[1]){ //3 matching 2nd row vertical
		    array_push($matches, "row2vertical");
			
			     echo "<span class=\"float-left\">".
			     "<h3>You won!!</h3>".
			     "<span class=\"win-board\"> <img src=\"./Images/Win7.jpg\" width=\"100\"/></span>".
			     "</span>";
				 
	    }
		if($line1[2] == $line2[2] && $line2[2] == $line3[2]){ //3 matching 3rd row vertical
		    array_push($matches, "row3vertical");
			echo "<span class=\"float-left\">".
			     "<h3>You won!!</h3>".
			     "<span class=\"win-board\"> <img src=\"./Images/Win8.jpg\" width=\"100\"/></span>".
			     "</span>";
		}
		if($line1[0] == $line1[1] && $line1[1] == $line1[2]){ //3 matching 1st row horizontal
		    array_push($matches, "row1horizontal");
			echo "<span class=\"float-left\">".
			     "<h3>You won!!</h3>".
			     "<span class=\"win-board\"> <img src=\"./Images/Win3.jpg\" width=\"100\"/></span>".
			     "</span>";
		}
		if($line2[0] == $line2[1] && $line2[1] == $line2[2]){ //3 matching 2nd row horizontal
		    array_push($matches, "row2horizontal");
			echo "<span class=\"float-left\">".
			     "<h3>You won!!</h3>".
			     "<span class=\"win-board\"> <img src=\"./Images/Win4.jpg\" width=\"100\"/></span>".
			     "</span>";
		}
		if($line3[0] == $line3[1] && $line3[1] == $line3[2]){ //3 matching 3rd row horizontal
		    array_push($matches, "row3horizontal");
			echo "<span class=\"float-left\">".
			     "<h3>You won!!</h3>".
			     "<span class=\"win-board\"> <img src=\"./Images/Win5.jpg\" width=\"100\"/></span>".
			     "</span>";
		}
		if($line1[0] == $line2[1] && $line2[1] == $line3[2]){ //3 matching diagonal
		    array_push($matches, "diagonal1");
			echo "<span class=\"float-left\">".
			     "<h3>You won!!</h3>".
			     "<span class=\"win-board\"> <img src=\"./Images/Win1.jpg\" width=\"100\"/></span>".
			     "</span>";
		}
		if($line1[2] == $line2[1] && $line2[1] == $line3[0]){ //3 matching diagonal
		    array_push($matches, "diagonal2");
			echo "<span class=\"float-left\">".
			    "<h3>You won!!</h3>".
			     "<span class=\"win-board\"> <img src=\"./Images/Win2.jpg\" width=\"100\"/></span>".
				 "</span>";
		}
		
		if(sizeof($matches) == 0){
			echo "<h3>Sorry ". strtok($myName, " "). "! Better luck next time!</h3>";
			
			update_total($myGameID, $current, $bet, "lose", 0);
			
		}
		else if(sizeof($matches) == 1){
			
			update_total($myGameID, $current, $bet, "win", 1);
			//echo "<p>Regular win</p>";
		}else if(sizeof($matches) == 2){
			
			echo "<p>DOUBLE WIN</p>";
			
			update_total($myGameID, $current, $bet, "win", 2);
			
		}else if(sizeof($matches) == 3){
			
			echo "<p>TRIPPLE WIN</p>";
			
			update_total($myGameID, $current, $bet, "win", 3);
			
		}else if(sizeof($matches) == 4){
			
			echo "<p>QUADRUPLE WIN</p>";
			
			update_total($myGameID, $current, $bet, "win", 4);
		}
		
		}
		 $statement = "SELECT gameID, gamePlayerName, gameTotalDollars FROM casino_game WHERE gameInSession=1";
		 $currentGame = $pdo->query($statement);
		 
		 $myGame = $currentGame->Fetch(); 
		 
		 $myMoney = $myGame['gameTotalDollars'];
		 $myID = $myGame['gameID'];
		 
		 if($bet == .50){   //I got really annoyed having to select a bet radio button every time so this makes it so u can do repeat bet
		  	echo "<script>$( document ).ready(function() { $('#fiftyCents').prop(\"checked\", true);});</script>";
		  }else if($bet == 1.00){
		  	echo "<script>$( document ).ready(function() { $('#oneDollar').prop(\"checked\", true);});</script>";
		  }else if($bet == 1.50){
		  	echo "<script>$( document ).ready(function() { $('#oneDollarFifty').prop(\"checked\", true);});</script>";
		  }else if($bet == 2.00){
		  	echo "<script>$( document ).ready(function() { $('#twoDollars').prop(\"checked\", true);});</script>";
		  }else if($bet == 2.50){
		  	echo "<script>$( document ).ready(function() { $('#twoDollarFifty').prop(\"checked\", true);});</script>";
		  }else if($bet == 3.00){
		  	echo "<script>$( document ).ready(function() { $('#threeDollar').prop(\"checked\", true);});</script>";
		  }else if($bet == 3.50){
		  	echo "<script>$( document ).ready(function() { $('#threeDollarFifty').prop(\"checked\", true);});</script>";
		  }else if($bet == 4.00){
		  	echo "<script>$( document ).ready(function() { $('#fourDollar').prop(\"checked\", true);});</script>";
		  }
		 
		 echo "</div>";
		
		 }else{
		 	 $statement = "SELECT gameID, gamePlayerName, gameTotalDollars FROM casino_game WHERE gameInSession=1";
		 $currentGame = $pdo->query($statement);
		 
		 $myGame = $currentGame->Fetch(); 
		 	
		 $myName = $myGame['gamePlayerName'];
		 $myMoney = $myGame['gameTotalDollars'];
		 $myID = $myGame['gameID'];
		 
		 	echo "<table id=\"slot-machine\">". 		
		"<tr><td>". "X". "</td><td>". "X". "</td><td>". "X". "</td></tr>".
		"<tr><td>". "X". "</td><td>". "X". "</td><td>". "X". "</td></tr>".
		"<tr><td>". "X". "</td><td>". "X". "</td><td>". "X". "</td></tr>".
		"</table></div>";
		 }
		 
		 if(empty($_POST["bet"]) && $currentGameInSession == true){
		 	 echo "<script>alert(\"Select amount to bet\")</script>";
		 }
		
	
          ?>	
		
		</div>
		  <br>
		<div class="row">
		    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
		      <form action="end_game.php" method="post" id="cash-out-form">
		      	 <input type="hidden" id="cash_out_my_name" name="cash_out_my_name" value="<?php echo $myName; ?>">
		      	 <input type="hidden" id="cash_out_my_total" name="cash_out_my_total" value="<?php echo $myMoney; ?>">
		      	 <input type="hidden" name="game_id" value="<?php echo $myID; ?>">
			     <input class="btn btn-danger" type="submit" id="cash-out" value="Cash Out (End Game)"/>
			  </form>
		   </div>
		    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
		    <form action="index.php" method="post" id="pull-lever">
			 Bet Amount:
			 <input type="hidden" value="<?php echo $myMoney; ?>" name="current_play_amount"/>
			 $.50&nbsp;<input type="radio" name="bet" value=".5" id="fiftyCents"/>&nbsp;&nbsp;
			 $1.00&nbsp;<input type="radio" name="bet" value="1" id="oneDollar"/>&nbsp;&nbsp;
			 $1.50&nbsp;<input type="radio" name="bet" value="1.5" id="oneDollarFifty"/>&nbsp;&nbsp;
			 $2.00&nbsp;<input type="radio" name="bet" value="2" id="twoDollars"/>&nbsp;&nbsp;
			 $2.50&nbsp;<input type="radio" name="bet" value="2.5" id="twoDollarFifty"/>&nbsp;&nbsp;
			 $3.00&nbsp;<input type="radio" name="bet" value="3" id="threeDollar"/>&nbsp;&nbsp;
			 $3.50&nbsp;<input type="radio" name="bet" value="3.5" id="threeDollarFifty"/>&nbsp;&nbsp;
			 $4.00&nbsp;<input type="radio" name="bet" value="4" id="fourDollar"/>&nbsp;&nbsp;
			 </form>
		   </div>
		   <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			 Credits remaining: $<input type="text" value="<?php echo $myMoney; ?>" readonly/>
		   </div>
		</div>
		<br>
		<br>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				
				  <button id="spin" name="spin" type="submit" class="btn btn-success">
				  	play
				  </button>
				
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				
				  <a href="./TopWins.php" class="btn btn-info">
				  View Top Wins of all time!
				  </a>
				
			</div>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
					
			</div>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				
				  <a href="./rest.php?format_type=XML" class="btn btn-info">
				  XML Report of average playing time
				  </a>
				
			</div>
		</div>
		
	
</div>

</body>
</html>