<?php
	//Loome ühenduse andmebaasiga
	require_once("../config_global.php");
	$database = "if15_mkoinc_3";
	session_start();
	
	
	function addReview($from, $where, $timeh){
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("INSERT INTO veod (id, algus, ots, aeg, autonr, juht) VALUES (?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("isssss", $_SESSION["logged_in_user_id"], $from, $where, $timeh);
		
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
	function getReviewData($keyword=""){
		
		$search="%%";
		
		//kas otsisõna on tühi
		if($keyword==""){
			//ei otsi midagi
			//echo "Ei otsi";
			
		}else{
			//otsin
			echo "Otsin " .$keyword;
			$search="%".$keyword."%";
			// "linex"
			// "%linex%"
			
		}
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT id, algus, ots, aeg, autonr, juht FROM veod WHERE deleted IS NULL AND (algus LIKE ?)");
		$stmt->bind_param("s", $search);
		$stmt->bind_result($id, $from, $mwhere, $timeh, $carnr, $driver);
		$stmt->execute();
		
		//tekitan tühja massiivi, kus edaspidi hoian objekte
		$review_array = array ();
		
		//tee midagi seni, kuni saame andmebaasist ühe rea andmeid
		while($stmt->fetch()){
			//seda siin sees tehakse nii mitu korda kui on ridu
			
			//tekitan objekti, kus hakkan hoidma väärtusi
			$review = new StdClass();
			$review->id = $id;
			$review->algus =$from;
			$review->ots=$where;
			$review->aeg=$timeh;
			$review->autonr=$carnr;
			$review->juht=$driver;
			//lisan massiivi ühe rea juurde
			
			array_push($review_array, $review);
			//var dump ütleb muutuja tüübi ja sisu
			//echo "<pre>";
			//var_dump($car_array);
			//echo "</pre><br>";
			
		}
		//tagastan massiivi, kus kõik read sees
		return $review_array;
		
		$stmt->close();
		$mysqli->close();
		
	}
	function updateReview($id, $from, $mwhere, $timeh, $carnr, $driver){
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("UPDATE veod SET algus=?,  ots=?, aeg=? , autonr=?, juht=? WHERE id=?");
		echo $mysqli->error;
		$stmt->bind_param("sssi", $from, $where, $timeh, $id);
		if($stmt->execute()){

		header("Location: table.php");
			
		}
		$stmt->close();
		$mysqli->close();
		
	}
	
	
?>