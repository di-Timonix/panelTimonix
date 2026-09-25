<?php

	/* 
	
		Timonix Arads
		system zarządzania serwisami timonix.pl
		di_Timonix
		
		główne jądro przepływem danych
	
	*/
	
	require_once("arads.php");
	
	if ($_SESSION['zalogowany'] != true) {
		//header ("Location: https://konto.timonix.pl/?wpt=timonix_app_c_manifest&st=timonix_login&r=false&adder=sdf654gs65dt4h6ws4t6hw6srth6w46th4w65rt4h65w4r65th4w65rt46wr4t6w5r4h968w4rt&adder_eeeprom=sdf654gae56r4g5awer46h461rt65he4rt6he6rt416h41r6t41e65t1r465he465th46e5j5e4t6yje4ty6j41e6t5yj4e65tyh4w65rt46wr4t6w5r4h968w4rt&arg=ssh_ddo_pd&v_nert=6e5r4g65e4r6g465g41ws6tr49q64er94wrt94ety9ulk4r698yu464tr6j4t6yk46y4646ttttttt1244444t66df514sd65r4y6saeddd&wpt=timonix_app_c_manifest&connect=https://arads.timonix.pl/",TRUE,303);
		echo '<meta http-equiv="Refresh" content="0; url= https://konto.timonix.pl/?wpt=timonix_app_c_manifest&st=timonix_login&r=false&adder=sdf654gs65dt4h6ws4t6hw6srth6w46th4w65rt4h65w4r65th4w65rt46wr4t6w5r4h968w4rt&adder_eeeprom=sdf654gae56r4g5awer46h461rt65he4rt6he6rt416h41r6t41e65t1r465he465th46e5j5e4t6yje4ty6j41e6t5yj4e65tyh4w65rt46wr4t6w5r4h968w4rt&arg=ssh_ddo_pd&v_nert=6e5r4g65e4r6g465g41ws6tr49q64er94wrt94ety9ulk4r698yu464tr6j4t6yk46y4646ttttttt1244444t66df514sd65r4y6saeddd&wpt=timonix_app_c_manifest&connect=https://arads.timonix.pl/" />';
		exit();
	}
	
	if	($_POST["akcja"] == "load_page") {
		if ($_POST["strona_laduj"] == "/") {
			require_once("kontent/panel.php");
		}else{
			$t = explode("/", $_POST["strona_laduj"]);
			if ($t[0] == "/"){
				$strona_laduj = $t[1];
			}else{
				$strona_laduj = $_POST["strona_laduj"];
			}
			
			if (@is_file("kontent/" . $strona_laduj . ".php") === true) {
				require_once("kontent/" . $strona_laduj . ".php");
			}else{
				echo '<section class="tsr-alert tsr-alert-error"> '. $error["laduj"] .' </section>';
			}
		}
	}

?>