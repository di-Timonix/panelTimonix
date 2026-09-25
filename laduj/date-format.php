<?php	
	/* 
	
		Timonix Arads
		system zarządzania serwisami timonix.pl
		di_Timonix
		
		zaządza czasem serwera
	
	*/
	
	function data_format($datetime, $foramt_czasu) {
		
		$date = date_create($datetime);
		
		$datetime_format = date_format($date, $foramt_czasu);
		
		return $datetime_format;
		
	};

?>