<?php

	/* 
	
		Timonix Arads
		system zarządzania serwisami timonix.pl
		di_Timonix
		
		Aktulizowanie statusu pracy
	
	*/
	
	// ładowanie rdzenia arads
	require_once("../../arads.php");
	ini_set('display_errors', 1);
	error_reporting (E_ALL | E_STRICT);
	
	$ed = [
			"type" => "status/404",
			"message" => $error["data"]["error_data_send"]
		];
	
	if (isset($_POST["job_status"])) {
		$t = trim(htmlentities($_POST["job_status"], ENT_QUOTES, "UTF-8"));
		
		if ($t == "zakończ_prace") {
			$c = "zakończona";
		}elseif ($t == "zacznij_prace") {
			$c = "pracuje";
		}elseif ($t == "zrezygnuj_zpracy") {
			$c = "przerwano";
		}else{
			$ed["message"] = $error["data"]["error_data"];
			echo json_encode($ed);			
			exit();
		}
		
		$wyn = $db->query("SELECT `status_pracownika` FROM `arads_pracownicy` WHERE `id_uzytkownika` = ". $_SESSION['id'] );
		
		if (!$wyn) {
			$ed["message"] = $error["sql"]["error_load"];
			echo json_encode($ed);	
			exit();
		}
		
		if ($wyn[0]["status_pracownika"] == $c) {
			$ed["type"] = "status/202";
			$ed["message"] = $error["data"]["info_data_same"];
			echo json_encode($ed);	
			exit();
		}
		
		$sp = false;
		
		if ($c == "zakończona" && $wyn[0]["status_pracownika"] == "pracuje") {
			$sp = true;
		}elseif ($c == "przerwano" && $wyn[0]["status_pracownika"] == "pracuje") {
			$sp = true;
		}elseif ($c == "pracuje" && $wyn[0]["status_pracownika"] == "zakończona") {
			$sp = true;
		}elseif ($c == "pracuje" && $wyn[0]["status_pracownika"] == "przerwano") {
			$sp = true;
		}
		
		if ($sp === true) {
		   $agent = $_SERVER['HTTP_USER_AGENT'];

			function getOS() { 

				$os_platform  = "Unknown OS Platform";

				$os_array     = array(
									  '/windows nt 11/i'      =>  'Windows 11',
									  '/windows nt 10/i'      =>  'Windows 10',
									  '/windows nt 6.3/i'     =>  'Windows 8.1',
									  '/windows nt 6.2/i'     =>  'Windows 8',
									  '/windows nt 6.1/i'     =>  'Windows 7',
									  '/windows nt 6.0/i'     =>  'Windows Vista',
									  '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
									  '/windows nt 5.1/i'     =>  'Windows XP',
									  '/windows xp/i'         =>  'Windows XP',
									  '/windows nt 5.0/i'     =>  'Windows 2000',
									  '/windows me/i'         =>  'Windows ME',
									  '/win98/i'              =>  'Windows 98',
									  '/win95/i'              =>  'Windows 95',
									  '/win16/i'              =>  'Windows 3.11',
									  '/macintosh|mac os x/i' =>  'Mac OS X',
									  '/mac_powerpc/i'        =>  'Mac OS 9',
									  '/linux/i'              =>  'Linux',
									  '/ubuntu/i'             =>  'Ubuntu',
									  '/iphone/i'             =>  'iPhone',
									  '/ipod/i'               =>  'iPod',
									  '/ipad/i'               =>  'iPad',
									  '/android/i'            =>  'Android',
									  '/blackberry/i'         =>  'BlackBerry',
									  '/webos/i'              =>  'Mobile'
								);

				foreach ($os_array as $regex => $value)
					if (preg_match($regex, $_SERVER['HTTP_USER_AGENT']))
						$os_platform = $value;

				return $os_platform;
			}

			function getBrowser() {

				$browser        = "Unknown Browser";

				$browser_array = array(
										'/msie/i'      => 'Internet Explorer',
										'/firefox/i'   => 'Firefox',
										'/safari/i'    => 'Safari',
										'/chrome/i'    => 'Chrome',
										'/edge/i'      => 'Edge',
										'/opera/i'     => 'Opera',
										'/opera_gx/i'  => 'Opera GX',
										'/netscape/i'  => 'Netscape',
										'/maxthon/i'   => 'Maxthon',
										'/konqueror/i' => 'Konqueror',
										'/mobile/i'    => 'Handheld Browser'
								 );

				foreach ($browser_array as $regex => $value)
					if (preg_match($regex, $_SERVER['HTTP_USER_AGENT']))
						$browser = $value;

				return $browser;
			}
			
			$date = date('Y-m-d H:i:s');
			
			if($db -> insert("INSERT INTO `arads_historia_pracy`(`id`, `id_uzytkownika`, `stanowisko`, `id_urządzenia`, `ip_urządzenia`, `lokalizacja`, `typ_urządzenia`, `system_urządzenia`, `typ_akcji`, `operator`, `useragent`, `opis`, `datetime`) VALUES (NULL, '". $_SESSION["id"] ."','". $_SESSION["ranga"] ."','undefined','". $_SERVER['REMOTE_ADDR'] ."','". json_encode($_POST["pos"]) ."','". getBrowser() ."','". getOS() ."','". $c ."','". gethostbyaddr($_SERVER['REMOTE_ADDR']) ."','". $agent ."','". $_POST["job_status"] ."','". $date ."')")) {
				if($db -> update("UPDATE `arads_pracownicy` SET `status_pracownika` = '". $c ."' WHERE `id_uzytkownika` = ". $_SESSION['id'])) {
					$ed["type"] = "status/200";
					$ed["message"] = $error["data"]["success_data"];
					echo json_encode($ed);			
					exit();
				}else{
					$ed["type"] = "status/401";
					$ed["message"] = $error["data"]["error_db_update"];
					echo json_encode($ed);	
					exit();
				}	
			}else{
				$ed["type"] = "status/401";
				$ed["message"] = $error["data"]["error_db_update"];
				echo json_encode($ed);	
				exit();
			}	
			
		}else{
			$ed["type"] = "status/202";
			$ed["message"] = $error["data"]["error_data_parse"];
			echo json_encode($ed);	
			exit();
		}
		
	}else{
		$ed["message"] = $error["data"]["error_data_send"];
		echo json_encode($ed);			
		exit();
	}

?>

