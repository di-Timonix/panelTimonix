<?php	
	/* 
	
		Timonix Arads
		system zarządzania serwisami timonix.pl
		di_Timonix
		
		zarządza strefą  czasową serwera
	
	*/
	
	$tym = $db->query("SELECT * FROM `arads_aplikacja`");
	
	if ($tym != false) {
		$out = [];
		
		for ($i = 0; $i < $tym["num_rows"]; $i++) {
			$check = $tym[$i];
			unset($tym[$i]["id"]);
			$check["zespol"] = $tym[$i]["osoby_pracuja"] ?? ($tym[$i]["zespol"] ?? 1);
			$check["pozwolenie"] = user_settings[0]["pozwolenie"] ?? 1;
			$check["user"] = $tym[$i]["user"] ?? [1];
			$check["lang"] = $tym[$i]["lang"] ?? ["pl"];
			$check["country"] = $tym[$i]["country"] ?? ["PL"];
			$check["lvl"] = $tym[$i]["dostep_lvl"] ?? 5;
			$check["app"] = $tym[$i]["app"] ?? ["all"];
			$check["ranga"] = [$_SESSION["ranga"] ?? "właśćiciel"];
			$check["flaga"] = [$_SESSION["flaga"] ?? 30];
			
			if ($s = $user_permissions->check($check, null, "zadania", 2) == true) {
				unset($tym[$i]["dostep_lvl"]);
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