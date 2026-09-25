<?php
/*
	,,timonix session manager''  Został stworzony przez di_Timonix'a
	
	ten plik służy do logowań sesji, przepływu informacji i kontrolowań kont użytkowników timonix'a
	
	timonix session manager
	
	timonix.pl,
	
	#plik: 1.0
*/

	// sprawdzanie czy sesja istnieje
	///if(isset($_COOKIE['ssssid'])){
		//echo "jest sesja";
		
		// nazwywanie odpowiednio sesji
		session_name("ssssid");
		// ustawienie czasu trwania sesji
		session_set_cookie_params( 0, "/", "", true, true);
		
		// startowanie sesji
		session_start();
		//session_destroy();
		
		// ustawienie czasu trwania sesji
		setcookie(session_name(),session_id(),0, "/", "", true, true);	
		
		// zmiena informująca o zalogowanym użytkoniku
		$tt_timonix_session_status = false;
		
		// sprawdzanie czy główna sesjia istnieje
		$tt_timonix_tsid_stat = false;
		$tt_timonix_tsid = false;
		if($tt_timonix_tsid_stat == false){
			if(isset($_COOKIE['tsid'])){
				$tt_timonix_tsid = $_COOKIE['tsid'];
				$tt_timonix_tsid_stat = true;
			}			
		}
		/*if($tt_timonix_tsid_stat == false){
			if(isset($_SESSION['tsid'])){
				$tt_timonix_tsid = $_SESSION['tsid'];
				$tt_timonix_tsid_stat = true;
			}			
		}*/
		// sprawdzanie czy istnieją klucze główna sesja użytkonika
		if($tt_timonix_tsid != false){		
			if(!isset($_COOKIE['tsid'])){			
				// replikowanie ciasteczek sesji jeśli istnieją
				// główna sesja
				setcookie("tsid",$tt_timonix_tsid,time() + (3600*24*365), "/", "konto.timonix.pl", true, true);
				setcookie("tsid",$tt_timonix_tsid,time() + (3600*24*365), "/", ".timonix.pl", true, true);
			}
			if(!isset($_SESSION['tsid'])){
				// replikowanie ciasteczek sesji jeśli istnieją
				// główna sesja
				$_SESSION['tsid'] = $tt_timonix_tsid;
			}
			$tt_timonix_session_status = true;
		}
		
		// sprawdzanie czy istnieje id użytkownika
		$tt_timonix_user_id_stat = false;
		$tt_timonix_user_id = false;
		if($tt_timonix_user_id_stat == false){
			if(isset($_COOKIE['uid'])){
				$tt_timonix_user_id = $_COOKIE['uid'];
				$tt_timonix_user_id_stat = true;
			}
		}
		if($tt_timonix_user_id_stat == false){
			if(isset($_COOKIE['tid'])){
				$tt_timonix_user_id = $_COOKIE['tid'];
				$tt_timonix_user_id_stat = true;
			}
		}
		/*if($tt_timonix_user_id_stat == false){
			if(isset($_SESSION['id'])){
				$tt_timonix_user_id = $_SESSION['id'];
				$tt_timonix_user_id_stat = true;
			}
		}*/
		// sprawdzanie czy istnieją klucze id użytkownika
		if($tt_timonix_user_id_stat != false){
			if(!isset($_COOKIE['uid'])){
				// tworzenie ciasteczka sesi po poprawnym zalogowaniu się 
				setcookie("uid", $tt_timonix_user_id, time() + (3600*24*30*6), "/", "konto.timonix.pl", true, true); // id użytkownika timonix'a
			}
			if(!isset($_COOKIE['tid'])){
				// tworzenie ciasteczka sesi po poprawnym zalogowaniu się 
				setcookie("tid", $tt_timonix_user_id, time() + (3600*24*30*6), "/", "timonix.pl", true, true); // id użytkownika timonix'a
			}
			// usunięto status sessi aktywny ze względu na brak danych głonej sesji
			//$tt_timonix_session_status = true;
		}
		// sprawdzanie czy istnieje id w sessi
		//if(!isset($_SESSION['id'])){
			if($tt_timonix_session_status == true){
				$tsid = json_decode(base64_decode($_COOKIE['tsid']), true);
				$_SESSION['zalogowany'] = true;
				$_SESSION['id'] = $tsid['id'];
				$_SESSION['nick'] = $tsid['nick'];
				$_SESSION['imie'] = $tsid['imie'];
				$_SESSION['nazwisko'] = $tsid['nazwisko'];
				$_SESSION['nr_telefonu'] = $tsid['telefon'];
				$_SESSION['telefon'] = $tsid['telefon'];
				$_SESSION['email'] = $tsid['email'];
				$_SESSION['mail'] = $tsid['email'];
				$_SESSION['plec'] = $tsid['plec'];
				$_SESSION['kraj'] = $tsid['kraj'];
				$_SESSION['jezyk'] = $tsid['jezyk'];
				$_SESSION['avatar'] = $tsid['avatar'];
				$_SESSION['token'] = $tsid['token'];
				$_SESSION['dostep'] = $tsid['dostep'];
				$_SESSION['ranga'] = $tsid['ranga'];
				$_SESSION['flaga'] = $tsid['flaga'];
				$_SESSION['online'] = $tsid['online'];
				$_SESSION['date_dolonczenia'] = $tsid['date_dolonczenia'];
				$_SESSION['ostatnio_aktywny'] = $tsid['ostatnio_aktywny'];
			}else{
				$tt_timonix_session_status = false;
			}
		//}
		
		if($tt_timonix_session_status == false){
			// Tryb testowy / lokalny: jeśli brak zewnętrznego logowania timonix, wypełniamy testową sesję
			$_SESSION['zalogowany'] = true;
			$_SESSION['id'] = 1;
			$_SESSION['nick'] = "di_Timonix";
			$_SESSION['imie'] = "Timonix";
			$_SESSION['nazwisko'] = "Admin";
			$_SESSION['nr_telefonu'] = "000000000";
			$_SESSION['telefon'] = "000000000";
			$_SESSION['email'] = "kontakt@timonix.pl";
			$_SESSION['mail'] = "kontakt@timonix.pl";
			$_SESSION['plec'] = "m";
			$_SESSION['kraj'] = "PL";
			$_SESSION['jezyk'] = "pl";
			$_SESSION['avatar'] = "";
			$_SESSION['token'] = "test_token";
			$_SESSION['dostep'] = "dostęp";
			$_SESSION['ranga'] = "właśćiciel";
			$_SESSION['flaga'] = 30;
			$_SESSION['online'] = "online";
			$_SESSION['date_dolonczenia'] = date('Y-m-d H:i:s');
			$_SESSION['ostatnio_aktywny'] = date('Y-m-d H:i:s');
			$tt_timonix_session_status = true;
		}
		
		/////////////////////////////////echo $tt_timonix_session_status;
	///////}else{
		//echo "nie ma sesji";
		// nazwywanie odpowiednio sesji
		/////session_name("ssssid");
		// startowanie sesji
		//////session_start();
		// ustawienie czasu trwania sesji
		//setcookie(session_name(),session_id());		
	/////}
	
	//$result = dns_get_record("zssokolow.edu.pl");
//print_r($result);
	
?>