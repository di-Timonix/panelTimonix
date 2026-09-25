<?php

	/* 
	
		Timonix Arads
		system zarządzania serwisami timonix.pl
		di_Timonix
		
		zarządzanie czasem pracy
	
	*/
	
	// ładowanie rdzenia arads
	require_once("arads.php");

?>

	<section class="tsr background-white tsr-p-5px tsr-border-radius10px">
		<section class="tsr">
			Status Pracy ARADS
		</section>
	</section>

	<section class="tsr background-white tsr-p-5px tsr-border-radius10px  tsr-mt-10">
		<section class="col-3 tsr-text-algin-left tsr-algin-left tsr-p-5px">
			<p>Status pracy</p>
			
			<section class="tsr tsr-mt-10 tsr-border-radius5px background-black white tsr-p-10px tsr-algin-center cursor-pointer arads-job-status tsr-pmodal">
				brak danych
				<section class="tsr-modal" tsr-modal-close="true">
					<section class="tsr">
						<span class="fs-110">Zmiana Statusu Pracy</span>
						
						<form accept-charset="UTF-8" action="" method="post" id="edit_job_status_option" autocomplete="off">	
		
							<section class="tsr">
								<select name="job-status-change" class="">
									<option value="zakończ_prace">Zakończ Pracę</option>
									<option value="zacznij_prace">Zacznij Pracę</option>
									<option value="zrezygnuj_zpracy">Zrezygnuj z Pracy</option>
								</select>	
							</section>	

							<section class="tsr tsr-inp tsr-mt-50">
								<button type="submit" class="input buttom" id="job_status_submit">Zapisz</button>
							</section>	
							
							<section class="tsr">
								<div class="contajner_post"></div>
							</section>			
						
						</form>	
					</section>
				</section>
			</section>
		</section>
	</section>
	
	<section class="tsr background-white tsr-p-5px tsr-border-radius10px tsr-mt-10">
		<section class="col-3 tsr-text-algin-left tsr-algin-left tsr-p-5px">
			<a href="https://tkonto.timonix.pl/dane-osobowehttps://tkonto.timonix.pl/dane-osobowe" target="_blank"> Zmiana hasła </a>
		</section>
		<section class="col-3 tsr-text-algin-left tsr-algin-left tsr-p-5px">
			<a href="" target="_blank">  </a>
		</section>
		<section class="col-3 tsr-text-algin-left tsr-algin-left tsr-p-5px">
			<a href="https://tkonto.timonix.pl/?arg=profails&wpt=timonix_app_c_manifest&connect=https://arads.timonix.pl/" target="_blank"> Profil Timonix.pl </a>
		</section>
	</section>
	
	<script>
		$(document).ready(function () {
			arads_panel();
			arads_job_status();
		});
	</script>