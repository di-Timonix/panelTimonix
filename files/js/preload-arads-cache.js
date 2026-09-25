	/* 
	
		Timonix Arads
		system zarządzania serwisami timonix.pl
		di_Timonix
		
		Skrypt zarządza cache panelu arads
	
	*/
	
	setTimeout(function () {
		var chc = 0;
		
		arads_cache({arads_cache: {load: "aplikacja"}}, 2*24, function(t) {
			chc++;
		});
		arads_cache({arads_cache: {load: "stanowisko"}}, 2*24, function(t) {
			chc++;
			setTimeout(function () {
				arads_cache({arads_cache: {load: "stanowisko"}}, 2, function(t) {
					console.log("up");
					arads_panel (0 ,"NaN");
					arads_job_status ();
				}, true, "update", 5 * 60 * 1000);
			}, 4444);
		});
		arads_cache({arads_cache: {load: "arads_us"}}, 2*24, function(t) {
			chc++;
		});
		arads_cache({arads_cache: {load: "zadania"}}, 2*24, function(t) {
			chc++;
			setTimeout(function () {
				arads_cache({arads_cache: {load: "zadania"}}, 2, function(t) {
					console.log("up");
					arads_panel (0 ,"NaN");
				}, true, "update", 1 * 60 * 1000);
			}, 4444);
		});
		
		console.log(chc);
	}, 4444);