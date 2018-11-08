<?php
	ini_set('display_errors',1);
	ini_set('display_startup_erros',1);
	error_reporting(E_ALL);

	include('connection.php');

	$filter = '';
	$json   = file_get_contents('php://input');
	$result = json_decode($json);	
	if ($result && $result->id > 0)
	{
		$filter = " WHERE id > {$result->id}";
	}

	while(true)
	{
		$sql = "SELECT * FROM messages{$filter} ORDER BY id ASC";
		$rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);				
		if (count($rows) > 0)
		{
			echo json_encode($rows);
			break;
		}
		else 
		{
			sleep(3);
			continue;
		}
	}