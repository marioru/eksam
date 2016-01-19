<?php

	//Loome ühenduse andmebaasiga
	require_once("../config_global.php");
	$database = "if15_mkoinc_3";
	session_start();
	
	
	function addveod($algus, $ots, $aeg){
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("INSERT INTO veod (algus, ots, aeg, autonr, juht) VALUES (?, ?, ?, ?, ?)");
		$stmt->bind_param("sssss",$algus, $ots, $aeg);
		
		//sõnum
		$message= "";
		
		if($stmt->execute()){
			//kui on tõene, INSERT õnnestus
			$message = "Sai edukalt lisatud";
			
			
		}else{
			//kui on väär, kuvame errori
			echo $stmt->error;
		}
		return $message;
		
		$stmt->close();
		$mysqli->close();
	}
	
	
	//annan vaikeväärtuse
	function getveodData(){
		
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT id, algus, ots, aeg, autonr, juht FROM veod WHERE seis IS NULL");
		$stmt->bind_result($id, $algus, $ots, $aeg, $autonr, $juht);
		$stmt->execute();
		
		$veod_array = array ();
		
	
		while($stmt->fetch()){
		
			
			
			$veod = new StdClass();
			$veod->id = $id;
			$veod->algus =$algus;
			$veod->ots=$ots;
			$veod->aeg=$aeg;
			$veod->autonr=$autonr;
			$veod->juht=$juht;
			
			
			array_push($veod_array, $veod);
		
			
		}
		//tagastan massiivi, kus kõik read sees
		return $veod_array;
		
		$stmt->close();
		$mysqli->close();
		
	}
	function updateveod($id, $autonr, $juht){
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("UPDATE veod SET autonr=?, juht=? WHERE id=?");
		echo $mysqli->error;
		$stmt->bind_param("ssi",  $autonr, $juht, $id);
		if($stmt->execute()){

		header("Location: juhita.php");
			
		}
		$stmt->close();
		$mysqli->close();
		
	}
	
	
?>