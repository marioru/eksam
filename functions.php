<?php

	//loob AB'i �henduse
	
	require_once("../config_global.php");
	$database = "if15_mkoinc_3";
	

	session_start();
	
	
	
	function addveod($from, $where, $timeh) {
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("INSERT INTO veod (id, algus, ots, autonr, juht) VALUES (?,?,?,?,?)");
		$stmt->bind_param("issss", $_SESSION["logged_in_user_id"], $from, $where);
		
		//s�num
		$message = "";
		
		if($stmt->execute()){
			// kui on t�ene,
			//siis INSERT �nnestus
			$message = "Sai edukalt lisatud";
			 
			
		}else{
			// kui on v��rtus FALSE
			// siis kuvame errori
			echo $stmt->error;
			
		}
		
		return $message;
		
		
		$stmt->close();
		
		$mysqli->close();
		
		
	}
	
?>

