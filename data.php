<?php
require_once("functions.php");
	
	
	
	$algus = "";
	$ots = "";
	$aeg = "";
	$algus_error = "";
	$ots_error = "";
	$aeg_error = "";
	
	// keegi vajutas nuppu
	if(isset($_POST["veo_leht"])){
		
		
		// valideerite väljad
		if ( empty($_POST["algus"]) ) {
			$algus_error = "See väli on kohustuslik";
		}else{
			$algus = cleanInput($_POST["algus"]);
		}
		
		if ( empty($_POST["ots"]) ) {
			$ots_error = "See väli on kohustuslik";
		}else{
			$ots = cleanInput($_POST["ots"]);
		}
		
		if ( empty($_POST["aeg"]) ) {
			$aeg_error = "See väli on kohustuslik";
		}else{
			$aeg = cleanInput($_POST["aeg"]);
		}
		
		if($algus_error == "" && $ots_error == "" && $aeg_error == ""){
			//salvestate ab'i fn kaudu Orders'isse
			// message funktsioonist
			$msg = addveod($algus, $ots, $aeg);
			
			if($msg != ""){
				//õnnestus, teeme inputi väljad tühjaks
				$algus = "";
				$ots = "";
				$aeg = "";
				
				echo $msg;
				
			}
			
		}
		
	}
	
	function cleanInput($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
?>



<link rel="stylesheet" type="text/css" href="kujundus.css">	
<h2>Lisa oma veotellimus</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
	<label for= "algus" >Algus</label><br>
	<input id="algus" name= "algus" type="text" value="<?php echo $algus; ?>"> <?php echo $algus_error; ?><br><br>
	<label for="ots">Ots</label><br>
	<input id="ots" name="ots" type="text" value="<?php echo $ots; ?>"> <?php echo $ots_error; ?><br><br>
	<label for="aeg">Aeg</label><br>
	<input id="aeg" name="aeg" type="text" value="<?php echo $aeg; ?>"> <?php echo $aeg_error; ?><br><br>
	<input type="submit" name="veo_leht" value="Salvesta">
</form>