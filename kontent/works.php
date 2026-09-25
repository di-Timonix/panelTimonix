<?php

	/* 
	
		Timonix Arads
		system zarządzania serwisami timonix.pl
		di_Timonix
		
		Oczymywanie zadań do wykonania
	
	*/
	
	// ładowanie rdzenia arads
	require_once("arads.php");
	
	// $all_aplication = $db->query("SELECT * FROM `arads_aplikacja` WHERE `status_projekt` = 'wydany' OR 'public' or 'publiczny'");

	if (isset ($_GET["z"])) {
		$z = $_GET["z"];
		require_once("sub-kontent/work-job.php");
	}else{
		$z = "NaN";
		require_once("sub-kontent/work-all-form.php");		
		require_once("sub-kontent/work-all.php");
	}

?>

