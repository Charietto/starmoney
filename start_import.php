<?php
/*
error_reporting(E_ALL);
ini_set('display_errors', 1);
*/
if($_FILES['csv'] != '') {
	
	require_once 'import.class.php';
	
	$daten_import = new Import();
	
	$daten_import->readImportData($_FILES['csv']['tmp_name']);
	
	//$daten_import->printImportData();
	
	$daten_import->generateStarMoneyFormat('StarMoney9_Adr.txt',$_FILES['csv']['name']);

} else {
	echo '<form method="post" enctype="multipart/form-data">';
	echo '<input name="csv" type="file" size="50" maxlength="100000">';
	echo '<input type="submit" name="umwandeln" value="umwandeln">';
	echo '</form>';
}
?>