<?php	
	/* 
	
		Timonix Arads
		system zarządzania serwisami timonix.pl
		di_Timonix
		
		zarządza strefą  czasową serwera
	
	*/
	
	$tym = $db->query2("SELECT *, `arads_zadania`.`id` AS 'idzad', `arads_aplikacja`.`id` as 'idap' FROM `arads_aplikacja` INNER JOIN `arads_zadania` ON `arads_aplikacja`.`id` = `arads_zadania`.`id_projektu` where `arads_zadania`.`osoby_pracuja` LIKE '%". $_SESSION["id"] ."%' OR  `arads_zadania`.`osoby_pracuja` LIKE '%". $_SESSION["id"] .",%' OR  `arads_zadania`.`osoby_pracuja` LIKE '%,". $_SESSION["id"] ."%' LIMIT 10;");
	
	if ($tym != false) {
		$out = [];
		
		for ($i = 0; $i < $tym["num_rows"]; $i++) {
			$check = $tym[$i];
			
			$check["zespol"] = $tym[$i]["zespol"];
			$check["pozwolenie"] = user_settings[0]["pozwolenie"];
			$check["user"] = $tym[$i]["user"];
			$check["team"] = $tym[$i]["osoby_pracuja"];
			$check["lang"] = $tym[$i]["lang"];
			$check["country"] = $tym[$i]["country"];
			$check["lvl"] = $tym[$i]["dostep_lvl"];
			$check["app"] = $tym[$i]["app"];
			$check["ranga"] = [$_SESSION["ranga"]];
			$check["flaga"] = [$_SESSION["flaga"]];
			
			if ($s = $user_permissions->check($check, null, "zadania", 2) == true) {
				unset($tym[$i]["dostep_lvl"]);
				unset($tym[$i]["id"]);
				array_push($out, $tym[$i]);
			}
		}
		
		if (count($out) == 0) {
			$out = "perm_deney";
		}else{
			$out = $out;
		}
	}else{
		$out = $error["sql"]["error_load"];
	}
	
?>