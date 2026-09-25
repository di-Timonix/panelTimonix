<?php

	/* 
	
		Timonix t4log
		system lofujący i debakujący zadania wykonywanie  serwisami timonix.pl
		di_Timonix
		
		wszystkie logi w pełni konfigurywalne
	
	*/

	class t4log {
		// udtawnienia
		protected $prefix = "";
		protected $secure = true;
		protected $coile = 1;
		protected $folder_ovner = "t4log";
		protected $folder = "Y.m.s";
		protected $folder_prefix = "";
		protected $time = "H:i:s";
		protected $day = "";
		
		public function __construct ($cfg = null) {
			if ($cfg == null) {
				
			}else{
				require_once($cfg);
			}
		}
		
	}

?>