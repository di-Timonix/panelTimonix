<?php

	/* 
	
		Timonix Arads
		system zarządzania serwisami timonix.pl
		di_Timonix
		
		główny profil panelu arads 
	
	*/
	
	// ładowanie rdzenia arads
	require_once("arads.php");

?>

	<section class="tsr background-white tsr-p-5px tsr-border-radius10px">
		<section class="tsr">
			Profil Użytkownika ARADS
		</section>
	</section>

	<section class="tsr background-white tsr-p-5px tsr-border-radius10px  tsr-mt-10">
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
		});
	</script>