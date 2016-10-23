<?php

	// Data Source Name, user/pass, and options
	$dsn = 'mysql:host=localhost;dbname=dbname';
	$username = 'enteryourown';
	$password = 'credentials';
	$options = array(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try {
		$pdo = new PDO($dsn, $username, $password, $options);
		
		                               // create table only need to run once
    //$sql = "CREATE TABLE casino_game (
    //gameID int NOT NULL AUTO_INCREMENT,
    //gameInSession bool NOT NULL,
    //gamePlayNumber int NOT NULL,
    //gamePlayerName varchar(255) NOT NULL,
    //gameLastPlayedDate datetime NOT NULL,
    //gameTotalDollars decimal(18, 2) NOT NULL,
    //primary key (gameID)
    //)";
	
	//$sql2 = "CREATE TABLE casino_winnings (
	//winID int NOT NULL AUTO_INCREMENT,
    //gameID int NOT NULL,
    //betAmount decimal(18, 2) NOT NULL,
    //winAmount decimal(18, 2) NOT NULL,
    //primary key (winID)
    //)";
	
	//$pdo->exec($sql);      // insert records only need to run once
	//$pdo->exec($sql2);
    //echo "Tables created successfully";
    
    //$sql = "INSERT INTO sk_courses VALUES
    //('cs601', 'Web Application Development'),
    //('cs602', 'Server-Side Web Development'),
    //('cs701', 'Rich Internet Application Development')";
	
    
	//$pdo->exec($sql);
	//$pdo->exec($sql2);
	
	//echo "Inserted values successfully";
		
	} catch(Exception $e) {
		echo "ERROR: " . $e->getMessage();
	}
	
	
?>