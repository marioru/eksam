<?php


	//loob AB'i �henduse
	
	require_once("../config_global.php");
	$database = "if15_mkoinc_3";
	

	session_start();
	
	
	
	function addveod($algus, $ots, $aeg) {
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("INSERT INTO veod (algus, ots, aeg) VALUES (?,?,?)");
		$stmt->bind_param("sss", $algus, $ots, $aeg);
		
		//s�num
		$message = "";
		
		if($stmt->execute()){
			// kui on t�ene,
			//siis INSERT �nnestus
			$message = "Sai edukalt lisatud";
			 
			
		}else{
			
			echo $stmt->error;
			
		}
		
		return $message;
		
		
		$stmt->close();
		
		$mysqli->close();
		
		
	}
	
?>

