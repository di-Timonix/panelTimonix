<?php

	/* 
	
		Timonix Arads
		system zarządzania serwisami timonix.pl
		di_Timonix
		
		wszystkie pliki timonix.pl
	
	*/
	
	// ładowanie rdzenia arads
	require_once("arads.php");
	
	$all_aplication = $db->query("SELECT * FROM `arads_aplikacja` WHERE `status_projekt` = ('wydany' OR 'public' OR 'publiczny') AND `dostep` LIKE 'all'");

?>

	<section class="tsr background-white tsr-p-5px tsr-border-radius10px">
		arads
	</section>
	
	<section class="tsr tsr-display-flex tsr-flex-wrap tsr-justify-content-space-between tsr-mt-10" style="flex-wrap: wrap; justify-content: space-between; gap: 15px; column-gap: 15px; ">
	
		<?php  
			
			for	($i = 0; $i < $all_aplication["num_rows"]; $i++) {
				
				// formatowanie odpowiednio kolorów
				if ($all_aplication[$i]["status"] == "online") {
					$bac = "background-green";
				}elseif (($all_aplication[$i]["status"] == "atak") OR ($all_aplication[$i]["status"] == "problem")) {
					$bac = "background-orange";
				}else{
					$bac = "background-red";
				} 
			
		?>
		
		<section class="col-fl-30 col-fl-50-2 col-fl-100-1 arads-lyout">
			<section class="tsr background-white tsr-border-radius10px">
				<section class="tsr"> 
					<img src="<?php echo $all_aplication[$i]["logo"]; ?>" alt="logo" class="tsr-border-radius10px arads-lyout-img" loading="lazy" />
				</section>
				<section class="tsr tsr-p-5px tsr-mt-10">
					<div class="tsr tsr-algin-left fs-120">
						<span><?php echo $all_aplication[$i]["nazwa"]; ?></span>
					</div>
					<div class="tsr tsr-algin-left fs-60">
						<span>Wersja: <?php echo $all_aplication[$i]["wersja"]; ?></span><span class="tsr-algin-right tsr-fr">Wersja Dev: <?php echo $all_aplication[$i]["wersja_deweloperska"]; ?></span>
					</div>
					<div class="tsr tsr-algin-left fs-90 <?php echo $bac; ?> tsr-mt-5 tsr-mb-5 tsr-p-5px">
						<span class="">Status: <?php echo $all_aplication[$i]["status"]; ?></span>
					</div>
					<div class="tsr tsr-algin-left fs-90 tsr-algin-center">
						<a href="<?php echo $all_aplication[$i]["www"]; ?>">Strona www</a>
					</div>
					
					<div class="tsr tsr-border-bottom-dashed-black tsr-p-5px"></div>
					
					<div class="tsr tsr-algin-left fs-90 tsr-algin-center">
						<a href="<?php echo $all_aplication[$i]["www_deweloper"]; ?>">Strona Dev</a>
					</div>
					<div class="tsr tsr-algin-left fs-80">
						<span>Dyrektor projektu: <?php echo $all_aplication[$i]["dyrektor"]; ?></span>
					</div>
					<div class="tsr tsr-algin-left fs-100">
						<details>
							<summary>Opis</summary>
							<p class="fs-80"><?php echo $all_aplication[$i]["opis"]; ?></p>
						</details>
					</div>
					<div class="tsr tsr-algin-left fs-80 tsr-mt-10">
						<span class="tsr-button tsr-normal tsr-pmodal">Szczegóły
							<section class="tsr-modal" tsr-modal-close="true">
								<section class="tsr">
									<span class="fs-110">Wszystkie Szczegóły</span>
									
									<div class="tsr tsr-mt-20">
										<div class="tsr tsr-algin-left">
											<span class="tsr-mr-20 fs-80">Nazwa:</span>
											<span><?php echo $all_aplication[$i]["nazwa"]; ?></span>
										</div>
										<div class="tsr tsr-algin-left">
											<span class="tsr-mr-20 fs-80">Nazwa Produkcyjna:</span>
											<span><?php echo $all_aplication[$i]["nazwa_produkcyjna"]; ?></span>
										</div>
										<div class="tsr tsr-algin-left">
											<span class="tsr-mr-20 fs-80">Dostęp od wieku:</span>
											<span>
												<?php 
													if ($all_aplication[$i]["wiek"] == 127) {
														echo "Każdego";
													}else{
														echo $all_aplication[$i]["wiek"] . " lat";
													}
												?>
											</span>
										</div>
										<div class="tsr tsr-algin-left">
											<span class="tsr-mr-20 fs-80">Zespół:</span>
											<span><?php echo $all_aplication[$i]["zespol"]; ?></span>
										</div>
										<div class="tsr tsr-algin-left">
											<span class="tsr-mr-20 fs-80">Dostęp w kraju:</span>
											<span><?php echo json_decode($all_aplication[$i]["kraj_jezyk"], true)[0]["kraj"]; ?></span>
										</div>
										<div class="tsr tsr-algin-left">
											<span class="tsr-mr-20 fs-80">Dostępne języki:</span>
											<span><?php echo json_decode($all_aplication[$i]["kraj_jezyk"], true)[0]["jezyk"]; ?></span>
										</div>
										<div class="tsr tsr-algin-left">
											<span class="tsr-mr-20 fs-80">Data Dodania:</span>
											<datetime><?php echo $all_aplication[$i]["datetime_dodania"]; ?></datetime>
										</div>
										<div class="tsr tsr-algin-left">
											<span class="tsr-mr-20 fs-80">Data Aktulizacji:</span>
											<datetime><?php echo $all_aplication[$i]["datetime_aktulizacji"]; ?></datetime>
										</div>
										<div class="tsr tsr-algin-left">
											<span class="tsr-mr-20 fs-80">Opis:</span>
											<span><?php echo $all_aplication[$i]["opis"]; ?></span>
										</div>
									</div>
									
								</section>
							</section>
						</span> 
						
						<?php 
							if (($all_aplication[$i]["dyrektor"] === $_SESSION["nick"]) || ($_SESSION["ranga"] === "właśćiciel") || ($_SESSION["flaga"] >= 30 && $_SESSION["flaga"] <= 35) ) {
						?>
						<span class="tsr-button tsr-info">Zarządzaj</span>
						<?php
							}
						?>
						
						<?php 
							if ( ($_SESSION["ranga"] == "właśćiciel") OR ($_SESSION["flaga"] >= 30 && $_SESSION["flaga"] <= 35) ) {
						?>
						<span class="tsr-button tsr-error">Usuń</span>
						<?php
							}
						?>
						
					</div>
				</section>
			</section>
		</section>

		<?php 
		
			}
			
		?>