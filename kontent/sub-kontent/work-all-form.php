<?php

	/* 
	
		Timonix Arads
		system zarządzania serwisami timonix.pl
		di_Timonix
		
		Wszystkie zadania / formularz pobierania danych
	
	*/
	
	$all_aplication = $db->query("SELECT * FROM `arads_aplikacja`");
	
	$all_app = [];
	
	for	($i = 0; $i < $all_aplication["num_rows"]; $i++) {	
		if($all_aplication[$i]["dostep_lvl"] <= user_settings[0]["poziom"]) {
			$all_app["num_rows"]++;
			array_push($all_app, $all_aplication[$i]);
		}
	
	}
	
	unset($all_aplication);

?>

	<section class="tsr background-white tsr-p-5px tsr-border-radius10px">
		arads - Wszystkie Zadania
	</section>
	
	<section class="tsr background-white tsr-p-5px tsr-border-radius10px tsr-mt-10">
	  <fieldset class="tsr-border-radius10px">
		<legend class="tsr-algin-left">Projekt:</legend>
			<section class="col-4 tsr-p-5px">
				<select class="arads-select-projekt" title="Projekt" name="arads-select-projekt">
					<option value="all">Wszystkie</option>
					<?php 
						
						for	($i = 0; $i < $all_app["num_rows"]; $i++) {
							echo '<option value="'. $all_app[$i]["id"] .'">'. $all_app[$i]["nazwa"] .'</option>';
						}
					
					?>
				</select>			
			</section>

			<section class="col-4 tsr-p-5px">
				<select class="arads-select-status" title="Status Zadania" name="arads-select-status">
					<option value="all">Wszystkie</option>
					<option value="do_wykonania">Do Wykonania</option>
					<option value="wykonywane">Wykonywane</option>
					<option value="planowane">Planowane</option>
					<option value="do_sprawdzenia">Do Sprawdzenia</option>
					<option value="wstrzymane">Wstrzymane</option>
					<option value="wycofane">Wycofane</option>
					<option value="ukończone">Ukończone</option>
				</select>		
			</section>	

			<section class="col-4 tsr-p-5px">
				<select class="arads-select-priorytet" title="Priorytet Zadania" name="arads-select-priorytet">
					<option value="all">Wszystkie</option>
					<option value="bardzo_niski">Bardzo Niski</option>
					<option value="niski">Niski</option>
					<option value="średni">Średni</option>
					<option value="wysoki">Wysoki</option>
					<option value="bardzo_wysoki">Bardzo Wysoki</option>
				</select>			
			</section>	

			<section class="col-4 tsr-p-5px">
				<input type="text" class="arads-select-tytul" placeholder="Tytuł Zadania" title="Tytuł Zadania Do Szukania" name="arads-select-tytul" />
			</section>

		</fieldset>
	</section>