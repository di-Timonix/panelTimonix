<?php	
	/* 
	
		Timonix Arads
		system zarządzania serwisami timonix.pl
		di_Timonix
		
		pobiera stanowisko pracownika
	
	*/
	
	$tym = $db->query("SELECT * FROM `arads_pracownicy` WHERE `id_uzytkownika` = " . $_SESSION["id"] . " LIMIT 1 ");
	
	if ($tym != false) {
		$out = [];
		
		for ($i = 0; $i < $tym["num_rows"]; $i++) {
			if ($s = $user_permissions->check(null, null, "user_data", 2) == true) {
				unset($tym[$i]["pensja"]);
				unset($tym[$i]["id"]);
				unset($tym[$i]["id_uzytkownika"]);
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