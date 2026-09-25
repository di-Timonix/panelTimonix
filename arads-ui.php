<?php

	/* 
	
		Timonix Arads
		system zarządzania serwisami timonix.pl
		di_Timonix
		
		główne jądro aplikacji ui
	
	*/

?>

<!DOCTYPE html>
<html lang="PL-pl" class="tsr-load-content-page" timonix="dts_box">
<head>

	<title>ARADS - timonix</title>
	<link rel="stylesheet" href="files/css/arads-load-screan.css">
	<script src="files/js/arads-load-screan.js"></script>
	
	<?php 
		require_once "laduj/seo.php"; 
		require_once "laduj/css.php"; 
		require_once "laduj/js.php"; 
	 ?>

</head>
<body>

	<!-- load screan -->
	<div class="tload-screan">
		<span class="tload-title">ARADS - Panel Administracyjny timonix</span>
		<span class="tload-description">Ładowanie Kontentu</span>
	</div>

	<header class="tsr tsr-height-50px">
		<nav class="tsr-nav-menu tsr-position-fixed">
			<section class="col-ms90 tsr-width-65-1 tsr-float-left tsr-f0 tsr-fl tsr-algin-left">
				<span class="tsr-display-none-1  tsr-ml-10 tsr-mr-10  tsr-pt-10px">
					arads - panel administratora
				</span>
				<span class="tsr-display-inline-block-1 tsr-display-none  tsr-ml-10 tsr-mr-10 tsr-algin-center tsr-pt-10px tsr-width-35-1 ">
					arads
				</span>
				
				<div class="tsr-button-menu-left tsr-menu-left-button tsr-display-block-2 tsr-display-none" onclick="myFunction(this)">
					<div class="bar1"></div>
					<div class="bar2"></div>
					<div class="bar3"></div>
				</div>
				
				<div class="tsr-button-menu-mobile tsr-display-block-1 tsr-display-none tsr-float-right" onclick="myFunction(this)">
					<div class="bar1"></div>
					<div class="bar2"></div>
					<div class="bar3"></div>
				</div>
				
			</section>
			<section class="col-ms10 tsr-width-35-1">
			<?php //require_once "menu.php"; ?>
			<?php require_once "timonix_kontener_aplikacji.php"; ?>
			</section>
		</nav>
	</header>
	
	<?php require_once "menu-left.php"; ?>
	
	<?php ///require_once "menu-mobile.php"; ?>
	
	<main class="container-right">
		<section class="container tsr-p-10px">

			
				<!--<script type="text/javascript">
				function ChangeUrl(title, url) {
					if (typeof (history.pushState) != "undefined") {
						var obj = { Title: title, Url: url };
						history.pushState(obj, obj.Title, obj.Url);
					} else {
						alert("Browser does not support HTML5.");
					}
				}
				</script>
				<input type="button" value="Page1" onclick="ChangeUrl('Page1', 'Page1');" />
				<input type="button" value="Page2" onclick="ChangeUrl('Page2', 'Page2');" />
				<input type="button" value="Page3" onclick="ChangeUrl('Page3', 'Page3');" />



				<input type="button" class="tsr-zmiana-url" value="st1" tsr-url="st1" />
				<input type="button" class="tsr-zmiana-url" value="st2" tsr-url="st2" />
				<a href="at1" class="tsr-zmiana-aurl">at1</a>
				<a href="at2" class="tsr-zmiana-aurl">at2</a>-->
			
			<?php //require_once("laduj/ui/home.php"); ?>
				
				

			
		</section>
	</main>



	<?php require_once "stopka.php"; ?>

	<script>
	
	
	// var isOnline = window.navigator.onLine;
// if (isOnline) {
  // console.log('online');
// } else {
  // console.log('offline');
// }
	// console.log(window.navigator.onLine);
	
	 // var ifConnected = window.navigator.onLine;
    // if (ifConnected) {
      // document.getElementById("checkOnline").innerHTML = "Online";
      // document.getElementById("checkOnline").style.color = "green";
    // } else {
      // document.getElementById("checkOnline").innerHTML = "Offline";
      // document.getElementById("checkOnline").style.color = "red";
    // }
// setInterval(function(){ 
  // var ifConnected = window.navigator.onLine;
    // if (ifConnected) {
      // document.getElementById("checkOnline").innerHTML = "Online";
      // document.getElementById("checkOnline").style.color = "green";
    // } else {
      // document.getElementById("checkOnline").innerHTML = "Offline";
      // document.getElementById("checkOnline").style.color = "red";
    // }
 // }, 1000);
 
	// document.getElementById("checkOnline").innerHTML = "Online";
    // document.getElementById("checkOnline").style.color = "green";
	</script>	
	
</body>
</html>