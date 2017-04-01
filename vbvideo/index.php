<?php
//Hunter Glisson
include '../includes/killmagicquotes.php';
include '../includes/dbconnect.php';


//runs select to populate table
try{
$sql = 'SELECT Title, StudioName, Category, Length, MovieNumber FROM video, studio WHERE video.StudioID = studio.StudioID'; 
$result = $pdo->query($sql);
while($row=$result->fetch()){
	$videos[] = array('title' => $row['Title'], 'name' => $row['StudioName'], 'category' => $row['Category'], 'length' => $row['Length'], 'movienumber' => $row['MovieNumber']);}
	
}catch(PDOException $e){
	$error = "Error populating jokes: " . $e->getMessage();
	include '../../includes/error.html.php';
	exit();
}

include 'listvideos.html.php';
?>

