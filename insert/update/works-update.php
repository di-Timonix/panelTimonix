<?php

	/* 
	
		Timonix Arads
		system zarządzania serwisami timonix.pl
		di_Timonix
		
		Aktulizowanie statusu zadań
	
	*/
	
	// ładowanie rdzenia arads
	require_once("../../arads.php");
	ini_set('display_errors', 1);
	error_reporting (E_ALL | E_STRICT);

	if (isset ($_POST["akcja"])) {
		$z = htmlentities($_POST["akcja"], ENT_QUOTES, "UTF-8");
		$data = json_decode($_POST["data"], true);
		
		$ile = count($data);
		
		if ($ile == 0) {
			echo json_encode('<div class="tsr tsr-alert tsr-alert-error">'. $error["data"]["error_data_is_empty"] .'</div>');
			exit();
		}
		
		// sprawdzanie poprawnośći typu danych
		for ($i = 0; $i < $ile; $i++) {
			if (is_int(intval($data[$i]["id"])) === false) {
				echo json_encode('<div class="tsr tsr-alert tsr-alert-warning">'. $error["data"]["error_data"]) .'</div>';
				exit();
			}
		}
		
		if ($z == "do_sprawdzenia"){
			if ($db->update("UPDATE `arads_zadania` SET `status` = 'do_sprawdzenia' WHERE `arads_zadania`.`id` in (".$db->super_unique($data, "id", true).");")) {
				echo json_encode('<div class="tsr tsr-alert tsr-alert-success">'. $error["data"]["success_data"] .'</div>');
			}else{
				echo json_encode('<div class="tsr tsr-alert tsr-alert-error">'. $error["data"]["error_db_update"] .'</div>');
			}
		}elseif ($z == "wykonywane"){
			// sprawdzanie czy dane są poprawne
			for ($i = 0; $i < $ile; $i++) {
				$check_aplication = $db->query("SELECT * FROM `arads_zadania` WHERE `id` = ". htmlentities($data[$i]["id"], ENT_QUOTES, "UTF-8") );
				
				if ($check_aplication[0]["status"] != "wykonywane") {
					$sp = explode ("," ,$check_aplication[0]["osoby_pracuja"]);
				
					if(array_search($_SESSION['id'], $sp) != false){
						if (count($sp) != 0) {
							$user = $check_aplication[0]["osoby_pracuja"]. "," . $_SESSION['id'];
						}else{
							$user = $_SESSION['id'];
						}
					}
				}else{
					unset ($data[$i]);
				}
				
			}
			
			if (count($data) != 0) {
				if ($db->update("UPDATE `arads_zadania` SET `status` = 'wykonywane' WHERE `arads_zadania`.`id` in (".$db->super_unique($data, "id", true).");")) {
					echo json_encode('<div class="tsr tsr-alert tsr-alert-success">'. $error["data"]["success_data"] .'</div>');
				}else{
					echo json_encode('<div class="tsr tsr-alert tsr-alert-error">'. $error["data"]["error_db_update"] .'</div>');
				}
			}else{
				echo json_encode('<div class="tsr tsr-alert tsr-alert-info">'. $error["data"]["info_data_same"] .'</div>');
			}
		}else{
			echo json_encode('<div class="tsr tsr-alert tsr-alert-warning">'. $error["data"]["error_data"] .'</div>');
		}
		
	}else{
		echo json_encode('<div class="tsr tsr-alert tsr-alert-error">'.$error["data"]["error_data_send"] .'</div>');
	}

?>

