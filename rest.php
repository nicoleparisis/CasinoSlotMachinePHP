
<?php


if (isset($_GET['format_type'])) {
	
   $type = $_GET['format_type'];	
		
	
	if($type == "XML"){
		
		$games = simplexml_load_file('./average_playtime.xml');
		
		foreach($games->game as $game){//loop thru xml file and print data
			echo "<p>Time Played: ". $game->time_played. " Amount Cashed Out: ". $game->amount_cashed_out. "</p>";
		}
		
	}
}

?>