<?php

	/* 
	
		Timonix Arads
		system zarządzania serwisami timonix.pl
		di_Timonix
		
		Oczymywanie zadań do wykonania
	
	*/
	
	// ładowanie rdzenia arads
	if (isset($z) == "NaN") {
		require_once("arads.php");
	}else{
		require_once("../../arads.php");
	}
	ini_set('display_errors', 1);
	error_reporting (E_ALL | E_STRICT);
	
	if (isset($_POST["arads_select_projekt"])) {
		if ($_POST["arads_select_projekt"] == "all") {
			$arads_select_projekt = "";
		}else{
			$arads_select_projekt = " where `id` LIKE '" . htmlentities($_POST["arads_select_projekt"], ENT_QUOTES, "UTF-8") . "'";
		}
	}else{
		$arads_select_projekt = "";
	}
	
	if (isset($_POST["arads_select_status"])) {
		if ($_POST["arads_select_status"] == "all") {
			$arads_select_status = "";
		}else{
			$arads_select_status = " AND `status` LIKE '" . htmlentities($_POST["arads_select_status"], ENT_QUOTES, "UTF-8") . "'";
		}
	}else{
		$arads_select_status = "";
	}
	
	if (isset($_POST["arads_select_priorytet"])) {
		if ($_POST["arads_select_priorytet"] == "all") {
			$arads_select_priorytet = "";
		}else{
			$arads_select_priorytet = " AND `priorytet` LIKE '" . htmlentities($_POST["arads_select_priorytet"], ENT_QUOTES, "UTF-8") . "'";
		}
	}else{
		$arads_select_priorytet = "";
	}
	
	if (isset($_POST["arads_select_tytul"])) {
		if ($_POST["arads_select_tytul"] == "") {
			$arads_select_tytul = "";
		}else{
			$arads_select_tytul = " AND `tytul` LIKE '%" . htmlentities($_POST["arads_select_tytul"], ENT_QUOTES, "UTF-8") . "%'";
		}
	}else{
		$arads_select_tytul = "";
	}
	
	$all_aplication = $db->query("SELECT * FROM `arads_aplikacja` " . $arads_select_projekt);
	
	$all_app = ["num_rows"=>0];
	
	for	($i = 0; $i < $all_aplication["num_rows"]; $i++) {	
		if($all_aplication[$i]["dostep_lvl"] <= user_settings[0]["poziom"]) {
			$all_app["num_rows"]++;
			array_push($all_app, $all_aplication[$i]);
		}
	
	}
	
	unset($all_aplication);
	
	$all_work = $db->query2("SELECT * FROM `arads_zadania` where `id_projektu` in (". $db->super_unique($all_app, "id", true) .") " . ($arads_select_status . $arads_select_priorytet . $arads_select_tytul));
	
	function check_priorytet($t){
		if ($t == "niski") {
			return " background-lime tsr-p-5px ";
		}elseif ($t == "bardzo_niski") {
			return " background-ciemny-morski white tsr-p-5px ";
		}elseif ($t == "wysoki") {
			return " background-yellow tsr-p-5px ";
		}elseif ($t == "bardzo_wysoki") {
			return " background-orange tsr-p-5px ";
		}elseif ($t == "natychmiast") {
			return " background-dark-red white tsr-p-5px ";
		}elseif ($t == "średni") {
			return " background-green white tsr-p-5px ";
		}else{
			return "";
		}
	}
?>
	
	<section class="tsr tsr-justify-content-space-between tsr-mt-10 arads-work-loads">
	
		<?php
		
			for	($i = 0; $i < $all_app["num_rows"]; $i++) {
				
		?>
	
		<section class="tsr tsr-mb-30" arads-id-project="<?php echo $all_app[$i]["id"]; ?>">
			<section class="tsr fs-80 tsr-algin-left tsr-border-bottom-solid">
				<a href="/works?z=<?php echo $all_app[$i]["id"]; ?>" class="tsr-zmiana-aurl arads-async-load-page"><img src="pliki/ikony/edit/technical-service.png" class="tsr-vertical-align-middle" title="zarządzaj" alt="Zarządzaj" loading="lazy"></a>
				 | 
				<img src="<?php echo $all_app[$i]["logo"]; ?>" alt="logo projektu" title="<?php echo $all_app[$i]["nazwa_produkcyjna"]; ?>" class="tsr-width-50px tsr-vertical-align-middle tsr-mr-10" loading="lazy" />
				<?php echo $all_app[$i]["nazwa"]; ?>
			</section>
			<section class="tsr tsr-border-bottom-solid tsr-p-10px">
				<details class="tsr tsr-algin-left tsr-mb-10" open>
					<summary>Do Wykonania</summary>
					<section class="tsr">
					<?php
						$chec_work = 0;
						for	($x = 0; $x < $all_work["num_rows"]; $x++) {
							if($all_app[$i]["id"] == $all_work[$x]["id_projektu"]) {
								if($all_work[$x]["status"] == "do_wykonania") {
					?>
						<details class="tsr tsr-border-top-solid tsr-algin-left tsr-mb-10">
							<summary class="fs-80 tsr-pt-5px tsr-pb-5px"><?php echo $all_work[$x]["tytul"]; ?> - <span class="<?php echo check_priorytet($all_work[$x]["priorytet"]); ?>"> <?php echo $all_work[$x]["priorytet"]; ?> </span> 
								<span class="tsr-pmodal">
									<img src="pliki/ikony/edit/info.png" class="tsr-vertical-align-middle tsr-ml-10" title="info" alt="info" loading="lazy" />
									<section class="tsr-modal" tsr-modal-close="true">
										<section class="tsr">
											<span class="fs-110">Wszystkie Szczegóły</span>
											
											<div class="tsr tsr-mt-20">
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">id projektu:</span>
													<span><?php echo $all_work[$x]["id_projektu"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">id uzytkownika dodania:</span>
													<span><?php echo $all_work[$x]["id_uzytkownika_dodania"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">tytuł:</span>
													<span><?php echo $all_work[$x]["tytul"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">status:</span>
													<span><?php echo $all_work[$x]["status"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">priorytet:</span>
													<span><?php echo $all_work[$x]["priorytet"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">poziom zaawansowania:</span>
													<span><?php echo $all_work[$x]["poziom_zaawansowania"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">wersja:</span>
													<span><?php echo $all_work[$x]["wersja"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">opis:</span>
													<span><?php echo $all_work[$x]["opis"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">data odania funkcji:</span>
													<span><?php echo $all_work[$x]["data_odania"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">data i czas dodania zadania:</span>
													<span><?php echo $all_work[$x]["datetime"]; ?></span>
												</div>
											</div>
											
										</section>
									</section>
								</span> 
							</summary>
							<section class="tsr">
								<div class="col-ms40 col-ms40-4 col-ms50-3 col-ms100-2 col-ms100-1 tsr-p-5px tsr-algin-justify">
									<img src="pliki/ikony/edit/description.png" class="tsr-vertical-align-middle tsr-mr-10" title="Opis" alt="opis" loading="lazy" />
									<?php echo $all_work[$x]["opis"]; ?>
								</div>
								<div class="col-ms30 col-ms30-4 col-ms50-3 col-ms100-2 col-ms100-1 tsr-p-5px">
									<img src="pliki/ikony/edit/teamwork.png" class="tsr-vertical-align-middle tsr-mr-10" title="Praca Zespołowa" alt="Praca Zespołowa" loading="lazy" />
									<?php echo $all_work[$x]["id_uzytkownika_dodania"]; ?>
								</div>
								<div class="col-ms20 col-ms20-5 col-ms20-4 col-ms50-3 col-ms50-2 col-ms100-1 tsr-p-5px">
									<img src="pliki/ikony/edit/hourglass.png" class="tsr-vertical-align-middle tsr-mr-10" title="Termin funkcji" alt="Termin funkcji" loading="lazy" />
									<time datetime="<?php echo $all_work[$x]["data_odania"]; ?>"><?php echo ceil((strtotime($all_work[$x]["data_odania"]) - time()) / (60 * 60 * 24)); ?> dni</time>
								</div>
								<div class="col-ms10 col-ms10-5 col-ms10-4 col-ms50-3 col-ms50-2 col-ms100-1 tsr-p-5px tsr-algin-right">
									<img src="pliki/ikony/edit/version.png" class="tsr-vertical-align-middle tsr-mr-10" title="Wersja aplikacji" alt="Wersja aplikacji" loading="lazy" />
									<span><?php echo $all_work[$x]["wersja"]; ?></span>
								</div>
							</section>
						</details>
					<?php
					
								$chec_work++;
								}
							}
						}
						if ($chec_work == 0){
					?>
					
						<section class="tsr-alert tsr-alert-info"><?php echo $error["sql_not_found"] ?></section>
					
					<?php } ?>
					</section>
				</details>
				
				<details class="tsr tsr-algin-left tsr-mb-10">
					<summary>Wykonywane</summary>
					<section class="tsr">
					<?php
						$chec_work = 0;
						for	($x = 0; $x < $all_work["num_rows"]; $x++) {
							if($all_app[$i]["id"] == $all_work[$x]["id_projektu"]) {
								if($all_work[$x]["status"] == "wykonywane") {
					?>
						<details class="tsr tsr-border-top-solid tsr-algin-left tsr-mb-10">
							<summary class="fs-80 tsr-pt-5px tsr-pb-5px"><?php echo $all_work[$x]["tytul"]; ?> - <span class="<?php echo check_priorytet($all_work[$x]["priorytet"]); ?>"> <?php echo $all_work[$x]["priorytet"]; ?> </span> 
								<span class="tsr-pmodal">
									<img src="pliki/ikony/edit/info.png" class="tsr-vertical-align-middle tsr-ml-10" title="info" alt="info" loading="lazy" />
									<section class="tsr-modal" tsr-modal-close="true">
										<section class="tsr">
											<span class="fs-110">Wszystkie Szczegóły</span>
											
											<div class="tsr tsr-mt-20">
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">id projektu:</span>
													<span><?php echo $all_work[$x]["id_projektu"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">id uzytkownika dodania:</span>
													<span><?php echo $all_work[$x]["id_uzytkownika_dodania"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">tytuł:</span>
													<span><?php echo $all_work[$x]["tytul"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">status:</span>
													<span><?php echo $all_work[$x]["status"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">priorytet:</span>
													<span><?php echo $all_work[$x]["priorytet"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">poziom zaawansowania:</span>
													<span><?php echo $all_work[$x]["poziom_zaawansowania"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">wersja:</span>
													<span><?php echo $all_work[$x]["wersja"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">opis:</span>
													<span><?php echo $all_work[$x]["opis"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">data odania funkcji:</span>
													<span><?php echo $all_work[$x]["data_odania"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">data i czas dodania zadania:</span>
													<span><?php echo $all_work[$x]["datetime"]; ?></span>
												</div>
											</div>
											
										</section>
									</section>
								</span> 
							</summary>
							<section class="tsr">
								<div class="col-ms40 col-ms40-4 col-ms50-3 col-ms100-2 col-ms100-1 tsr-p-5px tsr-algin-justify">
									<img src="pliki/ikony/edit/description.png" class="tsr-vertical-align-middle tsr-mr-10" title="Opis" alt="opis" loading="lazy" />
									<?php echo $all_work[$x]["opis"]; ?>
								</div>
								<div class="col-ms30 col-ms30-4 col-ms50-3 col-ms100-2 col-ms100-1 tsr-p-5px">
									<img src="pliki/ikony/edit/teamwork.png" class="tsr-vertical-align-middle tsr-mr-10" title="Praca Zespołowa" alt="Praca Zespołowa" loading="lazy" />
									<?php echo $all_work[$x]["id_uzytkownika_dodania"]; ?>
								</div>
								<div class="col-ms20 col-ms20-5 col-ms20-4 col-ms50-3 col-ms50-2 col-ms100-1 tsr-p-5px">
									<img src="pliki/ikony/edit/hourglass.png" class="tsr-vertical-align-middle tsr-mr-10" title="Termin funkcji" alt="Termin funkcji" loading="lazy" />
									<time datetime="<?php echo $all_work[$x]["data_odania"]; ?>"><?php echo ceil((strtotime($all_work[$x]["data_odania"]) - time()) / (60 * 60 * 24)); ?> dni</time>
								</div>
								<div class="col-ms10 col-ms10-5 col-ms10-4 col-ms50-3 col-ms50-2 col-ms100-1 tsr-p-5px tsr-algin-right">
									<img src="pliki/ikony/edit/version.png" class="tsr-vertical-align-middle tsr-mr-10" title="Wersja aplikacji" alt="Wersja aplikacji" loading="lazy" />
									<span><?php echo $all_work[$x]["wersja"]; ?></span>
								</div>
							</section>
						</details>
					<?php
					
								$chec_work++;
								}
							}
						}
						if ($chec_work == 0){
					?>
					
						<section class="tsr-alert tsr-alert-info"><?php echo $error["sql_not_found"] ?></section>
					
					<?php } ?>
					</section>
				</details>
				
				<details class="tsr sr-border-bottom-solid tsr-algin-left tsr-mb-10">
					<summary>Planowane</summary>
					<section class="tsr">
					<?php
						$chec_work = 0;
						for	($x = 0; $x < $all_work["num_rows"]; $x++) {
							if($all_app[$i]["id"] == $all_work[$x]["id_projektu"]) {
								if($all_work[$x]["status"] == "planowane") {
					?>
						<details class="tsr tsr-border-top-solid tsr-algin-left tsr-mb-10">
							<summary class="fs-80 tsr-pt-5px tsr-pb-5px"><?php echo $all_work[$x]["tytul"]; ?> - <span class="<?php echo check_priorytet($all_work[$x]["priorytet"]); ?>"> <?php echo $all_work[$x]["priorytet"]; ?> </span>
								<span class="tsr-pmodal">
									<img src="pliki/ikony/edit/info.png" class="tsr-vertical-align-middle tsr-ml-10" title="info" alt="info" loading="lazy" />
									<section class="tsr-modal" tsr-modal-close="true">
										<section class="tsr">
											<span class="fs-110">Wszystkie Szczegóły</span>
											
											<div class="tsr tsr-mt-20">
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">id projektu:</span>
													<span><?php echo $all_work[$x]["id_projektu"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">id uzytkownika dodania:</span>
													<span><?php echo $all_work[$x]["id_uzytkownika_dodania"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">tytuł:</span>
													<span><?php echo $all_work[$x]["tytul"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">status:</span>
													<span><?php echo $all_work[$x]["status"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">priorytet:</span>
													<span><?php echo $all_work[$x]["priorytet"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">poziom zaawansowania:</span>
													<span><?php echo $all_work[$x]["poziom_zaawansowania"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">wersja:</span>
													<span><?php echo $all_work[$x]["wersja"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">opis:</span>
													<span><?php echo $all_work[$x]["opis"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">data odania funkcji:</span>
													<span><?php echo $all_work[$x]["data_odania"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">data i czas dodania zadania:</span>
													<span><?php echo $all_work[$x]["datetime"]; ?></span>
												</div>
											</div>
											
										</section>
									</section>
								</span> 
							</summary>
							<section class="tsr">
								<div class="col-ms40 col-ms40-4 col-ms50-3 col-ms100-2 col-ms100-1 tsr-p-5px tsr-algin-justify">
									<img src="pliki/ikony/edit/description.png" class="tsr-vertical-align-middle tsr-mr-10" title="Opis" alt="opis" loading="lazy" />
									<?php echo $all_work[$x]["opis"]; ?>
								</div>
								<div class="col-ms30 col-ms30-4 col-ms50-3 col-ms100-2 col-ms100-1 tsr-p-5px">
									<img src="pliki/ikony/edit/teamwork.png" class="tsr-vertical-align-middle tsr-mr-10" title="Praca Zespołowa" alt="Praca Zespołowa" loading="lazy" />
									<?php echo $all_work[$x]["id_uzytkownika_dodania"]; ?>
								</div>
								<div class="col-ms20 col-ms20-5 col-ms20-4 col-ms50-3 col-ms50-2 col-ms100-1 tsr-p-5px">
									<img src="pliki/ikony/edit/hourglass.png" class="tsr-vertical-align-middle tsr-mr-10" title="Termin funkcji" alt="Termin funkcji" loading="lazy" />
									<time datetime="<?php echo $all_work[$x]["data_odania"]; ?>"><?php echo ceil((strtotime($all_work[$x]["data_odania"]) - time()) / (60 * 60 * 24)); ?> dni</time>
								</div>
								<div class="col-ms10 col-ms10-5 col-ms10-4 col-ms50-3 col-ms50-2 col-ms100-1 tsr-p-5px tsr-algin-right">
									<img src="pliki/ikony/edit/version.png" class="tsr-vertical-align-middle tsr-mr-10" title="Wersja aplikacji" alt="Wersja aplikacji" loading="lazy" />
									<span><?php echo $all_work[$x]["wersja"]; ?></span>
								</div>
							</section>
						</details>
					<?php
					
								$chec_work++;
								}
							}
						}
						if ($chec_work == 0){
					?>
					
						<section class="tsr-alert tsr-alert-info"><?php echo $error["sql_not_found"] ?></section>
					
					<?php } ?>
					</section>
				</details>

				<details class="tsr sr-border-bottom-solid tsr-algin-left tsr-mb-10">
					<summary>Do Sprawdzenia</summary>
					<section class="tsr">
					<?php
						$chec_work = 0;
						for	($x = 0; $x < $all_work["num_rows"]; $x++) {
							if($all_app[$i]["id"] == $all_work[$x]["id_projektu"]) {
								if($all_work[$x]["status"] == "do_sprawdzenia") {
					?>
						<details class="tsr tsr-border-top-solid tsr-algin-left tsr-mb-10">
							<summary class="fs-80 tsr-pt-5px tsr-pb-5px"><?php echo $all_work[$x]["tytul"]; ?> - <span class="<?php echo check_priorytet($all_work[$x]["priorytet"]); ?>"> <?php echo $all_work[$x]["priorytet"]; ?> </span>
								<span class="tsr-pmodal">
									<img src="pliki/ikony/edit/info.png" class="tsr-vertical-align-middle tsr-ml-10" title="info" alt="info" loading="lazy" />
									<section class="tsr-modal" tsr-modal-close="true">
										<section class="tsr">
											<span class="fs-110">Wszystkie Szczegóły</span>
											
											<div class="tsr tsr-mt-20">
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">id projektu:</span>
													<span><?php echo $all_work[$x]["id_projektu"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">id uzytkownika dodania:</span>
													<span><?php echo $all_work[$x]["id_uzytkownika_dodania"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">tytuł:</span>
													<span><?php echo $all_work[$x]["tytul"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">status:</span>
													<span><?php echo $all_work[$x]["status"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">priorytet:</span>
													<span><?php echo $all_work[$x]["priorytet"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">poziom zaawansowania:</span>
													<span><?php echo $all_work[$x]["poziom_zaawansowania"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">wersja:</span>
													<span><?php echo $all_work[$x]["wersja"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">opis:</span>
													<span><?php echo $all_work[$x]["opis"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">data odania funkcji:</span>
													<span><?php echo $all_work[$x]["data_odania"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">data i czas dodania zadania:</span>
													<span><?php echo $all_work[$x]["datetime"]; ?></span>
												</div>
											</div>
											
										</section>
									</section>
								</span> 
							</summary>
							<section class="tsr">
								<div class="col-ms40 col-ms40-4 col-ms50-3 col-ms100-2 col-ms100-1 tsr-p-5px tsr-algin-justify">
									<img src="pliki/ikony/edit/description.png" class="tsr-vertical-align-middle tsr-mr-10" title="Opis" alt="opis" loading="lazy" />
									<?php echo $all_work[$x]["opis"]; ?>
								</div>
								<div class="col-ms30 col-ms30-4 col-ms50-3 col-ms100-2 col-ms100-1 tsr-p-5px">
									<img src="pliki/ikony/edit/teamwork.png" class="tsr-vertical-align-middle tsr-mr-10" title="Praca Zespołowa" alt="Praca Zespołowa" loading="lazy" />
									<?php echo $all_work[$x]["id_uzytkownika_dodania"]; ?>
								</div>
								<div class="col-ms20 col-ms20-5 col-ms20-4 col-ms50-3 col-ms50-2 col-ms100-1 tsr-p-5px">
									<img src="pliki/ikony/edit/hourglass.png" class="tsr-vertical-align-middle tsr-mr-10" title="Termin funkcji" alt="Termin funkcji" loading="lazy" />
									<time datetime="<?php echo $all_work[$x]["data_odania"]; ?>"><?php echo ceil((strtotime($all_work[$x]["data_odania"]) - time()) / (60 * 60 * 24)); ?> dni</time>
								</div>
								<div class="col-ms10 col-ms10-5 col-ms10-4 col-ms50-3 col-ms50-2 col-ms100-1 tsr-p-5px tsr-algin-right">
									<img src="pliki/ikony/edit/version.png" class="tsr-vertical-align-middle tsr-mr-10" title="Wersja aplikacji" alt="Wersja aplikacji" loading="lazy" />
									<span><?php echo $all_work[$x]["wersja"]; ?></span>
								</div>
							</section>
						</details>
					<?php
					
								$chec_work++;
								}
							}
						}
						if ($chec_work == 0){
					?>
					
						<section class="tsr-alert tsr-alert-info"><?php echo $error["sql_not_found"] ?></section>
					
					<?php } ?>
					</section>
				</details>
				
				<details class="tsr sr-border-bottom-solid tsr-algin-left tsr-mb-10">
					<summary>Wstrzymane</summary>
					<section class="tsr">
					<?php
						$chec_work = 0;
						for	($x = 0; $x < $all_work["num_rows"]; $x++) {
							if($all_app[$i]["id"] == $all_work[$x]["id_projektu"]) {
								if($all_work[$x]["status"] == "wstrzymane") {
					?>
						<details class="tsr tsr-border-top-solid tsr-algin-left tsr-mb-10">
							<summary class="fs-80 tsr-pt-5px tsr-pb-5px"><?php echo $all_work[$x]["tytul"]; ?> - <span class="<?php echo check_priorytet($all_work[$x]["priorytet"]); ?>"> <?php echo $all_work[$x]["priorytet"]; ?> </span>
								<span class="tsr-pmodal">
									<img src="pliki/ikony/edit/info.png" class="tsr-vertical-align-middle tsr-ml-10" title="info" alt="info" loading="lazy" />
									<section class="tsr-modal" tsr-modal-close="true">
										<section class="tsr">
											<span class="fs-110">Wszystkie Szczegóły</span>
											
											<div class="tsr tsr-mt-20">
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">id projektu:</span>
													<span><?php echo $all_work[$x]["id_projektu"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">id uzytkownika dodania:</span>
													<span><?php echo $all_work[$x]["id_uzytkownika_dodania"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">tytuł:</span>
													<span><?php echo $all_work[$x]["tytul"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">status:</span>
													<span><?php echo $all_work[$x]["status"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">priorytet:</span>
													<span><?php echo $all_work[$x]["priorytet"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">poziom zaawansowania:</span>
													<span><?php echo $all_work[$x]["poziom_zaawansowania"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">wersja:</span>
													<span><?php echo $all_work[$x]["wersja"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">opis:</span>
													<span><?php echo $all_work[$x]["opis"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">data odania funkcji:</span>
													<span><?php echo $all_work[$x]["data_odania"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">data i czas dodania zadania:</span>
													<span><?php echo $all_work[$x]["datetime"]; ?></span>
												</div>
											</div>
											
										</section>
									</section>
								</span> 
							</summary>
							<section class="tsr">
								<div class="col-ms40 col-ms40-4 col-ms50-3 col-ms100-2 col-ms100-1 tsr-p-5px tsr-algin-justify">
									<img src="pliki/ikony/edit/description.png" class="tsr-vertical-align-middle tsr-mr-10" title="Opis" alt="opis" loading="lazy" />
									<?php echo $all_work[$x]["opis"]; ?>
								</div>
								<div class="col-ms30 col-ms30-4 col-ms50-3 col-ms100-2 col-ms100-1 tsr-p-5px">
									<img src="pliki/ikony/edit/teamwork.png" class="tsr-vertical-align-middle tsr-mr-10" title="Praca Zespołowa" alt="Praca Zespołowa" loading="lazy" />
									<?php echo $all_work[$x]["id_uzytkownika_dodania"]; ?>
								</div>
								<div class="col-ms20 col-ms20-5 col-ms20-4 col-ms50-3 col-ms50-2 col-ms100-1 tsr-p-5px">
									<img src="pliki/ikony/edit/hourglass.png" class="tsr-vertical-align-middle tsr-mr-10" title="Termin funkcji" alt="Termin funkcji" loading="lazy" />
									<time datetime="<?php echo $all_work[$x]["data_odania"]; ?>"><?php echo ceil((strtotime($all_work[$x]["data_odania"]) - time()) / (60 * 60 * 24)); ?> dni</time>
								</div>
								<div class="col-ms10 col-ms10-5 col-ms10-4 col-ms50-3 col-ms50-2 col-ms100-1 tsr-p-5px tsr-algin-right">
									<img src="pliki/ikony/edit/version.png" class="tsr-vertical-align-middle tsr-mr-10" title="Wersja aplikacji" alt="Wersja aplikacji" loading="lazy" />
									<span><?php echo $all_work[$x]["wersja"]; ?></span>
								</div>
							</section>
						</details>
					<?php
					
								$chec_work++;
								}
							}
						}
						if ($chec_work == 0){
					?>
					
						<section class="tsr-alert tsr-alert-info"><?php echo $error["sql_not_found"] ?></section>
					
					<?php } ?>
					</section>
				</details>
				
				<details class="tsr sr-border-bottom-solid tsr-algin-left tsr-mb-10">
					<summary>Wycofane</summary>
					<section class="tsr">
					<?php
						$chec_work = 0;
						for	($x = 0; $x < $all_work["num_rows"]; $x++) {
							if($all_app[$i]["id"] == $all_work[$x]["id_projektu"]) {
								if($all_work[$x]["status"] == "wycofane") {
					?>
						<details class="tsr tsr-border-top-solid tsr-algin-left tsr-mb-10">
							<summary class="fs-80 tsr-pt-5px tsr-pb-5px"><?php echo $all_work[$x]["tytul"]; ?> - <span class="<?php echo check_priorytet($all_work[$x]["priorytet"]); ?>"> <?php echo $all_work[$x]["priorytet"]; ?> </span>
								<span class="tsr-pmodal">
									<img src="pliki/ikony/edit/info.png" class="tsr-vertical-align-middle tsr-ml-10" title="info" alt="info" loading="lazy" />
									<section class="tsr-modal" tsr-modal-close="true">
										<section class="tsr">
											<span class="fs-110">Wszystkie Szczegóły</span>
											
											<div class="tsr tsr-mt-20">
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">id projektu:</span>
													<span><?php echo $all_work[$x]["id_projektu"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">id uzytkownika dodania:</span>
													<span><?php echo $all_work[$x]["id_uzytkownika_dodania"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">tytuł:</span>
													<span><?php echo $all_work[$x]["tytul"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">status:</span>
													<span><?php echo $all_work[$x]["status"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">priorytet:</span>
													<span><?php echo $all_work[$x]["priorytet"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">poziom zaawansowania:</span>
													<span><?php echo $all_work[$x]["poziom_zaawansowania"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">wersja:</span>
													<span><?php echo $all_work[$x]["wersja"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">opis:</span>
													<span><?php echo $all_work[$x]["opis"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">data odania funkcji:</span>
													<span><?php echo $all_work[$x]["data_odania"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">data i czas dodania zadania:</span>
													<span><?php echo $all_work[$x]["datetime"]; ?></span>
												</div>
											</div>
											
										</section>
									</section>
								</span> 
							</summary>
							<section class="tsr">
								<div class="col-ms40 col-ms40-4 col-ms50-3 col-ms100-2 col-ms100-1 tsr-p-5px tsr-algin-justify">
									<img src="pliki/ikony/edit/description.png" class="tsr-vertical-align-middle tsr-mr-10" title="Opis" alt="opis" loading="lazy" />
									<?php echo $all_work[$x]["opis"]; ?>
								</div>
								<div class="col-ms30 col-ms30-4 col-ms50-3 col-ms100-2 col-ms100-1 tsr-p-5px">
									<img src="pliki/ikony/edit/teamwork.png" class="tsr-vertical-align-middle tsr-mr-10" title="Praca Zespołowa" alt="Praca Zespołowa" loading="lazy" />
									<?php echo $all_work[$x]["id_uzytkownika_dodania"]; ?>
								</div>
								<div class="col-ms20 col-ms20-5 col-ms20-4 col-ms50-3 col-ms50-2 col-ms100-1 tsr-p-5px">
									<img src="pliki/ikony/edit/hourglass.png" class="tsr-vertical-align-middle tsr-mr-10" title="Termin funkcji" alt="Termin funkcji" loading="lazy" />
									<time datetime="<?php echo $all_work[$x]["data_odania"]; ?>"><?php echo ceil((strtotime($all_work[$x]["data_odania"]) - time()) / (60 * 60 * 24)); ?> dni</time>
								</div>
								<div class="col-ms10 col-ms10-5 col-ms10-4 col-ms50-3 col-ms50-2 col-ms100-1 tsr-p-5px tsr-algin-right">
									<img src="pliki/ikony/edit/version.png" class="tsr-vertical-align-middle tsr-mr-10" title="Wersja aplikacji" alt="Wersja aplikacji" loading="lazy" />
									<span><?php echo $all_work[$x]["wersja"]; ?></span>
								</div>
							</section>
						</details>
					<?php
					
								$chec_work++;
								}
							}
						}
						if ($chec_work == 0){
					?>
					
						<section class="tsr-alert tsr-alert-info"><?php echo $error["sql_not_found"] ?></section>
					
					<?php } ?>
					</section>
				</details>

				<details class="tsr sr-border-bottom-solid tsr-algin-left tsr-mb-10">
					<summary>Ukończone</summary>
					<section class="tsr">
					<?php
						$chec_work = 0;
						for	($x = 0; $x < $all_work["num_rows"]; $x++) {
							if($all_app[$i]["id"] == $all_work[$x]["id_projektu"]) {
								if($all_work[$x]["status"] == "ukończone") {
					?>
						<details class="tsr tsr-border-top-solid tsr-algin-left tsr-mb-10">
							<summary class="fs-80 tsr-pt-5px tsr-pb-5px"><?php echo $all_work[$x]["tytul"]; ?> - <span class="<?php echo check_priorytet($all_work[$x]["priorytet"]); ?>"> <?php echo $all_work[$x]["priorytet"]; ?> </span>
								<span class="tsr-pmodal">
									<img src="pliki/ikony/edit/info.png" class="tsr-vertical-align-middle tsr-ml-10" title="info" alt="info" loading="lazy" />
									<section class="tsr-modal" tsr-modal-close="true">
										<section class="tsr">
											<span class="fs-110">Wszystkie Szczegóły</span>
											
											<div class="tsr tsr-mt-20">
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">id projektu:</span>
													<span><?php echo $all_work[$x]["id_projektu"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">id uzytkownika dodania:</span>
													<span><?php echo $all_work[$x]["id_uzytkownika_dodania"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">tytuł:</span>
													<span><?php echo $all_work[$x]["tytul"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">status:</span>
													<span><?php echo $all_work[$x]["status"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">priorytet:</span>
													<span><?php echo $all_work[$x]["priorytet"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">poziom zaawansowania:</span>
													<span><?php echo $all_work[$x]["poziom_zaawansowania"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">wersja:</span>
													<span><?php echo $all_work[$x]["wersja"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">opis:</span>
													<span><?php echo $all_work[$x]["opis"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">data odania funkcji:</span>
													<span><?php echo $all_work[$x]["data_odania"]; ?></span>
												</div>
												<div class="tsr tsr-algin-left">
													<span class="tsr-mr-20 fs-80">data i czas dodania zadania:</span>
													<span><?php echo $all_work[$x]["datetime"]; ?></span>
												</div>
											</div>
											
										</section>
									</section>
								</span> 
							</summary>
							<section class="tsr">
								<div class="col-ms40 col-ms40-4 col-ms50-3 col-ms100-2 col-ms100-1 tsr-p-5px tsr-algin-justify">
									<img src="pliki/ikony/edit/description.png" class="tsr-vertical-align-middle tsr-mr-10" title="Opis" alt="opis" loading="lazy" />
									<?php echo $all_work[$x]["opis"]; ?>
								</div>
								<div class="col-ms30 col-ms30-4 col-ms50-3 col-ms100-2 col-ms100-1 tsr-p-5px">
									<img src="pliki/ikony/edit/teamwork.png" class="tsr-vertical-align-middle tsr-mr-10" title="Praca Zespołowa" alt="Praca Zespołowa" loading="lazy" />
									<?php echo $all_work[$x]["id_uzytkownika_dodania"]; ?>
								</div>
								<div class="col-ms20 col-ms20-5 col-ms20-4 col-ms50-3 col-ms50-2 col-ms100-1 tsr-p-5px">
									<img src="pliki/ikony/edit/hourglass.png" class="tsr-vertical-align-middle tsr-mr-10" title="Termin funkcji" alt="Termin funkcji" loading="lazy" />
									<time datetime="<?php echo $all_work[$x]["data_odania"]; ?>"><?php echo ceil((strtotime($all_work[$x]["data_odania"]) - time()) / (60 * 60 * 24)); ?> dni</time>
								</div>
								<div class="col-ms10 col-ms10-5 col-ms10-4 col-ms50-3 col-ms50-2 col-ms100-1 tsr-p-5px tsr-algin-right">
									<img src="pliki/ikony/edit/version.png" class="tsr-vertical-align-middle tsr-mr-10" title="Wersja aplikacji" alt="Wersja aplikacji" loading="lazy" />
									<span><?php echo $all_work[$x]["wersja"]; ?></span>
								</div>
							</section>
						</details>
					<?php
					
								$chec_work++;
								}
							}
						}
						if ($chec_work == 0){
					?>
					
						<section class="tsr-alert tsr-alert-info"><?php echo $error["sql_not_found"] ?></section>
					
					<?php } ?>
					</section>
				</details>
			</section>
		</section>
		
		<?php
		
			}
			
		?>
		
	</section>
	
	<script>
		//tsr_checkboxall2(".arads-checkbox-container", ".arads-pcheckbox", ".arads-checkbox");
	</script>