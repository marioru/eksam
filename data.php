<?php
require_once("functions.php");
	
	
	$from = "";
	$where = "";
	$timeh = "";
	$from_error = "";
	$where_error = "";
	$timeh_error = "";
	
	// keegi vajutas nuppu
	if(isset($_POST["from"])){
		
		
		// valideerite väljad
		if ( empty($_POST["from"]) ) {
			$from_error = "See väli on kohustuslik";
		}else{
			$from = cleanInput($_POST["from"]);
		}
		
		if ( empty($_POST["where"]) ) {
			$where_error = "See väli on kohustuslik";
		}else{
			$where_material = cleanInput($_POST["where"]);
		}
		
		if ( empty($_POST["timeh"]) ) {
			$where_error = "See väli on kohustuslik";
		}else{
			$timeh = cleanInput($_POST["timeh"]);
		}
		
		if($where_error == "" && $from_error == "" && $timeh_error == ""){
			//salvestate ab'i fn kaudu Orders'isse
			// message funktsioonist
			$msg = addveod($from, $where, $timeh);
			
			if($msg != ""){
				//õnnestus, teeme inputi väljad tühjaks
				$from = "";
				$where = "";
				$timeh = "";
				
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
	<label for="from" >Algus</label><br>
	<input id="from" name="from" type="text" value="<?php echo $from; ?>"> <?php echo $from_error; ?><br><br>
	<label for="where">Ots</label><br>
	<input id="where" name="where" type="text" value="<?php echo $where; ?>"> <?php echo $where_error; ?><br><br>
	<label for="timeh">Aeg</label><br>
	<input id="where" name="where" type="text" value="<?php echo $timeh; ?>"> <?php echo $timeh_error; ?><br><br>
	<input type="submit" name="add_product" value="Salvesta">
</form>