	/* 
	
		Timonix Arads
		system zarządzania serwisami timonix.pl
		di_Timonix
		
		Skrypty do zarządzania statusem pracy
	
	*/
		
	function arads_job_status (s = 100, ts = null) {
		
		if (storageAvailable('localStorage')) {
		
			let si1 = window.setInterval(function () {
				
				let st = localStorage;
				
				let t = st.getItem("stanowisko");
				
				if (t) {
					if(is_json(t)){
						// konwertowanie json to string
						rt = JSON.parse(t);
						
						if (rt[0]["status_pracownika"] === "pracuje") {
							let c = $(document).find(".arads-job-status").find(".tsr-modal");
							$(document).find(".arads-job-status").removeClass("background-black").removeClass("background-orange").removeClass("background-red").addClass("background-green").text("pracuje").append(c);
						}else if (rt[0]["status_pracownika"] === "zakończona") {
							let c = $(document).find(".arads-job-status").find(".tsr-modal");
							$(document).find(".arads-job-status").removeClass("background-black").removeClass("background-green").removeClass("background-red").addClass("background-orange").text("zakończona").append(c);
						}else if (rt[0]["status_pracownika"] === "przerwano") {
							let c = $(document).find(".arads-job-status").find(".tsr-modal");
							$(document).find(".arads-job-status").removeClass("background-black").removeClass("background-green").removeClass("background-orange").addClass("background-red").text("przerwano").append(c);
						}
						
						// if ($(document).find(".stanowiskoizespol").find(".tsr-alert").length != 0) {
							// $(document).find(".stanowiskoizespol").html('<section class="tsr fs-70"> <span> zespuł: '+ rt[0]["zespol"].replaceAll(",",", ") +' </span> </section>');
						// }else{
							// $(document).find(".stanowiskoizespol").append('<section class="tsr fs-70 tsr-mt-10"> <span> zespuł: '+ rt[0]["zespol"].replaceAll(",",", ") +' </span> </section>');
						// }
						
						clearInterval(si1);
					}
				}else{
					$(document).find(".arads-job-status").html('<section class="tsr-alert tsr-alert-error"> Błąd analizy! </section>');
				}
			}, s);
		
		}
		
	};
	
	$(document).on("click", "#job_status_submit", function (Event) {
		console.log($(this).closest("#edit_job_status_option").find('select[name="job-status-change"]').val());
		
		if ($(this).closest("#edit_job_status_option").find('select[name="job-status-change"]').val().trim().length === 0) {
			let a = $(document).find(".tsr-modal-active").closest("#edit_job_status_option").find(".contajner_post").append('<section class="tsr-alert tsr-alert-error"> Błędne dane! </section>');
			$(a[0]).find(".tsr-alert").delay(100).animate({opacity: "0"}, 1000).delay(100).hide(50, function () { $(this).remove(); });
		}else{
			
			//let ty = navigator.geolocation.getCurrentPosition(function (t) { return t })
			navigator.geolocation.getCurrentPosition(function (t) {console.log(JSON.stringify({latitude: t.coords.latitude, longitude: t.coords.longitude}))});
			navigator.geolocation.getCurrentPosition(function (t) {window.apos = t});
			
			setTimeout(() => {
				let t = tsr_ajax ("insert/update/job-status.php", {job_status: $(this).closest("#edit_job_status_option").find('select[name="job-status-change"]').val().trim(), pos: window.apos}, "", false, function (t) {
					
					if(is_json(t)){
						// konwertowanie json to string
						rt = JSON.parse(t);
						
						if (rt["type"] == "status/404") {
							let a = $(document).find(".tsr-modal-active").find("#edit_job_status_option").find(".contajner_post").append('<section class="tsr-alert tsr-alert-error"> '+ rt["message"] +' </section>');
							$(a[0]).find(".tsr-alert").delay(100).animate({opacity: "0"}, 1000).delay(100).hide(50, function () { $(this).remove(); });
							arads_cache({arads_cache: {load: "stanowisko"}}, 2, function(t) {
								 arads_job_status ();
							}, true, "update");
							return true;
						}else if(rt["type"] == "status/200") {
							let a = $(document).find(".tsr-modal-active").find("#edit_job_status_option").find(".contajner_post").append('<section class="tsr-alert tsr-alert-normal"> '+ rt["message"] +'! </section>');
							$(a[0]).find(".tsr-alert").delay(100).animate({opacity: "0"}, 1000).delay(100).hide(50, function () { $(this).remove(); });
							
							arads_cache({arads_cache: {load: "stanowisko"}}, 2, function(t) {
								 arads_job_status ();
							}, true, "update");
							
							return true;
						}else{
							let a = $(document).find(".tsr-modal-active").find("#edit_job_status_option").find(".contajner_post").append('<section class="tsr-alert tsr-alert-info"> '+ rt["message"] +' </section>');
							$(a[0]).find(".tsr-alert").delay(100).animate({opacity: "0"}, 1000).delay(100).hide(50, function () { $(this).remove(); });
							arads_cache({arads_cache: {load: "stanowisko"}}, 2, function(t) {
								 arads_job_status ();
							}, true, "update");
							return false;
						}
					}else{
						let a = $(document).find(".tsr-modal-active").find("#edit_job_status_option").find(".contajner_post").append('<section class="tsr-alert tsr-alert-warning"> Błędny format odpowiedzi serwera! </section>');
						console.log(a, a[0].previousSibling);
						$(a[0]).find(".tsr-alert").delay(100).animate({opacity: "0"}, 1000).delay(100).hide(50, function () { $(this).remove(); });;
						return false;
					}
					
				});
				
				if (t == false) {
					let a = $(document).find(".tsr-modal-active").find("#edit_job_status_option").find(".contajner_post").append('<section class="tsr-alert tsr-alert-error"> Wystąpił błąd pod czas poałączenia z serverem! </section>');
					$(a[0]).find(".tsr-alert").delay(100).animate({opacity: "0"}, 1000).delay(100).hide(50, function () { $(this).remove(); });
				}
			});
		}
	});	