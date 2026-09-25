<?php

	/* 
	
		Timonix Arads
		system zarządzania serwisami timonix.pl
		di_Timonix
		
		główne jądro aplikacji
	
	*/

	header("X-Frame-Options: SAMEORIGIN", true);
	header("server: timonixx", true);
	header("Server: timonixx", true);
	header("Server: tsr-framework", true);
	header("x-Server: tsr-framework", true);
	header("x-powered-by: tsr-framework/1.0.8", true);
	header("Remote-Ip: 44.44.44.44", true);
	header("Referrer-Policy: origin, strict-origin", true);
	header("Cross-Origin-Opener-Policy: same-origin", true);
	header("otherbot: noindex, nofollow", true);
	header("X-Robots-Tag: noindex, nofollow", true);	
	// header("Cache-Control: private, max-age=86400, stale-if-error=7200, max-stale=3600");
	header("Cache-Control: no-cache, max-age=86400, stale-if-error=7200, max-stale=3600", true);
	// header("Cache-Control: no-cache", true); // HTTP 1.1.
	header("Pragma: no-cache", true); // HTTP 1.0.
	// header("Expires: 86400", true); // Proxies.
	//header("Cache-Control: private, max-age=86400, stale-if-error=7200, max-stale=3600, no-cache", true);
	header("Range: bytes=200-1000, 2000-6576, 19000-", true);
	header("cache-control: max-age=86400");
	header_remove("server"); 	
	header_remove("Server"); 	

	// ładowanie pliku konfuguracyjnego z bazą danych
	require_once ("connect.php");
	// ładowanie klasy zarządzającej połączeniami z dba_close
	require_once ("class-db.php");
	// iniciowanie klasy łączącej db
	$db = new db();
	// ładowanie s-sm
	// zarządzanie sessiami
	require_once ("t-sm.php");
			
	if (isset($_SESSION['flaga']) && $_SESSION['flaga'] <= 5) {
		// header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
		http_response_code(504);
		exit();
	}	
	
	// ładowanie klasy zarządzającej url_domain
	require_once ("class-get-url.php");
	$url = new url ();
	define ("url", $url->get_url());
	// ładowanie klasy odpowiedzialnej za ustawienia użytkownika do panelu arads
	require_once ("class-user-ustawienia.php");
	// sprawdzanie czy użytkownik ma ustawienia
	$user_settings = new arads_user_settings();
	// sprawdzanie czy użytkownik ma config
	if($user_settings->check() == false) {
		$user_settings->add_settings();
	}else{
		define("user_settings", $user_settings->settings());
		$online =  $user_settings->update_online();
		
		if ($online == false) {
			header ("Location: " . url);
			exit();
		}
	}
	// ładowanie pozwoleń użytkownika
	require_once ("class-permission.php");
	// sprawdzanie czy użytkownik ma odpowiednie pozwolenie
	$user_permissions = new arads_user_permissions();
	//$user_permissions->check();
	// var_dump($user_permissions->check(null));
	// var_dump($user_permissions->error());
		
	if ($user_permissions->error() != null) {
		echo $user_permissions->error();
	}else{
		if ($user_permissions->check(null) === false) {
			http_response_code(401);
			exit();
		}
	}
	
	$as = [
		"user" => [1, 2, 3, 4],
		"team" => [1],
		"lang" => ["pl"],
		"country" => ["poland"],
		"lvl" => 5
	];
	
	//echo(htmlentities(json_encode($as)));
	//var_dump ($as, json_encode($as));
	
	
	$as = [
		"projekt" => ["lvl" => 1, ""],
		"lvl" => 5
	];
	
	//var_dump ($as, json_encode($as));
	
	//echo json_encode($as);
	
	// ładowanie pliku który adpowiada za ładowanie inncyh plików i zarządzanie nimi
	require_once ("tarla.php");
	
	// iniciowanie klasy url
	$url = new url();
	// sprawdzanie url i przekierowanie na ssl (wyłączone dla lokalnego testowania na localhost/http)
	// $url->check_ssl(true);

	if (isset($_SESSION['zalogowany']) && $_SESSION['zalogowany'] != true) {
		header ("Location: https://konto.timonix.pl/?wpt=timonix_app_c_manifest&st=timonix_login&r=false&adder=sdf654gs65dt4h6ws4t6hw6srth6w46th4w65rt4h65w4r65th4w65rt46wr4t6w5r4h968w4rt&adder_eeeprom=sdf654gae56r4g5awer46h461rt65he4rt6he6rt416h41r6t41e65t1r465he465th46e5j5e4t6yje4ty6j41e6t5yj4e65tyh4w65rt46wr4t6w5r4h968w4rt&arg=ssh_ddo_pd&v_nert=6e5r4g65e4r6g465g41ws6tr49q64er94wrt94ety9ulk4r698yu464tr6j4t6yk46y4646ttttttt1244444t66df514sd65r4y6saeddd&wpt=timonix_app_c_manifest&connect=https://arads.timonix.pl/",TRUE,303);
		exit();
	}
	
	if (!defined("APATH")) {
		define("APATH", dirname( __FILE__ ) . '/' );
	}
	
	// ładowanie pliku z błędami
	require_once (APATH . "blad.php");
	// inicowanie klasy ładującej pliki
	$laduj = new tarla();


	
	
	/* $hosts = gethostbynamel('www.techland.net');
print_r($hosts); */



/* timonix


ZXlKcFpDSTZJakVpTENKdWFXTnJJam9pVkdsdGIyNXBlQ0lzSW1sdGFXVWlPaUpVYjIxaGMzb2lMQ0p1WVhwM2FYTnJieUk2SWtOb2IzSjZYSFV3TVRFNWNHRWlMQ0psYldGcGJDSTZJblJ2YldrME16WkFhVzUwWlhKcFlTNXdiQ0lzSW5SbGJHVm1iMjRpT2lJd0lpd2ljR3hsWXlJNklrMWNkVEF4TVRsY2RUQXhOMk5qZW5sNmJtRWlMQ0pyY21GcUlqb2lVRXdpTENKcVpYcDVheUk2SW5Cc0lpd2lZWFpoZEdGeUlqb2lhSFIwY0hNNlhDOWNMMnR2Ym5SdkxuUnBiVzl1YVhndWNHeGNMMXd2Y0d4cGEybGNMMkYzWVhSaGNsd3ZZWFpoZEdGeVgzUkxiMjUwYnk1d2JtY2lMQ0owYjJ0bGJpSTZJaVF5ZVNReE1DUnJhV0phUlc4M1pVSTFRbTlYUXpFNVRrMUdjMk4xVTBkSFpIVkdURTl3VlVsV2N6QTBRVFppTjAwMGN6Sm1WMGhzWTB4WWRpSXNJbVJ2YzNSbGNDSTZJbVJ2YzNSY2RUQXhNVGx3SWl3aWNtRnVaMkVpT2lKM1hIVXdNVFF5WVZ4MU1ERTFZbHgxTURFd04ybGphV1ZzSWl3aVpteGhaMkVpT2lJek1DSXNJbTl1YkdsdVpTSTZJbTl1YkdsdVpTSXNJbVJoZEdWZlpHOXNiMjVqZW1WdWFXRWlPaUl5TURFNUxUQTRMVEF4SURFME9qUTBPalEwSWl3aWIzTjBZWFJ1YVc5ZllXdDBlWGR1ZVNJNklqSXdNakF0TURFdE1UWWdNVFE2TVRJNk1qa2lMQ0owWlhoMFpWOTBhVzF2Ym1sNGNHd2lPaUlpZlElM0QlM0Q
 */
?>