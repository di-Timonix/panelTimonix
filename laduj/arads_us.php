<?php	
	/* 
	
		Timonix Arads
		system zarządzania serwisami timonix.pl
		di_Timonix
		
		pobiera dane o pracowniku arads wszystkie uprawnienia i dane
	
	*/
	
	$tym = user_settings;
	
	if ($tym != false) {
		$out = [];
		
		for ($i = 0; $i < $tym["num_rows"]; $i++) {
			if ($s = $user_permissions->check(null, null, "arads_us", 2) == true) {
				unset($tym[$i]["poziom"]);
				unset($tym[$i]["id"]);
				unset($tym[$i]["id_uzytkownika"]);
				unset($tym[$i]["pozwolenie"]);
				unset($tym[$i]["pin"]);
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