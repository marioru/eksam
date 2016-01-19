<?php

require_once("edit_functions.php");
	$autonr = "";
	$juht = "";
if(isset($_POST["updateveod"])){
		//vajutas salvesta nuppu
		
		updateveod($_GET["id"],$_POST["algus"], $_POST["ots"],$_GET["aeg"],$_POST["autonr"], $_POST["juht"]);
		
	}

?>

<h2>Lisa oma veotellimus</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
	<input type="hidden" name="id" value="<?=$_GET["edit_id"];?>"
	<label for= "algus" >Algus</label><br>
	<input id="algus" name= "algus" type="text" value="<?=$algus->algus;?>"><br><br>
	<label for="ots">Ots</label><br>
	<input id="ots" name="ots" type="text" value="<?=$ots->ots;?>"><br><br>
	<label for="aeg">Aeg</label><br>
	<input id="aeg" name="aeg" type="text" value="<?=$aeg->aeg;?>"><br><br>
	<input type="submit" name="veo_leht" value="Salvesta">
</form>
