<?php

include('database.php');
global $pdo;


$sql = "CREATE TABLE casino_game (
    gameID int NOT NULL AUTO_INCREMENT,
    gameInSession bool NOT NULL,
    gamePlayNumber int NOT NULL,
    gamePlayerName varchar(255) NOT NULL,
    gameLastPlayedDate datetime NOT NULL,
    gameTotalDollars decimal(18, 2) NOT NULL,
    gameStartDate datetime NULL,
    gameEndDate datetime NULL,
    primary key (gameID)
    )";
	
	$sql2 = "CREATE TABLE casino_winnings (
	winID int NOT NULL AUTO_INCREMENT,
    gameID int NOT NULL,
    betAmount decimal(18, 2) NOT NULL,
    winAmount decimal(18, 2) NOT NULL,
    primary key (winID)
    )";
	
	$pdo->exec($sql);      // insert records only need to run once
	$pdo->exec($sql2);
    echo "Tables created successfully";
	
	?>