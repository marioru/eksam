<?php

	require_once("../config_global.php");
	$database = "if15_mkoinc_3";
function getEditData($edit_id){
	
	
	
	$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
	
	$stmt = $mysqli->prepare("SELECT autonr, juht FROM veod WHERE id=? AND seis IS NULL");
	$stmt->bind_param("i", $edit_id);
	$stmt->bind_result($autonr, $juht);
	$stmt->execute();
	
	$veod = new StdClass();
	
	//kas sain ühe rea andmeid kätte
	if($stmt->fetch()){
		//sain
		
		$veod->autonr = $autonr;
		$veod->juht = $juht;
		
		
	}else{
		//ei saanud
		header("Location: juhita.php");
		
	}
		return $veod;
		$stmt->close();
		$mysqli->close();
}
function updateveod($id, $autonr, $juht){
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("UPDATE veod SET autonr=?, juht=? WHERE id=?");
		$stmt->bind_param("ssi", $autonr, $juht, $id);
		if($stmt->execute()){
			// sai uuendatud
			// kustutame aadressirea tühjaks
			header("Location: juhita.php");
			
		}
		
		$stmt->close();
		$mysqli->close();
}
?>