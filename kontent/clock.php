<?php

	/* 
	
		Timonix Arads
		system zarządzania serwisami timonix.pl
		di_Timonix
		
		strona pokazuje czas w danych lokalizacjiach
	
	*/
	
	// ładowanie rdzenia arads
	require_once("arads.php");

?>

	<section class="tsr background-white tsr-p-5px tsr-border-radius10px">
		<section class="col-2 tsr-p-5px">
			<label for="atime_zone">Strefa Czasowa</label>
			<input list="time_zone" name="atime_zone" id="atime_zone">
			<datalist id="time_zone">
				<option value="Europe/Warsaw" select>
				<option value="America/New_York">
				<option value="Europe/London">
				<option value="Asia/Tokyo">
			</datalist>
		</section>
		<section class="col-2 tsr-p-5px">
		<label for="alang_zone">język wyświetlany</label>
			<input list="lang_zone" name="alang_zone" id="alang_zone">
			<datalist id="lang_zone">
				<option value="pl-PL" select>
				<option value="en-US">
			</datalist>
		</section>
	</section>
	
	<section class="tsr background-white tsr-p-5px tsr-mt-10 tsr-border-dotted-all tsr-border-radius10px tsr-display-none load-search-zone">
		<section class="tsr">
			<span class="fs-110 tsr-algin-left tsr-fr">Szukane Strefy Czasowe</span>
		</section>
		<section class="tsr tsr-mt-10 load-search-zone-add">
			
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

	<section class="tsr background-white tsr-p-5px tsr-mt-10 tsr-border-dotted-all tsr-border-radius10px">
		<section class="tsr">
			<span class="fs-110 tsr-algin-left tsr-fr">Wszystkie Strefy Czasowe</span>
		</section>
		<section class="tsr tsr-mt-10 load-time-data">
			<section class="tsr-alert tsr-alert-info"><span>Ładowanie danych!</span><section>
		</section>
	</section>
	
	<script>
		time_zone("pl-PL", "Europe/Warsaw", ".time-update-warsaw");
		time_zone("pl-PL", "America/New_York", ".time-update-new-york");
		time_zone("pl-PL", "Europe/London", ".time-update-london");
		time_zone("pl-PL", "Asia/Tokyo", ".time-update-tokyo");
		
		arads_cache({arads_cache: {load: "time_zone"}}, 2*24, function(t) {
			
			let tz = t,
				tzl = tz.length;
				console.log(tz);
			for (let i = 0; i < tzl; i++) { 
				$("#time_zone").append('<option value="'+ tz[i] +'" />');
				console.log(tz[i]);
			}
			
			generate_time_zone();
		});
		arads_cache({arads_cache: {load: "lang_time_zone"}}, 2*24, function(t) {
			let tz = t,
				tzl = tz.length;
				console.log(tz);
			for (let i = 0; i < tzl; i++) { 
				$("#lang_zone").append('<option value="'+ tz[i] +'" />');
				console.log(tz[i]);
			}
		});
		
		function generate_time_zone (s = null,l = "pl-PL", t = "Europe/Warsaw") {
			if (localStorage.getItem("time_zone")) {
				let at  = JSON.parse(localStorage.getItem("time_zone")),
					iat = at.length;
					
				if (iat != 0) {	
					$(document).find(".load-time-data").html("");
					
					for (let i = 0; i < iat; i++) {
						if (i % 2) {
							$(".load-time-data").append('<section class="col-4 tsr-p-5px"> <section class="tsr  background-orange black-hover background-white-hover tsr-border-radius10px"> <span class="tsr fs-90 ">'
							+ (at[i].split("/").length == 3 ? at[i].split("/")[1] + "/" + at[i].split("/")[2] : at[i].split("/")[1]) +'</span> <span class="tsr fs-130 time-update-'+ at[i].split("/")[1] +'">00:00</span> </section>	</section>');
							let ax1 = time_zone("pl-PL", at[i], ".time-update-"+ at[i].split("/")[1]);
							if (!ax1) {
								$(document).find(".load-time-data").before('<section class="tsr-alert tsr-alert-error"> Wystąpił błąd pod czas generowania danych </section>');
								$(".tsr-alert").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(1000).hide(500, function () { $(this).remove(); });
							}
						}else{
							$(".load-time-data").append('<section class="col-4 tsr-p-5px"> <section class="tsr  background-teal white black-hover background-white-hover tsr-border-radius10px"> <span class="tsr fs-90 ">'+ (at[i].split("/").length == 3 ? at[i].split("/")[1] + "/" + at[i].split("/")[2] : at[i].split("/")[1]) +'</span> <span class="tsr fs-130 time-update-'+ at[i].split("/")[1] +'">00:00</span> </section>	</section>');
							let ax1 = time_zone("pl-PL", at[i], ".time-update-"+ at[i].split("/")[1]);
							if (!ax1) {
								$(document).find(".load-time-data").before('<section class="tsr-alert tsr-alert-error"> Wystąpił błąd pod czas generowania danych </section>');
								$(".tsr-alert").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(1000).hide(500, function () { $(this).remove(); });
							}
						}
					}
				}else{
					$(document).find(".load-time-data").html("").before('<section class="tsr-alert tsr-alert-error"> Wystąpił błąd pod czas generowania danych </section>');
					$(".tsr-alert").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(1000).hide(500, function () { $(this).remove(); });
				}
			}else{
				$(".load-time-data").html('<section class="tsr-alert tsr-alert-error"><span>Błąd pod czas ładowania danych!</span><section>');
			}			
		}
		
		generate_time_zone();
		
		var generate_this_time_zone_i = 1;
		
		function generate_this_time_zone(l = "pl-PL", t = "Europe/Warsaw") {
			if (generate_this_time_zone_i % 2) {
				$(".load-search-zone-add").append('<section class="col-4 tsr-p-5px"> <section class="tsr  background-orange black-hover background-white-hover tsr-border-radius10px"> <span class="tsr fs-90 ">'
				+ (t.split("/").length == 3 ? t.split("/")[1] + "/" + t.split("/")[2] : t.split("/")[1]) +'</span> <span class="tsr fs-130 time-update-'+ t.split("/")[1] +'">00:00</span> </section>	</section>');
				let ax1 = time_zone(l, t, ".this_time-update-"+ t.split("/")[1]);
				if (!ax1) {
					$(document).find(".load-search-zone-add").before('<section class="tsr-alert tsr-alert-error"> Wystąpił błąd pod czas generowania danych </section>');
					$(".tsr-alert").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(1000).hide(500, function () { $(this).remove(); $(document.getElementsByClassName("load-search-zone")[0]).addClass("tsr-display-none");});
				}
			}else{
				$(".load-search-zone-add").append('<section class="col-4 tsr-p-5px"> <section class="tsr  background-teal white black-hover background-white-hover tsr-border-radius10px"> <span class="tsr fs-90 ">'+ (t.split("/").length == 3 ? t.split("/")[1] + "/" + t.split("/")[2] : t.split("/")[1]) +'</span> <span class="tsr fs-130 time-update-'+ t.split("/")[1] +'">00:00</span> </section>	</section>');
				let ax1 = time_zone(l, t, ".this_time-update-"+ t.split("/")[1]);
				if (!ax1) {
					$(document).find(".load-search-zone-add").before('<section class="tsr-alert tsr-alert-error"> Wystąpił błąd pod czas generowania danych </section>');
					$(".tsr-alert").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(1000).hide(500, function () { $(this).remove(); $(document.getElementsByClassName("load-search-zone")[0]).addClass("tsr-display-none");});
				}
			}
			
			generate_this_time_zone_i++;
		}
		
		document.getElementsByName("atime_zone")[0].addEventListener("change", () => {
			let ai = document.getElementsByName("alang_zone")[0].value,
				si = document.getElementsByName("atime_zone")[0].value;
			
			$(document.getElementsByClassName("load-search-zone")[0]).removeClass("tsr-display-none");
			if (ai == '' || si == '') {
				generate_this_time_zone();
			}else{
				console.log("this");
				generate_this_time_zone(ai, si);
			}
		});

		document.getElementsByName("alang_zone")[0].addEventListener("change", () => {
			let ai = document.getElementsByName("alang_zone")[0].value,
				si = document.getElementsByName("atime_zone")[0].value;
			
			$(document.getElementsByClassName("load-search-zone")[0]).removeClass("tsr-display-none");
			if (ai == '' || si == '') {
				generate_this_time_zone();
			}else{
				generate_this_time_zone(ai, si);
			}
		});
	</script>