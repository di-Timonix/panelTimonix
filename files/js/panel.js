	/* 
	
		Timonix Arads
		system zarządzania serwisami timonix.pl
		di_Timonix
		
		Skrypty do zarządzania panelem i głównymi skryptami
	
	*/
		
	function arads_panel(s = 100, ts = null) {
		
		if (storageAvailable('localStorage')) {
			
			if (ts != null) {
				$(document).find(".stanowiskoizespol").html('<section class="tsr-alert tsr-alert-info"> Brak danych </section>');
			}
			if (ts != null) {
				$(document).find(".panelzadanie").html('<section class="tsr-alert tsr-alert-info"> Brak danych </section>');
			}
		
			let si1 = window.setInterval(function () {
				
				let st = localStorage;
				
				let t = st.getItem("arads_us");
				
				if (t) {
					if(is_json(t)){
						// konwertowanie json to string
						rt = JSON.parse(t);
						
						if ($(document).find(".stanowiskoizespol").find(".tsr-alert").length != 0) {
							$(document).find(".stanowiskoizespol").html('<section class="tsr fs-70"> <span> zespuł: '+ rt[0]["zespol"].replaceAll(",",", ") +' </span> </section>');
						}else{
							$(document).find(".stanowiskoizespol").append('<section class="tsr fs-70 tsr-mt-10"> <span> zespuł: '+ rt[0]["zespol"].replaceAll(",",", ") +' </span> </section>');
						}
						
						clearInterval(si1);
					}
				}
			}, s);
			
			let si2 = window.setInterval(function () {
				let st = localStorage;
				
				let t = st.getItem("stanowisko");
				
				if (t) {
					if(is_json(t)){
						// konwertowanie json to string
						rt = JSON.parse(t);
						
						if ($(document).find(".stanowiskoizespol").length != 0) {
							if ($(document).find(".stanowiskoizespol").find(".tsr-alert").length != 0) {
								$(document).find(".stanowiskoizespol").html('<section class="tsr fs-70"> <span> stanowisko: '+ rt[0]["stanowisko"] +' </span> </section> <section class="tsr fs-60"> <span> status: '+ rt[0]["status_pracownika"] +' </span> </section>');
							}else{
								$(document).find(".stanowiskoizespol").append('<section class="tsr fs-70 tsr-mt-10"> <span> stanowisko: '+ rt[0]["stanowisko"] +' </span> </section>  <section class="tsr fs-60"> <span> status: '+ rt[0]["status_pracownika"] +' </span> </section>');
							}
						}
						
						clearInterval(si2);
					}
				}
			}, s);
			
			let si3 = window.setInterval(function () {
				let st = localStorage;
				
				let t = st.getItem("zadania");
				
				if (t) {
					if(is_json(t)){
						// konwertowanie json to string
						rt = JSON.parse(t);
						for (let i = 0; i < rt.length; i++) {
							if ($(document).find(".panelzadanie").find(".tsr-alert").length != 0) {
								$(document).find(".panelzadanie").html('<section class="tsr fs-70"> <a href="/works?z='+ rt[i]["id_projektu"] +'" class="tsr-zmiana-aurl"> <span> '+ rt[i]["tytul"] +' </span> </a> </section>');
							}else{
								$(document).find(".panelzadanie").append('<section class="tsr fs-70 tsr-mt-10"> <a href="/works?z='+ rt[i]["id_projektu"] +'" class="tsr-zmiana-aurl"> <span> '+ rt[i]["tytul"] +' </span> </a> </section>');
							}
						}
						
						clearInterval(si3);
					}
				}
			}, s);
		
		}
		
	};