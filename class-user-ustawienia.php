<?php

	/* 
	
		Timonix Arads
		system zarządzania serwisami timonix.pl
		di_Timonix
		
		wszystkie ustawienia użytkownika timonix.pl
	
	*/

	class arads_user_settings {
		
		protected $settings = [];
		
		public function __construct () {
			global $db;
			
			$userId = $_SESSION['id'] ?? 1;
			$settings = $db->query("SELECT * FROM `arads_uzytkownicy` WHERE `id_uzytkownika` = " . $userId);
			
			if ($settings != false && isset($settings["num_rows"]) && $settings["num_rows"] > 0) {
				$this->settings = $settings;
			} else {
				// Domyślne ustawienia użytkownika dla trybu testowego (gdy brak rekordu w tabeli arads_uzytkownicy)
				$this->settings = [
					"num_rows" => 1,
					0 => [
						"id" => 1,
						"id_uzytkownika" => $userId,
						"identyfikator" => "TEST01",
						"pin" => "0",
						"szef" => "pl",
						"poziom" => 5,
						"zespol" => 1,
						"pozwolenie" => 1,
						"lang" => json_encode(["pl"]),
						"country" => json_encode(["PL"]),
						"app" => json_encode(["all"]),
						"user" => [1],
						"team" => [1],
						"t" => "all",
						"zalogowany" => "true",
						"datetime_zalogowany" => date('Y-m-d H:i:s'),
						"datetime_dolonczenia" => date('Y-m-d H:i:s')
					]
				];
			}
		}
		
		public function check () {
			if (isset($this->settings["num_rows"]) && ($this->settings["num_rows"] >= 1) && ($this->settings != false)) {
				return true;
			}else{
				return false;
			}
		}
		
		public function add_settings () {
			if (arads_user_settings::check() == false) {
				global $db;
				
				$date = date('Y-m-d H:i:s');
				
				// identyfikator (wzór)
				// { pierwszy znak roku, pierwszy znak miesiąca, drugi znak roku, 2 znak miesiąca, 3 znak roku, 1 znak dnia, 4 znak roku, 2 znak dnia, 1 znak dodatkowy (od a do x), 2 znak dodatkowy (od a do x) }
				$data = explode (' ' , $date);
				$data = explode ('-' , $data[0]);
				
				// (A, Z, a, z)
				$UTF_8 = [65, 90, 97, 122];
				
				$ile_ids = $db->query2("SELECT `id` FROM `arads_uzytkownicy` WHERE `identyfikator` LIKE '%". $ids ."%'");
				
				if ($ile_ids["num_row"] != 0) {
					$ile_ids["num_row"]--;
					
					$ids_save = 0;
					
					if ( ($UTF_8[0] + $ile_ids["num_row"] >= $UTF_8[0]) && ($UTF_8[0] + $ile_ids["num_row"] <= $UTF_8[1]) ) {
						$ids_save = chr($UTF_8[0] + $ile_ids["num_row"]);
					}else{
						$ids_save++;
						$ile_ids["num_row"] = $ile_ids["num_row"] - 26;
					}
					
					if ($ids_save == 1) {	
						if ( ($UTF_8[0] + $ile_ids["num_row"] >= $UTF_8[0]) && ($UTF_8[0] + $ile_ids["num_row"] <= $UTF_8[1]) ) {
							$ids_save = "Z".chr($UTF_8[0] + $ile_ids["num_row"]);
						}else{
							$ids_save++;
							$ile_ids["num_row"] = $ile_ids["num_row"] - 26;
						}
					}
					
					if ($ids_save == 2) {											
						if ( ($UTF_8[2] + $ile_ids["num_row"] >= $UTF_8[2]) && ($UTF_8[2] + $ile_ids["num_row"] <= $UTF_8[3]) ) {
							$ids_save = chr($UTF_8[2] + $ile_ids["num_row"]);
						}else{
							$ids_save++;
							$ile_ids["num_row"] = $ile_ids["num_row"] - 26;
						}
					}
					
					if ($ids_save == 3) {
						if ( ($UTF_8[2] + $ile_ids["num_row"] >= $UTF_8[2]) && ($UTF_8[2] + $ile_ids["num_row"] <= $UTF_8[3]) ) {
							$ids_save = "z".chr($UTF_8[2] + $ile_ids["num_row"]);
						}else{
							echo "ERROR: AUTO_INS_US";
							exit();
						}
					}
				
				}else{
					$ids_save = '';
				}
				
				$ids = $data[0][0].$data[1][0].$data[0][1].$data[1][1].$data[0][2].$data[2][0].$data[0][3].$data[2][1].$ids_save;
				
				$zapytanie = $db->insert("INSERT INTO `arads_uzytkownicy` (`id`, `id_uzytkownika`, `identyfikator`, `pin`, `szef`, `poziom`, `zespol`, `pozwolenie`, `lang`, `country`, `app`, `zalogowany`, `datetime_zalogowany`, `datetime_dolonczenia`) VALUES (NULL, '". $_SESSION['id'] ."', '". $ids ."', '0', 'pl', 'PL', '1', 'true', '". $date ."', '". $date ."')");
				
				if ($zapytanie == true) {
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
		
		public function settings () {
			return $this->settings;
		}
		
		public function update_online () {
			$datetime = date('Y-m-d H:i:s');
			$date = date('Y-m-d');
			$time = date('H:i:s');
			
			global $db;
			
			require_once ("laduj/date-format.php");
			
			$time1 = (strtotime($time) - 600);
			$time2 = strtotime(data_format($this->settings[0]["datetime_zalogowany"], "H:i:s"));
			
			$date2 = data_format($this->settings[0]["datetime_zalogowany"], "Y-m-d");
			
			if ($this->settings[0]["zalogowany"] == "true") {
				
				if ($date == $date2) {
					if ($time1 >= $time2){
					
						$settings = $db->update("UPDATE `arads_uzytkownicy` SET `zalogowany`='false' WHERE `id_uzytkownika` = '". $_SESSION['id'] ."'");
						
						if ($settings == false) {
							
						}
						
						return false;
					}else{
						$settings = $db->update("UPDATE `arads_uzytkownicy` SET `zalogowany`='true',`datetime_zalogowany`='". $datetime ."' WHERE `id_uzytkownika` = '". $_SESSION['id'] ."'");
						return true;
					}
				}else{
					$settings = $db->update("UPDATE `arads_uzytkownicy` SET `zalogowany`='true',`datetime_zalogowany`='". $datetime ."' WHERE `id_uzytkownika` = '". $_SESSION['id'] ."'");
					return true;
				}
			
			}else{
				$settings = $db->update("UPDATE `arads_uzytkownicy` SET `zalogowany`='true',`datetime_zalogowany`='". $datetime ."' WHERE `id_uzytkownika` = '". $_SESSION['id'] ."'");
				return false;
			}
		}
		
	}

?>