<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="./Style/casino.css">
		<!-- Latest compiled and minified CSS -->
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <style>
        	td{
        		border:1px solid black;
        		padding:20px;
        	}
        	th{
        		border:1px solid black;
        	}
        </style>
    </head>
<body>
	<?php
global $pdo;
include('database.php');
?>	
	<div class="container">
	<h1>Top Wins of All Time</h1>
	<h4>Don't forget lower bets can get double wins increasing their win amount</h4>
	<hr>
	   <table id="win-table">
	           <?php
	           $statement = "SELECT w.gameID, g.gamePlayerName, w.betAmount, w.winAmount FROM casino_winnings as w JOIN casino_game as g on w.gameID = g.gameID ORDER BY w.winAmount DESC";
				
				$games = $pdo->query($statement);
				
				echo "<table>";
				echo "<tr><th>Name</th><th>Bet Amount</th><th>Win Amount</th></tr>";
					foreach($games->FetchAll() as $game) {
				    	echo "<tr>" .
				    		 "<td>". $game['gamePlayerName']. "</td>" .
				    		 "<td>". $game['betAmount']. "</td>" .
				    		 "<td>". $game['winAmount']. "</td>" .
				    		 "</tr>";
					}
	 
				?>
		</table>
				
				<br>
				<br>
				<br>
				<a href="./index.php">Back to Game</a>
	    </div>
	</body>
	</html>