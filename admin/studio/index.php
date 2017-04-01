<?php
//Hunter Glisson
include '../../includes/killmagicquotes.php';
include '../../includes/dbconnect.php';

if(isset($_GET['addstudio'])){	//runs if the user clicks add title
	include 'insertstudio.html.php'; //includes the insert
	exit();
}

if(isset($_POST['newname'])){ //runs if the user click add

	$valid = true;
	if(strlen($_POST["newstudioid"]) < 3){
		$valid = false;
	echo "<p>*StudioID must be three characters long</p>";
	
	}else if(is_numeric($_POST["newstudioid"])){
		$valid = false;
	echo "<p>*StudioID cannot be a number</p>";
	}
	
	if(strlen($_POST["newphone"]) < 12){
		$valid = false;
		echo "<p>*Phone number must be 12 characters long in ###-###-#### format</p>";
		
	}else if(!preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $_POST["newphone"])){
		$valid = false;
		echo "<p>*Phone number must be in ###-###-#### format</p>";}
		
	if(is_numeric($_POST['newname'])){
		$valid = false;
		echo "<p>*Studio name cannot be a number</p>";
	}
	if(is_numeric($_POST['newcontact'])){
		$valid = false;
		echo "<p>*Contact person cannot be a number</p>";
	}
		if($valid){
	try{
		//prepared sql for insert using variables
	$sql = 'INSERT INTO studio SET
		StudioID = :newstudioid,
		StudioName = :newname,
		ContactPerson = :newcontact,
		Phone = :newphone';
	$s = $pdo->prepare($sql);
	
	//binding values for the variables
	$s->bindValue(':newstudioid', strtoupper($_POST['newstudioid']));
	$s->bindValue(':newname', $_POST['newname']);
	$s->bindValue(':newcontact', $_POST['newcontact']);
	$s->bindValue(':newphone', $_POST['newphone']);
	$s->execute();
	
	}catch(PDOException $e){
	$error = "Error inserting record: " . $e->getMessage();
	include '../../includes/error.html.php';
	exit();
	}
}else{	
	include "insertstudio.html.php";
	exit();}
}

if(isset($_GET['deletestudio'])){ //runs if the user click delete
	
	try{
		
$sql = 'SELECT StudioName, ContactPerson, Phone, StudioID FROM studio WHERE StudioID = :studioid'; //select to show what you are deleting
	$s = $pdo->prepare($sql);
	$s->bindValue(':studioid', $_POST['studioid']);
	$s->execute();
	
while($row=$s->fetch()){
	$studios[] = array('name' => $row['StudioName'], 'contact' => $row['ContactPerson'], 'phone' => $row['Phone'], 'studioid' => $row['StudioID']);}
	
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
	$sql = 'DELETE FROM studio WHERE StudioID = :studioid'; //delete statement to remove record
	$s = $pdo->prepare($sql);
	$s->bindValue(':studioid', $_GET['confirmdelete']);
	$s->execute();
	
}catch(PDOException $e){
	$error = "Error deleting record: " . $e->getMessage();
	include '../../includes/error.html.php';
	exit();
	}
	header('Location: .');
	exit();
}
if(isset($_GET['studioid'])){ //runs if the user clicks edit
try{
	//used for populating fields
	$sql = "SELECT StudioID, StudioName, ContactPerson, Phone FROM studio WHERE StudioID = :studioid";
	$s = $pdo->prepare($sql);
	$s->bindValue(":studioid", $_GET["studioid"]);
	$s->execute();

	while($row = $s->fetch())
    {
		$studios[] = array('name' => $row['StudioName'], 'contact' => $row['ContactPerson'], 'phone' => $row['Phone'], 'studioid' => $row['StudioID']);}

}catch(PDOException $e){
	$error = "Error editing record: " . $e->getMessage();
	include '../../includes/error.html.php';
	exit();
	}
    include "updatestudio.html.php";
	exit();
}
if(isset($_POST['updatedname'])){ //runs if the user clicks update

	$valid = true;
if(strlen($_POST["updatedphone"]) < 12){
		$valid = false;
		echo "<p>*Phone number must be 12 characters long in ###-###-#### format</p>";
	
}else if(!preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $_POST["updatedphone"])){
	$valid = false;
	echo "<p>*Phone number must be in ###-###-#### format</p>";}
if(is_numeric($_POST['updatedname'])){
	$valid = false;
	echo "<p>*Studio name cannot be a number</p>";
}
if(is_numeric($_POST['updatedcontact'])){
	$valid = false;
	echo "<p>*Contact person cannot be a number</p>";
}
	if($valid){
		try{
	$sql = 'UPDATE studio SET
	StudioName = :name,
	ContactPerson = :contact,
	Phone = :phone 
	WHERE StudioID=:studioid';

	$s = $pdo->prepare($sql);
	$s->bindValue(':studioid', $_POST['updatedstudioid']);
	$s->bindValue(':name', $_POST['updatedname']);
	$s->bindValue(':contact', $_POST['updatedcontact']);
	$s->bindValue(':phone', $_POST['updatedphone']);

	$s->execute();

}catch(PDOException $e){
	$error = "Error editing record: " . $e->getMessage();
	include '../../includes/error.html.php';
	exit();
}
}else{
	try{
	//used for populating fields
	$sql = "SELECT StudioID, StudioName, ContactPerson, Phone FROM studio WHERE StudioID = :studioid";
	$s = $pdo->prepare($sql);
	$s->bindValue(":studioid", $_POST["updatedstudioid"]);//pulls from post from the existing form now since get is no longer available
	$s->execute();

	while($row = $s->fetch())
    {
		$studios[] = array('name' => $row['StudioName'], 'contact' => $row['ContactPerson'], 'phone' => $row['Phone'], 'studioid' => $row['StudioID']);}

}catch(PDOException $e){
	$error = "Error editing record: " . $e->getMessage();
	include '../../includes/error.html.php';
	exit();
	}

}
}


try{
$sql = 'SELECT StudioName, ContactPerson, Phone, StudioID FROM studio'; // populates table
$result = $pdo->query($sql);
while($row=$result->fetch()){
	$studios[] = array('name' => $row['StudioName'], 'contact' => $row['ContactPerson'], 'phone' => $row['Phone'], 'studioid' => $row['StudioID']);}
	
}catch(PDOException $e){
	$error = "Error populating jokes: " . $e->getMessage();
	include '../../includes/error.html.php';
	exit();
}

include 'liststudios.html.php';
?>

