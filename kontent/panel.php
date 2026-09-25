<?php

	/* 
	
		Timonix Arads
		system zarządzania serwisami timonix.pl
		di_Timonix
		
		główny panel arads
	
	*/
	
	// ładowanie rdzenia arads
	require_once("arads.php");
	
	require_once("laduj/aplikacja.php");

?>

	<section class="tsr background-white tsr-p-5px tsr-border-radius10px">
		<section class="col-3 tsr-text-algin-left tsr-algin-left tsr-p-5px">
			<p>Profil</p>
			<h1><?php echo $_SESSION["nick"]; ?></h1>
			<section class="avatar tsr-border-radius10px"><img src="<?php echo $_SESSION["avatar"]; ?>" alt="<?php echo $_SESSION["nick"]; ?>" title="<?php echo $_SESSION["nick"]; ?>" class="tsr-border-radius10px" load="lazly" /></section>
		</section>
		<section class="col-3 tsr-text-algin-left tsr-algin-left tsr-p-5px">
			<p>Stanowisko i zespuł</p>
			<section class="tsr stanowiskoizespol">
				<section class="tsr-alert tsr-alert-info"> Brak danych </section>
			</section>
		</section>
		<section class="col-3 tsr-text-algin-left tsr-algin-left tsr-p-5px">
			<p>Zadanie</p>
			<section class="tsr panelzadanie fs-90">
				<section class="tsr-alert tsr-alert-info"> Brak zadań! </section>
			</section>
		</section>
	</section>
	
	<section class="tsr background-white tsr-p-5px tsr-mt-10 tsr-border-dotted-all tsr-border-radius10px">
		<section class="tsr">
			<span class="fs-110 tsr-algin-left tsr-fr">Strefy Czasowe</span>
		</section>
		<section class="tsr tsr-mt-10">
			<section class="col-4 tsr-p-5px">
				<section class="tsr background-orange background-white-hover tsr-border-radius10px">
					<span class="tsr fs-90 ">Warszawa</span>
					<span class="tsr fs-130 time-update-warsaw">19:40</span>
				</section>	
			</section>
			<section class="col-4 tsr-p-5px">
				<section class="tsr  background-teal white black-hover background-white-hover tsr-border-radius10px">
					<span class="tsr fs-90 ">Nowy Jork</span>
					<span class="tsr fs-130 time-update-new-york">19:40</span>
				</section>	
			</section>
			<section class="col-4 tsr-p-5px">
				<section class="tsr background-orange background-white-hover tsr-border-radius10px">
					<span class="tsr fs-90 ">Londyn</span>
					<span class="tsr fs-130 time-update-london">19:40</span>
				</section>
			</section>
			<section class="col-4 tsr-p-5px">
				<section class="tsr background-teal white black-hover background-white-hover tsr-border-radius10px">
					<span class="tsr fs-90 ">Tokio</span>
					<span class="tsr fs-130 time-update-tokyo">19:40</span>
				</section>
			</section>
		</section>
	</section>
	
	<section class="tsr background-white tsr-p-5px tsr-mt-10 tsr-border-radius10px">
		<section class="tsr">
			<span class="fs-110 tsr-algin-left tsr-fl">Powiadomienia</span>
		</section>
		<section class="tsr tsr-mt-10">
			<section class="tsr-alert tsr-alert-info"> Brak Powiadomień! </section>
		</section>
	</section>
	
	<section class="tsr background-white tsr-p-5px tsr-mt-10 tsr-border-radius10px">
		<section class="tsr">
			<span class="fs-110 tsr-algin-left tsr-fl">Informacje</span>
		</section>
		<section class="tsr tsr-mt-10">
			<section class="tsr-alert tsr-alert-warning"> Brak informacji! </section>
		</section>
	</section>
	
	<script>
		$(document).ready(function () {
			time_zone("pl-PL", "Europe/Warsaw", ".time-update-warsaw");
			time_zone("pl-PL", "America/New_York", ".time-update-new-york");
			time_zone("pl-PL", "Europe/London", ".time-update-london");
			time_zone("pl-PL", "Asia/Tokyo", ".time-update-tokyo");
			arads_panel();
		});
	</script>