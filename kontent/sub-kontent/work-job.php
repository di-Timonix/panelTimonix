<?php

	/* 
	
		Timonix Arads
		system zarządzania serwisami timonix.pl
		di_Timonix
		
		Oczymywanie zadań do wykonania
	
	*/
	
	// ładowanie rdzenia arads
	require_once("arads.php");
	
	$arads_work_load = htmlentities($z, ENT_QUOTES, "UTF-8");
	
	$all_work = $db->query("SELECT * FROM `arads_zadania` where `id_projektu` = '". $arads_work_load ."' ");

// for	($i = 0; $i < $all_work["num_rows"]; $i++) {
	
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

	<section class="tsr background-white tsr-p-5px tsr-border-radius10px">
		<a href="/works" class="tsr-zmiana-aurl arads-async-load-page tsr-fl">
			<img src="pliki/ikony/edit/back-arrow.png" class="tsr-vertical-align-middle" title="Cofnji" alt="Cofnji" loading="lazy">
		</a>
		<span>
			arads - Zadania
		</span>
	</section>
	
	<section class="tsr tsr-mt-10">
	
		<section class="col-3 tsr-p-5px  tsr-border-radius10px tsr-border-solid-orange-2">
			<section class="tsr tsr-border-radius10px tsr-pt-10px tsr-pb-10px ">
				<section class="tsr tsr-border-bottom-solid-orange-4">Dostępne Zadania</section>
				<section class="tsr tsr-mt-10 arads-work-do-wykonania tsr-sortbox4">
					<?php 
						if ($all_work["num_rows"] != 0) {
							$chec_work = 0;
							for	($x = 0; $x < $all_work["num_rows"]; $x++) {
								
								$all_work_id_user_check = ($all_work[$x]["osoby_pracuja"] == "null" ? [1] : json_decode($all_work[$x]["osoby_pracuja"], true) );
								
								if(array_search($_SESSION['id'], $all_work_id_user_check) !== false) {
									if($all_work[$x]["status"] == "do_wykonania") {
					?>
					<section class="tsr tsr-mt-10 tsr-p-5px tsr-border-bottom-dashed tsr-border-top-dashed background-white tsr-border-radius10px tsd arads-work tsr-sortiner" arads-work-id="<?php echo $all_work[$x]["id"]; ?>">
						<section class="tsr tsr-algin-left" arads-title-work="<?php echo $all_work[$x]["tytul"]; ?>">
							<img src="pliki/ikony/edit/drag.png" alt="X" title="przeciągni" class="cursor-grab tsr-mr-15 tsr-vertical-align-middle tsr-display-inline-block tsr-sort-handle" style="user-select: none; -webkit-user-drag: none;" /><span class="arads-work-title fs-70" style="line-height: 30px;"><?php echo $all_work[$x]["tytul"]; ?> </span> - <span class="<?php echo check_priorytet($all_work[$x]["priorytet"]); ?>"> <?php echo $all_work[$x]["priorytet"]; ?> </span> 
						</section>
						<section class="tsr tsr-algin-left">
							<details class="tsr-mt-15">
								<summary>
									Więcej 
									<span class="tsr-p-5px">
										<img src="pliki/ikony/edit/hourglass.png" class="tsr-vertical-align-middle tsr-mr-10" title="Termin funkcji" alt="Termin funkcji" loading="lazy" />
										<time datetime="<?php echo $all_work[$x]["data_odania"]; ?>" class="fs-60"><?php echo ceil((strtotime($all_work[$x]["data_odania"]) - time()) / (60 * 60 * 24)); ?> dni</time>
									</span>
									<span class="tsr-p-5px tsr-algin-right">
										<img src="pliki/ikony/edit/version.png" class="tsr-vertical-align-middle tsr-mr-10" title="Wersja aplikacji" alt="Wersja aplikacji" loading="lazy" />
										<span class="fs-60"><?php echo $all_work[$x]["wersja"]; ?></span>
									</span>
								</summary>
								<p class="fs-80 arads-work-description">
									<div class="tsr tsr-p-5px tsr-algin-justify">
										<img src="pliki/ikony/edit/description.png" class="tsr-vertical-align-middle tsr-mr-10" title="Opis" alt="opis" loading="lazy" />
										<?php echo $all_work[$x]["opis"]; ?>
									</div>
									<div class="tsr tsr-p-5px">
										<img src="pliki/ikony/edit/teamwork.png" class="tsr-vertical-align-middle tsr-mr-10" title="Praca Zespołowa" alt="Praca Zespołowa" loading="lazy" />
										<?php echo $all_work[$x]["osoby_pracuja"]; ?>
									</div>
								</p>
							</details>
						</section>
					</section>
					<?php
										$chec_work++;
									}
								}
							}
							if ($chec_work == 0){
					?>
								<section class="tsr-alert tsr-alert-info"><?php echo $error["sql_not_found"] ?></section>
					<?php
							}
						}else{
					?>
						<section class="tsr-alert tsr-alert-info"><?php echo $error["sql_not_found"] ?></section>
					<?php		
						}
					?>
				</section>
			</section>
		</section>

		<section class="col-3 tsr-p-5px tsr-border-radius10px tsr-border-solid-gray-2">
			<section class="tsr tsr-border-radius10px tsr-pt-10px tsr-pb-10px">
				<section class="tsr tsr-border-bottom-solid-gray-4">Wykoknywane Zadanie</section>
				<section class="tsr tsr-mt-10 arads-work-get-work tsr-sortbox4">
					<?php 
						if ($all_work["num_rows"] != 0) {
							$chec_work = 0;
							for	($x = 0; $x < $all_work["num_rows"]; $x++) {
								
								$all_work_id_user_check = ($all_work[$x]["osoby_pracuja"] == "null" ? [1] : json_decode($all_work[$x]["osoby_pracuja"], true) );
								
								if(array_search($_SESSION['id'], $all_work_id_user_check) !== false) {
									if($all_work[$x]["status"] == "wykonywane") {
					?>
					<section class="tsr tsr-mt-10 tsr-p-5px tsr-border-bottom-dashed tsr-border-top-dashed background-white tsr-border-radius10px tsd arads-work tsr-sortiner" arads-work-id="<?php echo $all_work[$x]["id"]; ?>">
						<section class="tsr tsr-algin-left" arads-title-work="<?php echo $all_work[$x]["tytul"]; ?>">
							<img src="pliki/ikony/edit/drag.png" alt="X" title="przeciągni" class="cursor-grab tsr-mr-15 tsr-vertical-align-middle tsr-display-inline-block tsr-sort-handle" style="user-select: none; -webkit-user-drag: none;" /><span class="arads-work-title fs-70" style="line-height: 30px;"><?php echo $all_work[$x]["tytul"]; ?> </span> - <span class="<?php echo check_priorytet($all_work[$x]["priorytet"]); ?>"> <?php echo $all_work[$x]["priorytet"]; ?> </span> 
						</section>
						<section class="tsr tsr-algin-left">
							<details class="tsr-mt-15">
								<summary>
									Więcej 
									<span class="tsr-p-5px">
										<img src="pliki/ikony/edit/hourglass.png" class="tsr-vertical-align-middle tsr-mr-10" title="Termin funkcji" alt="Termin funkcji" loading="lazy" />
										<time datetime="<?php echo $all_work[$x]["data_odania"]; ?>" class="fs-60"><?php echo ceil((strtotime($all_work[$x]["data_odania"]) - time()) / (60 * 60 * 24)); ?> dni</time>
									</span>
									<span class="tsr-p-5px tsr-algin-right">
										<img src="pliki/ikony/edit/version.png" class="tsr-vertical-align-middle tsr-mr-10" title="Wersja aplikacji" alt="Wersja aplikacji" loading="lazy" />
										<span class="fs-60"><?php echo $all_work[$x]["wersja"]; ?></span>
									</span>
								</summary>
								<p class="fs-80 arads-work-description">
									<div class="tsr tsr-p-5px tsr-algin-justify">
										<img src="pliki/ikony/edit/description.png" class="tsr-vertical-align-middle tsr-mr-10" title="Opis" alt="opis" loading="lazy" />
										<?php echo $all_work[$x]["opis"]; ?>
									</div>
									<div class="tsr tsr-p-5px">
										<img src="pliki/ikony/edit/teamwork.png" class="tsr-vertical-align-middle tsr-mr-10" title="Praca Zespołowa" alt="Praca Zespołowa" loading="lazy" />
										<?php echo $all_work[$x]["osoby_pracuja"]; ?>
									</div>
								</p>
							</details>
						</section>
					</section>
					<?php
										$chec_work++;
									}
								}
							}
							if ($chec_work == 0){
					?>
								<section class="tsr-alert tsr-alert-info"><?php echo $error["sql_not_found"] ?></section>
					<?php
							}
							
						}else{
					?>
						<section class="tsr-alert tsr-alert-info"><?php echo $error["sql_not_found"] ?></section>
					<?php		
						}
					?>
				</section>		

					<?php  
						if ($chec_work != 0){
					?>
						<section class="tsr tsr-button tsr-normal tsr-mt-15 arads-work-save-wykonywane">
							<span><?php echo $error["save_data"]; ?></span>
						</section>					
					<?php
						}
					?>
				
			</section>
		</section>

		<section class="col-3 tsr-p-5px tsr-border-radius10px tsr-border-solid-green-2">
			<section class="tsr tsr-border-radius10px tsr-pt-10px tsr-pb-10px">	
				<section class="tsr tsr-border-bottom-solid-green-4">Dodaj Zadanie Do Sprawdzenia</section>	
				<section class="tsr tsr-mt-10 arads-work-do-sprawdzenia tsr-sortbox4">
									<?php 
						if ($all_work["num_rows"] != 0) {
							$chec_work = 0;
							for	($x = 0; $x < $all_work["num_rows"]; $x++) {
								
								$all_work_id_user_check = ($all_work[$x]["osoby_pracuja"] == "null" ? [1] : json_decode($all_work[$x]["osoby_pracuja"], true) );
								
								if(array_search($_SESSION['id'], $all_work_id_user_check) !== false) {
									if($all_work[$x]["status"] == "do_sprawdzenia") {
					?>
					<section class="tsr tsr-mt-10 tsr-p-5px tsr-border-bottom-dashed tsr-border-top-dashed background-white tsr-border-radius10px tsd arads-work tsr-sortiner" arads-work-id="<?php echo $all_work[$x]["id"]; ?>">
						<section class="tsr tsr-algin-left" arads-title-work="<?php echo $all_work[$x]["tytul"]; ?>">
							<img src="pliki/ikony/edit/drag.png" alt="X" title="przeciągni" class="cursor-grab tsr-mr-15 tsr-vertical-align-middle tsr-display-inline-block tsr-sort-handle" style="user-select: none; -webkit-user-drag: none;" /><span class="arads-work-title fs-70" style="line-height: 30px;"><?php echo $all_work[$x]["tytul"]; ?> </span> - <span class="<?php echo check_priorytet($all_work[$x]["priorytet"]); ?>"> <?php echo $all_work[$x]["priorytet"]; ?> </span> 
						</section>
						<section class="tsr tsr-algin-left">
							<details class="tsr-mt-15">
								<summary>
									Więcej 
									<span class="tsr-p-5px">
										<img src="pliki/ikony/edit/hourglass.png" class="tsr-vertical-align-middle tsr-mr-10" title="Termin funkcji" alt="Termin funkcji" loading="lazy" />
										<time datetime="<?php echo $all_work[$x]["data_odania"]; ?>" class="fs-60"><?php echo ceil((strtotime($all_work[$x]["data_odania"]) - time()) / (60 * 60 * 24)); ?> dni</time>
									</span>
									<span class="tsr-p-5px tsr-algin-right">
										<img src="pliki/ikony/edit/version.png" class="tsr-vertical-align-middle tsr-mr-10" title="Wersja aplikacji" alt="Wersja aplikacji" loading="lazy" />
										<span class="fs-60"><?php echo $all_work[$x]["wersja"]; ?></span>
									</span>
								</summary>
								<p class="fs-80 arads-work-description">
									<div class="tsr tsr-p-5px tsr-algin-justify">
										<img src="pliki/ikony/edit/description.png" class="tsr-vertical-align-middle tsr-mr-10" title="Opis" alt="opis" loading="lazy" />
										<?php echo $all_work[$x]["opis"]; ?>
									</div>
									<div class="tsr tsr-p-5px">
										<img src="pliki/ikony/edit/teamwork.png" class="tsr-vertical-align-middle tsr-mr-10" title="Praca Zespołowa" alt="Praca Zespołowa" loading="lazy" />
										<?php echo $all_work[$x]["osoby_pracuja"]; ?>
									</div>
								</p>
							</details>
						</section>
					</section>
					<?php
										$chec_work++;
									}
								}
							}
							if ($chec_work == 0){
					?>
								<section class="tsr-alert tsr-alert-info"><?php echo $error["sql_not_found"] ?></section>
					<?php
							}
							
						}else{
					?>
						<section class="tsr-alert tsr-alert-info"><?php echo $error["sql_not_found"] ?></section>
					<?php		
						}
					?>
				</section>		

					<?php  
						if ($chec_work != 0){
					?>
						<section class="tsr tsr-button tsr-normal tsr-mt-15 arads-work-save-do_sprawdzenia">
							<span><?php echo $error["save_data"]; ?></span>
						</section>					
					<?php
						}
					?>			
			</section>
		</section>
	
	</section>
	
	<script>
		$(document).ready(function() { 
		
			tsr_sortiner("tsr-data",".arads-work-do-wykonania, .arads-work-get-work, .arads-work-do-sprawdzenia",".tsr-sortiner",".tsr-sortitem",1,".tsr-sortbox4",false, 100);
			
			$(document).on("click", ".arads-work-save-do_sprawdzenia", function () {
				tsr_blocked_submit(1000, ".arads-work-save-do_sprawdzenia");
				
				tsr_ajax("insert/update/works-update.php", {
					"akcja": "do_sprawdzenia",
					"data": JSON.stringify(tsr_index(".arads-work-do-sprawdzenia", ".tsr-sortiner", "arads-work-id", ".tsr-sortitem", ".tsr-sort-handle", "text")),
					"app": <?php echo $arads_work_load; ?>
				}, '', false, function (t) {
					$(".arads-work-save-do_sprawdzenia").after(JSON.parse(t));
					$(".tsr-alert").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(1000).hide(500, function () { $(this).remove(); });
				}, function (e) {
					$(".arads-work-save-do_sprawdzenia").after('<section class="tsr-alert tsr-alert-error">Wystąpił Błąd pod czas ładowania strony!</section>');
					$(".tsr-alert").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(1000).hide(500, function () { $(this).remove(); });
				});
			})
			
			$(document).on("click", ".arads-work-save-wykonywane", function () {
				tsr_blocked_submit(1000, ".arads-work-save-wykonywane");
				
				tsr_ajax("insert/update/works-update.php", {
					"akcja": "wykonywane",
					"data": JSON.stringify(tsr_index(".arads-work-get-work", ".tsr-sortiner", "arads-work-id", ".tsr-sortitem", ".tsr-sort-handle", "text")),
					"app": <?php echo $arads_work_load; ?>
				}, '', false, function (t) {
					$(".arads-work-save-wykonywane").after(JSON.parse(t));
					$(".tsr-alert").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(1000).hide(500, function () { $(this).remove(); });
				}, function (e) {
					$(".arads-work-save-wykonywane").after('<section class="tsr-alert tsr-alert-error">Wystąpił Błąd pod czas ładowania strony!</section>');
					$(".tsr-alert").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(1000).hide(500, function () { $(this).remove(); });
				});
			})
		});
	</script>