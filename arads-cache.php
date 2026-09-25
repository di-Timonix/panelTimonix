<?php

	/* 
	
		Timonix Arads
		system zarządzania serwisami timonix.pl
		di_Timonix
		
		opsługuje cache timonix.pl
	
	*/
	
	require_once("arads.php");
	
	if (isset($_POST["arads_cache"])) {
		global $error;
		
		$c = htmlentities($_POST["arads_cache"]["load"], ENT_QUOTES, "UTF-8");
			
			$out = null;
			
			if ($c == "time_zone") {
				require_once("laduj/time_zone.php");
				$out = $world_zones;
			}elseif ($c == "lang_time_zone") {
				require_once("laduj/time_zone.php");
				$out = $word_lang;
			}elseif ($c == "aplikacja") {
				require_once("laduj/aplikacja.php");
			}else if ($c == "stanowisko") {
				require_once("laduj/stanowisko.php");
			}else if ($c == "arads_us") {
				require_once("laduj/arads_us.php");
			}else if ($c == "zadania") {
				require_once("laduj/zadania.php");
			}else{
				echo json_encode(["type" => "cache/404", "message" => $error["cache"]["404"]]);
				exit();
			}
			
			if ($out == "404") {
				$out = ["type" => "cache/404", "message" => $error["cache"]["404"]];
			}elseif ($out == "perm_deney") {
				$out = ["type" => "cache/access_deney", "message" => $error["permission"]["warm_no_access"]];
			}
			
			echo json_encode($out);
			
	}else{
		echo json_encode(["type" => "cache/method", "message" => $error["cache"]["method"]]);
		exit();
	}

?>