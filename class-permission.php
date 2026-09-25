<?php

	/* 
	
		Timonix Arads
		system zarządzania serwisami timonix.pl
		di_Timonix
		
		wszystkie permisie użytkownika timonix.pl
	
	*/

	class arads_user_permissions {
		
		// ostatnie sprawdzana permisja
		protected $permissions = [];
		
		// podstawowa konfiguracja timonix (dostęp dla zarządu)
		protected $timonix = [
				"t" => "cztplt",
				"lvl" => 45,
				"flaga" => 30,
				"lang" => ["pl"],
				"country" => ["PL"],
				"pozwolenie" => 11,
				"dostep_app" => ["all"],
				"ranga" => [
							"właśćiciel",
							"administrator",
							"ndst"
						],
				"dostep" => "dostęp",
				"online" => "online",
				"zalogowany" => "true"
			];
			
		// podstawowa konfiguracja ustawień arads
		protected $permissions_default = [
				"t" => "all",
				"lvl" => 5,
				"flaga" => 3,
				"lang" => ["pl"],
				"country" => ["PL"],
				"pozwolenie" => 1,
				"dostep_app" => ["all"],
				"ranga" => [
							"all"
						],
				"dostep" => "dostęp",
				"online" => "online",
				"zalogowany" => "true"
			];
			
		// ostatni błąd 	
		private $error = null;
		
		// zamienianie nazw słownych na liczby
		protected $dostep_app_zamien = [
					"all" => 1,
					"cztplt" => 5,
					"ndst" => 10,
					"tndst" => 11
				];
				
		protected $word = [
				"PL" => "poland"
			];
				
		
		public function __construct () {
			global $db;		
		}
		
		// dane do sprawdzenia, dane kontrolen, poziom kontroli permissi
		public function check ($check, $source = null, $txt = "panel", $p = 1) {
			
			if ($check == null){
				$check = user_settings[0];
				$check["zespol"] = user_settings[0]["zespol"] ?? 1;
				$check["pozwolenie"] = user_settings[0]["pozwolenie"] ?? 1;
				$check["user"] = user_settings[0]["user"] ?? [1];
				$check["team"] = user_settings[0]["team"] ?? [1];
				$check["lang"] = user_settings[0]["lang"];
				$check["country"] = user_settings[0]["country"];
				$check["lvl"] = user_settings[0]["poziom"];
				$check["app"] = user_settings[0]["app"];
				$check["ranga"] = [$_SESSION["ranga"]];
				$check["flaga"] = [$_SESSION["flaga"]];
			}
			
			if($source == null) {
				$source = $this->permissions_default;
			}
			
			if ($p < 1 && $p > 10){
				
				$this->error = "error_check_level";
				
				return false;
				exit();
			}else{
				
				// sprawdzanie danych
				// $ile_source = count($source);
				// $ile_check = count($check);
				
				$checksum = 0;
				$t = false;
				$lvl = false;
				$flaga = false;
				$lang = false;
				$country = false;
				$pozwolenie = false;
				$dostep_app = false;
				$ranga = false;
				$dostep = false;
				$online = false;
				$zalogowany = false;
				
				// var_dump($check);
				// var_dump($check["t"]);
				// var_dump($source["t"]);
				// var_dump(array_search($check["t"],$source["t"]));
				// if ($p == 1) {
					// for ($i_source = 0; $i_source < $ile_source; $i_source++) {
						if (isset($check["t"]) && isset($source["t"])) {
							/* var_dump($check["t"]);
							var_dump( 
								array_map(
									function($t){
										echo $t[0];
										//return array_key_exists($check["ranga"][0], $this->dostep_zamien);
									
									}, $check["t"]) 
							); */
							
							if ($check["t"]  == $source["t"]) {
								$checksum++;
								$t = true;
							}
						}
						
						if (isset($check["lvl"]) && isset($source["lvl"])) {
							if ($source["lvl"] >= $check["lvl"]) {
								$checksum++;
								$lvl = true;
							}
						}
						
						if (isset($check["flaga"]) && isset($source["flaga"])) {
							if ($source["flaga"] >= $check["flaga"]) {
								$checksum++;
							}
						}
						
						if (isset($check["lang"]) && isset($source["lang"])) {
							if(is_array($check["lang"]) == false) {
								$check["lang"] = json_decode($check["lang"], true);
								$ile = count($check["lang"]);
							}else{
								$ile = 0;
							}
							if(is_array($source["lang"]) == false) {
								$source["lang"] = json_decode($source["lang"], true);
							}
							
							for ($i = 0; $i < $ile; $i++) {
								if (array_search($check["lang"][$i], $source["lang"]) !== false) {
									$checksum++;
									$lang = true;
								}
							}
						}
						
						if (isset($check["country"]) && isset($source["country"])) {
							if(is_array($check["country"]) == false) {
								$check["country"] = json_decode($check["country"], true);
							}
							if(is_array($source["country"]) == false) {
								$source["country"] = json_decode($source["country"], true);
							}							
							$ile = count($check["country"]);
							
							for ($i = 0; $i < $ile; $i++) {
								if (array_search($check["country"][$i], $source["country"]) !== false) {
									$checksum++;
									$country = true;
								};
							}
						}
						
						if (isset($check["pozwolenie"]) && isset($source["pozwolenie"])) {
							if ($check["pozwolenie"] >= $source["pozwolenie"]) {
								$checksum++;
								$pozwolenie = true;
							}
						}
						
						if (isset($check["dostep_app"]) && isset($source["dostep_app"])) {
							if ($check["dostep_app"] >= $source["dostep_app"]) {
								$checksum++;
								$dostep_app = true;
							}
						}
						
						if (isset($check["ranga"]) && isset($source["ranga"])) {
							$ile = count($check["ranga"]);
							
							$ranga_check = [
								"użytkownik",
								"redaktor",
								"moderator",
								"współpracownik",
								"administrator",
								"właśćiciel"
							];
							
							for ($i = 0; $i < $ile; $i++) {
								if (array_search("all", $source["ranga"]) !== false) {
									$checksum++;
									$ranga = true;
								}else{
									if (array_search($check["ranga"][$i], $source["ranga"]) !== false) {
										$checksum++;
										$ranga = true;
									}
								}
							}
						}
						
						if (isset($_SESSION["dostep"])) {
							if ($_SESSION["dostep"] == "dostęp") {
								$checksum++;
								$dostep = true;
							}
						}
						
						if (isset($_SESSION["online"])) {
							if ($_SESSION["online"] == "online") {
								$checksum++;
								$online = true;
							}
						}
						
						if (isset(user_settings[0]["zalogowany"])) {
							if (user_settings[0]["zalogowany"] == "true") {
								$checksum++;
								$zalogowany = true;
							}
						}
					// }
				// }
				
				
				// var_dump($checksum,
					// $t,
					// $lvl,
					// $flaga,
					// $lang,
					// $country,
					// $pozwolenie,
					// $ranga,
					// $dostep,
					// $online,
					// $zalogowany);
				
				// określa status dostępu do panelu
				$status = false;
				
				/* if ($checksum == 0) {
					$status = false;
				}elseif ($checksum == 1) {
					if ($p == 1) {
						var_dump("<br  /><br  /><br  /><br  />", $lang , $country , $dostep , $online , $zalogowany, $pozwolenie ,"<br  /><br  /><br  /><br  />");
						if ($lang && $country && $dostep && $online && $zalogowany && $pozwolenie) {
							$status = true;
						}else{
							$status = false;
						}
					}else{
						$status = false;
					}
				}elseif ($checksum == 2) {
					if ($p == 2) {
						if ($lang && $country && $dostep && $online && $zalogowany && $pozwolenie) {
							$status = true;
						}else{
							$status = false;
						}
					}else{
						$status = false;
					}
				}else{
					// http_response_code(400);
					// exit();
				} */
				
				if ($txt === "panel" OR $txt === "user_data" OR $txt === "arads_us") {
					if ($checksum >= $p) {
						// var_dump("<br  /><br  /><br  /><br  />", $lang , $country , $dostep , $online , $zalogowany, $pozwolenie ,"<br  /><br  /><br  /><br  />");
						if ($lang && $country && $dostep && $online && $zalogowany && $pozwolenie) {
							$status = true;
						}else{
							$status = false;
						}
					}else{
						$status = false;
					}//var_dump("Timonix2");
				}elseif ($txt === "aplikacja" OR $txt === "zadania") {
					if ($checksum >= $p) {
						// var_dump("<br  /><br  /><br  /><br  />", $lang , $country , $dostep , $online , $zalogowany, $pozwolenie ,"<br  /><br  /><br  /><br  />");
						if ($lang && $country && $dostep && $online && $zalogowany && $pozwolenie && $lvl) {
							$status = true;
						}else{
							$status = false;
						}
					}else{
						$status = false;
					}//var_dump("Timonix");
				}else{
					$this->error = "error_data";
				
					return false;
					exit();
				}
				
				// var_dump($status);
				return $status;
			
			}
		}
		
		public function error () {
			return $this->error;
		}
		
		public function access () {
			return true;
		}
		
	}

?>