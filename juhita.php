<?php

	require_once("functions2.php");

if(isset($_POST["save"])){
		updateveod($_POST["id"], $_POST["autonr"], $_POST["juht"]);}
	
			
	$veod_array = getveodData();
?>

<html>
<link>
<body><h2>Tabel</h2>

<table border="1">
	<tr>
		<th>id</th>
		<th>algus</th>
		<th>ots</th>
		<th>aeg</th>
		<th>autonr</th>
		<th>juht</th>
		<th>edit</th>
		
	</tr>
	
</body>
</html>
	<?php
	//trükime välja read
	//
	for($i = 0; $i < count($veod_array); $i++){
		
		
		if(isset($_GET["edit"]) && $veod_array[$i]->id == $_GET["edit"]){
			
			echo"<tr>";
			echo"<form action='juhita.php' method='post'>";
			echo"<input type='hidden' name='id' value='".$veod_array[$i]->id."'>";
			echo"<td>".$veod_array[$i]->id."</td>";
			echo"<td>".$veod_array[$i]->algus."</td>";
			echo"<td>".$veod_array[$i]->ots."</td>";
			echo"<td>".$veod_array[$i]->aeg."</td>";
			echo"<td><input name='autonr' value='".$veod_array[$i]->autonr."'></td>";
			echo"<td><input name='juht' value='".$veod_array[$i]->juht."'></td>";
			echo "<td><a href='juhita.php'>cancel</a></td>";
			echo "<td><input type='submit' name='save'></td>";
			echo"</form>";
			echo"</tr>";
			
			
		}else{
		
		
			echo"<tr>";
			echo"<td>".$veod_array[$i]->id."</td>";
			echo"<td>".$veod_array[$i]->algus."</td>";
			echo"<td>".$veod_array[$i]->ots."</td>";
			echo"<td>".$veod_array[$i]->aeg."</td>";
			echo"<td>".$veod_array[$i]->autonr."</td>";
			echo"<td>".$veod_array[$i]->juht."</td>";
			echo "<td><a href='?edit=".$veod_array[$i]->id."'>edit</a></td>";
			echo "</tr>";
					}
		
}
		
	
	?>
</table>