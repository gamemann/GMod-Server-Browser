<?php
	$global = $_POST['global'];
	$gfl = $_POST['GFL'];
	$id = $_POST['resultid'];
	
	// Make Directory if non-existant.
	if (!file_exists('results/' . $id))
	{
		mkdir('results/' . $id);
	}
	
	$globalFile = fopen('results/' . $id . '/global.log', 'w+');
	
	if ($globalFile)
	{
		fwrite($globalFile, $global);
		
		fclose($globalFile);
	}
	
	$gflFile = fopen('results/' . $id . '/gfl.log', 'w+');
	
	if ($gflFile)
	{
		fwrite($gflFile, $gfl);
		
		fclose($gflFile);
	}
?>