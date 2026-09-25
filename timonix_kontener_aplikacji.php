<?php
/*
	tac ,,timonix aplication container''  Został stworzony przez di_Timonix'a
	
	timonix_kontener_aplikacji.php
	
	plik: ładowanie 2 kolumn 1 z avatarem i sesiami logowania 2 z wszystkimi aplikacjami timonix.pl
	
	tac,
	
	#plik: 1.0
*/
	
	
?>

	<section class="timonix-aplication-container tsr-fr <?php if($tt_timonix_session_status == false){ echo"tsr-width-auto tsr-mr-15"; } ?>">
		<section class="timonix-aplication-container-content" title="Usługi Timonix.pl">
			<section class="tsr tsr-phide">
				<section class="tsr timonix-aplication-box-navigation tsr-height-50px tsr-width-50px tsr-p-5px" role="timonix-aplication-box-navigation">
					<section class="col-3 timonix-aplication-box tsr-width-10px tsr-height-10px">
						<section class="timonix-aplication-box-item tsr-width-100 tsr-height-100 background-gray">
							
						</section>
					</section>
					<section class="col-3 timonix-aplication-box tsr-width-10px tsr-height-10px">
						<section class="timonix-aplication-box-item tsr-width-100 tsr-height-100 background-gray">
							
						</section>
					</section>
					<section class="col-3 timonix-aplication-box tsr-width-10px tsr-height-10px">
						<section class="timonix-aplication-box-item tsr-width-100 tsr-height-100 background-gray">
							
						</section>
					</section>
					<section class="col-3 timonix-aplication-box tsr-width-10px tsr-height-10px">
						<section class="timonix-aplication-box-item tsr-width-100 tsr-height-100 background-gray">
							
						</section>
					</section>
					<section class="col-3 timonix-aplication-box tsr-width-10px tsr-height-10px">
						<section class="timonix-aplication-box-item tsr-width-100 tsr-height-100 background-gray">
							
						</section>
					</section>
					<section class="col-3 timonix-aplication-box tsr-width-10px tsr-height-10px">
						<section class="timonix-aplication-box-item tsr-width-100 tsr-height-100 background-gray">
							
						</section>
					</section>
					<section class="col-3 timonix-aplication-box tsr-width-10px tsr-height-10px">
						<section class="timonix-aplication-box-item tsr-width-100 tsr-height-100 background-gray">
							
						</section>
					</section>
					<section class="col-3 timonix-aplication-box tsr-width-10px tsr-height-10px">
						<section class="timonix-aplication-box-item tsr-width-100 tsr-height-100 background-gray">
							
						</section>
					</section>
					<section class="col-3 timonix-aplication-box tsr-width-10px tsr-height-10px">
						<section class="timonix-aplication-box-item tsr-width-100 tsr-height-100 background-gray">
							
						</section>
					</section>
					<!--<section class="col-3 timonix-aplication-box-item">
						.
					</section><section class="col-3 timonix-aplication-box-item">
						.
					</section><section class="col-3 timonix-aplication-box-item">
						.
					</section><section class="col-3 timonix-aplication-box-item">
						.
					</section><section class="col-3 timonix-aplication-box-item">
						.
					</section><section class="col-3 timonix-aplication-box-item">
						.
					</section><section class="col-3 timonix-aplication-box-item">
						.
					</section><section class="col-3 timonix-aplication-box-item">
						.
					</section><section class="col-3 timonix-aplication-box-item">
						.
					</section>-->
				</section>
				<section class="tsr timonix-aplication-box-content tsr-display-none tsr-hide tsr-height-auto" role="gird" tsr-content-margin-top="55" tsr-content-margin="15">
					<section class="tsr timonix-aplication-box-content-over" role="gird">
					<?php 
						if($tt_timonix_session_status == false){
					?>
						<section class="timonix-aplication-box-content-item">
							<a href="https://konto.timonix.pl/?arg=ssh_ddo_pd&v_nert=6e5r4g65e4r6g465g41ws6tr49q64er94wrt94ety9ulk4r698yu464tr6j4t6yk46y4646ttttttt1244444t66df514sd65r4y6saeddd&wpt=timonix_app_c_manifest&connect=https://timonix.pl/" class="tsr-click">
								<section class="timonix-aplication-box-content-item-img tsr-border-radius15" tsr-tooltip="bottom" tsr-tooltip-content="static" tsr-tooltip-text="pre <br  /> define" >
									<img src="https://timonix.pl/pliki/ikony/avatar/avatar.png" title="Zaloguj Się!" alt="konto" class="tsr-border-radius15" >
								</section>
								<section class="tsr timonix-aplication-box-content-item-text">
									konto
								</section>
							</a>
						</section>
					<?php
						}else{
					?>						
						<section class="timonix-aplication-box-content-item">
							<a href="https://tkonto.timonix.pl/?arg=profails&wpt=timonix_app_c_manifest&connect=https://timonix.pl/" class="tsr-click">
								<section class="timonix-aplication-box-content-item-img tsr-border-radius15" tsr-tooltip="bottom" tsr-tooltip-content="static" tsr-tooltip-text="pre <br  /> define" >
									<img src="<?php echo $_SESSION['avatar'];?>" title="<?php echo $_SESSION['nick']; ?>" alt="tkonto" class="tsr-border-radius15" >
								</section>
								<section class="tsr timonix-aplication-box-content-item-text">
									tkonto
								</section>
							</a>
						</section>
					<?php
						}
					?>
					</section>
				</section>
			</section>
		</section>

		<?php 
			if($tt_timonix_session_status == false){
		?>
		<section class="tsr-button tsr-normal">
			<a href="https://konto.timonix.pl/?arg=ssh_ddo_pd&v_nert=6e5r4g65e4r6g465g41ws6tr49q64er94wrt94ety9ulk4r698yu464tr6j4t6yk46y4646ttttttt1244444t66df514sd65r4y6saeddd&wpt=timonix_app_c_manifest&connect=https://timonix.pl/"> 
				Zaloguj Się!
			</a>
		</section>
		<?php
			}else{
		?>
		<section class="timonix-aplication-container-content" title="Tkonto">
			<section class="menu-avatar-container tsr-phide" tsr-phide="true" tsr-content="tsr">
				<section class="tsr-avatar tsr-border-radius15 menu-avatar img" tsr-tooltip="bottom" tsr-tooltip-content="static" tsr-tooltip-text="pre <br  /> define" >
					<img src="<?php echo $_SESSION['avatar'];?>" title="<?php echo $_SESSION['nick']; ?>" alt="" >
				</section>
				<section class="tsr menu-avatar-container-content tsr-display-none tsr-hide tsr-height-auto" tsr-hide="true" tsr-content="auto" tsr-content-margin="10" tsr-content-margin-left="10" tsr-content-margin-top="55" tsr-content-margin-right="15" tsr-content-margin-bottom="10">
					<section class="tsr menu-avatar-container-content-over" title="">
						<section class="tsr-avatar-big tsr-border-radius15 menu-avatar img" tsr-tooltip="bottom" tsr-tooltip-content="static" tsr-tooltip-text="pre <br  /> define" >
							<img src="<?php echo $_SESSION['avatar'];?>" title="<?php echo $_SESSION['nick']; ?>" alt="avatar" >
						</section>
						<span class="tsr fs-70"><?php echo $_SESSION['imie'] ." ". $_SESSION['nick'] ." ". $_SESSION['nazwisko'];?></span>
						<span class="tsr fs-70"><?php echo $_SESSION['email'];?></span>
						<section class="tsr tsr-border-groove1-bottom tsr-mt-10 tsr-mb-10"></section>
						<!--<section class="tsr tsr-p-10px"> // tymczasowo wyłączone dopuki nie skończę panelu usera
							<a href="https://tkonto.timonix.pl/?&arg=ssh_pdo_rp3&r=false&t=app_r&sol=3s5e41r653h14sr61ths65rt1h65s14rt65h4s16rt1hs65rt1h564s&l=pl" class="tsr-click">
								<section class="tsr-button">Zarządzaj Kontem</section>
							</a>
							<!--<a href="https://konto.timonix.pl/?arg=ssh_ddo_pd&v_nert=6e5r4g65e4r6g465g41ws6tr49q64er94wrt94ety9ulk4r698yu464tr6j4t6yk46y4646ttttttt1244444t66df514sd65r4y6saeddd&wpt=timonix_app_c_manifest&connect=https://timonix.pl/">
								<section class="tsr-button">Zaloguj Się!</section>
							</a>-->
						<!--</section>
						<section class="tsr tsr-border-groove1-bottom tsr-mt-5 tsr-mb-5"></section>-->
						<section class="tsr tsr-p-10px">
							<a href="https://konto.timonix.pl/?st=timonix_out&r=false&adder=sdf654gs65dt4h6ws4t6hw6srth6w46th4w65rt4h65w4r65th4w65rt46wr4t6w5r4h968w4rt&adder_eeeprom=sdf654gae56r4g5awer46h461rt65he4rt6he6rt416h41r6t41e65t1r465he465th46e5j5e4t6yje4ty6j41e6t5yj4e65tyh4w65rt46wr4t6w5r4h968w4rt" class="tsr-click">
								<section class="tsr-button">Wyloguj</section>
							</a>
						</section>
						<!--<section class="tsr tsr-border-groove1-bottom tsr-mt-10 tsr-mb-10 fs-60"></section>
						<section class="tsr tsr-p-10px fs-60">
							<a href="Polityka prywatnośći">
								<span class="tsr fs-70">Polityka prywatnośći</span>
							</a>
							<a href="warunki korzystania z usług">
								<span class="tsr fs-70">warunki korzystania z usług</span>
							</a>
						</section>-->
					</section>
				</section>
			</section>
		</section>
		<?php }; ?>

	</section>