<?php
	function utf8ize($d) 
	{
		if (is_array($d)) 
		{
			foreach ($d as $k => $v) 
			{
				$d[$k] = utf8ize($v);
			}
		} 
		else if (is_string ($d)) 
		{
			return utf8_encode($d);
		}
		
		return $d;
	}
	
	echo '<form action="viewstuff.php" method="GET">';
		echo 'ID - <input type="text" name="id" value="' . (isset($_GET['id']) ? $_GET['id'] : '') . '" /><br />';
		echo 'Type - <input type="text" name="type" value="' . (isset($_GET['type']) ? $_GET['type'] : '') . '" /><br /><br />';
		echo '<input type="submit" value="Go!" />';
	echo '</form>';
	
	$id = $_GET['id'];
	$type = $_GET['type'];
	
	if ($type == 1)
	{
		$fileName = 'results/' . $id . '/global.log';
	}
	else
	{
		$fileName = 'results/' . $id . '/gfl.log';
	}
	
	$file = fopen($fileName, 'r+');
	
	if ($file)
	{
		$data = fread($file, filesize($fileName));
		
		fclose($file);
	}
	
	$temp = utf8ize($data);
	$temp = html_entity_decode($temp);
	$stuffz = json_decode($temp, true);

	if ($type == 1)
	{
		echo '<ul>';
			echo '<li>Start Time - ' . $stuffz['StartTime'] . '</li>';
			echo '<li>End Time - ' . $stuffz['EndTime'] . '</li>';
			echo '<li>Total Time - ' . $stuffz['TotalTime'] . '</li>';
			echo '<li>Server Count - ' . $stuffz['ServerCount'] . '</li>';
		echo '</ul>';
	}
	
	echo 'Servers:';
	echo '<ol>';
		foreach($stuffz["servers"] as $server)
		{	
			echo '<li>' . $server["data"]["name"] . '</li>';
		}
	echo '</ol>';
?>