<?php

	/* 
	
		Timonix Arads
		system zarządzania serwisami timonix.pl
		di_Timonix
		
		wszystkie pliki timonix.pl
	
	*/
	
	// ładowanie rdzenia arads
	require_once("arads.php");
	
	$all_aplication = $db->query("SELECT * FROM `arads_data_center`");

?>

	<section class="tsr background-white tsr-p-5px tsr-border-radius10px">
		Data Center
	</section>
	
	<section class="tsr tsr-display-flex tsr-flex-wrap tsr-justify-content-space-between tsr-mt-10" style="flex-wrap: wrap; justify-content: space-between; gap: 15px; column-gap: 15px; ">
	
		<?php  
			
			for	($i = 0; $i < $all_aplication["num_rows"]; $i++) {
			
				$ipv4 = json_decode($all_aplication[$i]["zakres_ipv4"], true);
				$ipv4_count = 0;
				if(!is_array($ipv4)){
					$ipv4 = null;
				}else{
					$ipv4_count = count($ipv4);
				}
				
				$ipv6 = json_decode($all_aplication[$i]["zakres_ipv6"], true);
				$ipv6_count = 0;
				if(!is_array($ipv6)){
					$ipv6 = null;
				}else{
					$ipv6_count = count($ipv6);
				}
				
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
				<section class="tsr tsr-p-5px tsr-mt-10">
					<div class="tsr tsr-algin-left fs-120">
						<span><?php echo $all_aplication[$i]["nazwa_skrocona"]; ?></span>
					</div>
					<div class="tsr tsr-algin-left fs-70">
						<span><?php echo $all_aplication[$i]["nazwa"]; ?></span>
					</div>
					<div class="tsr tsr-algin-left fs-90 <?php echo $bac; ?> tsr-mt-5 tsr-mb-5 tsr-p-5px">
						<span class="">Status: <?php echo $all_aplication[$i]["status"]; ?></span>
					</div>
					
					<div class="tsr tsr-border-bottom-dashed-black tsr-p-5px"></div>
					
					<div class="tsr tsr-algin-left fs-80">
						<span>Dyrektor DataCenter: <?php echo $all_aplication[$i]["dyrektor"]; ?></span>
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
											<span class="tsr-mr-20 fs-80">Zespół:</span>
											<span><?php echo $all_aplication[$i]["zespol"]; ?></span>
										</div>
										<div class="tsr tsr-algin-left">
											<span class="tsr-mr-20 fs-80">DataCenter w kraju:</span>
											<span><?php echo $all_aplication[$i]["kraj"]; ?></span>
										</div>
										<div class="tsr tsr-algin-left">
											<span class="tsr-mr-20 fs-80">DataCenter dokładny adres:</span>
											<span><?php echo $all_aplication[$i]["adres"]; ?></span>
										</div>
										<div class="tsr tsr-algin-left">
											<span class="tsr-mr-20 fs-80">Opis:</span>
											<span><?php echo $all_aplication[$i]["opis"]; ?></span>
										</div>
									</div>
									
								</section>
							</section>
						</span> 
						
						<span class="tsr-button tsr-info tsr-pmodal">Zdalny dostęp
							<section class="tsr-modal" tsr-modal-close="true">
								<section class="tsr">
									<span class="fs-110">Wszystkie Szczegóły</span>
									
									<div class="tsr tsr-mt-20">
										<?php if($all_aplication[$i]["zakres_ipv4"] != "null"){ 
											for($x = 0; $x < $ipv4_count; $x++){
										?>									
										<div class="tsr tsr-algin-left">
											<span class="tsr-mr-20 fs-80">ipv4:</span>
											<span><?php echo $ipv4[$x]; ?></span>
										</div>
										<?php
											}
											}else{ ?>
											<section class="tsr-alert tsr-alert-error"><?php echo $error["ip"]["v4"]["not_found"] ?></section>
										<?php }?>
										<?php if($all_aplication[$i]["zakres_ipv6"] != "null"){ 
											for($x = 0; $x < $ipv4_count; $x++){
										?>										
										<div class="tsr tsr-algin-left">
											<span class="tsr-mr-20 fs-80">ipv6:</span>
											<span><?php echo $ipv6[$x]; ?></span>
										</div>
										<?php
											}
											}else{ ?>
										<section class="tsr-alert tsr-alert-error"><?php echo $error["ip"]["v6"]["not_found"] ?></section>
										<?php }?>										
									</div>
									
								</section>
							</section>
						</span> 

						<span class="tsr-button tsr-normal"><a href="all-servers?t=t-0" class="tsr-zmiana-aurl">Serwery</a></span>
						
						<span class="tsr-button tsr-normal tsr-pmodal">Zasoby Serwerowni
							<section class="tsr-modal" tsr-modal-close="true">
								<section class="tsr">
									<span class="fs-110">Wszystkie Szczegóły</span>
									
									<div class="tsr tsr-mt-20">
										<?php if($all_aplication[$i]["zasoby"] != "null") { ?>
										<div class="tsr tsr-algin-left">
											<span class="tsr-mr-20 fs-80">Nazwa:</span>
											<span><?php echo $all_aplication[$i]["zasoby"]; ?></span>
										</div>
										<?php }else{ ?>
											<section class="tsr-alert tsr-alert-error"><?php echo $error["sql_not_found"] ?></section>
										<?php } ?>
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
						
					</div>
				</section>
			</section>
		</section>

		<?php 
		
			}
			
		?>