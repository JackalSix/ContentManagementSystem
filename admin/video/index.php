<?php
//Hunter Glisson
include '../../includes/killmagicquotes.php';
include '../../includes/dbconnect.php';

if(isset($_GET['addvideo'])){	//runs if the user clicks add title

	try{
		
$sql = 'SELECT StudioID, StudioName FROM studio';
$result = $pdo->query($sql);

while($row=$result->fetch()){
	$studios[] = array('studioid' => $row['StudioID'], 'studioname' => $row['StudioName']);}
	
}catch(PDOException $e){
	$error = "Error populating studios: " . $e->getMessage();
	include '../../includes/error.html.php';
	exit();
}	
	include 'insertvideo.html.php'; //includes the insert
	exit();
}

if(isset($_POST['newtitle'])){ //runs if the user click add
	$valid = true;
	if(strlen($_POST["newnewmovienum"]) < 4){
		$valid = false;
	echo "<p>*Movie number must be four characters long</p>";
	} else if(!preg_match('/^[A-z]{2}[0-9]{2}$/', $_POST["newnewmovienum"])){
				$valid = false;
	echo "<p>*Movie number must be two letters followed by two numbers</p>";
	}
	
	if(is_numeric($_POST['newtitle'])){
		$valid = false;
	echo "<p>*Title cannot be a number</p>";
	}
	if(is_numeric($_POST['newcategory'])){
		$valid = false;
	echo "<p>*Category cannot be a number</p>";
	}
	if(!is_numeric($_POST['newlength'])){
		$valid = false;
	echo "<p>*Length musft be a whole number</p>";
	} else if($_POST['newlength'] < 1){
		$valid = false;
	echo "<p>*Length cannot be lower than one</p>";		
	} else if($_POST['newlength'] > 255){
		$valid = false;
	echo "<p>*Length cannot be greater than two hundred fifty five</p>";				
	}
	
	if($valid){
	try{
		//prepared sql for insert using variables
	$sql = 'INSERT INTO video SET
		MovieNumber = :newmovienumber,
		StudioID = :newstudioid,
		Title = :newtitle,
		Category = :newcategory,
		Length = :newlength';
	$s = $pdo->prepare($sql);
	
	//binding values for the variables
	$s->bindValue(':newmovienumber', strtoupper($_POST['newnewmovienum']));
	$s->bindValue(':newstudioid', $_POST['newstudio']);
	$s->bindValue(':newtitle', $_POST['newtitle']);
	$s->bindValue(':newcategory', $_POST['newcategory']);
	$s->bindValue(':newlength', $_POST['newlength']);
	$s->execute();
	
	}catch(PDOException $e){
	$error = "Error inserting record: " . $e->getMessage();
	include '../../includes/error.html.php';
	exit();
	}
	}else{	
try{
		
$sql = 'SELECT StudioID, StudioName FROM studio';
$result = $pdo->query($sql);

while($row=$result->fetch()){
	$studios[] = array('studioid' => $row['StudioID'], 'studioname' => $row['StudioName']);}
	
}catch(PDOException $e){
	$error = "Error populating studios: " . $e->getMessage();
	include '../../includes/error.html.php';
	exit();
}	
	include 'insertvideo.html.php'; //includes the insert
	exit();
}}

if(isset($_GET['deletevideo'])){ //runs if the user click delete
	
	try{
		
$sql = 'SELECT Title, Category, Length, MovieNumber FROM video WHERE MovieNumber = :movienumber'; //select to show what you are deleting
	$s = $pdo->prepare($sql);
	$s->bindValue(':movienumber', $_POST['movienumber']);
	$s->execute();
	
while($row=$s->fetch()){
	$videos[] = array('title' => $row['Title'], 'category' => $row['Category'], 'length' => $row['Length'], 'movienumber' => $row['MovieNumber']);}
	
}catch(PDOException $e){
	$error = "Error populating record: " . $e->getMessage();
	include '../../includes/error.html.php';
	exit();
}
	include 'confirmdelete.html.php';
	exit();
}	

if(isset($_GET['confirmdelete'])){ //runs if the user click yes
try{
	$sql = 'DELETE FROM video WHERE MovieNumber = :movienumber'; //delete statement to remove record
	$s = $pdo->prepare($sql);
	$s->bindValue(':movienumber', $_GET['confirmdelete']);
	$s->execute();
	
}catch(PDOException $e){
	$error = "Error deleting record: " . $e->getMessage();
	include '../../includes/error.html.php';
	exit();
	}
	header('Location: .');
	exit();
}
if(isset($_GET['movienumber'])){ //runs if the user clicks edit
try{
	//used for populating fields
	$sql = "SELECT MovieNumber, StudioID, Title, Category, Length FROM video WHERE MovieNumber = :movienumber";
	$s = $pdo->prepare($sql);
	$s->bindValue(":movienumber", $_GET["movienumber"]);
	$s->execute();

	while($row = $s->fetch())
    {
		$videos[] = array('title' => $row['Title'], 'category' => $row['Category'], 'length' => $row['Length'], 'movienumber' => $row['MovieNumber'], 'studioid' => $row['StudioID']);}

	//used for populating dropdown
	$sql = 'SELECT StudioID, StudioName FROM studio';
	$result = $pdo->query($sql);
	
while($row=$result->fetch()){
	$studios[] = array('studioid' => $row['StudioID'], 'studioname' => $row['StudioName']);}
}catch(PDOException $e){
	$error = "Error editing record: " . $e->getMessage();
	include '../../includes/error.html.php';
	exit();
	}
    include "updatevideo.html.php";
	exit();
}
if(isset($_POST['updatedtitle'])){ //runs if the user clicks update
		
		$valid = true;
	if(is_numeric($_POST['updatedtitle'])){
		$valid = false;
	echo "<p>*Title cannot be a number</p>";
	}
	if(is_numeric($_POST['updatedcategory'])){
		$valid = false;
	echo "<p>*Category cannot be a number</p>";
	}
	if(!is_numeric($_POST['updatedlength'])){
		$valid = false;
	echo "<p>*Length musft be a whole number</p>";
	} else if($_POST['updatedlength'] < 1){
		$valid = false;
	echo "<p>*Length cannot be lower than one</p>";		
	} else if($_POST['updatedlength'] > 255){
		$valid = false;
	echo "<p>*Length cannot be greater than two hundred fifty five</p>";				
	}
	
	if($valid){
try{
	$sql = 'UPDATE video SET
	StudioID = :updatedstudio,
	Title = :updatedtitle,
	Category = :updatedcategory,
	Length = :updatedlength
	WHERE MovieNumber=:movienum';
	
	$s = $pdo->prepare($sql);
	$s->bindValue(':movienum', $_POST['updatednewmovienum']);
	$s->bindValue(':updatedstudio', $_POST['updatedstudio']);
	$s->bindValue(':updatedtitle', $_POST['updatedtitle']);
	$s->bindValue(':updatedcategory', $_POST['updatedcategory']);
	$s->bindValue(':updatedlength', $_POST['updatedlength']);
	$s->execute();

}catch(PDOException $e){
	$error = "Error editing record: " . $e->getMessage();
	include '../../includes/error.html.php';
	exit();
	}
	}else{try{
	//used for populating fields
	$sql = "SELECT MovieNumber, StudioID, Title, Category, Length FROM video WHERE MovieNumber = :movienumber";
	$s = $pdo->prepare($sql);
	$s->bindValue(":movienumber", $_POST["updatednewmovienum"]);//pulls from post from the existing form now since get is no longer available
	$s->execute();

	while($row = $s->fetch())
    {
		$videos[] = array('title' => $row['Title'], 'category' => $row['Category'], 'length' => $row['Length'], 'movienumber' => $row['MovieNumber'], 'studioid' => $row['StudioID']);}

	//used for populating dropdown
	$sql = 'SELECT StudioID, StudioName FROM studio';
	$result = $pdo->query($sql);
	
while($row=$result->fetch()){
	$studios[] = array('studioid' => $row['StudioID'], 'studioname' => $row['StudioName']);}
}catch(PDOException $e){
	$error = "Error editing record: " . $e->getMessage();
	include '../../includes/error.html.php';
	exit();
	}
    include "updatevideo.html.php";
	exit();}
}

try{
$sql = 'SELECT Title, Category, Length, MovieNumber FROM video'; // populates table
$result = $pdo->query($sql);
while($row=$result->fetch()){
	$videos[] = array('title' => $row['Title'], 'category' => $row['Category'], 'length' => $row['Length'], 'movienumber' => $row['MovieNumber']);}
	
}catch(PDOException $e){
	$error = "Error populating jokes: " . $e->getMessage();
	include '../../includes/error.html.php';
	exit();
}

include 'listvideos.html.php';
?>

