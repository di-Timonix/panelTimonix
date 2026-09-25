<?php

	/* 
	
		Timonix Arads
		system zarządzania serwisami timonix.pl
		di_Timonix
		
		główny plik z błędami projektu
	
	*/
	
	$error = [
		"laduj" => "Strona o takiej nazwie nie istnienie!",
		"laduj_error" => "Błąd pod czas ładowania pliku",
		"cache" => [
				"method" => "Błędna metoda nagłówka!",
				"error" => "nie przechwycony błąd!",
				"404" => "Taki cache nie istnieje!"
			],
		"sql_not_found" => "Brak danych do załadowania!",
		"ip" => [
			"v4" => [
				"not_found" => "Nie znaleziona ip w wersji V4"
			],
			"v6" => [
				"not_found" => "Nie znaleziona ip w wersji V6"
			]
		],
		"save_data" => "Zapisz Dane!",
		"data" => [
			"error_data_send" => "Wystąpił błąd pod czas przesyłania danych!",
			"error_data" => "Wystąpił błąd danych!",
			"error_db_update" => "Wystąpił błąd pod czas zaktualizowania danych",
			"success_data" => "Dane zostały zaktualizowane",
			"info_data_same" => "Dane zostały już wcześniej zaktualizowane!",
			"error_data_is_empty" => "Przesłane dane są puste!",
			"error_data_parse" => "Błąd parsowania danych!"
		],
		"sql" => [
			"404" => "Nie znaleziono takiego polecenia",
			"error_exercise_sql" => "Wystąpił błąd polecenia sql!",
			"info_data" => "",
			"error_load" => "Wystąpił błąd pod czas ładowania danych!"
		],
		"permission" => [
			"warm_no_access" => "Brak uprawień do zasobu!"
		]
	]

?>