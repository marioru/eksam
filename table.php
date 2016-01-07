<?php
	require_once("functions2.php");
	

	
	$rating = "";
	
	//kas kustutame, ?delete = vastav id mida kustutada on aadressireal
	if(isset($_GET["delete"])){
		echo "Kustutame id" .$_GET["delete"];
		//käivitan funktsiooni, saadan kaasa id
		deleteReview($_GET["delete"]);
	
	}
	//salvestan andmebaasi
	if(isset($_POST["save"])){
		updateReview($_POST["id"], $_POST["algus"], $_POST["ots"], $_POST["aeg"], $_POST["autonr"], $_POST["juht"]);
	}
	
	$keyword="";
	
	//aadressireal on keyword
	if(isset($_GET["keyword"])){
		
		//otsin	
		$keyword= $_GET["keyword"];
		$review_array = getReviewData($keyword);
		
	}else{
		//küsin kõik andmed
	//käivitan funktsiooni
	$review_array = getReviewData();
	}
	
?>
<html>
<link rel="stylesheet" type="text/css" href="kujundus.css">
<body>
<h2>Veod</h2>

<form action="tablek.php" method="get"> 
	<input type="search" name="keyword" value="<?=$keyword;?>">
	<input type="submit">
</form>
<table border="1">
	<tr>
		<th>Id</th>
		<th>algus</th>
		<th>ots</th>
		<th>aeg</th>
		<th>autonr</th>
		<th>juht</th>
		<th>comment</th>
		<th>X</th>
		<th>Edit</th>
		
	</tr>
</body>
</html>
	<?php
		//trükime välja read
		//massiivi pikkus count()
		for($i = 0; $i < count($review_array); $i++){
			//echo $review_array[$i]->id;
			
			//kasutaja tahab muuta seda rida
			if(isset($_GET["edit"]) && $review_array[$i]->id == $_GET["edit"]){
				
				echo "<tr>";
				echo "<form action='table.php' method='post'>";
				echo "<input type='hidden' name='id' value='".$review_array[$i]->id."'>";
				echo "<td>".$review_array[$i]->id."</td>";
				echo "<td><input name='algus' value ='".$review_array[$i]->algus."'></td>";
				echo "<td><input name='ots' value ='".$review_array[$i]->ots."'></td>";
				echo "<td><input name='aeg' value ='".$review_array[$i]->aeg."'></td>";
				echo "<td><input name='autonr' value ='".$review_array[$i]->autonr."'></td>";
				echo "<td><input name='juht' value ='".$review_array[$i]->juht."'></td>";
				echo "<td><a href='tablek.php'>Cancel</a></td>";
				echo "<td><input type='submit' name='save'></td>";
				echo "</tr>";
				echo "</form>";
				
			}else{
				echo "<tr>";
				echo "<td>".$review_array[$i]->id."</td>";
				echo "<td>".$review_array[$i]->algus."</td>";
				echo "<td>".$review_array[$i]->ots."</td>";
				echo "<td>".$review_array[$i]->autonr."</td>";
				echo "<td>".$review_array[$i]->juht."</td>";
				
				if($_SESSION["logged_in_user_id"] == $review_array[$i]->id){
					echo "<td><a href='?delete=".$review_array[$i]->id."'>X</a></td>";
					echo "<td><a href='?edit=".$review_array[$i]->id."'>edit</a></td>";
				}
				echo "</tr>";
			}
			
			
		}
	
	?>
</table>